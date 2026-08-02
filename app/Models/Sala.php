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

    // Período a que cada horário pertence — usado na distribuição automática
    // para garantir que candidatos do regular só ficam em salas da manhã e
    // os do pós-laboral só em salas da tarde.
    public static array $horariosPorPeriodo = [
        'regular'     => ['08:00-10:00', '10:30-12:30'],
        'pos-laboral' => ['13:00-15:00', '15:30-18:00'],
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
