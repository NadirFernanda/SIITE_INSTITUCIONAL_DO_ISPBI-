<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }
}
