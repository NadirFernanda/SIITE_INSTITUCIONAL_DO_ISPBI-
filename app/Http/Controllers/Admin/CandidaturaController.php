<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use App\Support\CsvSanitizer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CandidaturaController extends Controller
{
    public function index(Request $request)
    {
        // Estados activos primeiro (precisam de acção), concluídas/rejeitadas por
        // último — dentro de cada grupo, as mais recentes aparecem primeiro.
        $query = Candidatura::query()
            ->orderByRaw("CASE WHEN status IN ('concluida','rejeitada') THEN 1 ELSE 0 END")
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }
        if ($request->filled('perfil')) {
            $query->where('perfil', $request->input('perfil'));
        }
        if ($request->filled('periodo')) {
            $query->where('periodo', $request->input('periodo'));
        }
        if ($request->filled('local_inscricao')) {
            $query->where('local_inscricao', $request->input('local_inscricao'));
        }
        // Filtrar por Necessidade de Educação Especial
        if ($request->filled('necessidade_especial')) {
            $query->where('necessidade_especial', $request->input('necessidade_especial'));
        }
        if ($request->filled('q')) {
            $query->buscaTexto($request->input('q'), [
                'nome', 'email', 'bi', 'telefone', 'telefone2', 'escola_origem',
                'estado_civil', 'naturalidade_municipio', 'naturalidade_provincia',
                'residencia_municipio', 'residencia_bairro', 'filiacao_pai', 'filiacao_mae',
            ]);
        }

        if ($request->boolean('sem_recebida')) {
            $query->whereNull('whatsapp_recebida_enviado_at');
        }

        if ($request->boolean('sem_pagamento_whatsapp')) {
            $query->where('pagamento_confirmado', true)->whereNull('whatsapp_pagamento_enviado_at');
        }

        $candidaturas = $query->paginate(20)->withQueryString();

        // Pesquisa ao vivo (AJAX): só a tabela de resultados, sem recalcular os KPIs.
        if ($request->ajax()) {
            return view('admin.candidaturas._resultados', compact('candidaturas'));
        }

        $totais = [
            'total'      => Candidatura::count(),
            'pendente'   => Candidatura::where('status', 'pendente')->count(),
            'em_analise' => Candidatura::where('status', 'em_analise')->count(),
            'aprovada'   => Candidatura::where('status', 'aprovada')->count(),
            'rejeitada'  => Candidatura::where('status', 'rejeitada')->count(),
            'sem_recebida'          => Candidatura::whereNull('whatsapp_recebida_enviado_at')->count(),
            'sem_pagamento_whatsapp' => Candidatura::where('pagamento_confirmado', true)->whereNull('whatsapp_pagamento_enviado_at')->count(),
        ];

        return view('admin.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        $candidatura->load(['notaLancadaPor', 'assinante', 'confirmadoPor']);
        return view('admin.candidaturas.show', compact('candidatura'));
    }

    public function updateNota(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'nota_exame' => 'required|numeric|min:0|max:20',
        ], [
            'nota_exame.required' => 'A nota é obrigatória.',
            'nota_exame.numeric'  => 'A nota deve ser um número.',
            'nota_exame.min'      => 'A nota mínima é 0.',
            'nota_exame.max'      => 'A nota máxima é 20.',
        ]);

        $nota = round((float) $request->input('nota_exame'), 1);
        $candidatura->update([
            'nota_exame'      => $nota,
            'nota_lancada_por' => Auth::id(),
            'nota_lancada_em'  => now(),
        ]);

        AuditLog::registar('lancou_nota', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} | Nota: {$nota}");

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', "Nota {$nota} lançada com sucesso.");
    }

    public function downloadComprovativo(Candidatura $candidatura)
    {
        if (! $candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura ainda não foi assinada pelo DAAC. O comprovativo só pode ser gerado/enviado depois de assinada.');
        }

        AuditLog::registar('imprimiu_comprovativo', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        if (! $candidatura->comprovativo_gerado_em) {
            $candidatura->forceFill([
                'comprovativo_gerado_por' => \Illuminate\Support\Facades\Auth::id(),
                'comprovativo_gerado_em'  => now(),
            ])->save();
        }

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        $filename = 'comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        try {
            app(WhatsAppService::class)->enviarComprovativo($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar comprovativo via WhatsApp (admin): ' . $e->getMessage());
        }

        return $pdf->download($filename);
    }

    public function reenviarRecebida(Candidatura $candidatura)
    {
        try {
            $sucesso = app(WhatsAppService::class)->notificarCandidaturaRecebida($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao reenviar notificação de candidatura recebida: ' . $e->getMessage());
            $sucesso = false;
        }

        if ($sucesso) {
            $candidatura->forceFill([
                'whatsapp_recebida_enviado_at' => now(),
                'whatsapp_recebida_falhou_em'  => null,
            ])->save();
            return back()->with('success', "Mensagem de candidatura recebida reenviada a {$candidatura->nome}.");
        }

        $candidatura->forceFill(['whatsapp_recebida_falhou_em' => now()])->save();
        return back()->with('error', "Não foi possível reenviar a mensagem a {$candidatura->nome}. Verifique o número de telefone e a ligação do WhatsApp.");
    }

    public function reenviarComprovativo(Candidatura $candidatura)
    {
        if (! $candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura ainda não foi assinada. Assine primeiro — o comprovativo não foi enviado ao candidato.');
        }

        try {
            $sucesso = app(WhatsAppService::class)->enviarComprovativo($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao reenviar comprovativo via WhatsApp (admin): ' . $e->getMessage());
            $sucesso = false;
        }

        if ($sucesso) {
            return back()->with('success', "Comprovativo reenviado com sucesso para {$candidatura->nome} via WhatsApp.");
        }

        return back()->with('error', "Não foi possível enviar o comprovativo a {$candidatura->nome} via WhatsApp. Verifique o número de telefone e tente novamente.");
    }

    public function reenviarPagamento(Candidatura $candidatura)
    {
        if (! $candidatura->pagamento_confirmado) {
            return back()->with('error', 'O pagamento desta candidatura ainda não foi confirmado.');
        }

        try {
            $sucesso = app(WhatsAppService::class)->notificarPagamentoConfirmado($candidatura);
        } catch (\Throwable $e) {
            \Log::error('Falha ao reenviar notificação de pagamento confirmado: ' . $e->getMessage());
            $sucesso = false;
        }

        if ($sucesso) {
            $candidatura->forceFill([
                'whatsapp_pagamento_enviado_at' => now(),
                'whatsapp_pagamento_falhou_em'  => null,
            ])->save();
            return back()->with('success', "Mensagem de pagamento confirmado reenviada a {$candidatura->nome}.");
        }

        $candidatura->forceFill(['whatsapp_pagamento_falhou_em' => now()])->save();
        return back()->with('error', "Não foi possível reenviar a mensagem a {$candidatura->nome}. Verifique o número de telefone e a ligação do WhatsApp.");
    }

    public function downloadFolhaProva(Candidatura $candidatura)
    {
        // Ao contrário do DAAC, o admin pode gerar/reimprimir a folha de prova de um
        // candidato quantas vezes for necessário (ex.: substituir uma folha danificada
        // ou perdida) — não há limite de uma única impressão aqui.
        $pdf = Pdf::loadView('pdf.folha-prova', compact('candidatura'))
                  ->setPaper('a4', 'portrait')
                  ->setOption('margin-top', 0)
                  ->setOption('margin-bottom', 0)
                  ->setOption('margin-left', 0)
                  ->setOption('margin-right', 0);

        AuditLog::registar('baixou_folha_prova', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso}) [admin, sem limite]");

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

        // Sem limite de impressão para o admin — inclui todos os candidatos do filtro,
        // independentemente de já terem sido impressos antes (individualmente ou pelo DAAC).
        $candidaturas = $query->orderBy('numero_lugar')->get();

        if ($candidaturas->isEmpty()) {
            return back()->with('error', 'Nenhum candidato encontrado com os filtros aplicados.');
        }

        $html = '';
        foreach ($candidaturas as $c) {
            $view = \View::make('pdf.folha-prova', ['candidatura' => $c])->render();
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
            "Lote de {$candidaturas->count()} folhas de prova {$filtro} [admin, sem limite]");

        return $pdf->download('folhas-prova-lote-' . now()->format('YmdHis') . $filtro . '.pdf');
    }

    public function updateStatus(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'status'      => 'required|in:pendente,em_analise,aprovada,rejeitada',
            'notas_admin' => 'nullable|string|max:2000',
        ]);

        $oldStatus = $candidatura->status;
        $candidatura->update($request->only('status', 'notas_admin'));

        AuditLog::registar('alterou_status', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} {$candidatura->nome}: {$oldStatus} → {$candidatura->status}");

        if ($oldStatus !== $candidatura->status) {
            try {
                app(WhatsAppService::class)->notificarEstadoAlterado($candidatura, $oldStatus);
            } catch (\Throwable $e) {
                \Log::error('WhatsApp estado alterado (admin): ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', 'Estado atualizado com sucesso.');
    }

    public function create()
    {
        return view('admin.candidaturas.create');
    }

    public function store(Request $request)
    {
        $periodo      = $request->input('periodo');
        $periodoLabel = $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';
        $curso        = $request->input('curso');
        $perfisPermitidos = Candidatura::$perfisCurso[$curso] ?? [];
        $perfilRules  = empty($perfisPermitidos)
            ? ['nullable', 'string', 'max:150']
            : ['required', 'string', 'max:150', \Illuminate\Validation\Rule::in($perfisPermitidos)];

        $request->validate([
            'nome'                   => 'required|string|max:255',
            'filiacao_pai'           => 'required|string|max:255',
            'filiacao_mae'           => 'required|string|max:255',
            'data_nascimento'        => 'required|date|after:' . now()->subYears(100)->format('Y-m-d') . '|before_or_equal:' . now()->subYears(17)->endOfYear()->format('Y-m-d'),
            'naturalidade_municipio' => 'required|string|max:255',
            'naturalidade_provincia' => 'required|string|max:255',
            'bi'                     => ['required', 'string', 'size:14', 'regex:/^.{9}[A-Za-z]{2}.{3}$/'],
            'bi_emitido_em'          => 'required|string|max:255',
            'bi_data_emissao'        => 'required|date|before:today',
            'sexo'                   => 'required|in:masculino,feminino',
            'estado_civil'           => 'required|string|max:100',
            'necessidade_especial'   => 'required|string|max:255',
            'residencia_municipio'   => 'required|string|max:255',
            'residencia_bairro'      => 'required|string|max:255',
            'telefone'               => 'required|string|max:50',
            'telefone2'              => 'nullable|string|max:50',
            'email'                  => 'nullable|email|max:255',
            'habilitacoes'           => 'required|string|max:100',
            'escola_origem'          => 'required|string|max:255',
            'perfil'                 => $perfilRules,
            'ano_conclusao'          => 'required|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'      => 'required|in:maximo,medio,minimo',
            'trabalhador'            => 'required|in:sim,nao',
            'instituicao_laboral'    => 'nullable|required_if:trabalhador,sim|string|max:255',
            'curso'                  => [
                'required', 'string', 'in:' . implode(',', Candidatura::$cursos),
                \Illuminate\Validation\Rule::unique('candidaturas')->where(fn($q) =>
                    $q->where('bi', $request->input('bi'))
                      ->where('periodo', $request->input('periodo'))
                ),
            ],
            'periodo'                => ['required', \Illuminate\Validation\Rule::in(Candidatura::periodosPermitidos($curso))],
            'local_inscricao'        => 'required|in:dentro,fora',
        ], [
            'curso.unique'                    => "Já existe uma candidatura com este BI para o curso no período {$periodoLabel}.",
            'bi.size'                         => 'O Bilhete de Identidade deve ter exactamente 14 caracteres.',
            'bi.regex'                        => 'O Bilhete de Identidade deve ter letras na 10ª e 11ª posição (ex.: 024187059BA057).',
            'perfil.required'                 => 'O perfil do curso de origem é obrigatório para o curso seleccionado.',
            'perfil.in'                       => "O perfil seleccionado não é compatível com o curso '{$curso}'.",
            'periodo.in'                      => "O curso '{$curso}' só tem período Regular — não tem Pós-laboral.",
            'data_nascimento.before_or_equal' => 'É necessário completar 17 anos até ao final deste ano.',
            'data_nascimento.after'           => 'A data de nascimento indicada não é válida. Verifique se o ano está correcto.',
        ]);

        $data = $request->only([
            'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
            'naturalidade_municipio', 'naturalidade_provincia',
            'bi', 'bi_emitido_em', 'bi_data_emissao',
            'sexo', 'estado_civil', 'necessidade_especial',
            'residencia_municipio', 'residencia_bairro',
            'telefone', 'telefone2', 'email',
            'habilitacoes', 'escola_origem', 'perfil', 'ano_conclusao',
            'estado_financeiro', 'instituicao_laboral',
            'curso', 'periodo', 'local_inscricao',
        ]);
        $data['trabalhador'] = $request->input('trabalhador') === 'sim';

        try {
            $candidatura = Candidatura::create($data);
        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'curso' => "Já existe uma candidatura com este BI para o curso no período {$periodoLabel}.",
            ]);
        }

        AuditLog::registar('criou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        try {
            \Illuminate\Support\Facades\Mail::to('geral@isp-bie.ao')->send(new \App\Mail\CandidaturaReceived($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de candidatura (admin): ' . $e->getMessage());
        }

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', 'Candidatura registada com sucesso (Ficha n.º ' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . ').');
    }

    public function edit(Candidatura $candidatura)
    {
        return view('candidaturas.edit', [
            'candidatura' => $candidatura,
            'routePrefix' => 'admin',
            'layout'      => 'layouts.admin',
        ]);
    }

    public function update(Request $request, Candidatura $candidatura)
    {
        $request->merge(['bi' => strtoupper(trim($request->input('bi', '')))]);

        $curso = $request->input('curso');
        $perfisPermitidos = Candidatura::$perfisCurso[$curso] ?? [];
        $perfisValidos = array_merge($perfisPermitidos, ['Outro']);
        $perfilRules = empty($perfisPermitidos)
            ? ['nullable', 'string', 'max:150']
            : ['required', 'string', 'max:150', \Illuminate\Validation\Rule::in($perfisValidos)];

        $request->validate([
            'nome'                   => 'required|string|max:255',
            'filiacao_pai'           => 'nullable|string|max:255',
            'filiacao_mae'           => 'nullable|string|max:255',
            'data_nascimento'        => 'required|date|after:' . now()->subYears(100)->format('Y-m-d') . '|before_or_equal:' . now()->subYears(17)->endOfYear()->format('Y-m-d'),
            'naturalidade_municipio' => 'required|string|max:255',
            'naturalidade_provincia' => 'required|string|max:255',
            'bi'                     => ['required', 'string', 'size:14', 'regex:/^.{9}[A-Za-z]{2}.{3}$/'],
            'bi_emitido_em'          => 'required|string|max:255',
            'bi_data_emissao'        => 'required|date|before:today',
            'sexo'                   => 'required|in:masculino,feminino',
            'estado_civil'           => 'required|string|max:100',
            'necessidade_especial'   => 'required|string|max:255',
            'residencia_municipio'   => 'required|string|max:255',
            'residencia_bairro'      => 'required|string|max:255',
            'telefone'               => 'required|string|max:50',
            'telefone2'              => 'nullable|string|max:50',
            'email'                  => 'nullable|email|max:255',
            'habilitacoes'           => 'required|string|max:100',
            'escola_origem'          => 'required|string|max:255',
            'perfil'                 => $perfilRules,
            'ano_conclusao'          => 'required|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'      => 'required|in:maximo,medio,minimo',
            'trabalhador'            => 'required|in:sim,nao',
            'instituicao_laboral'    => 'nullable|required_if:trabalhador,sim|string|max:255',
            'curso'                  => ['required', 'string', 'in:' . implode(',', Candidatura::$cursos),
                \Illuminate\Validation\Rule::unique('candidaturas')->where(fn($q) =>
                    $q->where('bi', $request->input('bi'))->where('periodo', $request->input('periodo'))
                )->ignore($candidatura->id),
            ],
            'periodo'                => ['required', \Illuminate\Validation\Rule::in(Candidatura::periodosPermitidos($curso))],
            'local_inscricao'        => 'required|in:dentro,fora',
        ], [
            'perfil.required' => 'O perfil do curso de origem é obrigatório para o curso seleccionado.',
            'perfil.in'       => "O perfil seleccionado não é compatível com o curso '{$curso}'.",
            'periodo.in'      => "O curso '{$curso}' só tem período Regular — não tem Pós-laboral.",
            'curso.unique'    => 'Já existe uma candidatura com este Bilhete de Identidade para o curso e período indicados.',
            'bi.size'         => 'O Bilhete de Identidade deve ter exactamente 14 caracteres.',
            'bi.regex'        => 'O Bilhete de Identidade deve ter letras na 10ª e 11ª posição (ex.: 024187059BA057).',
            'data_nascimento.before_or_equal' => 'É necessário completar 17 anos até ao final deste ano.',
            'data_nascimento.after'           => 'A data de nascimento indicada não é válida. Verifique se o ano está correcto.',
        ]);

        $data = $request->only([
            'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
            'naturalidade_municipio', 'naturalidade_provincia',
            'bi', 'bi_emitido_em', 'bi_data_emissao',
            'sexo', 'estado_civil', 'necessidade_especial',
            'residencia_municipio', 'residencia_bairro',
            'telefone', 'telefone2', 'email',
            'habilitacoes', 'escola_origem', 'perfil', 'ano_conclusao',
            'estado_financeiro', 'instituicao_laboral', 'curso', 'periodo', 'local_inscricao',
        ]);
        $data['trabalhador'] = $request->input('trabalhador') === 'sim';

        $tinhaSalaAntes = $candidatura->sala_id !== null;

        try {
            $candidatura->update($data);
        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            // Backstop: a validação "unique" acima só protege contra outro registo já
            // existente — não contra uma corrida entre dois pedidos em simultâneo.
            return back()->withInput()->withErrors([
                'curso' => 'Já existe uma candidatura com este Bilhete de Identidade para o curso e período indicados.',
            ]);
        }

        AuditLog::registar('editou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome}");

        $avisoSala = null;
        // Se já tinha sala atribuída e o curso/período mudou, a sala antiga já
        // não é válida para o candidato — tentar realojar automaticamente para
        // uma sala do curso novo, em vez de o deixar preso à sala errada.
        if ($tinhaSalaAntes && $candidatura->wasChanged(['curso', 'periodo'])) {
            $resultado = app(\App\Services\DistribuicaoSalasService::class)->reatribuirCandidato($candidatura);
            $avisoSala = $resultado['mensagem'];
        }

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', 'Candidatura actualizada com sucesso.' . ($avisoSala ? ' ' . $avisoSala : ''));
    }

    public function destroy(Candidatura $candidatura)
    {
        AuditLog::registar('eliminou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        $candidatura->delete();
        return redirect()->route('admin.candidaturas.index')
            ->with('success', 'Candidatura eliminada.');
    }

    public function export(Request $request)
    {
        $query = Candidatura::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }
        if ($request->filled('perfil')) {
            $query->where('perfil', $request->input('perfil'));
        }
        // Aplicar filtro por necessidade_especial também no export
        if ($request->filled('necessidade_especial')) {
            $query->where('necessidade_especial', $request->input('necessidade_especial'));
        }

        $candidaturas = $query->get();

        $csv  = "\xEF\xBB\xBF"; // UTF-8 BOM for Excel
        $csv .= "ID,Nome,Email,Telefone,BI,Data Nascimento,Curso,Escola Origem,Ano Conclusão,Necessidade Especial,Habilitações Literárias,Status,Data Candidatura\n";

        foreach ($candidaturas as $c) {
            $csv .= implode(',', [
                $c->id,
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->nome)) . '"',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->email)) . '"',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->telefone)) . '"',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->bi ?? '')) . '"',
                $c->data_nascimento ? $c->data_nascimento->format('d/m/Y') : '',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->curso)) . '"',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->escola_origem ?? '')) . '"',
                $c->ano_conclusao ?? '',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->necessidade_especial ?? '')) . '"',
                '"' . str_replace('"', '""', CsvSanitizer::safe($c->habilitacoes ?? '')) . '"',
                Candidatura::$statusLabels[$c->status] ?? $c->status,
                $c->created_at->format('d/m/Y H:i'),
            ]) . "\n";
        }

        return Response::make($csv, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="candidaturas_' . date('Ymd_Hi') . '.csv"',
        ]);
    }
}
