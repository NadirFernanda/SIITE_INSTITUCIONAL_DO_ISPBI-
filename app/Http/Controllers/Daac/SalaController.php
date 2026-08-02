<?php

namespace App\Http\Controllers\Daac;

use App\Exports\SalaExameExport;
use App\Http\Controllers\Controller;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::query()
            ->withCount(['candidaturas' => function ($query) {
                $query->where('pagamento_confirmado', true);
            }])
            ->withCount(['candidaturas as candidaturas_impressas_count' => function ($query) {
                $query->where('pagamento_confirmado', true)->whereNotNull('folha_impressa_em');
            }])
            ->ordenadaPorHorario()
            ->get()
            ->filter(fn($sala) => $sala->candidaturas_count > 0);

        return view('daac.salas.index', compact('salas'));
    }

    public function show(Sala $sala)
    {
        // A geração/impressão das folhas de prova desta sala usa o mesmo mecanismo
        // por-candidato (candidaturas.folha_impressa_em/_por) da impressão individual
        // — ver Daac\CandidaturaController::downloadFolhasProvaLote(). Isto garante
        // que cada folha só é impressa uma vez, quer seja por sala, quer seja
        // individualmente.
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        return view('daac.salas.show', compact('sala', 'candidaturas'));
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . '.xlsx';
        return Excel::download(new SalaExameExport($sala), $filename);
    }

}
