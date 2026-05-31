<?php

namespace App\Http\Controllers\Daac;

use App\Http\Controllers\Controller;
use App\Mail\ComprovatvioConcluido;
use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CandidaturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidatura::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        } else {
            // Por defeito mostrar aprovadas + concluídas
            $query->whereIn('status', ['aprovada', 'concluida']);
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($r) use ($q) {
                $r->where('nome', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('bi', 'like', "%{$q}%");
                if (is_numeric($q)) $r->orWhere('id', (int) $q);
            });
        }

        $candidaturas = $query->paginate(20)->withQueryString();

        $totais = [
            'aprovada'  => Candidatura::where('status', 'aprovada')->count(),
            'concluida' => Candidatura::where('status', 'concluida')->count(),
            'total'     => Candidatura::count(),
        ];

        return view('daac.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        return view('daac.candidaturas.show', compact('candidatura'));
    }

    public function assinar(Request $request, Candidatura $candidatura)
    {
        if ($candidatura->isAssinada()) {
            return back()->with('error', 'Esta candidatura já foi assinada.');
        }

        $request->validate([
            'confirmar' => 'required|accepted',
        ], [
            'confirmar.accepted' => 'Confirme que pretende assinar digitalmente esta candidatura.',
        ]);

        // Gerar código único de assinatura (hash do conteúdo + utilizador + timestamp)
        $codigo = strtoupper(substr(
            hash('sha256',
                $candidatura->id . '|' .
                $candidatura->bi . '|' .
                $candidatura->nome . '|' .
                Auth::id() . '|' .
                now()->toIso8601String() . '|' .
                Str::random(16)
            ),
            0, 16
        ));

        $candidatura->update([
            'status'            => 'concluida',
            'assinado_por'      => Auth::id(),
            'assinado_em'       => now(),
            'assinatura_codigo' => $codigo,
        ]);

        // Enviar email ao candidato com comprovativo assinado
        try {
            Mail::to($candidatura->email)
                ->send(new ComprovatvioConcluido($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de comprovativo concluído: ' . $e->getMessage());
        }

        return redirect()->route('daac.candidaturas.show', $candidatura)
            ->with('success', "Candidatura assinada com sucesso. Código: {$codigo}");
    }
}
