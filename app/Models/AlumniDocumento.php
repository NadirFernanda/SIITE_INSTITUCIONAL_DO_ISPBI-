<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniDocumento extends Model
{
    protected $table = 'alumni_documentos';

    protected $fillable = [
        'titulo',
        'descricao',
        'ficheiro',
        'tamanho',
    ];
}
