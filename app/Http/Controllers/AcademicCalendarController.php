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

    public function image()
    {
        $calendar = AcademicCalendar::published();
        abort_unless($calendar, 404);

        $mime = match (strtolower(pathinfo($calendar['imagem'], PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        };

        return response()->file(Storage::disk('local')->path($calendar['imagem']), [
            'Content-Type' => $mime,
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
