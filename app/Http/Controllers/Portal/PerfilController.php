<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function edit()
    {
        $alumnus = Alumnus::where('user_id', auth()->id())->firstOrFail();
        return view('portal.perfil', compact('alumnus'));
    }

    public function update(Request $request)
    {
        $alumnus = Alumnus::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'contacto'  => 'nullable|string|max:50',
            'trabalha'  => 'required|in:sim,nao',
            'empresa'   => 'nullable|string|max:255',
            'pais'      => 'nullable|string|max:100',
            'cargo'     => 'nullable|string|max:255',
            'satisfacao' => 'nullable|string|max:2000',
        ], [
            'contacto.max'   => 'O contacto não pode ter mais de 50 caracteres.',
            'trabalha.required' => 'Por favor indique se está empregado.',
            'trabalha.in'    => 'Valor inválido para o campo de emprego.',
            'empresa.max'    => 'O nome da empresa não pode ter mais de 255 caracteres.',
            'pais.max'       => 'O país não pode ter mais de 100 caracteres.',
            'cargo.max'      => 'O cargo não pode ter mais de 255 caracteres.',
            'satisfacao.max' => 'O testemunho não pode ter mais de 2000 caracteres.',
        ]);

        $alumnus->contacto  = $validated['contacto'] ?? null;
        $alumnus->trabalha  = $validated['trabalha'] === 'sim';
        $alumnus->empresa   = $validated['trabalha'] === 'sim' ? ($validated['empresa'] ?? null) : null;
        $alumnus->pais      = $validated['pais'] ?? null;
        $alumnus->cargo     = $validated['trabalha'] === 'sim' ? ($validated['cargo'] ?? null) : null;
        $alumnus->satisfacao = $validated['satisfacao'] ?? null;
        $alumnus->save();

        return redirect()->route('portal.perfil')->with('success', 'Perfil actualizado com sucesso.');
    }
}
