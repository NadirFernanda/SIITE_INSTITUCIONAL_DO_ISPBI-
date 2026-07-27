<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidaturaController extends Controller
{
    public function index(Request $request)
    {
        // Only show candidates that have a generated exam code — required for launching grades
        $query = Candidatura::with('sala')->whereNotNull('codigo_exame')->orderByDesc('created_at');

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }
        if ($request->filled('periodo')) {
            $query->where('periodo', $request->input('periodo'));
        }
        if ($request->filled('nota')) {
            if ($request->input('nota') === 'sem_nota') {
                $query->whereNull('nota_exame');
            } elseif ($request->input('nota') === 'com_nota') {
                $query->whereNotNull('nota_exame');
            }
        }
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($r) use ($q) {
                $r->where('id', $q)
                  ->orWhere('codigo_exame', 'like', "%{$q}%");
            });
        }

        $candidaturas = $query->paginate(25)->withQueryString();

        $totais = [
            'total'    => Candidatura::count(),
            'sem_nota' => Candidatura::whereNull('nota_exame')->count(),
            'com_nota' => Candidatura::whereNotNull('nota_exame')->count(),
        ];

        return view('professor.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        $candidatura->load(['notaLancadaPor']);

        // carregar disciplinas definidas para a SALA — cada sala deve ter as suas próprias disciplinas
        $disciplines = collect();
        try {
            if ($candidatura->sala_id) {
                $disciplines = \App\Models\SalaDiscipline::where('sala_id', $candidatura->sala_id)
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $disciplines = collect();
        }

        // carregar notas já lançadas para esta candidatura
        $notas = \App\Models\CandidaturaNota::where('candidatura_id', $candidatura->id)->get()->keyBy('discipline');

        return view('professor.candidaturas.show', compact('candidatura', 'disciplines', 'notas'));
    }

    public function updateNotasDisciplinas(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'notas' => 'array',
            'notas.*' => 'nullable|numeric|min:0|max:20',
        ], [
            'notas.*.numeric' => 'Cada nota deve ser numérica.',
            'notas.*.min' => 'A nota mínima é 0.',
            'notas.*.max' => 'A nota máxima é 20.',
        ]);

        $dados = $request->input('notas', []);

        foreach ($dados as $disciplina => $valor) {
            // normalizar disciplina
            $disc = trim($disciplina);
            if ($valor === null || $valor === '') {
                // remover nota existente se vazio
                \App\Models\CandidaturaNota::where('candidatura_id', $candidatura->id)->where('discipline', $disc)->delete();
                continue;
            }

            $nota = round((float) $valor, 2);

            \App\Models\CandidaturaNota::updateOrCreate(
                ['candidatura_id' => $candidatura->id, 'discipline' => $disc],
                ['nota' => $nota, 'lancada_por' => Auth::id(), 'lancada_em' => now()]
            );

            // opcional: atualizar nota_exame geral se soma completa? Não por enquanto — soma é calculada na exportação
            \App\Models\AuditLog::registar('lancou_nota_disciplina', 'candidatura', $candidatura->id,
                "Ficha #{$candidatura->id} — {$candidatura->nome} | Disciplina: {$disc} | Nota: {$nota}");
        }

        return redirect()->route('professor.candidaturas.show', $candidatura)->with('success', 'Notas por disciplina atualizadas.');
    }

    public function updateNota(Request $request, Candidatura $candidatura)
    {
        // If this candidatura's sala has disciplines defined, disallow single overall nota
        $hasSalaDisciplines = false;
        try {
            if ($candidatura->sala_id) {
                $hasSalaDisciplines = \App\Models\SalaDiscipline::where('sala_id', $candidatura->sala_id)->exists();
            }
        } catch (\Throwable $e) {
            $hasSalaDisciplines = false;
        }

        if ($hasSalaDisciplines) {
            return redirect()->route('professor.candidaturas.show', $candidatura)
                ->with('error', 'Esta sala está configurada para lançamento por disciplinas. Use o formulário de "Lançamento de Notas por Disciplina".');
        }

        $request->validate([
            'nota_exame' => 'required|numeric|min:0|max:20',
        ], [
            'nota_exame.required' => 'A nota é obrigatória.',
            'nota_exame.numeric'  => 'A nota deve ser um número.',
            'nota_exame.min'      => 'A nota mínima é 0.',
            'nota_exame.max'      => 'A nota máxima é 20.',
        ]);

        $nota = round((float) $request->input('nota_exame'), 1);
        $candidatura->update([
            'nota_exame'       => $nota,
            'nota_lancada_por' => Auth::id(),
            'nota_lancada_em'  => now(),
        ]);

        AuditLog::registar('lancou_nota', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} | Nota: {$nota}");

        try {
            app(WhatsAppService::class)->notificarNotaLancada($candidatura);
        } catch (\Throwable $e) {
            \Log::error('WhatsApp nota lançada: ' . $e->getMessage());
        }

        // If the request included a redirect target (e.g., sala id), return to that pauta
        if ($request->filled('redirect_to')) {
            $salaId = $request->input('redirect_to');
            if (is_numeric($salaId)) {
                return redirect()->route('professor.salas.show', $salaId)
                    ->with('success', "Nota {$nota} lançada com sucesso.");
            }
        }

        return redirect()->route('professor.candidaturas.show', $candidatura)
            ->with('success', "Nota {$nota} lançada com sucesso.");
    }
}
