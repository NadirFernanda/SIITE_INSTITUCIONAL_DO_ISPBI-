<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsDAAC
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            // If not authenticated, redirect to the login page as a guest so Laravel
            // stores the intended URL in the session and returns the user there after login.
            return redirect()->guest(route('login'));
        }

        $user = Auth::user();
        
        if (! $user->hasRole('daac') && ! $user->hasRole('admin')) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // Non-authorized users should be sent to login rather than the public root.
            return redirect()->route('login');
        }

        return $next($request);
    }
}
