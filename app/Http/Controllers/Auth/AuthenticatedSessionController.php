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

        // Normalize role (remove accents, lowercase, strip non-alphanum)
        $normRole = mb_strtolower(@iconv('UTF-8', 'ASCII//TRANSLIT', (string) $role));
        $normRole = preg_replace('/[^a-z0-9]/', '', $normRole);

        \Log::info("Login: user={$user->email}, rawRole={$role}, normRole={$normRole}");

        $allowed = [
            'admin', 'tecnico', 'daac', 'lancamento', 'alumni', 'presidencia', 'secretaria',
            'subcomissaocorrecao', 'subcomissaolancamento', 'professor'
        ];

        if (! in_array($normRole, $allowed, true)) {
            \Log::warning("Login rejected: role '{$normRole}' not in allowed list");
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Resolve destination
        $destination = match(true) {
            $normRole === 'admin' => route('admin', absolute: false),
            $normRole === 'daac' => route('daac.candidaturas.index', absolute: false),
            $normRole === 'tecnico' => route('tecnico.candidaturas.index', absolute: false),
            $normRole === 'lancamento' || $normRole === 'subcomissaolancamento' => route('lancamento.salas.index', absolute: false),
            $normRole === 'professor' || $normRole === 'subcomissaocorrecao' => route('professor.candidaturas.index', absolute: false),
            $normRole === 'presidencia' => route('presidencia.salas.index', absolute: false),
            $normRole === 'secretaria' => route('secretaria.candidaturas.index', absolute: false),
            $normRole === 'alumni' && $user->aprovado => route('portal.dashboard', absolute: false),
            $normRole === 'alumni' && ! $user->aprovado => route('portal.pendente', absolute: false),
            default => null,
        };

        if ($destination === null) {
            \Log::error("Login: no destination found for role '{$normRole}'");
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Conta sem acesso configurado.',
            ]);
        }

        \Log::info("Login success: redirecting to {$destination}");

        // Não usar redirect()->intended() aqui: se o utilizador tinha uma
        // 'url.intended' antiga na sessão (ex.: uma tentativa anterior de aceder a
        // uma área doutro perfil, ou um link partilhado que já não corresponde ao
        // seu papel), intended() enviava-o para essa URL desatualizada em vez do
        // destino correcto — o middleware de papel dessa página rejeitava-o e
        // devolvia-o ao login, dando a impressão de que "o login não funcionou à
        // primeira". Já calculámos o destino certo para este papel, por isso
        // vamos sempre direto para lá.
        $request->session()->forget('url.intended');

        return redirect()->to($destination);
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
