<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const CANDIDATURAS_ATIVAS = 'candidaturas_ativas';

    public const PDI_PDF_PUBLICADO = 'pdi_pdf_publicado';

    protected $table = 'site_settings';

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    protected function casts(): array
    {
        return ['value' => 'boolean'];
    }

    public static function candidaturasAtivas(): bool
    {
        $value = static::query()
            ->where('key', self::CANDIDATURAS_ATIVAS)
            ->toBase()
            ->value('value');

        return in_array($value, [true, 1, '1', 't', 'true'], true);
    }

    public static function pdiPdfPublicado(): bool
    {
        $value = static::query()
            ->where('key', self::PDI_PDF_PUBLICADO)
            ->toBase()
            ->value('value');

        return in_array($value, [true, 1, '1', 't', 'true'], true);
    }
}
