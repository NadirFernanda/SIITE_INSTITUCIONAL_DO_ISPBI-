<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CandidaturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidatura::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }
        if ($request->filled('periodo')) {
            $query->where('periodo', $request->input('periodo'));
        }
        if ($request->filled('local_inscricao')) {
            $query->where('local_inscricao', $request->input('local_inscricao'));
        }
        if ($request->filled('q')) {
            $q = $request->input('q');
            // Se for número, pesquisa também pelo ID (número de ficha)
            $query->where(function ($r) use ($q) {
                $r->where('nome',                    'like', "%{$q}%")
                  ->orWhere('email',                 'like', "%{$q}%")
                  ->orWhere('bi',                    'like', "%{$q}%")
                  ->orWhere('telefone',              'like', "%{$q}%")
                  ->orWhere('telefone2',             'like', "%{$q}%")
                  ->orWhere('escola_origem',         'like', "%{$q}%")
                  ->orWhere('estado_civil',          'like', "%{$q}%")
                  ->orWhere('naturalidade_municipio','like', "%{$q}%")
                  ->orWhere('naturalidade_provincia','like', "%{$q}%")
                  ->orWhere('residencia_municipio',  'like', "%{$q}%")
                  ->orWhere('residencia_bairro',     'like', "%{$q}%")
                  ->orWhere('filiacao_pai',          'like', "%{$q}%")
                  ->orWhere('filiacao_mae',          'like', "%{$q}%");
                if (is_numeric($q)) {
                    $r->orWhere('id', (int) $q);
                }
            });
        }

        $candidaturas = $query->paginate(20)->withQueryString();
        $totais = [
            'total'      => Candidatura::count(),
            'pendente'   => Candidatura::where('status', 'pendente')->count(),
            'em_analise' => Candidatura::where('status', 'em_analise')->count(),
            'aprovada'   => Candidatura::where('status', 'aprovada')->count(),
            'rejeitada'  => Candidatura::where('status', 'rejeitada')->count(),
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
        AuditLog::registar('imprimiu_comprovativo', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        return $pdf->download('comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf');
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
        $perfilRules = empty($perfisPermitidos)
            ? ['nullable', 'string', 'max:150']
            : ['required', 'string', 'max:150', \Illuminate\Validation\Rule::in($perfisPermitidos)];

        $request->validate([
            'nome'                   => 'required|string|max:255',
            'filiacao_pai'           => 'nullable|string|max:255',
            'filiacao_mae'           => 'nullable|string|max:255',
            'data_nascimento'        => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'naturalidade_municipio' => 'required|string|max:255',
            'naturalidade_provincia' => 'required|string|max:255',
            'bi'                     => 'required|string|max:20',
            'bi_emitido_em'          => 'required|string|max:255',
            'bi_data_emissao'        => 'required|date|before:today',
            'sexo'                   => 'required|in:masculino,feminino',
            'estado_civil'           => 'required|string|max:100',
            'necessidade_especial'   => 'required|string|max:255',
            'residencia_municipio'   => 'required|string|max:255',
            'residencia_bairro'      => 'required|string|max:255',
            'telefone'               => 'required|string|max:50',
            'telefone2'              => 'nullable|string|max:50',
            'email'                  => 'required|email|max:255',
            'habilitacoes'           => 'required|string|max:100',
            'escola_origem'          => 'required|string|max:255',
            'perfil'                 => $perfilRules,
            'ano_conclusao'          => 'required|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'      => 'required|in:maximo,medio,minimo',
            'trabalhador'            => 'required|in:sim,nao',
            'instituicao_laboral'    => 'nullable|required_if:trabalhador,sim|string|max:255',
            'curso'                  => ['required', 'string', 'in:' . implode(',', Candidatura::$cursos),
                \Illuminate\Validation\Rule::unique('candidaturas')->where(fn($q) =>
                    $q->where('bi', $request->input('bi'))->where('periodo', $candidatura->periodo)
                )->ignore($candidatura->id),
            ],
            'periodo'                => 'required|in:regular,pos-laboral',
            'local_inscricao'        => 'required|in:dentro,fora',
        ], [
            'perfil.required' => 'O perfil do curso de origem é obrigatório para o curso seleccionado.',
            'perfil.in'       => "O perfil seleccionado não é compatível com o curso '{$curso}'.",
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

        $candidatura->update($data);

        AuditLog::registar('editou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome}");

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', 'Candidatura actualizada com sucesso.');
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

        $candidaturas = $query->get();

        $csv  = "\xEF\xBB\xBF"; // UTF-8 BOM for Excel
        $csv .= "ID,Nome,Email,Telefone,BI,Data Nascimento,Curso,Escola Origem,Ano Conclusão,Status,Data Candidatura\n";

        foreach ($candidaturas as $c) {
            $csv .= implode(',', [
                $c->id,
                '"' . str_replace('"', '""', $c->nome) . '"',
                '"' . str_replace('"', '""', $c->email) . '"',
                '"' . str_replace('"', '""', $c->telefone) . '"',
                '"' . str_replace('"', '""', $c->bi ?? '') . '"',
                $c->data_nascimento ? $c->data_nascimento->format('d/m/Y') : '',
                '"' . str_replace('"', '""', $c->curso) . '"',
                '"' . str_replace('"', '""', $c->escola_origem ?? '') . '"',
                $c->ano_conclusao ?? '',
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
