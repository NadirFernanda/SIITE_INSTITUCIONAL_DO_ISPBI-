<?php

namespace App\Http\Controllers\Concerns;

use App\Exports\SalaExameExport;
use App\Exports\SalasExameExportLote;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Geração em lote (todas as salas de um horário, num único ficheiro) das
 * listas PDF, PDF Lista de Exame e Excel Lista de Exame — usado pelos perfis
 * que têm permissão para imprimir estas listas individualmente por sala.
 * Poupa ter de descarregar sala a sala quando várias salas partilham o
 * mesmo horário.
 */
trait DownloadsSalasEmLote
{
    /**
     * Salas de um horário com pelo menos um candidato com pagamento confirmado.
     */
    protected function salasDoHorarioComCandidatos(Request $request)
    {
        $request->validate([
            'horario' => ['required', Rule::in(Sala::$horarios)],
        ], [
            'horario.required' => 'Escolha um horário para gerar a lista em lote.',
        ]);

        return Sala::where('horario', $request->input('horario'))
            ->whereHas('candidaturas', fn($q) => $q->where('pagamento_confirmado', true))
            ->ordenadaPorHorario()
            ->get();
    }

    public function pdfLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $html = '';
        foreach ($salas as $sala) {
            $candidaturas = $sala->candidaturas()
                ->where('pagamento_confirmado', true)
                ->orderBy('numero_lugar')
                ->get();
            $html .= \View::make('pdf.sala', compact('sala', 'candidaturas'))->render()
                . '<div style="page-break-after: always;"></div>';
        }

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download('salas-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    public function pdfExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $html = '';
        foreach ($salas as $sala) {
            $candidaturas = $sala->candidaturas()
                ->where('pagamento_confirmado', true)
                ->orderBy('numero_lugar')
                ->get();
            $html .= \View::make('pdf.sala-exame', compact('sala', 'candidaturas'))->render()
                . '<div style="page-break-after: always;"></div>';
        }

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download('lista-exame-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    public function excelExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'lista-exame-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasExameExportLote($salas), $filename);
    }
}
