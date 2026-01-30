<?php
namespace App\Http\Controllers\Admin;

use App\Models\Carrossel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarrosselController extends Controller
{
    public function update(Request $request, $id)
    {
        $carrossel = Carrossel::findOrFail($id);
        $request->validate([
            'imagem' => 'nullable|image|max:4096',
            'titulo' => 'nullable',
            'subtitulo' => 'nullable',
            'texto_botao' => 'nullable',
            'link' => 'nullable',
            'ordem' => 'nullable|integer',
        ]);
        $data = [
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'texto_botao' => $request->texto_botao,
            'link' => $request->link,
            'ordem' => $request->ordem ?? 0,
            'publicado' => $request->has('publicado'),
        ];
        if ($request->hasFile('imagem')) {
            // Remove imagem antiga
            \Storage::disk('public')->delete($carrossel->imagem);
            $data['imagem'] = $request->file('imagem')->store('carrossel', 'public');
        }
        $carrossel->update($data);
        return redirect('/admin/carrossel')->with('success', 'Carrossel atualizado com sucesso!');
    }
    public function edit($id)
    {
        $carrossel = Carrossel::findOrFail($id);
        return view('admin.carrossel.edit', compact('carrossel'));
    }
    public function index()
    {
        $carrosseis = Carrossel::orderBy('ordem')->get();
        return view('admin.carrossel', compact('carrosseis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|max:4096',
            'titulo' => 'nullable',
            'subtitulo' => 'nullable',
            'texto_botao' => 'nullable',
            'link' => 'nullable',
            'ordem' => 'nullable|integer',
        ]);
        $path = $request->file('imagem')->store('carrossel', 'public');
        Carrossel::create([
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'texto_botao' => $request->texto_botao,
            'imagem' => $path,
            'link' => $request->link,
            'ordem' => $request->ordem ?? 0,
        ]);
        return redirect('/admin/carrossel')->with('success', 'Imagem adicionada ao carrossel!');
    }

    public function destroy($id)
    {
        $item = Carrossel::findOrFail($id);
        \Storage::disk('public')->delete($item->imagem);
        $item->delete();
        return redirect('/admin/carrossel')->with('success', 'Imagem removida do carrossel!');
    }

    public function togglePublicar($id)
    {
        $carrossel = Carrossel::findOrFail($id);
        $carrossel->publicado = !$carrossel->publicado;
        $carrossel->save();
        return redirect()->back()->with('success', 'Status de publicação alterado!');
    }
}
