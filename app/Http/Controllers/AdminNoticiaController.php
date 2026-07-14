<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\NoticiaDocumento;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminNoticiaController extends Controller
{
    public function togglePublicar($id)
    {
        $noticia = Noticia::findOrFail($id);
        Gate::authorize('update', $noticia);
        $noticia->publicada = !$noticia->publicada;
        $noticia->save();
        return redirect()->route('admin.noticias')->with('success', 'Status de publicação atualizado!');
    }

    public function create()
    {
        Gate::authorize('create', Noticia::class);
        return view('admin.noticias-create');
    }

    public function index()
    {
        Gate::authorize('viewAny', Noticia::class);
        $noticias = Noticia::orderByDesc('data')->get();
        return view('admin.noticias', compact('noticias'));
    }

    public function edit($id)
    {
        $noticia = Noticia::with('documentos')->findOrFail($id);
        Gate::authorize('update', $noticia);
        return view('admin.noticias-edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);
        Gate::authorize('update', $noticia);

        $validated = $request->validate([
            'titulo'        => 'required|string|max:255',
            'texto'         => 'required|string|max:65535',
            'imagem'        => 'nullable|image|max:2048',
            'documentos'    => 'nullable|array|max:20',
            'documentos.*'  => 'file|extensions:pdf,doc,docx|max:10240',
            'data'          => 'required|date',
            'institucional' => 'required|boolean',
        ], [
            'documentos.*.extensions' => 'Apenas ficheiros PDF, DOC e DOCX são permitidos.',
            'documentos.*.max'   => 'Cada documento não pode ultrapassar 10 MB.',
        ]);

        if ($request->hasFile('imagem')) {
            if ($noticia->imagem) Storage::disk('public')->delete($noticia->imagem);
            $validated['imagem'] = $request->file('imagem')->store('noticias/imagens', 'public');
        }

        unset($validated['documentos']);
        $validated['institucional'] = (bool) $request->input('institucional', false);
        $validated['publicada']     = $request->boolean('publicada');
        $noticia->update($validated);

        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $caminho = $file->store('noticias/documentos', 'public');
                $noticia->documentos()->create([
                    'nome_original' => $file->getClientOriginalName(),
                    'caminho'       => $caminho,
                ]);
            }
        }

        return redirect()->route('admin.noticias')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $noticia = Noticia::with('documentos')->findOrFail($id);
        Gate::authorize('delete', $noticia);

        if ($noticia->imagem) Storage::disk('public')->delete($noticia->imagem);
        if ($noticia->pdf)    Storage::disk('public')->delete($noticia->pdf);

        foreach ($noticia->documentos as $doc) {
            Storage::disk('public')->delete($doc->caminho);
        }
        $noticia->documentos()->delete();
        $noticia->delete();

        return redirect()->route('admin.noticias')->with('success', 'Notícia apagada com sucesso!');
    }

    public function destroyDocumento(NoticiaDocumento $documento)
    {
        Gate::authorize('update', $documento->noticia);
        Storage::disk('public')->delete($documento->caminho);
        $documento->delete();
        return back()->with('success', 'Documento removido.');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Noticia::class);

        $validated = $request->validate([
            'titulo'        => 'required|string|max:255',
            'texto'         => 'required|string|max:65535',
            'imagem'        => 'nullable|image|max:2048',
            'documentos'    => 'nullable|array|max:20',
            'documentos.*'  => 'file|extensions:pdf,doc,docx|max:10240',
            'data'          => 'required|date',
            'institucional' => 'required|boolean',
        ], [
            'documentos.*.extensions' => 'Apenas ficheiros PDF, DOC e DOCX são permitidos.',
            'documentos.*.max'   => 'Cada documento não pode ultrapassar 10 MB.',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('noticias/imagens', 'public');
        }

        unset($validated['documentos']);
        $validated['institucional'] = (bool) $request->input('institucional', false);
        $validated['publicada']     = $request->boolean('publicada');
        $noticia = Noticia::create($validated);

        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $caminho = $file->store('noticias/documentos', 'public');
                $noticia->documentos()->create([
                    'nome_original' => $file->getClientOriginalName(),
                    'caminho'       => $caminho,
                ]);
            }
        }

        return redirect()->route('admin.noticias')->with('success', 'Notícia cadastrada com sucesso!');
    }
}
