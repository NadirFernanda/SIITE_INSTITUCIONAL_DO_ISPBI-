<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    protected $table = 'candidaturas';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'bi',
        'data_nascimento',
        'curso',
        'escola_origem',
        'ano_conclusao',
        'observacoes',
        'status',
        'notas_admin',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    public static array $cursos = [
        'Contabilidade e Administração',
        'Engenharia Informática',
        'Engenharia em Recursos Hídricos',
        'Comunicação Social',
        'Psicologia Clínica',
        'Engenharia Civil',
    ];

    public static array $statusLabels = [
        'pendente'   => 'Pendente',
        'em_analise' => 'Em Análise',
        'aprovada'   => 'Aprovada',
        'rejeitada'  => 'Rejeitada',
    ];

    public static array $statusColors = [
        'pendente'   => '#f59e0b',
        'em_analise' => '#3b82f6',
        'aprovada'   => '#22c55e',
        'rejeitada'  => '#ef4444',
    ];
}
