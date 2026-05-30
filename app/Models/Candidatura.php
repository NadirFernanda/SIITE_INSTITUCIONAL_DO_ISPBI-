<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    protected $table = 'candidaturas';

    protected $fillable = [
        'nome',
        'filiacao_pai',
        'filiacao_mae',
        'data_nascimento',
        'naturalidade_municipio',
        'naturalidade_provincia',
        'bi',
        'bi_emitido_em',
        'bi_data_emissao',
        'sexo',
        'estado_civil',
        'necessidade_especial',
        'residencia_municipio',
        'residencia_bairro',
        'telefone',
        'telefone2',
        'email',
        'habilitacoes',
        'escola_origem',
        'ano_conclusao',
        'estado_financeiro',
        'trabalhador',
        'instituicao_laboral',
        'curso',
        'periodo',
        'observacoes',
        'status',
        'notas_admin',
    ];

    protected $casts = [
        'data_nascimento'  => 'date',
        'bi_data_emissao'  => 'date',
        'trabalhador'      => 'boolean',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
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
