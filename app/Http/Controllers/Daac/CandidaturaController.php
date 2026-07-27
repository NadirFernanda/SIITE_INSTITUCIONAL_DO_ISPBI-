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
        $query = Candidatura::query()
            ->where('pagamento_confirmado', true)
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($r) use ($q) {
                $r->where('nome', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('bi', 'like', "%{$q}%");
                if (is_numeric($q)) $r->orWhere('id', (int) $q);
            });
        }

        $candidaturas = $query->paginate(20)->withQueryString();

        $totais = [
            'por_assinar' => Candidatura::where('pagamento_confirmado', true)->whereNull('assinado_em')->count(),
            'concluida'   => Candidatura::where('status', 'concluida')->count(),
            'total'       => Candidatura::where('pagamento_confirmado', true)->count(),
        ];

        return view('daac.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        return view('daac.candidaturas.show', compact('candidatura'));
    }

    public function downloadComprovativo(Candidatura $candidatura)
    {
        AuditLog::registar('imprimiu_comprovativo', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        return $pdf->download('comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf');
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

        try {
            Mail::to($candidatura->email)
                ->send(new ComprovatvioConcluido($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de comprovativo concluído: ' . $e->getMessage());
        }

        try {
            app(WhatsAppService::class)->notificarAssinaturaDAAC($candidatura);
        } catch (\Throwable $e) {
            \Log::error('WhatsApp assinatura DAAC: ' . $e->getMessage());
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

        $pdf = Pdf::loadView('pdf.folha-prova', compact('candidatura'))
                  ->setPaper('a4', 'portrait')
                  ->setOption('margin-top', 0)
                  ->setOption('margin-bottom', 0)
                  ->setOption('margin-left', 0)
                  ->setOption('margin-right', 0);

        AuditLog::registar('baixou_folha_prova', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        return $pdf->download('folha-prova-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '-' . \Str::slug($candidatura->nome) . '.pdf');
    }

    public function downloadFolhasProvaLote(Request $request)
    {
        $request->validate([
            'sala_id' => 'nullable|exists:salas,id',
            'curso'   => 'nullable|string|max:255',
        ]);

        $query = Candidatura::where('pagamento_confirmado', true)
                             ->whereNotIn('status', ['rejeitada']);

        if ($request->filled('sala_id')) {
            $query->where('sala_id', $request->input('sala_id'));
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        $candidaturas = $query->orderBy('numero_lugar')->get();

        if ($candidaturas->isEmpty()) {
            return back()->with('error', 'Nenhum candidato encontrado com os filtros aplicados.');
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
            $filtro = '-sala-' . \Str::slug($sala->nome);
        } elseif ($request->filled('curso')) {
            $filtro = '-curso-' . \Str::slug($request->input('curso'));
        }

        AuditLog::registar('baixou_folhas_prova_lote', null, null,
            "Lote de {$candidaturas->count()} folhas de prova {$filtro}");

        return $pdf->download('folhas-prova-lote-' . now()->format('YmdHis') . $filtro . '.pdf');
    }
}
