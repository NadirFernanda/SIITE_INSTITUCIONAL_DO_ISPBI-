<?php

namespace App\Http\Controllers\Secretaria;

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
        // Não confirmadas primeiro (precisam de acção), confirmadas por último —
        // dentro de cada grupo, as mais recentes aparecem primeiro.
        $query = Candidatura::query()
            ->orderBy('pagamento_confirmado')
            ->orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->buscaTexto($request->input('q'), ['nome', 'email', 'bi', 'telefone']);
        }

        if ($request->filled('pagamento')) {
            $query->where('pagamento_confirmado', $request->input('pagamento') === 'sim');
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        $candidaturas = $query->paginate(25)->withQueryString();

        if ($request->ajax()) {
            return view('secretaria.candidaturas._resultados', compact('candidaturas'));
        }

        $totais = [
            'total'       => Candidatura::count(),
            'confirmados' => Candidatura::where('pagamento_confirmado', true)->count(),
            'pendentes'   => Candidatura::where('pagamento_confirmado', false)->count(),
        ];

        return view('secretaria.candidaturas.index', compact('candidaturas', 'totais'));
    }

    public function show(Candidatura $candidatura)
    {
        return view('secretaria.candidaturas.show', compact('candidatura'));
    }

    public function confirmarPagamento(Request $request, Candidatura $candidatura)
    {
        if ($candidatura->pagamento_confirmado) {
            return back()->with('error', 'O pagamento desta candidatura já foi confirmado.');
        }

        $candidatura->update([
            'pagamento_confirmado'    => true,
            'pagamento_confirmado_em' => now(),
            'pagamento_confirmado_por' => Auth::id(),
        ]);

        AuditLog::registar('confirmou_pagamento', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        try {
            if (app(WhatsAppService::class)->notificarPagamentoConfirmado($candidatura)) {
                $candidatura->forceFill([
                    'whatsapp_pagamento_enviado_at' => now(),
                    'whatsapp_pagamento_falhou_em'  => null,
                ])->save();
            } else {
                $candidatura->forceFill(['whatsapp_pagamento_falhou_em' => now()])->save();
            }
        } catch (\Throwable $e) {
            \Log::error('WhatsApp pagamento confirmado: ' . $e->getMessage());
            $candidatura->forceFill(['whatsapp_pagamento_falhou_em' => now()])->save();
        }

        return back()->with('success', "Pagamento da Ficha #{$candidatura->id} confirmado com sucesso.");
    }

    public function cancelarPagamento(Candidatura $candidatura)
    {
        if (! $candidatura->pagamento_confirmado) {
            return back()->with('error', 'Esta candidatura não tem pagamento confirmado.');
        }

        $candidatura->update([
            'pagamento_confirmado'     => false,
            'pagamento_confirmado_em'  => null,
            'pagamento_confirmado_por' => null,
        ]);

        AuditLog::registar('cancelou_pagamento', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} ({$candidatura->curso})");

        return back()->with('success', "Confirmação de pagamento da Ficha #{$candidatura->id} cancelada.");
    }
}
