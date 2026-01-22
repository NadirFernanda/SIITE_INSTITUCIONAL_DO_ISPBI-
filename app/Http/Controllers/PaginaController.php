<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function show($id)
    {
        $pagina = Pagina::findOrFail($id);
        return view('pages.pagina', compact('pagina'));
    }
}
