<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = ['nome', 'capacidade', 'data_exame', 'horario'];

    public static array $horarios = [
        '08:00-10:00',
        '10:30-12:30',
        '13:00-15:00',
        '15:30-18:00',
    ];

    protected $casts = [
        'data_exame' => 'date',
    ];

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class);
    }

    public function totalAtribuido(): int
    {
        return $this->candidaturas()->count();
    }

    public function lotacaoRestante(): int
    {
        return $this->capacidade - $this->totalAtribuido();
    }
}
