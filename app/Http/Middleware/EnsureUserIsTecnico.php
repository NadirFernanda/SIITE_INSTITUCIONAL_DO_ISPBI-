<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTecnico
{
    /**
     * Permite acesso a utilizadores com role 'admin' ou 'tecnico'.
     * Qualquer outro role é silenciosamente rejeitado.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! in_array(Auth::user()->role, ['admin', 'tecnico'], true)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

        return $next($request);
    }
}
