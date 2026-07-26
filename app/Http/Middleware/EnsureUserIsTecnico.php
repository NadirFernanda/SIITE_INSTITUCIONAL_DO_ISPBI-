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
        if (! Auth::check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

        $role = (string) Auth::user()->role;
        $role = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $role));
        $role = preg_replace('/[^a-z0-9]/', '', $role);

        if (! in_array($role, ['admin', 'tecnico'], true)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

        return $next($request);
    }
}
