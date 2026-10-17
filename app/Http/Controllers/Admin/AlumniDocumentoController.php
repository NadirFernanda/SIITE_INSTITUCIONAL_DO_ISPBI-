<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniDocumentoController extends Controller
{
    public function index()
    {
        $documentos = AlumniDocumento::orderByDesc('created_at')->get();
        return view('admin.alumni-documentos', compact('documentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'nullable|string|max:2000',
            'ficheiro'  => 'required|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'titulo.required'    => 'O título é obrigatório.',
            'titulo.max'         => 'O título não pode ter mais de 255 caracteres.',
            'ficheiro.required'  => 'O ficheiro é obrigatório.',
            'ficheiro.file'      => 'O campo deve conter um ficheiro.',
            'ficheiro.mimes'     => 'Apenas ficheiros PDF, DOC e DOCX são permitidos.',
            'ficheiro.max'       => 'O ficheiro não pode ter mais de 10 MB.',
        ]);

        $file    = $request->file('ficheiro');
        $path    = $file->store('alumni-documentos', 'public');
        $tamanho = $this->formatBytes($file->getSize());

        AlumniDocumento::create([
            'titulo'    => $validated['titulo'],
            'descricao' => $validated['descricao'] ?? null,
            'ficheiro'  => $path,
            'tamanho'   => $tamanho,
        ]);

        return redirect()->route('admin.alumni-documentos.index')
            ->with('success', 'Documento carregado com sucesso.');
    }

    public function destroy(AlumniDocumento $documento)
    {
        if (Storage::disk('public')->exists($documento->ficheiro)) {
            Storage::disk('public')->delete($documento->ficheiro);
        }

        $documento->delete();

        return redirect()->route('admin.alumni-documentos.index')
            ->with('success', 'Documento eliminado com sucesso.');
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
