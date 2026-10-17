<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Models\SiteSetting;
use App\Support\PdiContent;
use Illuminate\Support\Facades\Storage;

class PdiController extends Controller
{
    public function index()
    {
        return view('pages.pdi', [
            'photoUrl' => PdiContent::photoUrl(),
            'pdfUrl' => PdiContent::pdfUrl(),
        ]);
    }

    public function photo()
    {
        $path = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);
        abort_unless(Midia::isManagedPdiPhotoPath($path), 404);

        $disk = Storage::disk('public');
        abort_unless($disk->exists($path), 404);

        $mime = match (strtolower(pathinfo($path, PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        };

        return response()->file($disk->path($path), [
            'Content-Type' => $mime,
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function document()
    {
        abort_unless(SiteSetting::pdiPdfPublicado(), 404);

        $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);
        abort_unless(Midia::isManagedPdiPdfPath($path), 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($path), 404);

        return response()->file($disk->path($path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="PDI-2026-2031-ISP-Bie.pdf"',
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
