<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();
        $role = $user->role ?? '';

        if (! in_array($role, ['admin', 'tecnico', 'daac', 'lancamento', 'alumni'], true)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $destination = match(true) {
            $role === 'admin'      => route('admin', absolute: false),
            $role === 'daac'       => route('daac.candidaturas.index', absolute: false),
            $role === 'tecnico'    => route('tecnico.candidaturas.index', absolute: false),
            $role === 'lancamento' => route('lancamento.salas.index', absolute: false),
            $role === 'alumni' && $user->aprovado  => route('portal.dashboard', absolute: false),
            $role === 'alumni' && ! $user->aprovado => route('portal.pendente', absolute: false),
            default => '/',
        };

        return redirect()->intended($destination);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
