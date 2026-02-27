<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResultadosController extends Controller
{
    /**
     * Proxy login to external validation endpoint and return JSON.
     */
    public function validar(Request $request)
    {
        $url = 'https://app.multiplo.io/isp-bie/_config/valid.php';

        $payload = [
            'Email' => $request->input('Email'),
            'Senha' => $request->input('Senha'),
            'Entrar' => $request->input('Entrar', 'Entrar'),
        ];

        try {
            // Send as form-data (application/x-www-form-urlencoded)
            $resp = Http::asForm()->post($url, $payload);
        } catch (\Exception $e) {
            // log and return error (do not disable SSL verification in production)
            Log::error('Unable to contact external validation: '.$e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Erro ao contactar o servidor remoto.'], 500);
            }
            return redirect()->back()->with('resultados_error', 'Erro ao contactar o servidor remoto. Por favor tente mais tarde.');
        }

        // If remote responded with redirect to an error page
        $location = $resp->header('Location', '');
        if (in_array($resp->status(), [301, 302]) && str_contains($location, 'erro')) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Credenciais inválidas.'], 401);
            }
            return redirect()->back()->with('resultados_error', 'Credenciais inválidas.');
        }

        // If remote responded with a redirect and it does NOT contain 'erro', treat as success and redirect the browser (server-side) for non-AJAX submissions, or return redirect URL for AJAX
        if (in_array($resp->status(), [301, 302]) && !str_contains($location, 'erro') && !empty($location)) {
            // resolve relative locations
            $redirect = $location;
            if (!str_starts_with($redirect, 'http')) {
                $base = 'https://app.multiplo.io/isp-bie/';
                $redirect = rtrim($base, '/') . '/' . ltrim($redirect, '/');
            }
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'redirect' => $redirect], 200);
            }
            return redirect()->to($redirect);
        }

        // Heuristic: if the returned HTML contains the sign-in modal or 'erro' treat as failure
        $body = (string) $resp->body();
        if ($resp->status() === 200 && (str_contains($body, 'modal-signin') || str_contains($body, 'index.php?erro') || str_contains($body, 'Entrar'))) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Credenciais inválidas.'], 401);
            }
            return redirect()->back()->with('resultados_error', 'Credenciais inválidas.');
        }

        // If successful but no redirect header, send a default portal redirect
        if ($resp->successful()) {
            $portal = 'https://app.multiplo.io/isp-bie/';
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'redirect' => $portal], 200);
            }
            return redirect()->to($portal);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Erro no servidor remoto.'], 500);
        }
        return redirect()->back()->with('resultados_error', 'Erro no servidor remoto.');
    }
}
