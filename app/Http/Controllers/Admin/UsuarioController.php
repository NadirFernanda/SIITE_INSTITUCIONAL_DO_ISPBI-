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

        // Remover o fundo (papel/foto/scan) e uniformizar a tinta da assinatura (GD).
        // Fotos/scans raramente têm fundo branco puro (sombra, papel amarelado, tom
        // acinzentado da câmara) — um limiar fixo de "branco == RGB>=240" deixava
        // esse fundo visível como um rectângulo feio à volta da assinatura. Em vez
        // disso, usamos a luminância de cada pixel: claro = transparente, escuro =
        // tinta, com uma faixa intermédia suavizada (anti-serrilhado); e forçamos a
        // tinta para um tom escuro uniforme, para não ficar com o tom acinzentado/
        // azulado da imagem original.
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
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                $trans_colour = imagecolorallocatealpha($dst, 0, 0, 0, 127);
                imagefill($dst, 0, 0, $trans_colour);

                $darkThreshold  = 120; // luminância <= isto: tinta totalmente opaca
                $lightThreshold = 205; // luminância >= isto: fundo totalmente transparente
                [$inkR, $inkG, $inkB] = [26, 35, 50]; // tom escuro uniforme (evita cinza/azulado da foto)

                for ($y = 0; $y < $h; $y++) {
                    for ($x = 0; $x < $w; $x++) {
                        $rgb = imagecolorat($src, $x, $y);
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;
                        $luminance = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);

                        if ($luminance >= $lightThreshold) {
                            continue; // mantém-se transparente
                        }

                        if ($luminance <= $darkThreshold) {
                            $alpha = 0;
                        } else {
                            $ratio = ($luminance - $darkThreshold) / ($lightThreshold - $darkThreshold);
                            $alpha = (int) round($ratio * 127);
                        }

                        $col = imagecolorallocatealpha($dst, $inkR, $inkG, $inkB, $alpha);
                        if ($col === false) {
                            $col = $trans_colour;
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
