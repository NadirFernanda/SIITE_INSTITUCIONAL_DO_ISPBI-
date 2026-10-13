<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AlumniDocumentStorage
{
    public function diskFor(string $path): ?string
    {
        if (! $this->validPath($path)) {
            return null;
        }

        foreach (['alumni_private', 'public'] as $disk) {
            if (Storage::disk($disk)->exists($path)) {
                return $disk;
            }
        }

        return null;
    }

    public function validPath(string $path): bool
    {
        return str_starts_with($path, 'alumni-documentos/')
            && ! str_contains($path, '..')
            && ! str_contains($path, '\\')
            && ! str_contains($path, "\0");
    }
}
