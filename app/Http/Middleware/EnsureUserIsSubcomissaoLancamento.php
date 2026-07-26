<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSubcomissaoLancamento
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        
        // Check if user has permission for this role (including admin override)
        if (! $user->hasRole('lancamento') && ! $user->hasRole('admin')) {
            return abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
