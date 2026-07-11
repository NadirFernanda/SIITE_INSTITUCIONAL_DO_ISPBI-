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

    public function uploadSignature(Request $request, User $usuario)
    {
        if ($usuario->role !== 'daac') {
            return redirect()->route('admin.usuarios')->with('error', 'Apenas utilizadores DAAC podem ter assinatura digitalizada.');
        }

        $request->validate([
            'signature_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'signature_image.required' => 'Selecione uma imagem da assinatura.',
            'signature_image.image'    => 'O ficheiro deve ser uma imagem (PNG ou JPG).',
            'signature_image.mimes'    => 'Apenas PNG e JPG são aceites.',
            'signature_image.max'      => 'A imagem não pode exceder 2 MB.',
        ]);

        $file = $request->file('signature_image');
        $mime = $file->getMimeType();
        $base64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->path()));

        $usuario->forceFill(['signature_image' => $base64])->save();

        return redirect()->route('admin.usuarios')->with('success', 'Assinatura digitalizada de ' . $usuario->name . ' guardada com sucesso.');
    }

    public function removeSignature(User $usuario)
    {
        $usuario->forceFill(['signature_image' => null])->save();
        return redirect()->route('admin.usuarios')->with('success', 'Assinatura de ' . $usuario->name . ' removida.');
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
