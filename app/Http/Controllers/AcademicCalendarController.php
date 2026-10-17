<?php

namespace App\Http\Controllers;

use App\Support\AcademicCalendar;
use Illuminate\Support\Facades\Storage;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $calendar = AcademicCalendar::published();

        return view('pages.calendario-academico', [
            'calendar' => $calendar,
            'preview' => false,
            'pdfUrl' => AcademicCalendar::hasPdf($calendar) ? route('calendario-academico.documento') : null,
        ]);
    }

    public function document()
    {
        $calendar = AcademicCalendar::published();
        abort_unless(AcademicCalendar::hasPdf($calendar), 404);

        return response()->file(Storage::disk('local')->path($calendar['pdf']), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Calendario-Academico-ISP-Bie.pdf"',
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
