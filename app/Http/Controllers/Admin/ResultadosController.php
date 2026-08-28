<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Models\CursoVaga;
use App\Services\AdmissaoService;
use Illuminate\Http\Request;

/**
 * Cálculo de resultados de admissão (admitido/não admitido) por curso e
 * período, com base na nota de exame e nas vagas configuradas. Não confundir
 * com App\Http\Controllers\ResultadosController (placeholder da página
 * pública /resultados, que liga a um portal externo de terceiros).
 */
class ResultadosController extends Controller
{
    public function index()
    {
        $linhas = [];

        foreach (Candidatura::$cursos as $curso) {
            foreach (Candidatura::periodosPermitidos($curso) as $periodo) {
                $vagas = (int) (CursoVaga::where('curso', $curso)->where('periodo', $periodo)->value('vagas') ?? 0);

                $baseQuery = Candidatura::where('curso', $curso)->where('periodo', $periodo)
                    ->where('pagamento_confirmado', true);

                $linhas[] = [
                    'curso' => $curso,
                    'periodo' => $periodo,
                    'vagas' => $vagas,
                    'totalCandidatos' => (clone $baseQuery)->count(),
                    'calculado' => (clone $baseQuery)->whereNotNull('resultado_admissao')->exists(),
                    'admitidos' => (clone $baseQuery)->where('resultado_admissao', 'admitido')->count(),
                ];
            }
        }

        return view('admin.resultados.index', compact('linhas'));
    }

    public function actualizarVagas(Request $request)
    {
        $dados = $request->validate([
            'vagas' => ['required', 'array'],
            'vagas.*' => ['nullable', 'integer', 'min:0'],
        ]);

        foreach ($dados['vagas'] as $chave => $valor) {
            [$curso, $periodo] = explode('|', $chave, 2);

            CursoVaga::updateOrCreate(
                ['curso' => $curso, 'periodo' => $periodo],
                ['vagas' => (int) $valor]
            );
        }

        return back()->with('success', 'Vagas actualizadas.');
    }

    public function calcular(Request $request, AdmissaoService $admissaoService)
    {
        $dados = $request->validate([
            'curso' => ['required', 'string'],
            'periodo' => ['required', 'string'],
        ]);

        $admissaoService->calcular($dados['curso'], $dados['periodo']);

        return redirect()->route('admin.resultados.show', $dados)
            ->with('success', 'Resultados calculados.');
    }

    public function show(Request $request)
    {
        $curso = $request->query('curso');
        $periodo = $request->query('periodo');

        abort_unless(in_array($curso, Candidatura::$cursos, true), 404);
        abort_unless(in_array($periodo, Candidatura::periodosPermitidos($curso), true), 404);

        $vagas = (int) (CursoVaga::where('curso', $curso)->where('periodo', $periodo)->value('vagas') ?? 0);

        $candidatos = Candidatura::where('curso', $curso)->where('periodo', $periodo)
            ->where('pagamento_confirmado', true)
            ->orderByRaw('nota_exame IS NULL, nota_exame DESC')
            ->orderBy('id')
            ->get();

        $grupos = array_merge(Candidatura::categoriasEspeciaisPermitidas($curso), ['Geral']);
        $resumoGrupos = [];

        foreach ($grupos as $grupo) {
            $doGrupo = $candidatos->filter(function ($c) use ($grupo) {
                $categoriaCandidato = ($c->necessidade_especial && $c->necessidade_especial !== 'Nenhuma')
                    ? $c->necessidade_especial
                    : 'Geral';

                return $categoriaCandidato === $grupo;
            });

            $admitidosGrupo = $doGrupo->where('resultado_admissao', 'admitido');

            $resumoGrupos[$grupo] = [
                'total' => $doGrupo->count(),
                'admitidos' => $admitidosGrupo->count(),
                'nota_corte' => $admitidosGrupo->count() ? $admitidosGrupo->min('nota_exame') : null,
            ];
        }

        return view('admin.resultados.show', compact('curso', 'periodo', 'vagas', 'candidatos', 'resumoGrupos'));
    }
}
