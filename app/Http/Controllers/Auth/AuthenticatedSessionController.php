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

        // Normalize role (remove accents, lowercase, strip non-alphanum) to match middleware normalization
        $normRole = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', (string) $role));
        $normRole = preg_replace('/[^a-z0-9]/', '', $normRole);

        $allowed = [
            'admin', 'tecnico', 'daac', 'lancamento', 'alumni', 'presidencia', 'secretaria',
            'subcomissaocorrecao', 'subcomissaolancamento', 'professor'
        ];

        if (! in_array($normRole, $allowed, true)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Resolve destination using normalized role and known mappings
        $destination = match(true) {
            $normRole === 'admin' => route('admin', absolute: false),
            $normRole === 'daac' => route('daac.candidaturas.index', absolute: false),
            $normRole === 'tecnico' => route('tecnico.candidaturas.index', absolute: false),
            // both 'lancamento' and 'subcomissaolancamento' map to lancamento panel
            $normRole === 'lancamento' || $normRole === 'subcomissaolancamento' => route('lancamento.salas.index', absolute: false),
            // professores / subcomissao de correcao map to professor panel
            $normRole === 'professor' || $normRole === 'subcomissaocorrecao' => route('professor.candidaturas.index', absolute: false),
            $normRole === 'presidencia' => route('presidencia.salas.index', absolute: false),
            $normRole === 'secretaria' => route('secretaria.candidaturas.index', absolute: false),
            $normRole === 'alumni' && $user->aprovado => route('portal.dashboard', absolute: false),
            $normRole === 'alumni' && ! $user->aprovado => route('portal.pendente', absolute: false),
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
