<?php

namespace App\Support;

use App\Models\Midia;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class PdiContent
{
    public const ORIGINAL_PHOTO = 'images/institucional/pdi-2026-2031.jpg';

    public static function photoUrl(): ?string
    {
        $path = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);

        if (Midia::isManagedPdiPhotoPath($path) && Storage::disk('public')->exists($path)) {
            return route('pdi.fotografia');
        }

        return is_file(public_path(self::ORIGINAL_PHOTO))
            ? asset(self::ORIGINAL_PHOTO)
            : null;
    }

    public static function pdfUrl(): ?string
    {
        if (! SiteSetting::pdiPdfPublicado()) {
            return null;
        }

        $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        return Midia::isManagedPdiPdfPath($path) && Storage::disk('local')->exists($path)
            ? route('pdi.documento')
            : null;
    }
}
