<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcursoAlert extends Model
{
    use HasFactory;

    protected $table = 'concurso_alerts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'interests',
        'consent',
    ];

    protected $casts = [
        'interests' => 'array',
        'consent' => 'boolean',
    ];
}
