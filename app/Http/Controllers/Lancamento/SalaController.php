<?php

namespace App\Http\Controllers\Lancamento;

use App\Exports\SalaExameExportLancamento;
use App\Exports\SalasExameExportLoteLancamento;
use App\Http\Controllers\Concerns\DownloadsSalasEmLote;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
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
                $query->whereNotIn('status', ['rejeitada']);

                if ($cursoFiltro) {
                    $query->where('curso', $cursoFiltro);
                }

                if ($periodoFiltro) {
                    $query->where('periodo', $periodoFiltro);
                }
            }])
            ->ordenadaPorHorario();

        if ($cursoFiltro) {
            $salasQuery->whereHas('candidaturas', fn ($q) => $q->where('curso', $cursoFiltro));
        }
        if ($periodoFiltro) {
            $salasQuery->whereHas('candidaturas', fn ($q) => $q->where('periodo', $periodoFiltro));
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

        return view('lancamento.salas.index', compact(
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos',
            'cursosDisponiveis', 'cursoFiltro', 'datasDisponiveis', 'horarioFiltro', 'dataFiltro',
            'periodoFiltro', 'resumo'
        ));
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome,' . $sala->id,
            'capacidade' => 'required|integer|min:1|max:1000',
        ]);

        $sala->update($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('lancamento.salas.index')->with('success', 'Sala actualizada.');
    }

    public function destroy(Sala $sala)
    {
        Candidatura::where('sala_id', $sala->id)
                   ->update(['sala_id' => null, 'numero_lugar' => null]);
        $sala->delete();

        return redirect()->route('lancamento.salas.index')->with('success', 'Sala eliminada.');
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
        return view('lancamento.salas.show', compact('sala', 'candidaturas'));
    }

    /**
     * Distribui os candidatos pelas salas de acordo com o calendário oficial
     * dos Exames de Acesso (Sala::$agendaExames) — lógica partilhada com os
     * painéis Admin e Técnico via DistribuicaoSalasService.
     */
    public function distribuir(\App\Services\DistribuicaoSalasService $service)
    {
        $resultado = $service->distribuir();

        return redirect()->route('lancamento.salas.index')->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function limpar()
    {
        $count = Candidatura::whereNotNull('sala_id')->count();
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        AuditLog::registar('limpou_salas', null, null,
            "Distribuição removida — {$count} candidatos retirados das salas");

        return redirect()->route('lancamento.salas.index')
            ->with('success', 'Distribuição removida.');
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

    // Usa o parcial ANÓNIMO (só N.º Ficha, sem nome) — o Lançamento lança
    // notas por código sem ver os nomes dos candidatos, ao contrário dos
    // outros perfis, cujo "PDF Exame" mostra nome e assinatura (ver
    // pdf/_sala-exame-conteudo.blade.php).
    public function pdfExame(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
        $pdf = Pdf::loadView('pdf.sala-exame-codigos', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('lista-exame-' . \Str::slug($sala->nome) . '.pdf');
    }

    // Substitui o pdfExameLote()/pdfExameLotePorCurso() do trait
    // DownloadsSalasEmLote — pela mesma razão de excelExameLote() abaixo: o
    // Lançamento mantém a lista de exame anónima (só código), sem nome nem
    // separação por categoria especial (que revelaria informação sobre o
    // candidato mesmo sem mostrar o nome).
    public function pdfExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        return $this->gerarPdfExameLoteCodigos($salas, 'lista-exame-' . \Str::slug($request->input('horario')) . '.pdf');
    }

    public function pdfExameLotePorCurso(Request $request)
    {
        $salas = $this->salasDoCursoComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse curso.');
        }

        $curso = $request->input('curso');

        return $this->gerarPdfExameLoteCodigos($salas, 'lista-exame-' . \Str::slug($curso) . '.pdf', $curso);
    }

    private function gerarPdfExameLoteCodigos($salas, string $nomeFicheiro, ?string $cursoFiltro = null)
    {
        $logoPath = public_path('images/logo.png');
        $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';

        $conteudo = '';
        foreach ($salas as $i => $sala) {
            $candidaturasQuery = $sala->candidaturas()->where('pagamento_confirmado', true);
            if ($cursoFiltro !== null) {
                $candidaturasQuery->where('curso', $cursoFiltro);
            }
            $candidaturas = $candidaturasQuery->orderBy('numero_lugar')->get();
            $conteudo .= \View::make('pdf._sala-exame-codigos-conteudo', [
                'sala' => $sala, 'candidaturas' => $candidaturas, 'logoBase64' => $logoBase64,
                'primeiroDoDocumento' => $i === 0,
            ])->render();
        }

        $html = \View::make('pdf._sala-wrapper-lote', ['conteudo' => $conteudo, 'paddingCelula' => '8px 10px'])->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download($nomeFicheiro);
    }

    public function excelExame(Sala $sala)
    {
        return Excel::download(new SalaExameExportLancamento($sala),
            'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    // Substitui o excelExameLote() do trait DownloadsSalasEmLote — o Lançamento
    // usa a sua própria variante de exportação (SalaExameExportLancamento), não
    // a genérica usada pelos outros perfis.
    public function excelExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'lista-exame-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasExameExportLoteLancamento($salas), $filename);
    }

    public function gerarCodigos(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->whereNotNull('numero_lugar')
            ->whereNull('codigo_exame')
            ->get();

        if ($candidaturas->isEmpty()) {
            return redirect()->route('lancamento.salas.show', $sala)
                ->with('error', 'Todos os candidatos desta sala já têm código de exame gerado.');
        }

        foreach ($candidaturas as $candidatura) {
            $candidatura->update(['codigo_exame' => Candidatura::gerarCodigoExame()]);
        }

        AuditLog::registar('gerou_codigos_exame', 'sala', $sala->id,
            "Códigos de exame gerados para {$candidaturas->count()} candidatos na sala {$sala->nome}");

        return redirect()->route('lancamento.salas.show', $sala)
            ->with('success', "{$candidaturas->count()} códigos de exame gerados para a sala {$sala->nome}.");
    }
}
