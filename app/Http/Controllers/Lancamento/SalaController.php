<?php

namespace App\Http\Controllers\Lancamento;

use App\Exports\SalaExameExportLancamento;
use App\Exports\SalaNotasExportLancamento;
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
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
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

    public function distribuir()
    {
        $salas = Sala::orderByDesc('capacidade')->get();

        if ($salas->isEmpty()) {
            return redirect()->route('lancamento.salas.index')
                ->with('error', 'Não existem salas registadas. Crie salas antes de distribuir.');
        }

        // Cursos prioritários (Enfermagem, depois Psicologia) obtêm salas maiores primeiro
        $prioridades = Candidatura::$cursosPrioritarios;
        $todos = Candidatura::whereNotIn('status', ['rejeitada'])->orderBy('nome')->get();

        $grupos = collect();
        foreach ($prioridades as $curso) {
            $grupos = $grupos->merge(
                $todos->filter(fn($c) => $c->curso === $curso)
                      ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                      ->sortByDesc(fn($g) => $g->count())
            );
        }
        $grupos = $grupos->merge(
            $todos->reject(fn($c) => in_array($c->curso, $prioridades))
                  ->groupBy(fn($c) => $c->curso . '|||' . $c->periodo)
                  ->sortByDesc(fn($g) => $g->count())
        );

        $totalCandidatos = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $totalLugares    = $salas->sum('capacidade');

        if ($totalCandidatos > $totalLugares) {
            return redirect()->route('lancamento.salas.index')
                ->with('error', "Capacidade insuficiente: {$totalCandidatos} candidatos mas apenas {$totalLugares} lugares.");
        }

        Candidatura::whereNotIn('status', ['rejeitada'])
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

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
        // 2) ainda não estiver reservada para outro curso.
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

        $ponteiros = [];
        $naoAtribuidos = [];

        foreach ($grupos as $chave => $candidatos) {
            [$curso, $periodo] = explode('|||', $chave);
            $idx   = $ponteiros[$periodo] ?? 0;
            $lugar = 1;
            foreach ($candidatos as $candidato) {
                while ($idx < count($salaQueue) && (
                        $salaQueue[$idx]['ocupado'] >= $salaQueue[$idx]['capacidade']
                        || !$compativel($salaQueue[$idx], $curso, $periodo)
                    )) {
                    $idx++;
                    $lugar = 1;
                }
                if ($idx >= count($salaQueue)) {
                    $naoAtribuidos[] = $chave;
                    continue;
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

        AuditLog::registar('distribuiu_salas', null, null,
            "{$atribuidos} candidatos distribuídos pelas salas");

        if (!empty($naoAtribuidos)) {
            $semSalaCount = $totalCandidatos - $atribuidos;
            $resumo = collect($naoAtribuidos)->countBy()->map(fn($n, $g) => str_replace('|||', ' — ', $g) . " ({$n})")->implode('; ');
            return redirect()->route('lancamento.salas.index')->with('error',
                "{$atribuidos} candidatos distribuídos pelas salas. ATENÇÃO: {$semSalaCount} candidato(s) ficaram "
                . "SEM sala — não há salas suficientes para evitar misturar cursos diferentes na mesma sala/horário "
                . "({$resumo}). Adicione mais salas/horários e distribua novamente.");
        }

        return redirect()->route('lancamento.salas.index')
            ->with('success', "{$atribuidos} candidatos distribuídos pelas salas.");
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
        return Excel::download(new SalaExameExportLancamento($sala),
            'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    public function excelNotas(Sala $sala)
    {
        return Excel::download(new SalaNotasExportLancamento($sala),
            'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx');
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
