<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatistica extends Model
{
    protected $fillable = [
        'titulo', 'valor', 'descricao', 'ordem', 'icone'
    ];

    protected $casts = [
        'ordem' => 'integer',
    ];
}
