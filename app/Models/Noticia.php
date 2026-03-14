<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'noticias';

    protected $fillable = [
        'titulo',
        'texto',
        'imagem',
        'pdf',
        'data',
        'institucional',
        'publicada',
    ];

    protected $casts = [
        'data'          => 'date',
        'publicada'     => 'boolean',
        'institucional' => 'boolean',
    ];
}
