<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::where('publicada', true)
            ->where('para_alumni', true)
            ->orderByDesc('data')
            ->paginate(12);

        return view('portal.noticias.index', compact('noticias'));
    }

    public function show($id)
    {
        $noticia = Noticia::where('id', $id)
            ->where('publicada', true)
            ->where('para_alumni', true)
            ->firstOrFail();

        return view('portal.noticias.show', compact('noticia'));
    }
}
