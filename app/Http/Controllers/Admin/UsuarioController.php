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
            'signature_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'signature_image.required' => 'Selecione uma imagem da assinatura.',
            'signature_image.image'    => 'O ficheiro deve ser uma imagem (PNG ou JPG).',
            'signature_image.mimes'    => 'Apenas PNG e JPG são aceites.',
            'signature_image.max'      => 'A imagem não pode exceder 2 MB.',
        ]);

        $file = $request->file('signature_image');
        $mime = $file->getMimeType();

        // Tentar remover fundo branco automaticamente (GD) e guardar PNG com transparência
        try {
            $src = null;
            if (in_array($mime, ['image/png', 'image/x-png'])) {
                $src = imagecreatefrompng($file->path());
            } elseif (in_array($mime, ['image/jpeg', 'image/jpg'])) {
                $src = imagecreatefromjpeg($file->path());
            }

            if ($src !== null) {
                $w = imagesx($src);
                $h = imagesy($src);
                $dst = imagecreatetruecolor($w, $h);
                imagesavealpha($dst, true);
                $trans_colour = imagecolorallocatealpha($dst, 0, 0, 0, 127);
                imagefill($dst, 0, 0, $trans_colour);

                // Limiar: considerar branco pixels com RGB >= 240
                $threshold = 240;

                for ($y = 0; $y < $h; $y++) {
                    for ($x = 0; $x < $w; $x++) {
                        $rgb = imagecolorat($src, $x, $y);
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;

                        if ($r >= $threshold && $g >= $threshold && $b >= $threshold) {
                            // transparente: já o é por fundo preenchido
                            // nada a fazer (pixel transparente)
                            continue;
                        }

                        $col = imagecolorallocatealpha($dst, $r, $g, $b, 0);
                        if ($col === false) {
                            // fallback: usar nearest color
                            $col = imagecolorallocatealpha($dst, min(255,$r), min(255,$g), min(255,$b), 0);
                        }
                        imagesetpixel($dst, $x, $y, $col);
                    }
                }

                ob_start();
                imagepng($dst);
                $pngData = ob_get_clean();

                imagedestroy($src);
                imagedestroy($dst);

                $base64 = 'data:image/png;base64,' . base64_encode($pngData);
            } else {
                // fallback: store original
                $base64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->path()));
            }
        } catch (\Throwable $e) {
            // Em caso de erro, gravar sem processamento
            $base64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->path()));
            \Log::error('Falha ao processar assinatura (remover fundo): ' . $e->getMessage());
        }

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
