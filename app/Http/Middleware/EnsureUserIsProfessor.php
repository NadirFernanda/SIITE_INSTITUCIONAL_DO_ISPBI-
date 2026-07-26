<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsProfessor
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            abort(403, 'Acesso restrito a membros da Subcomissão de Correcção.');
        }

        $user = Auth::user();
        
        if (! $user->hasRole('correcao') && ! $user->hasRole('admin')) {
            abort(403, 'Acesso restrito a membros da Subcomissão de Correcção.');
        }

        return $next($request);
    }
}
