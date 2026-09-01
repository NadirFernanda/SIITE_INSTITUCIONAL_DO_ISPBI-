<?php

namespace App\Http\Controllers\Admin;

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

        // Resumo de candidatos por curso/período/data/horário, já filtrado
        // pelos mesmos critérios da lista de salas acima — só conta quem já
        // está atribuído a uma sala (sala_id preenchido).
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

        // Estatísticas para o painel
        $totalCandidatos   = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $atribuidos        = Candidatura::whereNotNull('sala_id')->count();
        $semSala           = $totalCandidatos - $atribuidos;
        $totalLugares      = $salas->sum('capacidade');

        // Grupos por curso+período (para mostrar na view)
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

        return view('admin.salas.index', compact(
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
            'data_exame' => 'nullable|date',
            'horario'    => 'nullable|in:' . implode(',', Sala::$horarios),
        ], [
            'nome.unique' => 'Já existe uma sala com este nome.',
        ]);

        Sala::create($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('admin.salas.index')->with('success', 'Sala criada com sucesso.');
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome,' . $sala->id,
            'capacidade' => 'required|integer|min:1|max:1000',
            'data_exame' => 'nullable|date',
            'horario'    => 'nullable|in:' . implode(',', Sala::$horarios),
        ]);

        $sala->update($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('admin.salas.index')->with('success', 'Sala actualizada.');
    }

    public function destroy(Sala $sala)
    {
        // Libertar candidatos desta sala antes de apagar
        Candidatura::where('sala_id', $sala->id)
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        $sala->delete();

        return redirect()->route('admin.salas.index')->with('success', 'Sala eliminada.');
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        return view('admin.salas.show', compact('sala', 'candidaturas'));
    }

    /**
     * Lista os candidatos que a distribuição automática não conseguiu
     * colocar em nenhuma sala (por falta de capacidade no curso/bloco deles),
     * para o admin os atribuir manualmente a uma sala à sua escolha — único
     * caso em que a regra "uma sala, um curso" pode ser ultrapassada
     * deliberadamente, por decisão humana.
     */
    public function semSala()
    {
        $candidaturas = Candidatura::whereNull('sala_id')
            ->whereNotIn('status', ['rejeitada'])
            ->orderBy('curso')->orderBy('periodo')->orderBy('nome')
            ->get();

        $salas = Sala::whereNotNull('data_exame')
            ->withCount('candidaturas')
            ->ordenadaPorHorario()
            ->get();

        return view('admin.salas.sem-sala', compact('candidaturas', 'salas'));
    }

    /**
     * Atribuição manual de uma sala a um candidato — usada só para os que
     * ficaram sem sala depois da distribuição automática. O admin escolhe
     * livremente a sala, mesmo que já tenha outro curso ou esteja cheia; é
     * uma decisão consciente para casos excepcionais, não a regra geral.
     */
    public function atribuirManual(Request $request, Candidatura $candidatura)
    {
        $request->validate(['sala_id' => 'required|exists:salas,id']);

        $sala = Sala::findOrFail($request->input('sala_id'));
        $numeroLugar = $sala->candidaturas()->count() + 1;

        $candidatura->forceFill([
            'sala_id'      => $sala->id,
            'numero_lugar' => $numeroLugar,
        ])->save();

        AuditLog::registar('atribuiu_sala_manual', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} atribuída manualmente a {$sala->nome}"
            . ($sala->data_exame ? " ({$sala->data_exame->format('d/m/Y')}, {$sala->horario})" : ''));

        return redirect()->route('admin.salas.sem-sala')
            ->with('success', "{$candidatura->nome} atribuído(a) a {$sala->nome}.");
    }

    /**
     * Distribui os candidatos pelas salas de acordo com o calendário oficial
     * dos Exames de Acesso (Sala::$agendaExames) — lógica partilhada com os
     * painéis Técnico e Lançamento via DistribuicaoSalasService.
     */
    public function distribuir(Request $request, \App\Services\DistribuicaoSalasService $service)
    {
        $resultado = $service->distribuir();

        return redirect()->route('admin.salas.index')->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function limpar()
    {
        $count = Candidatura::whereNotNull('sala_id')->count();
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        AuditLog::registar('limpou_salas', null, null,
            "Distribuição removida — {$count} candidatos retirados das salas");

        return redirect()->route('admin.salas.index')
            ->with('success', 'Distribuição removida. Todos os candidatos foram retirados das salas.');
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
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . $sufixo . '.xlsx';

        return Excel::download(new SalaExameExport($sala, $necessidadeEspecial, true), $filename);
    }

}
