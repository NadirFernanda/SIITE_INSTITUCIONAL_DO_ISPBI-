<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAlumni
{
    /**
     * Handle an incoming request.
     * Only alumni users with aprovado=true may pass through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('portal.login');
        }

        $user = Auth::user();

        $role = (string) $user->role;
        $role = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $role));
        $role = preg_replace('/[^a-z0-9]/', '', $role);

        if ($role !== 'alumni') {
            // Não é alumni — deslogar e enviar para o login do portal
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('portal.login');
        }

        if (! $user->aprovado) {
            return redirect()->route('portal.pendente');
        }

        return $next($request);
    }
}
