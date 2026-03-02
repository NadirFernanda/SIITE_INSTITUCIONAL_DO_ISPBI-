<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\ConcursoAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConcursoPublished;

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
                // store on the public disk so files are served from /storage
                $path = $file->store('concursos', 'public');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        // If published on create, notify
        if ($concurso->status === 'published') {
            try {
                // queue email to avoid blocking request; requires a queue worker (QUEUE_CONNECTION not 'sync')
                Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->queue(new ConcursoPublished($concurso));
            } catch (\Throwable $e) {
                // fallback to synchronous send if queueing fails
                try {
                    Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->send(new ConcursoPublished($concurso));
                } catch (\Throwable $e2) {
                    \Log::error('Falha ao enviar email de concurso publicado: '.$e2->getMessage());
                }
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

        $was = $concurso->status;
        $concurso->update($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('concursos', 'public');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        // If changed to published, notify
        if ($concurso->status === 'published' && $was !== 'published') {
            try {
                Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->queue(new ConcursoPublished($concurso));
            } catch (\Throwable $e) {
                try {
                    Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->send(new ConcursoPublished($concurso));
                } catch (\Throwable $e2) {
                    \Log::error('Falha ao enviar email de concurso publicado: '.$e2->getMessage());
                }
            }
        }

        return redirect()->route('admin.concursos.index')->with('status', 'Concurso atualizado.');
    }

    public function destroy(Concurso $concurso)
    {
        // delete attached files
        foreach ($concurso->attachments as $att) {
            try {
                // attachments may be stored with a 'public/' prefix from older code,
                // normalize and delete from the public disk
                $p = preg_replace('/^public\\//', '', $att->path);
                Storage::disk('public')->delete($p);
            } catch (\\Throwable $e) { }
        }
        $concurso->delete();
        return redirect()->route('admin.concursos.index')->with('status', 'Concurso removido.');
    }

    public function destroyAttachment($id)
    {
        $att = ConcursoAttachment::findOrFail($id);
        try {
            $p = preg_replace('/^public\\//', '', $att->path);
            Storage::disk('public')->delete($p);
        } catch (\\Throwable $e) { }
        $att->delete();
        return back()->with('status', 'Anexo removido.');
    }
}
