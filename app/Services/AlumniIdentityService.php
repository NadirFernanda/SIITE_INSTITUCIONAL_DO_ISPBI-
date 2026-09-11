<?php

namespace App\Services;

use App\Models\Alumnus;
use Illuminate\Support\Collection;

class AlumniIdentityService
{
    public static function matches(string $name, string $course, int $year): Collection
    {
        $nameKey = self::normalize($name);
        $courseKey = self::courseKey($course);

        return Alumnus::where('ano', $year)->get()->filter(
            fn (Alumnus $alumnus) => self::normalize($alumnus->nome) === $nameKey
                && self::courseKey($alumnus->curso) === $courseKey
        );
    }

    public static function courseKey(?string $course): string
    {
        $course = self::normalize($course ?? '');

        return match (true) {
            str_contains($course, 'informatica') => 'informatica',
            str_contains($course, 'hidrico') => 'hidricos',
            str_contains($course, 'contabilidade') => 'contabilidade',
            str_contains($course, 'comunicacao') => 'comunicacao',
            str_contains($course, 'psicologia') => 'psicologia',
            str_contains($course, 'enfermagem') => 'enfermagem',
            default => $course,
        };
    }

    private static function normalize(string $value): string
    {
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', trim($value));

        return preg_replace('/[^a-z0-9]/', '', strtolower($ascii ?: $value));
    }
}
