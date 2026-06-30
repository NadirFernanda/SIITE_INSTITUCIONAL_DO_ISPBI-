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
        'pais',
        'cargo',
        'satisfacao',
        'publicado',
        'testemunho',
        'user_id',
    ];

    protected $casts = [
        'trabalha'  => 'boolean',
        'publicado' => 'boolean',
        'testemunho'=> 'boolean',
        'ano'       => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
