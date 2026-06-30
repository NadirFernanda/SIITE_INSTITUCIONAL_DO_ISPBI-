<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Já autenticado como alumni aprovado → portal
        if (Auth::check() && Auth::user()->role === 'alumni') {
            return Auth::user()->aprovado
                ? redirect()->route('portal.dashboard')
                : redirect()->route('portal.pendente');
        }

        // Já autenticado como outro role → não tem acesso ao portal alumni
        if (Auth::check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        return view('portal.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Insira um e-mail válido.',
            'password.required' => 'A palavra-passe é obrigatória.',
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'E-mail ou palavra-passe incorrectos.',
            ]);
        }

        $user = Auth::user();

        // Só alumni podem entrar pelo portal
        if ($user->role !== 'alumni') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Esta área é exclusiva para alumni. Utilize o acesso institucional.',
            ]);
        }

        $request->session()->regenerate();

        return $user->aprovado
            ? redirect()->route('portal.dashboard')
            : redirect()->route('portal.pendente');
    }

    public function showRegister()
    {
        return view('portal.register');
    }

    public function register(Request $request)
    {
        $cursosPermitidos = [
            'Informática de Gestão',
            'Gestão de Recursos Hídricos',
            'Psicologia',
            'Comunicação Social',
            'Contabilidade e Finanças',
            'Enfermagem',
            'Outro',
        ];

        $validated = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'curso'    => 'required|string|in:' . implode(',', $cursosPermitidos),
            'ano'      => 'required|integer|min:1990|max:2030',
        ], [
            'nome.required'       => 'O nome é obrigatório.',
            'nome.max'            => 'O nome não pode ter mais de 255 caracteres.',
            'email.required'      => 'O endereço de e-mail é obrigatório.',
            'email.email'         => 'Por favor insira um endereço de e-mail válido.',
            'email.unique'        => 'Este endereço de e-mail já está registado.',
            'password.required'   => 'A palavra-passe é obrigatória.',
            'password.min'        => 'A palavra-passe deve ter pelo menos 8 caracteres.',
            'password.confirmed'  => 'As palavras-passe não coincidem.',
            'curso.required'      => 'O curso é obrigatório.',
            'curso.in'            => 'Selecione um curso válido da lista.',
            'ano.required'        => 'O ano de conclusão é obrigatório.',
            'ano.integer'         => 'O ano de conclusão deve ser um número inteiro.',
            'ano.min'             => 'O ano de conclusão deve ser a partir de 1990.',
            'ano.max'             => 'O ano de conclusão não pode ser superior a 2030.',
        ]);

        $user = new User();
        $user->name     = $validated['nome'];
        $user->email    = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->forceFill([
            'role'     => 'alumni',
            'aprovado' => false,
        ]);
        $user->save();

        Alumnus::create([
            'nome'      => $validated['nome'],
            'curso'     => $validated['curso'],
            'ano'       => $validated['ano'],
            'user_id'   => $user->id,
            'contacto'  => '',
            'trabalha'  => false,
            'publicado' => false,
        ]);

        return redirect()->route('portal.pendente')
            ->with('success', 'A sua conta está a ser analisada pelo administrador. Receberá acesso em breve.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
