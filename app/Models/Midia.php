<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    public const ORGANIGRAMA_NOME = '__ispbie_system_organigrama_v1__';

    public const PDI_FOTOGRAFIA_NOME = '__ispbie_system_pdi_fotografia_v1__';

    public const PDI_DOCUMENTO_NOME = '__ispbie_system_pdi_documento_v1__';

    protected $fillable = ['nome', 'caminho'];

    // null: use the original image; empty string: explicitly unpublished.
    public static function organigramaPath(): ?string
    {
        return static::query()
            ->where('nome', self::ORGANIGRAMA_NOME)
            ->orderBy('id')
            ->value('caminho');
    }

    public static function isManagedOrganigramaPath(?string $path): bool
    {
        return $path !== null
            && (bool) preg_match('~\Aorganigramas/[A-Za-z0-9_-]+\.(?:jpg|jpeg|png|webp)\z~', $path);
    }

    public static function systemNames(): array
    {
        return [self::ORGANIGRAMA_NOME, self::PDI_FOTOGRAFIA_NOME, self::PDI_DOCUMENTO_NOME];
    }

    public static function pdiPath(string $name): ?string
    {
        return static::query()->where('nome', $name)->orderBy('id')->value('caminho');
    }

    public static function isManagedPdiPhotoPath(?string $path): bool
    {
        return $path !== null
            && (bool) preg_match('~\Apdi/fotografias/[A-Za-z0-9_-]+\.(?:jpg|jpeg|png|webp)\z~', $path);
    }

    public static function isManagedPdiPdfPath(?string $path): bool
    {
        return $path !== null
            && (bool) preg_match('~\Apdi/documentos/[A-Za-z0-9_-]+\.pdf\z~', $path);
    }
}
