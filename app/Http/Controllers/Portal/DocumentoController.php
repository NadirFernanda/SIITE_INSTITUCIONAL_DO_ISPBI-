<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AlumniDocumento;
use App\Services\AlumniDocumentStorage;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = AlumniDocumento::orderByDesc('created_at')->get();
        return view('portal.documentos', compact('documentos'));
    }

    public function download(AlumniDocumento $documento, AlumniDocumentStorage $storage)
    {
        $disk = $storage->diskFor($documento->ficheiro);
        abort_if($disk === null, 404, 'Ficheiro não encontrado.');

        return Storage::disk($disk)->download($documento->ficheiro, basename($documento->ficheiro));
    }
}
