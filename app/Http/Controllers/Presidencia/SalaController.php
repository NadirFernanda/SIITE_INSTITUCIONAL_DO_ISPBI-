<?php

namespace App\Http\Controllers\Presidencia;

use App\Exports\SalaExameExport;
use App\Exports\SalaNotasExport;
use App\Exports\SalasNotasExportLote;
use App\Http\Controllers\Concerns\DownloadsSalasEmLote;
use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    use DownloadsSalasEmLote;

    public function index(Request $request)
    {
        $cursoFiltro   = $request->query('curso');
        $horarioFiltro = $request->query('horario_filtro');
        $dataFiltro    = $request->query('data_filtro');
        $periodoFiltro = $request->query('periodo_filtro');

        $salasQuery = Sala::query()
            ->withCount(['candidaturas as candidaturas_count' => function ($query) use ($cursoFiltro, $periodoFiltro) {
                $query->where('pagamento_confirmado', true)
                    ->whereNotIn('status', ['rejeitada']);

                if ($cursoFiltro) {
                    $query->where('curso', $cursoFiltro);
                }

                if ($periodoFiltro) {
                    $query->where('periodo', $periodoFiltro);
                }
            }])
            ->ordenadaPorHorario();

        if ($cursoFiltro) {
            $salasQuery->whereHas('candidaturas', fn ($q) => $q->where('pagamento_confirmado', true)->where('curso', $cursoFiltro));
        }
        if ($periodoFiltro) {
            $salasQuery->whereHas('candidaturas', fn ($q) => $q->where('pagamento_confirmado', true)->where('periodo', $periodoFiltro));
        }
        if ($horarioFiltro) {
            $salasQuery->where('horario', $horarioFiltro);
        }
        if ($dataFiltro) {
            $salasQuery->whereDate('data_exame', $dataFiltro);
        }
        $salas = $salasQuery->get();

        $cursosDisponiveis = Candidatura::whereNotIn('status', ['rejeitada'])
            ->whereNotNull('curso')
            ->distinct()
            ->orderBy('curso')
            ->pluck('curso');

        $datasDisponiveis = Sala::whereNotNull('data_exame')
            ->distinct()
            ->orderBy('data_exame')
            ->pluck('data_exame');

        $resumoQuery = \DB::table('candidaturas')
            ->join('salas', 'salas.id', '=', 'candidaturas.sala_id')
            ->selectRaw("candidaturas.curso, candidaturas.periodo, salas.data_exame, salas.horario, COUNT(*) as total")
            ->whereNotIn('candidaturas.status', ['rejeitada']);
        if ($cursoFiltro) {
            $resumoQuery->where('candidaturas.curso', $cursoFiltro);
        }
        if ($periodoFiltro) {
            $resumoQuery->where('candidaturas.periodo', $periodoFiltro);
        }
        if ($horarioFiltro) {
            $resumoQuery->where('salas.horario', $horarioFiltro);
        }
        if ($dataFiltro) {
            $resumoQuery->whereDate('salas.data_exame', $dataFiltro);
        }
        $resumo = $resumoQuery
            ->groupByRaw('candidaturas.curso, candidaturas.periodo, salas.data_exame, salas.horario')
            ->orderBy('salas.data_exame')->orderBy('salas.horario')->orderBy('candidaturas.curso')
            ->get();

        $totalCandidatos = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $atribuidos      = Candidatura::whereNotNull('sala_id')->count();
        $semSala         = $totalCandidatos - $atribuidos;
        $totalLugares    = $salas->sum('capacidade');

        $grupos = \DB::table('candidaturas')
            ->selectRaw("TRIM(curso) as curso,
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END as periodo,
                COUNT(*) as total")
            ->whereNotIn('status', ['rejeitada'])
            ->groupByRaw("TRIM(curso),
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END")
            ->orderByRaw("TRIM(curso),
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END")
            ->get();

        return view('presidencia.salas.index', compact(
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos',
            'cursosDisponiveis', 'cursoFiltro', 'datasDisponiveis', 'horarioFiltro', 'dataFiltro',
            'periodoFiltro', 'resumo'
        ));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();

        $cursoSala = $candidaturas->first()->curso ?? null;
        $categoriasSala = collect(Candidatura::categoriasEspeciaisPermitidas($cursoSala))
            ->filter(fn ($cat) => $candidaturas->contains('necessidade_especial', $cat))
            ->values();

        return view('presidencia.salas.show', compact('sala', 'candidaturas', 'categoriasSala'));
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function pdfExame(Request $request, Sala $sala)
    {
        $necessidadeEspecial = $request->query('necessidade_especial');
        $query = $sala->candidaturas()->where('pagamento_confirmado', true);
        if ($necessidadeEspecial) {
            $query->where('necessidade_especial', $necessidadeEspecial);
        } else {
            $query->where(fn ($q) => $q->whereNull('necessidade_especial')->orWhere('necessidade_especial', 'Nenhuma'));
        }
        $candidaturas = $query->get();
        $pdf = Pdf::loadView('pdf.sala-exame', compact('sala', 'candidaturas', 'necessidadeEspecial'))
                  ->setPaper('a4', 'portrait');
        $sufixo = $necessidadeEspecial ? '-' . \Str::slug($necessidadeEspecial) : '';
        return $pdf->download('lista-exame-' . \Str::slug($sala->nome) . $sufixo . '.pdf');
    }

    public function excelExame(Request $request, Sala $sala)
    {
        $necessidadeEspecial = $request->query('necessidade_especial');
        $sufixo = $necessidadeEspecial ? '-' . \Str::slug($necessidadeEspecial) : '';
        return Excel::download(new SalaExameExport($sala, $necessidadeEspecial, true),
            'lista-exame-' . \Str::slug($sala->nome) . $sufixo . '.xlsx');
    }

    public function excelNotas(Sala $sala)
    {
        return Excel::download(new SalaNotasExport($sala),
            'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx');
    }

    public function excelNotasLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'lancamento-notas-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasNotasExportLote($salas), $filename);
    }
}
