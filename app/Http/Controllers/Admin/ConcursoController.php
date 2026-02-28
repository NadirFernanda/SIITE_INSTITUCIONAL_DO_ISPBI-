<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\ConcursoAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConcursoController extends Controller
{
    public function index()
    {
        $concursos = Concurso::orderByDesc('publish_at')->paginate(20);
        return view('admin.concursos.index', compact('concursos'));
    }

    public function create()
    {
        return view('admin.concursos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'publish_at' => 'nullable|date',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:10240',
        ]);

        $concurso = Concurso::create($data + ['created_by' => auth()->id()]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('public/concursos');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('admin.concursos.index')->with('status', 'Concurso criado.');
    }

    public function edit(Concurso $concurso)
    {
        return view('admin.concursos.edit', compact('concurso'));
    }

    public function update(Request $request, Concurso $concurso)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'publish_at' => 'nullable|date',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:10240',
        ]);

        $concurso->update($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('public/concursos');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('admin.concursos.index')->with('status', 'Concurso atualizado.');
    }

    public function destroy(Concurso $concurso)
    {
        // delete attached files
        foreach ($concurso->attachments as $att) {
            try { Storage::delete($att->path); } catch (\Throwable $e) { }
        }
        $concurso->delete();
        return redirect()->route('admin.concursos.index')->with('status', 'Concurso removido.');
    }
}
