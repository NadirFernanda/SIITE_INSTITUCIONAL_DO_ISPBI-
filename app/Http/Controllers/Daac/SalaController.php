<?php

namespace App\Http\Controllers\Daac;

use App\Exports\SalaExameExport;
use App\Exports\SalasExameExportLote;
use App\Http\Controllers\Controller;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    public function index(Request $request)
    {
        $cursoFiltro   = $request->query('curso');
        $horarioFiltro = $request->query('horario_filtro');
        $dataFiltro    = $request->query('data_filtro');
        $periodoFiltro = $request->query('periodo_filtro');

        $salasQuery = Sala::query()
            ->withCount(['candidaturas' => function ($query) {
                $query->where('pagamento_confirmado', true);
            }])
            ->withCount(['candidaturas as candidaturas_impressas_count' => function ($query) {
                $query->where('pagamento_confirmado', true)->whereNotNull('folha_impressa_em');
            }]);

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

        $salas = $salasQuery->ordenadaPorHorario()->get()
            ->filter(fn($sala) => $sala->candidaturas_count > 0);

        $cursosDisponiveis = \App\Models\Candidatura::where('pagamento_confirmado', true)
            ->whereNotNull('curso')
            ->distinct()
            ->orderBy('curso')
            ->pluck('curso');

        $datasDisponiveis = Sala::whereNotNull('data_exame')
            ->distinct()
            ->orderBy('data_exame')
            ->pluck('data_exame');

        // Resumo de candidatos por curso/período/data/horário, com os mesmos
        // filtros aplicados à lista de salas acima.
        $resumoQuery = \DB::table('candidaturas')
            ->join('salas', 'salas.id', '=', 'candidaturas.sala_id')
            ->selectRaw("candidaturas.curso, candidaturas.periodo, salas.data_exame, salas.horario, COUNT(*) as total")
            ->where('candidaturas.pagamento_confirmado', true);
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

        return view('daac.salas.index', compact(
            'salas', 'cursosDisponiveis', 'cursoFiltro', 'datasDisponiveis', 'horarioFiltro', 'dataFiltro',
            'periodoFiltro', 'resumo'
        ));
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

    /**
     * Salas de um horário, para os downloads em lote — todas as que tiverem
     * candidatos atribuídos e pagamento confirmado.
     */
    protected function salasDoHorario(Request $request)
    {
        $request->validate([
            'horario' => ['required', \Illuminate\Validation\Rule::in(Sala::$horarios)],
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
        $salas = $this->salasDoHorario($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        // Um único documento <html>/<body> com o conteúdo de todas as salas
        // — concatenar vários documentos completos (um <html> por sala) é
        // HTML inválido e fazia o dompdf inserir páginas em branco a mais
        // entre salas (testado empiricamente). Ver pdf/_sala-wrapper-lote.
        $logoPath = public_path('images/logo.png');
        $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';

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

    public function excelExameLote(Request $request)
    {
        $salas = $this->salasDoHorario($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'lista-exame-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasExameExportLote($salas), $filename);
    }
}
