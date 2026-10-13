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
    protected $signature = 'alumni:preparar-documentos-privados {--dry-run : Apenas inventariar e verificar}';

    protected $description = 'Copia documentos alumni para armazenamento privado, sem eliminar originais nem alterar a BD';

    public function handle(AlumniDocumentStorage $storage): int
    {
        $failed = false;
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
                        $this->info("Documento #{$documento->id}: já privado.");

                        continue;
                    }
                    $this->error("Documento #{$documento->id}: ficheiro ausente.");
                    $failed = true;

                    continue;
                }
                $sourceHash = hash_file('sha256', $public->path($path));
                if ($sourceHash === false) {
                    throw new RuntimeException('Não foi possível verificar o original.');
                }
                if ($private->exists($path)) {
                    if ($sourceHash !== hash_file('sha256', $private->path($path))) {
                        $this->error("Documento #{$documento->id}: conflito; nada sobrescrito.");
                        $failed = true;
                    } else {
                        $this->info("Documento #{$documento->id}: cópia verificada.");
                    }

                    continue;
                }
                if ($this->option('dry-run')) {
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

        return $failed ? self::FAILURE : self::SUCCESS;
    }

    private function copyVerified(Filesystem $public, Filesystem $private, string $path, string $sourceHash): void
    {
        $private->makeDirectory(dirname($path));
        $destination = $private->path($path);
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
                if (! is_file($destination) || $sourceHash !== hash_file('sha256', $destination)) {
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
}
