<?php

namespace App\Http\Controllers\Daac;

use App\Http\Controllers\Controller;
use App\Mail\ComprovatvioConcluido;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CandidaturaController extends Controller
{
    public function index(Request $request)
    {
        // DAAC só vê candidaturas com pagamento confirmado pela Secretaria
        // Por assinar primeiro (precisa de acção), assinadas por último — dentro de
        // cada grupo, as mais recentes aparecem primeiro.
        $query = Candidatura::query()
            ->where('pagamento_confirmado', true)
            ->orderByRaw('CASE WHEN assinado_em IS NULL THEN 0 ELSE 1 END')
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        if ($request->boolean('sem_comprovativo')) {
            $query->whereNull('comprovativo_gerado_em');
        }

        if ($request->boolean('whatsapp_falhou')) {
            // Abrange tanto tentativas que falharam como assinadas em que o envio nunca
            // sequer foi tentado (ex.: assinadas antes desta funcionalidade existir).
            $query->whereNotNull('assinado_em')->whereNull('whatsapp_comprovativo_enviado_at');
        }

        if ($request->boolean('whatsapp_enviado')) {
            $query->whereNotNull('whatsapp_comprovativo_enviado_at');
        }

        if ($request->filled('q')) {
            $query->buscaTexto($request->input('q'), ['nome', 'email', 'bi']);
        }

        $candidaturas = $query->paginate(20)->withQueryString();

        if ($request->ajax()) {
            return view('daac.candidaturas._resultados', compact('candidaturas'));
        }

        $totais = [
            'por_assinar'      => Candidatura::where('pagamento_confirmado', true)->whereNull('assinado_em')->count(),
            'concluida'        => Candidatura::where('status', 'concluida')->count(),
            'total'            => Candidatura::where('pagamento_confirmado', true)->count(),
            'sem_comprovativo' => Candidatura::where('pagamento_confirmado', true)->whereNull('comprovativo_gerado_em')->count(),
            'whatsapp_falhou'  => Candidatura::where('pagamento_confirmado', true)->whereNotNull('assinado_em')->whereNull('whatsapp_comprovativo_enviado_at')->count(),
            'whatsapp_enviado' => Candidatura::where('pagamento_confirmado', true)->whereNotNull('whatsapp_comprovativo_enviado_at')->count(),
        ];

        return view('daac.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        return view('daac.candidaturas.show', compact('candidatura'));
    }

    public function downloadComprovativo(Candidatura $candidatura)
    {
        if (! $candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura ainda não foi assinada. Assine primeiro — o comprovativo não foi enviado ao candidato.');
        }

        AuditLog::registar('imprimiu_comprovativo', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        if (! $candidatura->comprovativo_gerado_em) {
            $candidatura->forceFill([
                'comprovativo_gerado_por' => Auth::id(),
                'comprovativo_gerado_em'  => now(),
            ])->save();
        }

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        $filename = 'comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        try {
            app(WhatsAppService::class)->enviarComprovativo($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar comprovativo via WhatsApp (daac): ' . $e->getMessage());
        }

        return $pdf->download($filename);
    }

    public function imprimirPresencialComprovativo(Candidatura $candidatura)
    {
        if (! $candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura ainda não foi assinada. Assine primeiro — o comprovativo não pode ser impresso.');
        }

        AuditLog::registar('imprimiu_comprovativo_presencial', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        $candidatura->forceFill([
            'comprovativo_impresso_presencialmente_por' => Auth::id(),
            'comprovativo_impresso_presencialmente_em'  => now(),
        ])->save();

        if (! $candidatura->comprovativo_gerado_em) {
            $candidatura->forceFill([
                'comprovativo_gerado_por' => Auth::id(),
                'comprovativo_gerado_em'  => now(),
            ])->save();
        }

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        $filename = 'comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->stream($filename);
    }

    public function reenviarComprovativo(Candidatura $candidatura)
    {
        if (! $candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura ainda não foi assinada. Assine primeiro — o comprovativo não foi enviado ao candidato.');
        }

        try {
            $sucesso = app(WhatsAppService::class)->enviarComprovativo($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao reenviar comprovativo via WhatsApp (daac): ' . $e->getMessage());
            $sucesso = false;
        }

        if ($sucesso) {
            return back()->with('success', "Comprovativo reenviado com sucesso para {$candidatura->nome} via WhatsApp.");
        }

        return back()->with('error', "Não foi possível enviar o comprovativo a {$candidatura->nome} via WhatsApp. Verifique o número de telefone e tente novamente.");
    }

    public function assinar(Request $request, Candidatura $candidatura)
    {
        if ($candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura já foi assinada.');
        }

        $request->validate([
            'confirmar' => 'required|accepted',
        ], [
            'confirmar.accepted' => 'Confirme que pretende assinar digitalmente esta candidatura.',
        ]);

        // Código único: hash dos dados + utilizador autenticado + timestamp
        $codigo = strtoupper(substr(
            hash('sha256',
                $candidatura->id . '|' .
                $candidatura->bi . '|' .
                $candidatura->nome . '|' .
                Auth::id() . '|' .
                Auth::user()->name . '|' .
                now()->toIso8601String() . '|' .
                Str::random(16)
            ),
            0, 16
        ));

        $candidatura->update([
            'status'            => 'concluida',
            'assinado_por'      => Auth::id(),
            'assinado_em'       => now(),
            'assinatura_codigo' => $codigo,
        ]);

        AuditLog::registar('assinou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso}) | Código: {$codigo}");

        // Email é opcional na candidatura — só enviar se o candidato tiver indicado um
        if ($candidatura->email) {
            try {
                // Enfileirar o e-mail para resposta rápida no frontend (requer queue worker configurado)
                Mail::to($candidatura->email)->queue(new ComprovatvioConcluido($candidatura));
            } catch (\Throwable $e) {
                \Log::error('Falha ao enfileirar email de comprovativo concluído: ' . $e->getMessage());
            }
        }

        try {
            // Despachar uma job para notificar via WhatsApp de forma assíncrona (reduz latency)
            \App\Jobs\NotifyWhatsAppAssinatura::dispatch($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao despachar job WhatsApp assinatura DAAC: ' . $e->getMessage());
        }

        return redirect()->route('daac.candidaturas.show', $candidatura)
            ->with('success', "Candidatura assinada por " . Auth::user()->name . ". Código: {$codigo}");
    }

    public function rejeitar(Request $request, Candidatura $candidatura)
    {
        if ($candidatura->isAssinada()) {
            return back()->with('error', 'Não é possível rejeitar uma candidatura já assinada.');
        }

        $request->validate([
            'motivo_rejeicao' => 'required|string|max:1000',
        ], [
            'motivo_rejeicao.required' => 'Indique o motivo da rejeição.',
        ]);

        $nota = "[Rejeitado por " . Auth::user()->name . " em " . now()->format('d/m/Y H:i') . "]\n" .
                $request->input('motivo_rejeicao');

        $candidatura->update([
            'status'      => 'rejeitada',
            'notas_admin' => $nota,
        ]);

        AuditLog::registar('rejeitou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        return redirect()->route('daac.candidaturas.index')
            ->with('success', "Candidatura de {$candidatura->nome} rejeitada por " . Auth::user()->name . ".");
    }

    public function downloadFolhaProva(Candidatura $candidatura)
    {
        // Apenas candidaturas com pagamento confirmado
        if (!$candidatura->pagamento_confirmado) {
            return back()->with('error', 'Apenas candidaturas com pagamento confirmado podem ter folhas de prova impressas.');
        }

        // Permitir impressão apenas uma vez
        if ($candidatura->folha_impressa_em) {
            $user = optional(\App\Models\User::find($candidatura->folha_impressa_por))->name;
            $when = $candidatura->folha_impressa_em->format('d/m/Y H:i');
            return back()->with('error', "Folha de prova já foi impressa em {$when} por " . ($user ?? 'DAAC') . ".");
        }

        $pdf = Pdf::loadView('pdf.folha-prova', compact('candidatura'))
                  ->setPaper('a4', 'portrait')
                  ->setOption('margin-top', 0)
                  ->setOption('margin-bottom', 0)
                  ->setOption('margin-left', 0)
                  ->setOption('margin-right', 0);

        AuditLog::registar('baixou_folha_prova', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        // Marcar como impressa antes de devolver o PDF (atomic enough for this flow)
        try {
            $candidatura->update([
                'folha_impressa_por' => \Auth::id(),
                'folha_impressa_em'  => now(),
            ]);
            AuditLog::registar('imprimiu_folha_prova', 'candidatura', $candidatura->id,
                "Imprimiu folha de prova — Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");
        } catch (\Throwable $e) {
            \Log::error('Falha ao marcar folha imprima como impressa: ' . $e->getMessage());
        }

        return $pdf->download('folha-prova-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '-' . \Str::slug($candidatura->nome) . '.pdf');
    }

    public function downloadFolhasProvaLote(Request $request)
    {
        $request->validate([
            'sala_id' => 'nullable|exists:salas,id',
            'curso'   => 'nullable|string|max:255',
            'horario' => ['nullable', \Illuminate\Validation\Rule::in(\App\Models\Sala::$horarios)],
        ]);

        $query = Candidatura::where('pagamento_confirmado', true)
                             ->whereNotIn('status', ['rejeitada']);

        if ($request->filled('sala_id')) {
            $query->where('sala_id', $request->input('sala_id'));
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        // Imprimir todas as salas de um horário de uma vez — para o DAAC ir
        // imprimindo horário a horário, em vez de sala a sala.
        if ($request->filled('horario')) {
            $query->whereHas('sala', function ($q) use ($request) {
                $q->where('horario', $request->input('horario'));
            });
        }

        $totalNoFiltro = (clone $query)->count();

        // Cada folha só pode ser impressa uma vez — seja individualmente ou em lote.
        // Excluir do lote quem já tenha sido impresso antes (por esta via ou pela
        // individual), para nunca sair uma segunda via da mesma folha de exame.
        $query->whereNull('folha_impressa_em');

        // Agrupado por sala (nome) e depois por lugar — para um lote que abranja
        // várias salas do mesmo horário sair organizado sala a sala na impressão,
        // em vez de intercalado (numero_lugar não é único entre salas diferentes).
        $candidaturas = $query->with('sala')->get()->sortBy(function ($c) {
            return sprintf('%s|%05d', $c->sala?->nome ?? '', $c->numero_lugar ?? 0);
        })->values();

        if ($candidaturas->isEmpty()) {
            $mensagem = $totalNoFiltro > 0
                ? 'Todas as folhas de prova deste filtro já tinham sido impressas anteriormente.'
                : 'Nenhum candidato encontrado com os filtros aplicados.';
            return back()->with('error', $mensagem);
        }

        // Criar PDF com múltiplas páginas
        $html = '';
        foreach ($candidaturas as $candidatura) {
            $view = \View::make('pdf.folha-prova', compact('candidatura'))->render();
            $html .= $view . '<div style="page-break-after: always;"></div>';
        }

        $pdf = Pdf::loadHTML($html)
                  ->setPaper('a4', 'portrait')
                  ->setOption('margin-top', 0)
                  ->setOption('margin-bottom', 0)
                  ->setOption('margin-left', 0)
                  ->setOption('margin-right', 0);

        $filtro = '';
        if ($request->filled('sala_id')) {
            $sala = \App\Models\Sala::find($request->input('sala_id'));
            $filtro .= '-sala-' . \Str::slug($sala->nome);
        }
        if ($request->filled('curso')) {
            $filtro .= '-curso-' . \Str::slug($request->input('curso'));
        }
        if ($request->filled('horario')) {
            $filtro .= '-horario-' . \Str::slug($request->input('horario'));
        }

        // Marcar todas como impressas ANTES de devolver o PDF, para nunca poderem
        // ser reimpressas — nem individualmente, nem noutro lote.
        Candidatura::whereIn('id', $candidaturas->pluck('id'))->update([
            'folha_impressa_por' => Auth::id(),
            'folha_impressa_em'  => now(),
        ]);

        AuditLog::registar('baixou_folhas_prova_lote', null, null,
            "Lote de {$candidaturas->count()} folhas de prova {$filtro}");

        return $pdf->download('folhas-prova-lote-' . now()->format('YmdHis') . $filtro . '.pdf');
    }
}
