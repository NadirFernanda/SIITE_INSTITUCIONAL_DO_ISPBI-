<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     * Only users with role === 'admin' may pass through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            // Log out any non-admin user that somehow got through 'auth'
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect silently rather than returning a 403 that reveals the
            // admin panel exists at this URL (prevents path enumeration).
            return redirect('/');
        }

        $role = (string) Auth::user()->role;
        $role = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $role));
        $role = preg_replace('/[^a-z0-9]/', '', $role);

        if ($role !== 'admin') {
            // Log out any non-admin user that somehow got through 'auth'
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect silently rather than returning a 403 that reveals the
            // admin panel exists at this URL (prevents path enumeration).
            return redirect('/');
        }

        return $next($request);
    }
}
