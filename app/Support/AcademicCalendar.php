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

    public static function draft(): ?array
    {
        return self::read(Midia::CALENDARIO_RASCUNHO_NOME);
    }

    public static function published(): ?array
    {
        return self::read(Midia::CALENDARIO_PUBLICADO_NOME);
    }

    public static function draftRevision(): ?string
    {
        $path = self::pointer(Midia::CALENDARIO_RASCUNHO_NOME);

        return $path && self::readPath($path) ? hash('sha256', $path) : null;
    }

    public static function hasPdf(?array $calendar): bool
    {
        return $calendar && self::isPdfPath($calendar['pdf'] ?? null)
            && Storage::disk('local')->exists($calendar['pdf']);
    }

    public static function isPdfPath(?string $path): bool
    {
        return $path !== null
            && (bool) preg_match('~\A'.self::PDF_DIRECTORY.'/[A-Za-z0-9_-]+\.pdf\z~', $path);
    }

    public static function saveDraft(array $calendar): void
    {
        $calendar = self::validatedSnapshot($calendar);
        if ($calendar === null) {
            throw new RuntimeException('O rascunho do calendário contém dados inválidos.');
        }

        $path = self::VERSION_DIRECTORY.'/'.Str::uuid().'.json';
        $disk = Storage::disk('local');
        $content = json_encode($calendar, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        if (! $disk->put($path, $content) || ! $disk->exists($path)) {
            throw new RuntimeException('Não foi possível guardar o rascunho.');
        }

        try {
            self::setPointer(Midia::CALENDARIO_RASCUNHO_NOME, $path);
        } catch (Throwable $exception) {
            $disk->delete($path);
            throw $exception;
        }
    }

    public static function publish(string $expectedRevision): void
    {
        DB::transaction(function () use ($expectedRevision) {
            $draft = Midia::query()->where('nome', Midia::CALENDARIO_RASCUNHO_NOME)
                ->orderBy('id')->lockForUpdate()->first();
            $path = $draft?->caminho;
            if (! $path || ! hash_equals(hash('sha256', $path), $expectedRevision)) {
                throw new RuntimeException('O rascunho mudou desde a última revisão. Pré-visualize-o novamente.');
            }

            $calendar = self::readPath($path);
            if (! $calendar || (empty($calendar['atividades']) && ! self::hasPdf($calendar))) {
                throw new RuntimeException('O rascunho precisa de actividades ou de um PDF válido antes da publicação.');
            }
            if ($calendar['pdf'] !== null && ! self::hasPdf($calendar)) {
                throw new RuntimeException('O PDF do rascunho não está disponível. Carregue-o novamente.');
            }

            $published = Midia::query()->where('nome', Midia::CALENDARIO_PUBLICADO_NOME)
                ->orderBy('id')->lockForUpdate()->first();
            if ($published) {
                $published->update(['caminho' => $path]);
            } else {
                Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);
            }
        });
    }

    public static function unpublish(): void
    {
        self::setPointer(Midia::CALENDARIO_PUBLICADO_NOME, '');
    }

    private static function read(string $name): ?array
    {
        return self::readPath(self::pointer($name));
    }

    private static function readPath(?string $path): ?array
    {
        if (! $path || ! preg_match('~\A'.self::VERSION_DIRECTORY.'/[a-f0-9-]+\.json\z~', $path)) {
            return null;
        }

        $disk = Storage::disk('local');
        if (! $disk->exists($path)) {
            return null;
        }

        try {
            $decoded = json_decode($disk->get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            return null;
        }

        return is_array($decoded) ? self::validatedSnapshot($decoded) : null;
    }

    private static function validatedSnapshot(array $calendar): ?array
    {
        $year = $calendar['ano'] ?? null;
        if (! is_string($year) || ! preg_match('~\A(20\d{2})/(20\d{2})\z~', $year, $matches)
            || (int) $matches[2] !== (int) $matches[1] + 1
            || ! is_array($calendar['atividades'] ?? null)
            || count($calendar['atividades']) > 200) {
            return null;
        }

        $pdf = $calendar['pdf'] ?? null;
        if ($pdf !== null && ! is_string($pdf)) {
            return null;
        }
        if ($pdf !== null && ! self::isPdfPath($pdf)) {
            return null;
        }

        $ids = [];
        foreach ($calendar['atividades'] as $activity) {
            if (! is_array($activity)
                || ! is_string($activity['id'] ?? null)
                || ! preg_match('~\A[a-f0-9-]{36}\z~', $activity['id'])
                || isset($ids[$activity['id']])
                || ! in_array($activity['semestre'] ?? null, [1, 2], true)
                || ! is_string($activity['titulo'] ?? null)
                || trim($activity['titulo']) === ''
                || mb_strlen($activity['titulo']) > 160
                || ! is_string($activity['descricao'] ?? null)
                || mb_strlen($activity['descricao']) > 1000
                || ! self::validDate($activity['inicio'] ?? null, $matches)
                || ! self::validDate($activity['fim'] ?? null, $matches)
                || $activity['fim'] < $activity['inicio']) {
                return null;
            }
            $ids[$activity['id']] = true;
        }

        return [
            'ano' => $year,
            'atividades' => $calendar['atividades'],
            'pdf' => $pdf,
        ];
    }

    private static function validDate(mixed $date, array $years): bool
    {
        if (! is_string($date) || ! preg_match('~\A(\d{4})-(\d{2})-(\d{2})\z~', $date, $parts)) {
            return false;
        }

        return in_array((int) $parts[1], [(int) $years[1], (int) $years[2]], true)
            && checkdate((int) $parts[2], (int) $parts[3], (int) $parts[1]);
    }

    private static function pointer(string $name): ?string
    {
        return Midia::query()->where('nome', $name)->orderBy('id')->value('caminho');
    }

    private static function setPointer(string $name, string $path): void
    {
        if (! in_array($name, [Midia::CALENDARIO_RASCUNHO_NOME, Midia::CALENDARIO_PUBLICADO_NOME], true)) {
            throw new RuntimeException('Referência de calendário inválida.');
        }

        DB::transaction(function () use ($name, $path) {
            $record = Midia::query()->where('nome', $name)->orderBy('id')->lockForUpdate()->first();
            if ($record) {
                $record->update(['caminho' => $path]);
            } else {
                Midia::create(['nome' => $name, 'caminho' => $path]);
            }
        });
    }
}
