<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use Illuminate\Http\Request;
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
        return view('admin.candidaturas.show', compact('candidatura'));
    }

    public function updateStatus(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'status'      => 'required|in:pendente,em_analise,aprovada,rejeitada',
            'notas_admin' => 'nullable|string|max:2000',
        ]);

        $candidatura->update($request->only('status', 'notas_admin'));

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
        ]);

        $data = $request->only([
            'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
            'naturalidade_municipio', 'naturalidade_provincia',
            'bi', 'bi_emitido_em', 'bi_data_emissao',
            'sexo', 'estado_civil', 'necessidade_especial',
            'residencia_municipio', 'residencia_bairro',
            'telefone', 'telefone2', 'email',
            'habilitacoes', 'escola_origem', 'ano_conclusao',
            'estado_financeiro', 'instituicao_laboral', 'curso', 'periodo',
        ]);
        $data['trabalhador'] = $request->input('trabalhador') === 'sim';

        $candidatura->update($data);

        return redirect()->route('admin.candidaturas.show', $candidatura)
            ->with('success', 'Candidatura actualizada com sucesso.');
    }

    public function destroy(Candidatura $candidatura)
    {
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
