<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnus;

class AdminAlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumnus::orderByDesc('created_at')->get();
        return view('admin.alumni', compact('alumni'));
    }

    public function togglePublicar($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->publicado = !$alumnus->publicado;
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Status de publicação atualizado!');
    }

    public function toggleTestemunho($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->testemunho = !$alumnus->testemunho;
        // Se está sendo publicado como testemunho, também marca como publicado
        if ($alumnus->testemunho) {
            $alumnus->publicado = true;
        }
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Status de testemunho atualizado!');
    }
}
