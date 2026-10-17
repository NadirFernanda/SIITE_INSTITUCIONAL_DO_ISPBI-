<?php
namespace App\Http\Controllers\Admin;

use App\Models\Midia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MidiaController extends Controller
{
    public function index()
    {
        $midias = Midia::whereNotIn('nome', Midia::systemNames())->get();
        return view('admin.midia', compact('midias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mp3|max:5120',
        ]);
        $file = $request->file('arquivo');
        $nome = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        if (in_array($nome, Midia::systemNames(), true)) {
            return back()->withErrors(['arquivo' => 'Este nome está reservado para um conteúdo institucional.']);
        }
        $path = $file->store('midias', 'public');
        Midia::create([
            'nome' => $nome,
            'caminho' => $path,
        ]);
        return redirect('/admin/midia')->with('success', 'Arquivo enviado com sucesso!');
    }

    public function destroy($id)
    {
        $midia = Midia::findOrFail($id);
        abort_if(in_array($midia->nome, Midia::systemNames(), true), 403);
        \Storage::disk('public')->delete($midia->caminho);
        $midia->delete();
        return redirect('/admin/midia')->with('success', 'Arquivo excluído com sucesso!');
    }
}
