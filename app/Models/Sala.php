<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = ['nome', 'capacidade', 'data_exame', 'horario'];

    // Cada bloco cobre os dois horários seguidos da mesma sala/turma (ex.: as
    // duas provas da manhã), já que a mesma sala serve o candidato nos dois —
    // ver Sala::$agendaExames.
    public static array $horarios = [
        '08:00-10:00 e 10:30-12:30',
        '13:00-15:00 e 15:30-17:30',
        '15:30-17:30',
    ];

    /**
     * Calendário oficial dos Exames de Acesso 2026/2027 (Anexo 2) — data e
     * horário fixos por curso e período, usados pela distribuição automática
     * de salas (App\Services\DistribuicaoSalasService) para colocar cada
     * candidato na sala certa, no dia e horário certos.
     *
     * A Engenharia em Recursos Hídricos não distingue Regular/Pós-laboral —
     * ambos os períodos partilham o mesmo horário único (confirmado com a
     * instituição).
     */
    public static array $agendaExames = [
        'Comunicação Social' => [
            'regular'     => ['data' => '2026-09-02', 'horario' => '08:00-10:00 e 10:30-12:30'],
            'pos-laboral' => ['data' => '2026-09-02', 'horario' => '13:00-15:00 e 15:30-17:30'],
        ],
        'Engenharia Informática' => [
            'regular'     => ['data' => '2026-09-02', 'horario' => '08:00-10:00 e 10:30-12:30'],
            'pos-laboral' => ['data' => '2026-09-02', 'horario' => '13:00-15:00 e 15:30-17:30'],
        ],
        'Engenharia em Recursos Hídricos' => [
            'regular'     => ['data' => '2026-09-02', 'horario' => '15:30-17:30'],
            'pos-laboral' => ['data' => '2026-09-02', 'horario' => '15:30-17:30'],
        ],
        'Contabilidade e Administração' => [
            'regular'     => ['data' => '2026-09-03', 'horario' => '08:00-10:00 e 10:30-12:30'],
            'pos-laboral' => ['data' => '2026-09-03', 'horario' => '13:00-15:00 e 15:30-17:30'],
        ],
        'Psicologia' => [
            'regular'     => ['data' => '2026-09-03', 'horario' => '08:00-10:00 e 10:30-12:30'],
            'pos-laboral' => ['data' => '2026-09-03', 'horario' => '13:00-15:00 e 15:30-17:30'],
        ],
        'Enfermagem' => [
            'regular'     => ['data' => '2026-09-04', 'horario' => '08:00-10:00 e 10:30-12:30'],
            'pos-laboral' => ['data' => '2026-09-04', 'horario' => '13:00-15:00 e 15:30-17:30'],
        ],
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
            // Ordenação natural do nome ("Sala 1", "Sala 2", ... "Sala 24") em vez
            // de alfabética simples, que colocava "Sala 10" antes de "Sala 2".
            // Ordenar primeiro por comprimento do nome e só depois alfabeticamente
            // funciona como ordenação natural sempre que os números tenham a mesma
            // quantidade de dígitos dentro do mesmo comprimento de texto — válido
            // em PostgreSQL, MySQL e SQLite sem precisar de funções específicas.
            ->orderByRaw('LENGTH(nome)')
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
