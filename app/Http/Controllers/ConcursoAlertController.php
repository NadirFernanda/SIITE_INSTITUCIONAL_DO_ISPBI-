<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConcursoAlert;
use Illuminate\Support\Facades\Log;

class ConcursoAlertController extends Controller
{
    /**
     * Store a new alert subscription.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'interests' => 'nullable|array',
            'interests.*' => 'string|max:255',
            'consent' => 'accepted',
        ]);

        try {
            $alert = ConcursoAlert::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'interests' => $data['interests'] ?? null,
                'consent' => true,
            ]);

            // Optionally: send a confirmation email to the user or notify admins
            // For now, log the subscription for operational visibility
            Log::info('New concurso alert subscription', ['id' => $alert->id, 'email' => $alert->email]);

            if ($request->expectsJson()) {
                return response()->json(['status' => 'ok', 'message' => 'Inscrição recebida. Obrigado.'], 201);
            }

            return redirect()->back()->with('alert_status', 'Inscrição recebida. Obrigado.');

        } catch (\Throwable $e) {
            Log::error('Failed to store concurso alert: '.$e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Erro ao processar pedido.'], 500);
            }
            return redirect()->back()->withErrors('Erro ao processar o pedido. Por favor, tente novamente.');
        }
    }
}
