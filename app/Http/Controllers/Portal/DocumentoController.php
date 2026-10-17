<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AlumniDocumento;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = AlumniDocumento::orderByDesc('created_at')->get();
        return view('portal.documentos', compact('documentos'));
    }

    public function download(AlumniDocumento $documento)
    {
        if (! Storage::disk('public')->exists($documento->ficheiro)) {
            abort(404, 'Ficheiro não encontrado.');
        }

        return Storage::disk('public')->download($documento->ficheiro, basename($documento->ficheiro));
    }
}
