<?php

namespace App\Http\Controllers;

use App\Support\AcademicCalendar;
use Illuminate\Support\Facades\Storage;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        return view('pages.calendario-academico', [
            'calendar' => AcademicCalendar::published(),
        ]);
    }

    public function document()
    {
        return $this->serveDocument('attachment');
    }

    public function viewDocument()
    {
        return $this->serveDocument('inline');
    }

    private function serveDocument(string $disposition)
    {
        $calendar = AcademicCalendar::published();
        abort_unless($calendar, 404);

        $response = response()->file(Storage::disk('local')->path($calendar['pdf']), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => $disposition.'; filename="Calendario-Academico-ISP-Bie.pdf"',
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);

        $response->setPrivate();
        $response->headers->set('Cache-Control', 'no-store, private');

        return $response;
    }
}
