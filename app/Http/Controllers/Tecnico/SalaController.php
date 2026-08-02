<?php

namespace App\Http\Controllers\Tecnico;

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
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
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
        return view('tecnico.salas.show', compact('sala', 'candidaturas'));
    }

    public function distribuir()
    {
        $salas = Sala::orderByDesc('capacidade')->get();

        if ($salas->isEmpty()) {
            return redirect()->route('tecnico.salas.index')
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
            return redirect()->route('tecnico.salas.index')
                ->with('error', "Capacidade insuficiente: {$totalCandidatos} candidatos mas apenas {$totalLugares} lugares.");
        }

        Candidatura::whereNotIn('status', ['rejeitada'])
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        $salaQueue = $salas->map(fn($s) => [
            'id'        => $s->id,
            'capacidade'=> $s->capacidade,
            'ocupado'   => 0,
        ])->values()->toArray();

        $salaIdx = 0;

        foreach ($grupos as $candidatos) {
            $lugar = 1;
            foreach ($candidatos as $candidato) {
                while ($salaIdx < count($salaQueue) &&
                       $salaQueue[$salaIdx]['ocupado'] >= $salaQueue[$salaIdx]['capacidade']) {
                    $salaIdx++;
                    $lugar = 1;
                }
                if ($salaIdx >= count($salaQueue)) break;

                Candidatura::where('id', $candidato->id)->update([
                    'sala_id'      => $salaQueue[$salaIdx]['id'],
                    'numero_lugar' => $lugar,
                ]);
                $salaQueue[$salaIdx]['ocupado']++;
                $lugar++;
            }
            if ($salaIdx < count($salaQueue) && $salaQueue[$salaIdx]['ocupado'] > 0) {
                $salaIdx++;
            }
        }

        $atribuidos = Candidatura::whereNotNull('sala_id')->count();

        AuditLog::registar('distribuiu_salas', null, null,
            "{$atribuidos} candidatos distribuídos pelas salas");

        return redirect()->route('tecnico.salas.index')
            ->with('success', "{$atribuidos} candidatos distribuídos pelas salas.");
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
        return Excel::download(new SalaExameExport($sala),
            'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    public function excelNotas(Sala $sala)
    {
        return Excel::download(new SalaNotasExport($sala),
            'lancamento-notas-' . \Str::slug($sala->nome) . '.xlsx');
    }
}
