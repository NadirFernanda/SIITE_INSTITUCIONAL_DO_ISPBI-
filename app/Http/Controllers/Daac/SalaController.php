<?php

namespace App\Http\Controllers\Daac;

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
        return view('daac.salas.index', compact('salas'));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        return view('daac.salas.show', compact('sala', 'candidaturas'));
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))->setPaper('a4', 'portrait');
        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        return Excel::download(new SalaExameExport($sala), 'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    public function excelNotas(Sala $sala)
    {
        return Excel::download(new SalaNotasExport($sala), 'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx');
    }
}
