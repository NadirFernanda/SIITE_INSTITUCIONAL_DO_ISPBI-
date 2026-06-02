<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RelatorioController extends Controller
{
    /** Página de relatórios — filtros + tabela */
    public function index(Request $request, string $layout = 'layouts.admin')
    {
        $query = Candidatura::query()->orderByDesc('created_at');

        // ── Filtros ──────────────────────────────────────────────────────────
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($r) use ($q) {
                $r->where('nome',                    'like', "%{$q}%")
                  ->orWhere('bi',                    'like', "%{$q}%")
                  ->orWhere('email',                 'like', "%{$q}%")
                  ->orWhere('telefone',              'like', "%{$q}%")
                  ->orWhere('escola_origem',         'like', "%{$q}%")
                  ->orWhere('naturalidade_provincia','like', "%{$q}%")
                  ->orWhere('naturalidade_municipio','like', "%{$q}%")
                  ->orWhere('residencia_municipio',  'like', "%{$q}%");
                if (is_numeric($q)) $r->orWhere('id', (int) $q);
            });
        }

        foreach (['status','periodo','sexo','curso','estado_financeiro','naturalidade_provincia'] as $filtro) {
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
        $query = Candidatura::query()->orderByDesc('created_at');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($r) use ($q) {
                $r->where('nome','like',"%{$q}%")->orWhere('bi','like',"%{$q}%")
                  ->orWhere('email','like',"%{$q}%");
            });
        }
        foreach (['status','periodo','sexo','curso','estado_financeiro','naturalidade_provincia'] as $filtro) {
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
                '"' . str_replace('"','""',$c->nome) . '"',
                '"' . str_replace('"','""',$c->bi ?? '') . '"',
                $c->sexo ? ucfirst($c->sexo) : '',
                $c->data_nascimento ? $c->data_nascimento->format('d/m/Y') : '',
                '"' . str_replace('"','""',collect([$c->naturalidade_municipio,$c->naturalidade_provincia])->filter()->implode(', ')) . '"',
                '"' . str_replace('"','""',collect([$c->residencia_bairro,$c->residencia_municipio])->filter()->implode(', ')) . '"',
                '"' . str_replace('"','""',$c->telefone ?? '') . '"',
                '"' . str_replace('"','""',$c->email ?? '') . '"',
                '"' . str_replace('"','""',$c->curso) . '"',
                $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular',
                '"' . str_replace('"','""',$c->habilitacoes ?? '') . '"',
                '"' . str_replace('"','""',$c->escola_origem ?? '') . '"',
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
