<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use App\Support\CsvSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RelatorioController extends Controller
{
    /** Página de relatórios — filtros + tabela */
    public function index(Request $request, string $layout = 'layouts.admin')
    {
        $query = Candidatura::query()
            ->where('pagamento_confirmado', true)
            ->orderByDesc('created_at');

        // ── Filtros ──────────────────────────────────────────────────────────
        if ($request->filled('q')) {
            $query->buscaTexto($request->input('q'), [
                'nome', 'bi', 'email', 'telefone', 'escola_origem',
                'naturalidade_provincia', 'naturalidade_municipio', 'residencia_municipio',
            ]);
        }

        foreach (['status','periodo','sexo','curso','estado_financeiro','naturalidade_provincia','necessidade_especial'] as $filtro) {
            if ($request->filled($filtro)) {
                $query->where($filtro, $request->input($filtro));
            }
        }

        if ($request->filled('trabalhador')) {
            $query->where('trabalhador', $request->input('trabalhador') === 'sim');
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->input('data_inicio'));
        }
        if ($request->filled('data_fim')) {
            $query->whereDate('created_at', '<=', $request->input('data_fim'));
        }

        if ($request->ajax()) {
            $candidaturas = $query->paginate(50)->withQueryString();
            return view('relatorios._resultados', compact('candidaturas'));
        }

        // ── Estatísticas do resultado filtrado ───────────────────────────────
        $total    = (clone $query)->count();
        $masc     = (clone $query)->where('sexo', 'masculino')->count();
        $fem      = (clone $query)->where('sexo', 'feminino')->count();
        $regular  = (clone $query)->where('periodo', 'regular')->count();
        $posLab   = (clone $query)->where('periodo', 'pos-laboral')->count();

        $candidaturas = $query->paginate(50)->withQueryString();

        $provincias = Candidatura::select('naturalidade_provincia')
            ->distinct()->whereNotNull('naturalidade_provincia')
            ->orderBy('naturalidade_provincia')->pluck('naturalidade_provincia');

        $stats = compact('total','masc','fem','regular','posLab');

        return view('relatorios.index', compact('candidaturas','stats','provincias','layout'));
    }

    /** Export CSV com os mesmos filtros */
    public function export(Request $request)
    {
        $query = Candidatura::query()
            ->where('pagamento_confirmado', true)
            ->orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->buscaTexto($request->input('q'), ['nome', 'bi', 'email']);
        }
        foreach (['status','periodo','sexo','curso','estado_financeiro','naturalidade_provincia','necessidade_especial'] as $filtro) {
            if ($request->filled($filtro)) $query->where($filtro, $request->input($filtro));
        }
        if ($request->filled('trabalhador')) {
            $query->where('trabalhador', $request->input('trabalhador') === 'sim');
        }
        if ($request->filled('data_inicio')) $query->whereDate('created_at', '>=', $request->input('data_inicio'));
        if ($request->filled('data_fim'))    $query->whereDate('created_at', '<=', $request->input('data_fim'));

        $candidaturas = $query->get();

        $csv  = "\xEF\xBB\xBF";
        $csv .= "Ficha,Nome,BI,Sexo,Data Nasc.,Naturalidade,Residência,Telefone,Email,Curso,Período,Habilitações,Escola,Ano Conc.,Est.Financeiro,Trabalhador,Status,Data Candidatura\n";

        foreach ($candidaturas as $c) {
            $csv .= implode(',', [
                str_pad($c->id, 5, '0', STR_PAD_LEFT),
                '"' . str_replace('"','""',CsvSanitizer::safe($c->nome)) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->bi ?? '')) . '"',
                $c->sexo ? ucfirst($c->sexo) : '',
                $c->data_nascimento ? $c->data_nascimento->format('d/m/Y') : '',
                '"' . str_replace('"','""',CsvSanitizer::safe(collect([$c->naturalidade_municipio,$c->naturalidade_provincia])->filter()->implode(', '))) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe(collect([$c->residencia_bairro,$c->residencia_municipio])->filter()->implode(', '))) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->telefone ?? '')) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->email ?? '')) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->curso)) . '"',
                $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->habilitacoes ?? '')) . '"',
                '"' . str_replace('"','""',CsvSanitizer::safe($c->escola_origem ?? '')) . '"',
                $c->ano_conclusao ?? '',
                isset(Candidatura::$statusLabels[$c->estado_financeiro ?? '']) ? Candidatura::$statusLabels[$c->estado_financeiro] : ($c->estado_financeiro ?? ''),
                $c->trabalhador ? 'Sim' : 'Não',
                Candidatura::$statusLabels[$c->status] ?? $c->status,
                $c->created_at->format('d/m/Y H:i'),
            ]) . "\n";
        }

        return Response::make($csv, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="relatorio_candidaturas_' . date('Ymd_Hi') . '.csv"',
        ]);
    }
}
