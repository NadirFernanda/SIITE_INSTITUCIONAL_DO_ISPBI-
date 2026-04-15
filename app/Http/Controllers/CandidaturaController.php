<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'telefone'       => 'required|string|max:50',
            'bi'             => 'nullable|string|max:20',
            'data_nascimento'=> 'nullable|date|before:today',
            'curso'          => ['required', 'string', 'in:' . implode(',', Candidatura::$cursos)],
            'escola_origem'  => 'nullable|string|max:255',
            'ano_conclusao'  => 'nullable|integer|min:1990|max:' . date('Y'),
            'observacoes'    => 'nullable|string|max:2000',
        ]);

        Candidatura::create($request->only([
            'nome', 'email', 'telefone', 'bi',
            'data_nascimento', 'curso', 'escola_origem',
            'ano_conclusao', 'observacoes',
        ]));

        return redirect()->route('candidaturas')
            ->with('candidatura_success', 'Candidatura submetida com sucesso! Entraremos em contacto em breve.');
    }
}
