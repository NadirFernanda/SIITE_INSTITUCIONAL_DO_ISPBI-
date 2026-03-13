<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        // Garante que apenas administradores podem acessar
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }
}
