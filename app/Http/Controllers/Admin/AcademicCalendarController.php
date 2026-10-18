<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\AcademicCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        return view('admin.calendario-academico', [
            'published' => AcademicCalendar::published(),
        ]);
    }

    public function publish(Request $request)
    {
        $data = $request->validate([
            'ano' => ['required', 'regex:/\A20\d{2}\/20\d{2}\z/'],
            'imagem' => ['required', 'image', 'mimetypes:image/jpeg,image/png,image/webp',
                'extensions:jpg,jpeg,png,webp', 'dimensions:max_width=8000,max_height=8000', 'max:10240'],
        ]);
        [$first, $second] = array_map('intval', explode('/', $data['ano']));
        if ($second !== $first + 1) {
            throw ValidationException::withMessages(['ano' => 'Indique dois anos consecutivos, por exemplo 2026/2027.']);
        }

        $file = $request->file('imagem');
        if (getimagesize($file->getRealPath()) === false) {
            throw ValidationException::withMessages(['imagem' => 'Seleccione uma imagem JPG, PNG ou WebP válida.']);
        }

        $disk = Storage::disk('local');
        try {
            $path = $file->store('calendarios-academicos/imagens', 'local');
            if (! AcademicCalendar::isImagePath($path) || ! $disk->exists($path)) {
                throw new \RuntimeException('A imagem não foi guardada correctamente.');
            }
            AcademicCalendar::publish($data['ano'], $path);
        } catch (Throwable $exception) {
            if (isset($path) && AcademicCalendar::isImagePath($path)) {
                $disk->delete($path);
            }
            report($exception);

            return back()->withErrors(['imagem' => 'Não foi possível publicar a imagem. A versão anterior mantém-se.']);
        }

        return redirect()->route('admin.calendario-academico')
            ->with('success', 'Calendário académico publicado.');
    }

    public function unpublish(Request $request)
    {
        $request->validate(['confirmar_retirada' => ['required', 'accepted']]);
        try {
            AcademicCalendar::unpublish();
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['publicacao' => 'Não foi possível retirar o calendário da página pública.']);
        }

        return redirect()->route('admin.calendario-academico')
            ->with('success', 'Calendário retirado da página pública.');
    }
}
