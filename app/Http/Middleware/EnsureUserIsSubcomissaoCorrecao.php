<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSubcomissaoCorrecao
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            abort(403, 'Acesso restrito a membros da Subcomissão de Correcção.');
        }

        $role = (string) Auth::user()->role;
        $role = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $role));
        $role = preg_replace('/[^a-z0-9]/', '', $role);

        if (! in_array($role, ['admin', 'subcomissao_correcao'], true)) {
            abort(403, 'Acesso restrito a membros da Subcomissão de Correcção.');
        }

        return $next($request);
    }
}
