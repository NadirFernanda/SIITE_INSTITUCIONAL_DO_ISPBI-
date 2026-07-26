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

        if (! $user->hasRole('alumni')) {
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
