<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class InstitucionalController extends Controller
{
    public function index()
    {
                // Busca notícias institucionais que também estejam publicadas
                $noticias = Noticia::where(function($q) {
                        $q->where('institucional', true)
                            ->orWhere('institucional', 1)
                            ->orWhere('institucional', '1')
                            ->orWhere('institucional', 'true')
                            ->orWhere('institucional', 'on')
                            ->orWhere('institucional', 'sim')
                            ->orWhere('institucional', 'yes');
                })
                ->where('publicada', true)
                ->orderByDesc('data')->get();
                return view('pages.institucional', compact('noticias'));
    }
}
