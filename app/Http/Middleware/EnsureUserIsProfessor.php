<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsProfessor
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! in_array($request->user()->role, ['admin', 'professor'], true)) {
            abort(403, 'Acesso restrito ao perfil Professor.');
        }
        return $next($request);
    }
}
