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

    /**
     * Show a single user in a dedicated page so each profile has its own URL
     * (allows opening multiple profiles in separate browser tabs).
     */
    public function show(User $usuario)
    {
        return view('admin.usuario', compact('usuario'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:10|confirmed',
        ]);

        $roleLabels = ['tecnico' => 'Técnico', 'daac' => 'DAAC', 'secretaria' => 'Secretaria', 'subcomissao_correcao' => 'Subcomissão de Correcção', 'subcomissao_lancamento' => 'Subcomissão de Lançamento', 'presidencia' => 'Presidência'];
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
        if ($usuario->id === Auth::id() || $usuario->hasRole('admin')) {
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
        if (! $usuario->hasRole('daac')) {
            return redirect()->route('admin.usuarios')->with('error', 'Apenas utilizadores DAAC podem ter assinatura digitalizada.');
        }

        $request->validate([
            'nome_assinatura' => 'required|string|max:100',
        ], [
            'nome_assinatura.required' => 'Escreva o nome a usar na assinatura.',
        ]);

        // Assinatura gerada a partir de texto, numa fonte cursiva, em vez de pedir para
        // carregar uma foto/scan da assinatura em papel — essas fotos nunca tinham fundo
        // branco puro (sombra, papel amarelado, tom da câmara) e ficavam com um aspecto
        // pouco profissional. Isto dá um resultado limpo, com fundo transparente, parecido
        // com as assinaturas digitais geradas por aplicações como DocuSign.
        $texto  = trim($request->input('nome_assinatura'));
        $base64 = \App\Services\SignatureImageGenerator::generate($texto);

        $usuario->forceFill(['signature_image' => $base64])->save();

        return redirect()->route('admin.usuarios')->with('success', 'Assinatura digital de ' . $usuario->name . ' gerada com sucesso.');
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
