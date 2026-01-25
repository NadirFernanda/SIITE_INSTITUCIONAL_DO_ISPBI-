<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nome',
        'curso',
        'ano',
        'contacto',
        'trabalha',
        'empresa',
        'cargo',
        'satisfacao',
        'publicado',
        'testemunho',
    ];
}
