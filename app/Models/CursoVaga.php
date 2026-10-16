<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CursoVaga extends Model
{
    protected $table = 'curso_vagas';

    protected $fillable = ['curso', 'periodo', 'vagas'];

    protected $casts = [
        'vagas' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(function (CursoVaga $cursoVaga) {
            if (! $cursoVaga->wasRecentlyCreated && ! $cursoVaga->wasChanged('vagas')) {
                return;
            }

            DB::table('candidaturas')
                ->where('curso', $cursoVaga->curso)
                ->where('periodo', $cursoVaga->periodo)
                ->whereNotNull('resultado_admissao')
                ->update([
                    'resultado_admissao' => null,
                    'resultado_calculado_em' => null,
                    'resultado_calculado_por' => null,
                    'updated_at' => now(),
                ]);
        });
    }
}
