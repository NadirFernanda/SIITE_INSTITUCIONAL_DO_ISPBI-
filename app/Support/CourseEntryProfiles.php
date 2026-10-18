<?php

namespace App\Support;

use App\Models\Candidatura;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class CourseEntryProfiles
{
    private const FILE = 'course-entry-profiles.json';

    public function additions(): array
    {
        try {
            return $this->read();
        } catch (Throwable $e) {
            report($e);

            return [];
        }
    }

    public function forCourse(string $course): array
    {
        $profiles = Candidatura::$perfisCurso[$course] ?? [];

        foreach ($this->additions()[$course] ?? [] as $profile) {
            if (! $this->contains($profiles, $profile)) {
                $profiles[] = $profile;
            }
        }

        return $profiles;
    }

    public function all(): array
    {
        $result = [];
        foreach (Candidatura::$cursos as $course) {
            $result[$course] = $this->forCourse($course);
        }

        return $result;
    }

    public function add(string $course, string $profile): bool
    {
        return $this->change($course, function (array &$additions) use ($course, $profile): bool {
            if ($this->contains(Candidatura::$perfisCurso[$course], $profile)
                || $this->contains($additions[$course] ?? [], $profile)) {
                return false;
            }
            if (count($additions[$course] ?? []) >= 100) {
                throw new RuntimeException('Limite de perfis adicionais atingido para este curso.');
            }

            $additions[$course][] = $profile;

            return true;
        });
    }

    public function remove(string $course, string $profile): bool
    {
        return $this->change($course, function (array &$additions) use ($course, $profile): bool {
            $current = $additions[$course] ?? [];
            $remaining = array_values(array_filter(
                $current,
                fn (string $item) => mb_strtolower($item) !== mb_strtolower($profile)
            ));
            if (count($remaining) === count($current)) {
                return false;
            }

            if ($remaining) {
                $additions[$course] = $remaining;
            } else {
                unset($additions[$course]);
            }

            return true;
        });
    }

    private function change(string $course, callable $callback): bool
    {
        if (! in_array($course, Candidatura::$cursos, true)) {
            throw new RuntimeException('Curso inválido.');
        }

        $path = Storage::disk('local')->path(self::FILE);
        $directory = dirname($path);
        if (! is_dir($directory) && ! mkdir($directory, 0750, true) && ! is_dir($directory)) {
            throw new RuntimeException('Não foi possível preparar o armazenamento dos perfis.');
        }

        $lock = fopen($path.'.lock', 'c');
        if ($lock === false) {
            throw new RuntimeException('Não foi possível bloquear o ficheiro de perfis.');
        }

        try {
            if (! flock($lock, LOCK_EX)) {
                throw new RuntimeException('Não foi possível bloquear o ficheiro de perfis.');
            }

            $additions = $this->read();
            if (! $callback($additions)) {
                return false;
            }

            $json = json_encode($additions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)."\n";
            $temporary = tempnam($directory, 'profiles-');
            if ($temporary === false) {
                throw new RuntimeException('Não foi possível preparar a gravação dos perfis.');
            }

            try {
                if (file_put_contents($temporary, $json) !== strlen($json) || ! @rename($temporary, $path)) {
                    throw new RuntimeException('Não foi possível guardar os perfis.');
                }
            } finally {
                if (is_file($temporary)) {
                    unlink($temporary);
                }
            }

            return true;
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    private function read(): array
    {
        $path = Storage::disk('local')->path(self::FILE);
        if (! is_file($path)) {
            return [];
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new RuntimeException('Não foi possível ler os perfis guardados.');
        }

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        if (! is_array($data) || array_is_list($data) && $data !== []) {
            throw new RuntimeException('O ficheiro de perfis tem um formato inválido.');
        }

        foreach ($data as $course => $profiles) {
            if (! in_array($course, Candidatura::$cursos, true) || ! is_array($profiles) || ! array_is_list($profiles)
                || count($profiles) > 100 || count(array_filter($profiles, 'is_string')) !== count($profiles)) {
                throw new RuntimeException('O ficheiro de perfis contém dados inválidos.');
            }
        }

        return $data;
    }

    private function contains(array $profiles, string $profile): bool
    {
        foreach ($profiles as $current) {
            if (mb_strtolower($current) === mb_strtolower($profile)) {
                return true;
            }
        }

        return false;
    }
}
