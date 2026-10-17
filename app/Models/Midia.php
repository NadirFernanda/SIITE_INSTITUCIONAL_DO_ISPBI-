<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    public const ORGANIGRAMA_NOME = '__ispbie_system_organigrama_v1__';

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
}
