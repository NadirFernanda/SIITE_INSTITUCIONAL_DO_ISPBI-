<?php

namespace App\Http\Controllers\Daac;

use App\Exports\SalaExameExport;
use App\Exports\SalasExameExportLote;
use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        // Só mostra o botão de uma categoria se esta sala tiver mesmo pelo
        // menos um candidato nela — mesmo padrão já usado no Admin.
        $cursoSala = $candidaturas->first()->curso ?? null;
        $categoriasSala = collect(\App\Models\Candidatura::categoriasEspeciaisPermitidas($cursoSala))
            ->filter(fn ($cat) => $candidaturas->contains('necessidade_especial', $cat))
            ->values();

        return view('daac.salas.show', compact('sala', 'candidaturas', 'categoriasSala'));
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

    public function excelExame(Request $request, Sala $sala)
    {
        $necessidadeEspecial = $request->query('necessidade_especial');
        $sufixo = $necessidadeEspecial ? '-' . \Str::slug($necessidadeEspecial) : '';
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . $sufixo . '.xlsx';
        return Excel::download(new SalaExameExport($sala, $necessidadeEspecial, true), $filename);
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

    /**
     * Salas com pelo menos um candidato de um curso, com pagamento confirmado.
     * Ver App\Http\Controllers\Concerns\DownloadsSalasEmLote::salasDoCursoComCandidatos
     * (equivalente usado pelos outros perfis através do trait partilhado).
     */
    protected function salasDoCurso(Request $request)
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

    public function pdfExameLote(Request $request)
    {
        $salas = $this->salasDoHorario($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        return $this->gerarPdfExameLote($salas, null, 'lista-exame-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    /**
     * Gera o PDF Exame em lote — por cada sala, uma secção "Lista Geral"
     * (sem candidatos de categoria especial) mais uma secção por cada
     * categoria presente nessa sala, exactamente como o Excel Exame em lote
     * (App\Exports\SalasExameExportLote::sheets) — a única diferença entre
     * os dois deve ser o formato do ficheiro, não o conteúdo. Espelha
     * App\Http\Controllers\Concerns\DownloadsSalasEmLote::gerarPdfExameLote
     * (o Daac não usa o trait, por ter a sua própria implementação em lote).
     */
    protected function gerarPdfExameLote(Collection $salas, ?string $cursoFiltro, string $nomeFicheiro)
    {
        $logoPath = public_path('images/logo.png');
        $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';

        $conteudo = '';
        $primeiro = true;

        foreach ($salas as $sala) {
            $candidaturasQuery = $sala->candidaturas()->where('pagamento_confirmado', true);
            if ($cursoFiltro !== null) {
                $candidaturasQuery->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($cursoFiltro)]);
            }
            $candidaturas = $candidaturasQuery->get();

            $cursoSala = $candidaturas->first()->curso ?? null;
            $categoriasSala = collect(Candidatura::categoriasEspeciaisPermitidas($cursoSala))
                ->filter(fn ($cat) => $candidaturas->contains('necessidade_especial', $cat))
                ->values();

            $listaGeral = $candidaturas
                ->filter(fn ($c) => empty($c->necessidade_especial) || $c->necessidade_especial === 'Nenhuma')
                ->values();

            $conteudo .= \View::make('pdf._sala-exame-conteudo', [
                'sala' => $sala, 'candidaturas' => $listaGeral, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $primeiro, 'necessidadeEspecial' => null,
            ])->render();
            $primeiro = false;

            foreach ($categoriasSala as $categoria) {
                $candidatosCategoria = $candidaturas->filter(fn ($c) => $c->necessidade_especial === $categoria)->values();
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

    public function pdfLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCurso($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        $logoPath = public_path('images/logo.png');
        $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';

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

    public function excelExameLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCurso($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        $filename = 'lista-exame-' . \Str::slug($curso) . '.xlsx';
        return Excel::download(new SalasExameExportLote($salas, $curso), $filename);
    }

    public function pdfExameLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCurso($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');
        return $this->gerarPdfExameLote($salas, $curso, 'lista-exame-' . \Str::slug($curso) . '.pdf');
    }
}
