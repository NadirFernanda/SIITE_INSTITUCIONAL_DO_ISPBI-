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

    /**
     * Logótipo em base64, calculado uma única vez e partilhado por todas as
     * salas do lote (evita reler/recodificar o ficheiro por sala).
     */
    protected function logoBase64ParaLote(): string
    {
        $logoPath = public_path('images/logo.png');

        return (file_exists($logoPath) && filesize($logoPath) > 0)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';
    }

    public function pdfLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        // Um único documento <html>/<body> com o conteúdo de todas as salas
        // — concatenar vários documentos completos (um <html> por sala) é
        // HTML inválido e fazia o dompdf inserir páginas em branco a mais
        // entre salas (testado empiricamente). Ver pdf/_sala-wrapper-lote.
        $logoBase64 = $this->logoBase64ParaLote();
        $conteudo = '';
        foreach ($salas as $i => $sala) {
            $candidaturas = $sala->candidaturas()
                ->where('pagamento_confirmado', true)
                ->orderBy('numero_lugar')
                ->get();
            $conteudo .= \View::make('pdf._sala-conteudo', [
                'sala' => $sala, 'candidaturas' => $candidaturas, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $i === 0,
            ])->render();
        }

        $html = \View::make('pdf._sala-wrapper-lote', ['conteudo' => $conteudo, 'paddingCelula' => '5px 10px'])->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download('salas-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    public function pdfExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $logoBase64 = $this->logoBase64ParaLote();
        $conteudo = '';
        foreach ($salas as $i => $sala) {
            $candidaturas = $sala->candidaturas()
                ->where('pagamento_confirmado', true)
                ->orderBy('numero_lugar')
                ->get();
            $conteudo .= \View::make('pdf._sala-exame-conteudo', [
                'sala' => $sala, 'candidaturas' => $candidaturas, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $i === 0,
            ])->render();
        }

        $html = \View::make('pdf._sala-wrapper-lote', ['conteudo' => $conteudo, 'paddingCelula' => '8px 10px'])->render();
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
