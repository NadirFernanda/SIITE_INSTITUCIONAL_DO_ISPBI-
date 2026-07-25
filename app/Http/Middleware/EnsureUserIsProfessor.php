<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSubcomissaoCorrecao
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'subcomissao_correcao'], true)) {
            abort(403, 'Acesso restrito a membros da Subcomissão de Correcção.');
        }

        return $next($request);
    }
}
