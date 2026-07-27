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
            // If not authenticated, redirect guest to login so Laravel preserves the intended URL.
            return redirect()->guest(route('login'));
        }

        $user = Auth::user();
        
        // Normalize role to allow case/accents variations stored in DB (e.g., "Presidência" -> "presidencia")
        if (! $user->hasRole('secretaria') && ! $user->hasRole('admin')) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // Non-authorized users should be sent to login rather than the public root.
            return redirect()->route('login');
        }

        return $next($request);
    }
}
