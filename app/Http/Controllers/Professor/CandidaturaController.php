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
        $query = Candidatura::with('sala')->orderByDesc('created_at');

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
        return view('professor.candidaturas.show', compact('candidatura'));
    }

    public function updateNota(Request $request, Candidatura $candidatura)
    {
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

        return redirect()->route('professor.candidaturas.show', $candidatura)
            ->with('success', "Nota {$nota} lançada com sucesso.");
    }
}
