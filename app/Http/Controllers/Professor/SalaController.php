<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\Candidatura;

class SalaController extends Controller
{
    // Listar salas com candidatos
    public function index()
    {
        $salas = Sala::with(['candidaturas' => function ($query) {
            $query->select('sala_id', 'codigo_exame', 'nota_exame', 'nota_lancada_em', 'id');
        }])
            ->whereHas('candidaturas')
            ->ordenadaPorHorario()
            ->get()
            ->map(function ($sala) {
                $candidaturas = $sala->candidaturas;
                $sala->total_candidatos = $candidaturas->count();
                $sala->com_nota = $candidaturas->whereNotNull('nota_exame')->count();
                $sala->sem_nota = $candidaturas->whereNull('nota_exame')->count();
                $sala->percentual_conclusao = $sala->total_candidatos > 0 
                    ? round(($sala->com_nota / $sala->total_candidatos) * 100) 
                    : 0;
                return $sala;
            });

        return view('professor.salas.index', compact('salas'));
    }

    // Exibir pauta de uma sala com candidatos (anonimato)
    public function show(Sala $sala)
    {
        // carregar disciplinas definidas para esta sala (se existirem)
        $salaDiscs = \App\Models\SalaDiscipline::where('sala_id', $sala->id)->orderBy('id')->get();

        $candidaturas = $sala->candidaturas()
            ->select('id', 'sala_id', 'codigo_exame', 'nota_exame', 'nota_lancada_por', 'nota_lancada_em')
            ->whereNotNull('codigo_exame')
            ->orderBy('numero_lugar')
            ->get()
            ->map(function ($c) use ($salaDiscs) {
                // Carregar dados de quem lançou a nota
                if ($c->nota_lancada_por) {
                    $c->notaLancadaPor = \App\Models\User::find($c->nota_lancada_por);
                }

                // Carregar notas por disciplina para esta candidatura (se existirem)
                try {
                    $c->discipline_notas = \App\Models\CandidaturaNota::where('candidatura_id', $c->id)->get()->keyBy('discipline');
                } catch (\Throwable $e) {
                    $c->discipline_notas = collect();
                }

                return $c;
            });

        return view('professor.salas.show', compact('sala', 'candidaturas', 'salaDiscs'));
    }
}
