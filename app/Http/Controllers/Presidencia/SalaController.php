<?php

namespace App\Http\Controllers\Presidencia;

use App\Exports\SalaExameExport;
use App\Exports\SalaNotasExport;
use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::withCount('candidaturas')->orderBy('nome')->get();

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
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
        ));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        return view('presidencia.salas.show', compact('sala', 'candidaturas'));
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function pdfExame(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        $pdf = Pdf::loadView('pdf.sala-exame', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('lista-exame-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        return Excel::download(new SalaExameExport($sala),
            'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    public function excelNotas(Sala $sala)
    {
        return Excel::download(new SalaNotasExport($sala),
            'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx');
    }
}
