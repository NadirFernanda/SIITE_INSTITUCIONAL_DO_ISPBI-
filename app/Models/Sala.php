<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = ['nome', 'capacidade', 'data_exame', 'horario'];

    // Cada horário é um turno independente, com a sua própria capacidade
    // cheia das 24 salas (candidatos diferentes em cada turno, mesma sala
    // reaproveitada) — conforme o Anexo 2 oficial, que lista cada horário da
    // manhã/tarde como uma linha própria de capacidade. Ver Sala::$agendaExames.
    public static array $horarios = [
        '08:00-10:00',
        '10:30-12:30',
        '13:00-15:00',
        '15:30-17:30',
    ];

    /**
     * Calendário oficial dos Exames de Acesso 2026/2027 (Anexo 2) — data e
     * horários fixos por curso e período, usados pela distribuição automática
     * de salas (App\Services\DistribuicaoSalasService) para colocar cada
     * candidato na sala certa, no dia e turno certos.
     *
     * Cada período (regular/pós-laboral) tem normalmente DOIS turnos no
     * mesmo dia (ex.: 08:00-10:00 e 10:30-12:30) — são turnos distintos, com
     * candidatos diferentes em cada um, não a mesma pessoa a fazer duas
     * provas seguidas. Isso duplica a capacidade real desse período: as 24
     * salas (1.130 lugares) servem primeiro o turno da manhã cedo, depois
     * esvaziam e recebem outro grupo de candidatos no turno seguinte. A
     * distribuição preenche o primeiro turno até à capacidade máxima e só
     * depois passa candidatos para o turno seguinte da lista.
     *
     * A Engenharia em Recursos Hídricos tem período único (Regular) — não tem
     * variante Pós-laboral. Uma candidatura deste curso com período
     * "pos-laboral" é uma anomalia de dados e fica sinalizada como "sem
     * correspondência no calendário" pela distribuição, em vez de ser
     * assumida silenciosamente como Regular.
     */
    public static array $agendaExames = [
        'Comunicação Social' => [
            'regular'     => ['data' => '2026-09-02', 'horarios' => ['08:00-10:00', '10:30-12:30']],
            'pos-laboral' => ['data' => '2026-09-02', 'horarios' => ['13:00-15:00', '15:30-17:30']],
        ],
        'Engenharia Informática' => [
            'regular'     => ['data' => '2026-09-02', 'horarios' => ['08:00-10:00', '10:30-12:30']],
            'pos-laboral' => ['data' => '2026-09-02', 'horarios' => ['13:00-15:00', '15:30-17:30']],
        ],
        'Engenharia em Recursos Hídricos' => [
            'regular' => ['data' => '2026-09-02', 'horarios' => ['15:30-17:30']],
        ],
        'Contabilidade e Administração' => [
            'regular'     => ['data' => '2026-09-03', 'horarios' => ['08:00-10:00', '10:30-12:30']],
            'pos-laboral' => ['data' => '2026-09-03', 'horarios' => ['13:00-15:00', '15:30-17:30']],
        ],
        'Psicologia' => [
            'regular'     => ['data' => '2026-09-03', 'horarios' => ['08:00-10:00', '10:30-12:30']],
            'pos-laboral' => ['data' => '2026-09-03', 'horarios' => ['13:00-15:00', '15:30-17:30']],
        ],
        'Enfermagem' => [
            'regular'     => ['data' => '2026-09-04', 'horarios' => ['08:00-10:00', '10:30-12:30']],
            'pos-laboral' => ['data' => '2026-09-04', 'horarios' => ['13:00-15:00', '15:30-17:30']],
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
