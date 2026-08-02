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

    public function disciplines()
    {
        return $this->hasMany(SalaDiscipline::class);
    }

    /**
     * Ordena as salas por data e horário do exame (manhã antes de tarde), depois
     * por nome — em vez de alfabética simples, que misturava os horários de uma
     * mesma sala (ex.: "Sala 1" das 8h e "Sala 1" das 13h ficavam lado a lado
     * sem relação com a ordem real do dia). Salas sem horário definido vão para
     * o fim de cada data. Formato zero-padded (HH:MM) já ordena cronologicamente
     * como string, por isso não precisa de conversão especial.
     */
    public function scopeOrdenadaPorHorario($query)
    {
        return $query->orderBy('data_exame')
            ->orderByRaw('CASE WHEN horario IS NULL THEN 1 ELSE 0 END')
            ->orderBy('horario')
            ->orderBy('nome');
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
