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
            'draft' => AcademicCalendar::draft(),
            'draftRevision' => AcademicCalendar::draftRevision(),
            'published' => AcademicCalendar::published(),
        ]);
    }

    public function preview()
    {
        $calendar = AcademicCalendar::draft();
        abort_unless($calendar, 404);

        return view('pages.calendario-academico', [
            'calendar' => $calendar,
            'preview' => true,
            'pdfUrl' => AcademicCalendar::hasPdf($calendar)
                ? route('admin.calendario-academico.documento.preview') : null,
            'downloadUrl' => null,
        ]);
    }

    public function startDraft(Request $request)
    {
        $data = $request->validate(['ano' => ['required', 'regex:/\A20\d{2}\/20\d{2}\z/']]);
        [$first, $second] = array_map('intval', explode('/', $data['ano']));
        if ($second !== $first + 1) {
            throw ValidationException::withMessages(['ano' => 'Indique dois anos consecutivos, por exemplo 2026/2027.']);
        }

        if (AcademicCalendar::draft()) {
            $request->validate(['confirmar_substituicao' => ['required', 'accepted']]);
        }

        return $this->saveDraft(['ano' => $data['ano'], 'atividades' => [], 'pdf' => null],
            'Rascunho criado. O calendário publicado não foi alterado.');
    }

    public function uploadPdf(Request $request)
    {
        $calendar = $this->requireDraft();
        $request->validate([
            'documento' => ['required', 'file', 'max:25600', 'mimetypes:application/pdf', 'extensions:pdf'],
        ]);

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
            if (! is_string($path) || ! AcademicCalendar::isPdfPath($path) || ! $disk->exists($path)) {
                throw new \RuntimeException('O PDF não foi guardado correctamente.');
            }
            $calendar['pdf'] = $path;
            AcademicCalendar::saveDraft($calendar);
        } catch (Throwable $exception) {
            if (isset($path) && is_string($path) && AcademicCalendar::isPdfPath($path)) {
                $disk->delete($path);
            }
            report($exception);
            return back()->withErrors(['documento' => 'Não foi possível guardar o PDF. A versão publicada mantém-se.']);
        }

        return redirect()->route('admin.calendario-academico')
            ->with('success', 'PDF carregado no rascunho. A publicação não foi alterada.');
    }

    public function removeDraftPdf(Request $request)
    {
        $request->validate(['confirmar_remocao' => ['required', 'accepted']]);
        $calendar = $this->requireDraft();
        $calendar['pdf'] = null;

        return $this->saveDraft($calendar, 'PDF retirado do rascunho. A versão publicada mantém-se.');
    }

    public function previewPdf()
    {
        $calendar = AcademicCalendar::draft();
        abort_unless(AcademicCalendar::hasPdf($calendar), 404);

        $response = response()->file(Storage::disk('local')->path($calendar['pdf']), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Calendario-Academico-Previsualizacao.pdf"',
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);

        $response->setPrivate();
        $response->headers->set('Cache-Control', 'no-store, private');

        return $response;
    }

    public function publish(Request $request)
    {
        $data = $request->validate([
            'confirmar_publicacao' => ['required', 'accepted'],
            'revisao' => ['required', 'regex:/\A[a-f0-9]{64}\z/'],
        ]);
        try {
            AcademicCalendar::publish($data['revisao']);
        } catch (Throwable $exception) {
            report($exception);
            return back()->withErrors(['publicacao' => $exception instanceof \RuntimeException
                ? $exception->getMessage()
                : 'Não foi possível publicar o calendário. A versão anterior mantém-se.']);
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

    private function requireDraft(): array
    {
        $calendar = AcademicCalendar::draft();
        if (! $calendar) {
            throw ValidationException::withMessages(['rascunho' => 'Crie primeiro um rascunho válido.']);
        }

        return $calendar;
    }

    private function saveDraft(array $calendar, string $message)
    {
        try {
            AcademicCalendar::saveDraft($calendar);
        } catch (Throwable $exception) {
            report($exception);
            return back()->withErrors(['rascunho' => 'Não foi possível guardar o rascunho. A versão publicada mantém-se.']);
        }

        return redirect()->route('admin.calendario-academico')->with('success', $message);
    }
}
