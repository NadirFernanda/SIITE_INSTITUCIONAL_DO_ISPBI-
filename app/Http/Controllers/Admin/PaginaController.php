<?php
namespace App\Http\Controllers\Admin;

use App\Models\Pagina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaginaController extends Controller
{
    public function index()
    {
        $paginas = Pagina::all();
        return view('admin.paginas', compact('paginas'));
    }

    public function create()
    {
        return view('admin.paginas-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'conteudo' => 'nullable',
        ]);
        Pagina::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);
        return redirect('/admin/paginas')->with('success', 'Página criada com sucesso!');
    }
}
