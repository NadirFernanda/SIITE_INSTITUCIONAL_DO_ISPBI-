<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSecretaria
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        
        // Normalize role to allow case/accents variations stored in DB (e.g., "Presidência" -> "presidencia")
        if (! $user->hasRole('secretaria') && ! $user->hasRole('admin')) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

        return $next($request);
    }
}
