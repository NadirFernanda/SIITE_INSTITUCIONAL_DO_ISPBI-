<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnus;
use App\Models\User;

class AdminAlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumnus::with('user')->orderByDesc('created_at')->get();

        $pendingCount = User::where('role', 'alumni')
            ->where('aprovado', false)
            ->count();

        return view('admin.alumni', compact('alumni', 'pendingCount'));
    }

    public function togglePublicar($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->publicado = ! $alumnus->publicado;
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Estado de publicação actualizado.');
    }

    public function toggleTestemunho($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->testemunho = ! $alumnus->testemunho;
        if ($alumnus->testemunho) {
            $alumnus->publicado = true;
        }
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Estado de testemunho actualizado.');
    }

    public function aprovar($id)
    {
        $alumnus = Alumnus::with('user')->findOrFail($id);

        if ($alumnus->user) {
            $alumnus->user->forceFill(['aprovado' => true])->save();
        }

        return redirect()->route('admin.alumni')->with('success', 'Utilizador aprovado no portal alumni.');
    }

    public function revogar($id)
    {
        $alumnus = Alumnus::with('user')->findOrFail($id);

        if ($alumnus->user) {
            $alumnus->user->forceFill(['aprovado' => false])->save();
        }

        return redirect()->route('admin.alumni')->with('success', 'Acesso ao portal alumni revogado.');
    }
}
