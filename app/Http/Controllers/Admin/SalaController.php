<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalaExameExport;
use App\Exports\SalaNotasExport;
use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::withCount('candidaturas')->orderBy('nome')->get();

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
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
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
            ->orderBy('numero_lugar')
            ->get();

        return view('admin.salas.show', compact('sala', 'candidaturas'));
    }

    /**
     * Algoritmo de distribuição:
     * 1. Agrupa candidatos por (curso, período), ordenados alfabeticamente
     * 2. Para cada grupo, atribui salas disponíveis preenchendo até à capacidade
     * 3. Se um grupo excede uma sala, continua na próxima sala disponível
     */
    public function distribuir(Request $request)
    {
        $salas = Sala::orderByDesc('capacidade')->get();

        if ($salas->isEmpty()) {
            return redirect()->route('admin.salas.index')
                ->with('error', 'Não existem salas registadas. Crie salas antes de distribuir.');
        }

        // Candidatos a distribuir — Enfermagem vem PRIMEIRO para obter salas maiores
        $prioritarios = Candidatura::$cursosPrioritarios;

        $todos = Candidatura::whereNotIn('status', ['rejeitada'])
            ->orderBy('nome')
            ->get();

        // Separar prioritários (Enfermagem) dos restantes
        $grupoPrioritario = $todos->filter(fn($c) => in_array($c->curso, $prioritarios))
                                  ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                                  ->sortByDesc(fn($g) => $g->count());

        $grupoNormal = $todos->reject(fn($c) => in_array($c->curso, $prioritarios))
                             ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                             ->sortByDesc(fn($g) => $g->count());

        // Merge: prioritários primeiro
        $grupos = $grupoPrioritario->merge($grupoNormal);

        $totalCandidatos = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $totalLugares    = $salas->sum('capacidade');

        if ($totalCandidatos > $totalLugares) {
            return redirect()->route('admin.salas.index')
                ->with('error', "Capacidade insuficiente: {$totalCandidatos} candidatos mas apenas {$totalLugares} lugares disponíveis. Adicione mais salas.");
        }

        // Limpar distribuição anterior
        Candidatura::whereNotIn('status', ['rejeitada'])
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        // Fila de salas com espaço disponível (indexed para controle)
        $salaQueue = $salas->map(fn($s) => [
            'id'        => $s->id,
            'capacidade'=> $s->capacidade,
            'ocupado'   => 0,
        ])->values()->toArray();

        $salaIdx = 0; // índice da sala actual na fila

        foreach ($grupos as $chave => $candidatos) {
            $lugar = 1; // reinicia numeração em cada sala para este grupo

            foreach ($candidatos as $candidato) {
                // Se a sala actual está cheia, avança para a próxima
                while ($salaIdx < count($salaQueue) &&
                       $salaQueue[$salaIdx]['ocupado'] >= $salaQueue[$salaIdx]['capacidade']) {
                    $salaIdx++;
                    $lugar = 1;
                }

                if ($salaIdx >= count($salaQueue)) break; // segurança

                // Se mudou de grupo E a sala já tinha candidatos de outro grupo,
                // avança para a próxima sala limpa (salas por curso+período)
                // Nota: este comportamento garante separação por curso/período
                // A fila de salas não é reutilizada entre grupos diferentes

                Candidatura::where('id', $candidato->id)->update([
                    'sala_id'      => $salaQueue[$salaIdx]['id'],
                    'numero_lugar' => $lugar,
                ]);

                $salaQueue[$salaIdx]['ocupado']++;
                $lugar++;
            }

            // Ao terminar um grupo, avança para sala nova (separação por curso/período)
            if ($salaIdx < count($salaQueue) && $salaQueue[$salaIdx]['ocupado'] > 0) {
                $salaIdx++;
            }
        }

        $atribuidos = Candidatura::whereNotNull('sala_id')->count();

        return redirect()->route('admin.salas.index')
            ->with('success', "{$atribuidos} candidatos distribuídos por " . ($salaIdx) . " sala(s).");
    }

    public function limpar()
    {
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        return redirect()->route('admin.salas.index')
            ->with('success', 'Distribuição removida. Todos os candidatos foram retirados das salas.');
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function pdfExame(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        $pdf = Pdf::loadView('pdf.sala-exame', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('lista-exame-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . '.xlsx';
        return Excel::download(new SalaExameExport($sala), $filename);
    }

    public function excelNotas(Sala $sala)
    {
        $filename = 'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx';
        return Excel::download(new SalaNotasExport($sala), $filename);
    }
}
