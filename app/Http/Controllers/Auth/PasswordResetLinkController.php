<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Envia o link se o email existir, mas devolve sempre a mesma mensagem
        // genérica — não revelar se um endereço está ou não registado evita
        // enumeração de contas de staff (defesa contra phishing direccionado).
        Password::sendResetLink($request->only('email'));

        return back()->with('status', 'Se esse endereço de email estiver associado a uma conta, foi enviado um link de recuperação de password.');
    }
}
