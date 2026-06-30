<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AlumniDocumento;
use App\Models\Alumnus;
use App\Models\Noticia;

class DashboardController extends Controller
{
    public function index()
    {
        $noticias = Noticia::where('publicada', true)
            ->where('para_alumni', true)
            ->orderByDesc('data')
            ->take(5)
            ->get();

        $documentos = AlumniDocumento::orderByDesc('created_at')
            ->take(3)
            ->get();

        $alumnus = Alumnus::where('user_id', auth()->id())->first();

        $totalAlumni     = Alumnus::where('publicado', true)->count();
        $totalDocumentos = AlumniDocumento::count();
        $totalNoticias   = Noticia::where('publicada', true)->where('para_alumni', true)->count();

        return view('portal.dashboard', compact(
            'noticias',
            'documentos',
            'alumnus',
            'totalAlumni',
            'totalDocumentos',
            'totalNoticias'
        ));
    }
}
