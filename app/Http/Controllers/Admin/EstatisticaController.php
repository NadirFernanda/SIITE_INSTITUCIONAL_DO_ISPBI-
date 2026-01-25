<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estatisticas = \App\Models\Estatistica::orderBy('ordem')->get();
        return view('admin.estatisticas.index', compact('estatisticas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.estatisticas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'ordem' => 'nullable|integer',
            'icone' => 'nullable|string|max:255',
        ]);

        \App\Models\Estatistica::create($request->only(['titulo', 'valor', 'descricao', 'ordem', 'icone']));

        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estatistica = \App\Models\Estatistica::findOrFail($id);
        return view('admin.estatisticas.edit', compact('estatistica'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'valor' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'ordem' => 'nullable|integer',
            'icone' => 'nullable|string|max:255',
        ]);

        $estatistica = \App\Models\Estatistica::findOrFail($id);
        $estatistica->update($request->only(['titulo', 'valor', 'descricao', 'ordem', 'icone']));

        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estatistica = \App\Models\Estatistica::findOrFail($id);
        $estatistica->delete();
        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística excluída com sucesso!');
    }
}
