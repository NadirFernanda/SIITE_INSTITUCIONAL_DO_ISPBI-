<?php
namespace App\Http\Controllers\Admin;

use App\Models\Midia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MidiaController extends Controller
{
    public function index()
    {
        $midias = \App\Models\Midia::all();
        return view('admin.midia', compact('midias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mp3|max:5120',
        ]);
        $file = $request->file('arquivo');
        $path = $file->store('midias', 'public');
        \App\Models\Midia::create([
            'nome' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'caminho' => $path,
        ]);
        return redirect('/admin/midia')->with('success', 'Arquivo enviado com sucesso!');
    }

    public function destroy($id)
    {
        $midia = \App\Models\Midia::findOrFail($id);
        \Storage::disk('public')->delete($midia->caminho);
        $midia->delete();
        return redirect('/admin/midia')->with('success', 'Arquivo excluído com sucesso!');
    }
}
