<?php

namespace App\Console\Commands;

use App\Models\AlumniDocumento;
use App\Services\AlumniDocumentStorage;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class PrepararDocumentosAlumniPrivados extends Command
{
    protected $signature = 'alumni:preparar-documentos-privados
        {--dry-run : Apenas inventariar e verificar (comportamento padrão)}
        {--copy : Copiar os ficheiros após confirmação explícita}
        {--change-id= : Identificador da intervenção autorizada}
        {--confirm= : Escrever COPIAR_DOCUMENTOS_ALUMNI para confirmar}';

    protected $description = 'Copia documentos alumni para armazenamento privado, sem eliminar originais nem alterar a BD';

    public function handle(AlumniDocumentStorage $storage): int
    {
        $copy = (bool) $this->option('copy');
        $changeId = (string) $this->option('change-id');
        if ($copy && ($this->option('dry-run')
            || $this->option('confirm') !== 'COPIAR_DOCUMENTOS_ALUMNI'
            || ! preg_match('/^[A-Za-z0-9._-]{3,80}$/', $changeId))) {
            $this->error('Cópia recusada: indicar --copy, --change-id e --confirm=COPIAR_DOCUMENTOS_ALUMNI, sem --dry-run.');

            return self::FAILURE;
        }
        if (! $copy && ($changeId !== '' || $this->option('confirm') !== null)) {
            $this->error('Opções de execução fornecidas sem --copy.');

            return self::FAILURE;
        }

        $lock = null;
        if ($copy) {
            $privateRoot = Storage::disk('alumni_private')->path('');
            if (! is_dir($privateRoot) && ! mkdir($privateRoot, 0700, true) && ! is_dir($privateRoot)) {
                $this->error('Não foi possível preparar o disco privado.');

                return self::FAILURE;
            }
            $lock = fopen($privateRoot.'/.migration.lock', 'c');
            if (! is_resource($lock) || ! flock($lock, LOCK_EX | LOCK_NB)) {
                $this->error('Já existe uma cópia alumni em execução.');
                if (is_resource($lock)) {
                    fclose($lock);
                }

                return self::FAILURE;
            }
            $this->info('Intervenção '.$changeId.': cópia autorizada; os originais serão preservados.');
        }

        $failed = false;
        try {
            foreach (AlumniDocumento::orderBy('id')->cursor() as $documento) {
                try {
                    $path = $documento->ficheiro;
                    if (! $storage->validPath($path)) {
                        $this->error("Documento #{$documento->id}: caminho inválido.");
                        $failed = true;

                        continue;
                    }
                    $public = Storage::disk('public');
                    $private = Storage::disk('alumni_private');
                    if (! $public->exists($path)) {
                        if ($private->exists($path)) {
                            $this->assertContainedFile($private, $path);
                            $this->info("Documento #{$documento->id}: apenas privado; conferir com inventário aprovado.");

                            continue;
                        }
                        $this->error("Documento #{$documento->id}: ficheiro ausente.");
                        $failed = true;

                        continue;
                    }
                    $this->assertContainedFile($public, $path);
                    $sourceHash = hash_file('sha256', $public->path($path));
                    if ($sourceHash === false) {
                        throw new RuntimeException('Não foi possível verificar o original.');
                    }
                    if ($private->exists($path)) {
                        $this->assertContainedFile($private, $path);
                        if ($sourceHash !== hash_file('sha256', $private->path($path))) {
                            $this->error("Documento #{$documento->id}: conflito; nada sobrescrito.");
                            $failed = true;
                        } else {
                            $this->info("Documento #{$documento->id}: cópia verificada.");
                        }

                        continue;
                    }
                    if (! $copy) {
                        $this->info("Documento #{$documento->id}: seria copiado.");

                        continue;
                    }
                    $this->copyVerified($public, $private, $path, $sourceHash);
                    $this->info("Documento #{$documento->id}: copiado e verificado; original preservado.");
                } catch (Throwable $exception) {
                    // Continue the inventory; a failed item must not undo verified copies.
                    $this->error("Documento #{$documento->id}: cópia não concluída; original preservado (".$exception->getMessage().').');
                    $failed = true;
                }
            }
        } finally {
            if (is_resource($lock)) {
                flock($lock, LOCK_UN);
                fclose($lock);
            }
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }

    private function copyVerified(Filesystem $public, Filesystem $private, string $path, string $sourceHash): void
    {
        $private->makeDirectory(dirname($path));
        $destination = $private->path($path);
        $root = realpath($private->path(''));
        $parent = realpath(dirname($destination));
        if ($root === false || $parent === false || ! str_starts_with($parent.DIRECTORY_SEPARATOR, rtrim($root, '/\\').DIRECTORY_SEPARATOR)) {
            throw new RuntimeException('Destino fora do disco privado.');
        }
        if (file_exists($destination) || is_link($destination)) {
            throw new RuntimeException('Destino já ocupado; nada sobrescrito.');
        }
        $temporary = $destination.'.'.bin2hex(random_bytes(12)).'.partial';
        $input = $output = null;

        try {
            $input = $public->readStream($path);
            $output = fopen($temporary, 'xb');
            if (! is_resource($input) || ! is_resource($output)
                || ! chmod($temporary, 0600)
                || stream_copy_to_stream($input, $output) === false || ! fflush($output)
                || ! fsync($output)) {
                throw new RuntimeException('Falha na escrita da cópia temporária.');
            }
            fclose($input);
            fclose($output);
            $input = $output = null;

            if ($sourceHash !== hash_file('sha256', $temporary)
                || $sourceHash !== hash_file('sha256', $public->path($path))) {
                throw new RuntimeException('Integridade inválida ou original alterado durante a cópia.');
            }

            // A same-filesystem hard link publishes a complete file atomically and
            // fails if another process has created the destination. Never overwrite.
            if (! @link($temporary, $destination)) {
                if (is_link($destination) || ! is_file($destination) || $sourceHash !== hash_file('sha256', $destination)) {
                    throw new RuntimeException('Destino em conflito ou publicação atómica indisponível.');
                }
            }
        } finally {
            if (is_resource($input)) {
                fclose($input);
            }
            if (is_resource($output)) {
                fclose($output);
            }
            if (is_file($temporary)) {
                unlink($temporary);
            }
        }
    }

    private function assertContainedFile(Filesystem $disk, string $path): void
    {
        $root = realpath($disk->path(''));
        $file = realpath($disk->path($path));
        if ($root === false || $file === false || ! str_starts_with($file, rtrim($root, '/\\').DIRECTORY_SEPARATOR) || ! is_file($file)) {
            throw new RuntimeException('Caminho fora do disco ou ficheiro inválido.');
        }
        $cursor = $disk->path($path);
        while ($cursor !== $disk->path('') && dirname($cursor) !== $cursor) {
            if (is_link($cursor)) {
                throw new RuntimeException('Links simbólicos não são permitidos em documentos alumni.');
            }
            $cursor = dirname($cursor);
        }
    }
}
