<?php

namespace App\Support;

use App\Models\Midia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class AcademicCalendar
{
    private const VERSION_DIRECTORY = 'calendarios-academicos/versoes';

    private const PDF_DIRECTORY = 'calendarios-academicos/documentos';

    public static function published(): ?array
    {
        $path = Midia::query()->where('nome', Midia::CALENDARIO_PUBLICADO_NOME)
            ->orderBy('id')->value('caminho');
        if (! is_string($path)
            || ! preg_match('~\A'.self::VERSION_DIRECTORY.'/[a-f0-9-]+\.json\z~', $path)) {
            return null;
        }

        $disk = Storage::disk('local');
        if (! $disk->exists($path)) {
            return null;
        }

        try {
            $snapshot = json_decode($disk->get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            return null;
        }

        if (! is_array($snapshot)
            || ! self::validYear($snapshot['ano'] ?? null)
            || ! self::isPdfPath($snapshot['pdf'] ?? null)
            || ! $disk->exists($snapshot['pdf'])) {
            return null;
        }

        return ['ano' => $snapshot['ano'], 'pdf' => $snapshot['pdf']];
    }

    public static function isPdfPath(mixed $path): bool
    {
        return is_string($path)
            && (bool) preg_match('~\A'.self::PDF_DIRECTORY.'/[A-Za-z0-9_-]+\.pdf\z~', $path);
    }

    public static function publish(string $year, string $pdfPath): void
    {
        $disk = Storage::disk('local');
        if (! self::validYear($year) || ! self::isPdfPath($pdfPath) || ! $disk->exists($pdfPath)) {
            throw new RuntimeException('O ano ou o PDF do calendário são inválidos.');
        }

        $versionPath = self::VERSION_DIRECTORY.'/'.Str::uuid().'.json';
        $content = json_encode(['ano' => $year, 'pdf' => $pdfPath], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        if (! $disk->put($versionPath, $content) || ! $disk->exists($versionPath)) {
            throw new RuntimeException('Não foi possível guardar a versão do calendário.');
        }

        try {
            DB::transaction(function () use ($versionPath) {
                $record = Midia::query()->where('nome', Midia::CALENDARIO_PUBLICADO_NOME)
                    ->orderBy('id')->lockForUpdate()->first();
                if ($record) {
                    $record->update(['caminho' => $versionPath]);
                } else {
                    Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $versionPath]);
                }
            });
        } catch (Throwable $exception) {
            $disk->delete($versionPath);
            throw $exception;
        }
    }

    public static function unpublish(): void
    {
        DB::transaction(function () {
            $record = Midia::query()->where('nome', Midia::CALENDARIO_PUBLICADO_NOME)
                ->orderBy('id')->lockForUpdate()->first();
            if ($record) {
                $record->update(['caminho' => '']);
            }
        });
    }

    private static function validYear(mixed $year): bool
    {
        return is_string($year)
            && preg_match('~\A(20\d{2})/(20\d{2})\z~', $year, $matches) === 1
            && (int) $matches[2] === (int) $matches[1] + 1;
    }
}
