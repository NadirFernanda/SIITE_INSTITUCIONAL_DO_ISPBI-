<?php

namespace App\Http\Controllers\Concerns;

use App\Exports\SalaExameExport;
use App\Exports\SalasExameExportLote;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
     * Salas com pelo menos um candidato de um curso, com pagamento confirmado.
     * Diferente do filtro por horário: uma sala pode ter candidatos de mais
     * do que um curso, por isso o curso é filtrado também dentro de cada
     * sala (nas candidaturas), não só na escolha de quais salas entram.
     */
    protected function salasDoCursoComCandidatos(Request $request)
    {
        $request->validate([
            'curso' => ['required', 'string'],
        ], [
            'curso.required' => 'Escolha um curso para gerar a lista em lote.',
        ]);

        $curso = trim($request->input('curso'));

        return Sala::whereHas('candidaturas', function ($q) use ($curso) {
                $q->where('pagamento_confirmado', true)
                    ->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [$curso]);
            })
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

        return $this->gerarPdfExameLote($salas, null, 'lista-exame-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    public function excelExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'pauta-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasExameExportLote($salas), $filename);
    }

    public function pdfLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCursoComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        $logoBase64 = $this->logoBase64ParaLote();
        $conteudo = '';
        foreach ($salas as $i => $sala) {
            $candidaturas = $sala->candidaturas()
                ->where('pagamento_confirmado', true)
                ->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($curso)])
                ->orderBy('numero_lugar')
                ->get();
            $conteudo .= \View::make('pdf._sala-conteudo', [
                'sala' => $sala, 'candidaturas' => $candidaturas, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $i === 0,
            ])->render();
        }

        $html = \View::make('pdf._sala-wrapper-lote', ['conteudo' => $conteudo, 'paddingCelula' => '5px 10px'])->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download('salas-' . \Str::slug($curso) . '.pdf');
    }

    public function pdfExameLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCursoComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        return $this->gerarPdfExameLote($salas, $curso, 'lista-exame-' . \Str::slug($curso) . '.pdf');
    }

    /**
     * Gera o PDF Exame em lote com lista geral e folhas separadas para as
     * categorias especiais, mantendo o mesmo critério de filtragem do Excel.
     */
    protected function gerarPdfExameLote(Collection $salas, ?string $cursoFiltro, string $nomeFicheiro)
    {
        $logoBase64 = $this->logoBase64ParaLote();
        $conteudo = '';
        $primeiro = true;

        foreach ($salas as $sala) {
            $candidaturasQuery = $sala->candidaturas()->where('pagamento_confirmado', true);
            if ($cursoFiltro !== null) {
                $candidaturasQuery->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($cursoFiltro)]);
            }
            $candidaturas = $candidaturasQuery->get();

            $categoriasSala = $candidaturas
                ->pluck('necessidade_especial')
                ->filter(fn ($cat) => $cat !== null && trim((string) $cat) !== '' && mb_strtolower(trim((string) $cat)) !== 'nenhuma')
                ->map(fn ($cat) => trim((string) $cat))
                ->unique(fn ($cat) => mb_strtolower($cat))
                ->values();
            $listaGeral = $candidaturas
                ->filter(fn ($c) => $c->necessidade_especial === null
                    || trim((string) $c->necessidade_especial) === ''
                    || mb_strtolower(trim((string) $c->necessidade_especial)) === 'nenhuma')
                ->values();

            $conteudo .= \View::make('pdf._sala-exame-conteudo', [
                'sala' => $sala, 'candidaturas' => $listaGeral, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $primeiro, 'necessidadeEspecial' => null,
            ])->render();
            $primeiro = false;

            foreach ($categoriasSala as $categoria) {
                $candidatosCategoria = $candidaturas
                    ->filter(fn ($c) => $c->necessidade_especial !== null
                        && mb_strtolower(trim((string) $c->necessidade_especial)) === mb_strtolower($categoria))
                    ->values();
                $conteudo .= \View::make('pdf._sala-exame-conteudo', [
                    'sala' => $sala, 'candidaturas' => $candidatosCategoria, 'logoBase64' => $logoBase64,
                    'primeiroDoDocumento' => false, 'necessidadeEspecial' => $categoria,
                ])->render();
            }
        }

        $html = \View::make('pdf._sala-wrapper-lote', ['conteudo' => $conteudo, 'paddingCelula' => '8px 10px'])->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download($nomeFicheiro);
    }

    public function excelExameLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCursoComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        $filename = 'pauta-' . \Str::slug($curso) . '.xlsx';
        return Excel::download(new SalasExameExportLote($salas, $curso), $filename);
    }
}
