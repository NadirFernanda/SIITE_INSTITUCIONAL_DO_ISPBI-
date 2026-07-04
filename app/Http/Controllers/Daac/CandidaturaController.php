<?php

namespace App\Http\Controllers\Daac;

use App\Http\Controllers\Controller;
use App\Mail\ComprovatvioConcluido;
use App\Models\AuditLog;
use App\Models\Candidatura;
use Barryvdh\DomPDF\Facade\Pdf;
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
        }
        // Sem filtro de status: mostra todas (pendente, em_análise, aprovada, concluída)

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
            'por_assinar' => Candidatura::whereNull('assinado_em')->count(),
            'concluida'   => Candidatura::where('status', 'concluida')->count(),
            'total'       => Candidatura::count(),
        ];

        return view('daac.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        return view('daac.candidaturas.show', compact('candidatura'));
    }

    public function downloadComprovativo(Candidatura $candidatura)
    {
        AuditLog::registar('imprimiu_comprovativo', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))->setPaper('a4', 'portrait');
        return $pdf->download('comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf');
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

        // Código único: hash dos dados + utilizador autenticado + timestamp
        $codigo = strtoupper(substr(
            hash('sha256',
                $candidatura->id . '|' .
                $candidatura->bi . '|' .
                $candidatura->nome . '|' .
                Auth::id() . '|' .
                Auth::user()->name . '|' .
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

        AuditLog::registar('assinou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso}) | Código: {$codigo}");

        try {
            Mail::to($candidatura->email)
                ->send(new ComprovatvioConcluido($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de comprovativo concluído: ' . $e->getMessage());
        }

        return redirect()->route('daac.candidaturas.show', $candidatura)
            ->with('success', "Candidatura assinada por " . Auth::user()->name . ". Código: {$codigo}");
    }

    public function rejeitar(Request $request, Candidatura $candidatura)
    {
        if ($candidatura->isAssinada()) {
            return back()->with('error', 'Não é possível rejeitar uma candidatura já assinada.');
        }

        $request->validate([
            'motivo_rejeicao' => 'required|string|max:1000',
        ], [
            'motivo_rejeicao.required' => 'Indique o motivo da rejeição.',
        ]);

        $nota = "[Rejeitado por " . Auth::user()->name . " em " . now()->format('d/m/Y H:i') . "]\n" .
                $request->input('motivo_rejeicao');

        $candidatura->update([
            'status'      => 'rejeitada',
            'notas_admin' => $nota,
        ]);

        AuditLog::registar('rejeitou_candidatura', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        return redirect()->route('daac.candidaturas.index')
            ->with('success', "Candidatura de {$candidatura->nome} rejeitada por " . Auth::user()->name . ".");
    }
}
