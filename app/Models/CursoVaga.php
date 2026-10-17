<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoVaga extends Model
{
    protected $table = 'curso_vagas';

    protected $fillable = ['curso', 'periodo', 'vagas'];

    protected $casts = [
        'vagas' => 'integer',
    ];
}
