<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('role')->orderBy('name')->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:10|confirmed',
        ]);

        $roleLabels = ['tecnico' => 'Técnico', 'daac' => 'DAAC', 'secretaria' => 'Secretaria'];
        $role = in_array($request->input('role'), array_keys($roleLabels), true)
            ? $request->input('role')
            : 'tecnico';

        User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ])->forceFill(['role' => $role])->save();

        $roleLabel = $roleLabels[$role];
        return redirect()->route('admin.usuarios')->with('success', "{$roleLabel} criado com sucesso.");
    }

    public function resetPassword(Request $request, User $usuario)
    {
        // Nunca alterar a própria conta por aqui, e nunca alterar outro admin
        if ($usuario->id === Auth::id() || $usuario->role === 'admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Operação não permitida.');
        }

        $request->validate([
            'password' => 'required|string|min:10|confirmed',
        ]);

        $usuario->forceFill(['password' => Hash::make($request->input('password'))])->save();

        return redirect()->route('admin.usuarios')->with('success', 'Password redefinida com sucesso.');
    }

    public function destroy(User $usuario)
    {
        // Proteger: não apagar a própria conta, não apagar outros admins
        if ($usuario->id === Auth::id() || $usuario->role === 'admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Não é possível eliminar esta conta.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Utilizador eliminado.');
    }
}
