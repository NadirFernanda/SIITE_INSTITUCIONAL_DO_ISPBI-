<?php
namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function show($id)
    {
        $noticia = Noticia::where('id', $id)
            ->where('publicado', true)
            ->firstOrFail();
        return view('noticias.show', compact('noticia'));
    }
}
