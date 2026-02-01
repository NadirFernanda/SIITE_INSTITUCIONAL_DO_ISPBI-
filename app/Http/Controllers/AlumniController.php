<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnus;

class AlumniController extends Controller
{
    public function show($id)
    {
        $alumnus = Alumnus::where('id', $id)
            ->where('publicado', true)
            ->where('testemunho', true)
            ->firstOrFail();

        return view('pages.alumni-show', compact('alumnus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'ano' => 'required|integer|min:1950|max:2100',
            'contacto' => 'required|string|max:255',
            'trabalha' => 'required|in:sim,nao',
            'empresa' => 'nullable|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'satisfacao' => 'nullable|string',
        ]);

        $alumnus = new Alumnus();
        $alumnus->nome = $validated['nome'];
        $alumnus->curso = $validated['curso'];
        $alumnus->ano = $validated['ano'];
        $alumnus->contacto = $validated['contacto'];
        $alumnus->trabalha = $validated['trabalha'] === 'sim';
        $alumnus->empresa = $validated['trabalha'] === 'sim' ? $validated['empresa'] : null;
        $alumnus->cargo = $validated['trabalha'] === 'sim' ? $validated['cargo'] : null;
        $alumnus->satisfacao = $validated['trabalha'] === 'sim' ? $validated['satisfacao'] : null;
        $alumnus->save();

        return redirect()->route('alumni')->with('success', 'Cadastro enviado com sucesso!');
    }
}
