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
            'documento' => ['required', 'file', 'mimetypes:application/pdf', 'extensions:pdf', 'max:25600'],
        ]);
        [$first, $second] = array_map('intval', explode('/', $data['ano']));
        if ($second !== $first + 1) {
            throw ValidationException::withMessages(['ano' => 'Indique dois anos consecutivos, por exemplo 2026/2027.']);
        }

        $file = $request->file('documento');
        $handle = fopen($file->getRealPath(), 'rb');
        $header = $handle ? fread($handle, 5) : false;
        if ($handle) {
            fclose($handle);
        }
        if ($header !== '%PDF-') {
            throw ValidationException::withMessages(['documento' => 'Seleccione um PDF válido.']);
        }

        $disk = Storage::disk('local');
        try {
            $path = $file->store('calendarios-academicos/documentos', 'local');
            if (! AcademicCalendar::isPdfPath($path) || ! $disk->exists($path)) {
                throw new \RuntimeException('O PDF não foi guardado correctamente.');
            }
            AcademicCalendar::publish($data['ano'], $path);
        } catch (Throwable $exception) {
            if (isset($path) && AcademicCalendar::isPdfPath($path)) {
                $disk->delete($path);
            }
            report($exception);

            return back()->withErrors(['documento' => 'Não foi possível publicar o PDF. A versão anterior mantém-se.']);
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
