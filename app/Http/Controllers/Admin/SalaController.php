<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalaExameExport;
use App\Exports\SalaNotasExport;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
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
            ->where('pagamento_confirmado', true)
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

        // Candidatos a distribuir — cursos em Candidatura::$cursosPrioritarios vêm
        // primeiro, por ordem (Enfermagem, depois Psicologia), para obter salas maiores
        $prioridades = Candidatura::$cursosPrioritarios;

        $todos = Candidatura::whereNotIn('status', ['rejeitada'])
            ->orderBy('nome')
            ->get();

        // Um nível por curso prioritário (na ordem definida), cada um ordenado por
        // grupo maior primeiro; os restantes cursos ficam no fim, sem prioridade
        // entre si (o sistema preenche como for mais conveniente)
        $grupos = collect();
        foreach ($prioridades as $curso) {
            $grupos = $grupos->union(
                $todos->filter(fn($c) => $c->curso === $curso)
                      ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                      ->sortByDesc(fn($g) => $g->count())
            );
        }
        $grupos = $grupos->union(
            $todos->reject(fn($c) => in_array($c->curso, $prioridades))
                  ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                  ->sortByDesc(fn($g) => $g->count())
        );

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
            'id'         => $s->id,
            'capacidade' => $s->capacidade,
            'horario'    => $s->horario,
            'ocupado'    => 0,
            'curso_atual'=> null, // curso ao qual a sala está reservada nesta distribuição
        ])->values()->toArray();

        $horariosPorPeriodo = Sala::$horariosPorPeriodo;

        // REGRA CRÍTICA: numa sala só pode haver candidatos de UM curso por horário —
        // nunca misturar cursos diferentes na mesma sala. Uma sala só serve este grupo se:
        // 1) não tiver horário fixo definido, ou o horário pertencer ao período pedido; e
        // 2) ainda não estiver reservada para outro curso (só pode ser reservada para
        //    o mesmo curso deste grupo, ou estar completamente livre).
        $compativel = function (array $sala, string $curso, string $periodo) use ($horariosPorPeriodo) {
            if ($sala['horario'] && isset($horariosPorPeriodo[$periodo])
                && !in_array($sala['horario'], $horariosPorPeriodo[$periodo], true)) {
                return false;
            }
            if ($sala['curso_atual'] !== null && $sala['curso_atual'] !== $curso) {
                return false;
            }
            return true;
        };

        $ponteiros = []; // um índice de avanço por período — cada período percorre a fila de salas de forma independente
        $naoAtribuidos = []; // candidatos que não couberam em nenhuma sala compatível/exclusiva

        foreach ($grupos as $chave => $candidatos) {
            [$curso, $periodo] = explode('|||', $chave);
            $idx   = $ponteiros[$periodo] ?? 0;
            $lugar = 1; // reinicia numeração em cada sala para este grupo

            foreach ($candidatos as $candidato) {
                // Avança até encontrar uma sala com espaço, do período certo e
                // ainda não reservada para outro curso
                while ($idx < count($salaQueue) && (
                        $salaQueue[$idx]['ocupado'] >= $salaQueue[$idx]['capacidade']
                        || !$compativel($salaQueue[$idx], $curso, $periodo)
                    )) {
                    $idx++;
                    $lugar = 1;
                }

                if ($idx >= count($salaQueue)) {
                    $naoAtribuidos[] = $chave;
                    continue; // sem salas livres/exclusivas para este curso+período
                }

                Candidatura::where('id', $candidato->id)->update([
                    'sala_id'      => $salaQueue[$idx]['id'],
                    'numero_lugar' => $lugar,
                ]);

                $salaQueue[$idx]['ocupado']++;
                $salaQueue[$idx]['curso_atual'] = $curso;
                $lugar++;
            }

            $ponteiros[$periodo] = $idx;
        }

        $atribuidos = Candidatura::whereNotNull('sala_id')->count();

        if (!empty($naoAtribuidos)) {
            $resumo = collect($naoAtribuidos)->countBy()->map(fn($n, $g) => str_replace('|||', ' — ', $g) . " ({$n})")->implode('; ');
            \Log::warning("Distribuição: candidatos sem sala por falta de salas exclusivas disponíveis: {$resumo}");
        }

        // --- Sincronizar disciplinas do curso para cada sala ---
        try {
            $salasAssigned = Sala::whereIn('id', Candidatura::whereNotNull('sala_id')->distinct()->pluck('sala_id'))->get();
            foreach ($salasAssigned as $s) {
                // obter o primeiro candidato desta sala para inferir o curso
                $first = $s->candidaturas()->whereNotNull('curso')->first();
                if (! $first) continue;

                $courseName = trim($first->curso);
                if (! $courseName) continue;

                // buscar disciplinas do curso (case-insensitive)
                $courseDisc = \App\Models\CourseDiscipline::whereRaw('LOWER(course_name) = ?', [mb_strtolower($courseName)])->get();

                if ($courseDisc->isEmpty()) {
                    // tentar sem normalização (exata)
                    $courseDisc = \App\Models\CourseDiscipline::where('course_name', $courseName)->get();
                }

                if ($courseDisc->isEmpty()) continue;

                // sincronizar: remover disciplinas da sala que não pertencem ao curso e criar/atualizar as restantes
                \Illuminate\Support\Facades\DB::transaction(function () use ($s, $courseDisc) {
                    $incoming = $courseDisc->pluck('discipline')->map(fn($d) => trim($d))->filter()->values()->all();

                    \App\Models\SalaDiscipline::where('sala_id', $s->id)
                        ->whereNotIn('discipline', $incoming)
                        ->delete();

                    foreach ($courseDisc as $cd) {
                        \App\Models\SalaDiscipline::updateOrCreate(
                            ['sala_id' => $s->id, 'discipline' => $cd->discipline],
                            ['weight_percent' => (int) $cd->weight_percent]
                        );
                    }
                });
            }
        } catch (\Throwable $e) {
            \Log::error('Erro ao sincronizar disciplinas para salas: ' . $e->getMessage());
        }

        $totalSalasUsadas = $salasAssigned->count();

        AuditLog::registar('distribuiu_salas', null, null,
            "{$atribuidos} candidatos distribuídos por {$totalSalasUsadas} sala(s)");

        $mensagem = "{$atribuidos} candidatos distribuídos por {$totalSalasUsadas} sala(s).";
        if (!empty($naoAtribuidos)) {
            $semSalaCount = $totalCandidatos - $atribuidos;
            $mensagem .= " ATENÇÃO: {$semSalaCount} candidato(s) ficaram SEM sala — não há salas suficientes para "
                . "evitar misturar cursos diferentes na mesma sala/horário ({$resumo}). Adicione mais salas/horários "
                . "e distribua novamente.";
            return redirect()->route('admin.salas.index')->with('error', $mensagem);
        }

        return redirect()->route('admin.salas.index')->with('success', $mensagem);
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

    public function pdfExame(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
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
