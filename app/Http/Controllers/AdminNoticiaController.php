<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Storage;

class AdminNoticiaController extends Controller
{
    public function togglePublicar($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->publicada = !$noticia->publicada;
        $noticia->save();
        return redirect()->route('admin.noticias')->with('success', 'Status de publicação atualizado!');
    }
    public function create()
    {
        return view('admin.noticias-create');
    }
    public function index()
    {
        $noticias = Noticia::orderByDesc('data')->get();
        return view('admin.noticias', compact('noticias'));
    }
    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.noticias-edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
            'data' => 'required|date',
            'institucional' => 'required|boolean',
        ]);

        if ($request->hasFile('imagem')) {
            if ($noticia->imagem) Storage::disk('public')->delete($noticia->imagem);
            $validated['imagem'] = $request->file('imagem')->store('noticias/imagens', 'public');
        }
        if ($request->hasFile('pdf')) {
            if ($noticia->pdf) Storage::disk('public')->delete($noticia->pdf);
            $validated['pdf'] = $request->file('pdf')->store('noticias/pdfs', 'public');
        }

        $validated['institucional'] = (bool) $request->input('institucional', false);
        $noticia->update($validated);
        return redirect()->route('admin.noticias')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        if ($noticia->imagem) Storage::disk('public')->delete($noticia->imagem);
        if ($noticia->pdf) Storage::disk('public')->delete($noticia->pdf);
        $noticia->delete();
        return redirect()->route('admin.noticias')->with('success', 'Notícia apagada com sucesso!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
            'data' => 'required|date',
            'institucional' => 'required|boolean',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('noticias/imagens', 'public');
        }
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $request->file('pdf')->store('noticias/pdfs', 'public');
        }

        $validated['institucional'] = (bool) $request->input('institucional', false);
        Noticia::create($validated);
        return redirect()->route('admin.noticias')->with('success', 'Notícia cadastrada com sucesso!');
    }
}
