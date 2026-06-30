<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use Illuminate\Http\Request;

class DiretorioController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumnus::where('publicado', true);

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        if ($request->filled('busca')) {
            $busca = '%' . $request->input('busca') . '%';
            $query->where('nome', 'like', $busca);
        }

        $alumni = $query->orderBy('nome')->get();

        $cursos = Alumnus::where('publicado', true)
            ->select('curso')
            ->distinct()
            ->orderBy('curso')
            ->pluck('curso');

        return view('portal.diretorio', compact('alumni', 'cursos'));
    }
}
