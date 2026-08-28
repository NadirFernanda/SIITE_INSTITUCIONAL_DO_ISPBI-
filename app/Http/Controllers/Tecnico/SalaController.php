<?php

namespace App\Http\Controllers\Tecnico;

use App\Exports\SalaExameExport;
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

        $salasQuery = Sala::withCount('candidaturas')->ordenadaPorHorario();
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

        return view('tecnico.salas.index', compact(
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos',
            'cursosDisponiveis', 'cursoFiltro', 'datasDisponiveis', 'horarioFiltro', 'dataFiltro',
            'periodoFiltro', 'resumo'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome',
            'capacidade' => 'required|integer|min:1|max:1000',
        ], [
            'nome.unique' => 'Já existe uma sala com este nome.',
        ]);

        Sala::create($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('tecnico.salas.index')->with('success', 'Sala criada com sucesso.');
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome,' . $sala->id,
            'capacidade' => 'required|integer|min:1|max:1000',
        ]);

        $sala->update($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('tecnico.salas.index')->with('success', 'Sala actualizada.');
    }

    public function destroy(Sala $sala)
    {
        Candidatura::where('sala_id', $sala->id)
                   ->update(['sala_id' => null, 'numero_lugar' => null]);
        $sala->delete();

        return redirect()->route('tecnico.salas.index')->with('success', 'Sala eliminada.');
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        $cursoSala = $candidaturas->first()->curso ?? null;
        $categoriasSala = collect(Candidatura::categoriasEspeciaisPermitidas($cursoSala))
            ->filter(fn ($cat) => $candidaturas->contains('necessidade_especial', $cat))
            ->values();

        return view('tecnico.salas.show', compact('sala', 'candidaturas', 'categoriasSala'));
    }

    /**
     * Distribui os candidatos pelas salas de acordo com o calendário oficial
     * dos Exames de Acesso (Sala::$agendaExames) — lógica partilhada com os
     * painéis Admin e Lançamento via DistribuicaoSalasService.
     */
    public function distribuir(\App\Services\DistribuicaoSalasService $service)
    {
        $resultado = $service->distribuir();

        return redirect()->route('tecnico.salas.index')->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function limpar()
    {
        $count = Candidatura::whereNotNull('sala_id')->count();
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        AuditLog::registar('limpou_salas', null, null,
            "Distribuição removida — {$count} candidatos retirados das salas");

        return redirect()->route('tecnico.salas.index')
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
}
