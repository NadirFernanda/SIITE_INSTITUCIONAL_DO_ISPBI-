<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    protected $table = 'candidaturas';

    protected $fillable = [
        'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
        'naturalidade_municipio', 'naturalidade_provincia',
        'bi', 'bi_emitido_em', 'bi_data_emissao',
        'sexo', 'estado_civil', 'necessidade_especial',
        'residencia_municipio', 'residencia_bairro',
        'telefone', 'telefone2', 'email',
        'habilitacoes', 'escola_origem', 'perfil', 'local_inscricao', 'pagamento_confirmado', 'pagamento_confirmado_em', 'pagamento_confirmado_por', 'ano_conclusao',
        'estado_financeiro', 'trabalhador', 'instituicao_laboral',
        'curso', 'periodo', 'observacoes',
        'status', 'notas_admin',
        'sala_id', 'numero_lugar',
        'assinado_por', 'assinado_em', 'assinatura_codigo',
        'nota_exame', 'nota_lancada_por', 'nota_lancada_em',
    ];

    protected $casts = [
        'data_nascimento'  => 'date',
        'bi_data_emissao'  => 'date',
        'trabalhador'           => 'boolean',
        'pagamento_confirmado'  => 'boolean',
        'pagamento_confirmado_em' => 'datetime',
        'nota_exame'       => 'float',
        'nota_lancada_em'  => 'datetime',
        'assinado_em'      => 'datetime',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    public static array $cursos = [
        'Contabilidade e Administração',
        'Engenharia Informática',
        'Engenharia em Recursos Hídricos',
        'Comunicação Social',
        'Psicologia Clínica',
        'Enfermagem',
    ];

    // Perfis de acesso por curso (conforme documento oficial)
    public static array $perfisCurso = [
        'Comunicação Social' => [
            'Língua Portuguesa e EMC',
            'Ciências Económicas e Jurídicas',
            'História e Geografia',
            'Autarquias Locais',
            'Educação Moral e Cívica',
            'Ciências Humanas',
            'Ensino Primário',
            'Propedêutico',
            'Educador Social',
            'Filosofia',
            'Administração Pública',
            'Telecomunicações',
        ],
        'Contabilidade e Administração' => [
            'Matemática e Física',
            'Ciências Físicas e Biológicas',
            'Comércio',
            'Técnico de Minas',
            'Gestão de Recursos Humanos',
            'Técnico de Contabilidade',
            'Autarquias',
            'Ciências Económicas e Jurídicas',
            'Técnico de Finanças',
            'Técnico de Gestão Empresarial',
            'Técnico de Estatística',
            'Técnico de Secretariado',
            'Administração Pública',
            'Instalação Eléctrica',
            'Construção Civil',
        ],
        'Enfermagem' => [
            'Enfermagem Geral',
            'Análises Clínicas',
            'Radiologia',
            'Ciências Físicas e Biológicas',
            'Biologia e Química',
            'Educação Física',
            'Química',
            'Produção Vegetal',
            'Produção Animal',
        ],
        'Engenharia em Recursos Hídricos' => [
            'Matemática e Física',
            'Ciências Físicas e Biológicas',
            'Ciências Económicas e Jurídicas',
            'Técnico de Estatística',
            'Telecomunicações',
            'Técnico de Móveis',
            'Técnico de Minas',
            'Eletricidade',
            'Instalação Eléctrica',
            'Construção Civil',
            'Máquinas e Motores',
            'Energias Renováveis',
            'Mecânica',
            'Química',
        ],
        'Engenharia Informática' => [
            'Informática de Gestão',
            'Matemática e Física',
            'Ciências Económicas e Jurídicas',
            'Técnico de Estatística',
            'Técnico de Móveis',
            'Instalação Eléctrica',
            'Construção Civil',
            'Telecomunicações',
            'Energias Renováveis',
            'Mecânica',
            'Eletricidade',
            'Máquinas e Motores',
        ],
        'Psicologia Clínica' => [
            'Ciências Humanas',
            'Ciências Económicas e Jurídicas',
            'História e Geografia',
            'Ciências Físicas e Biológicas',
            'Educador Social',
            'Enfermagem Geral',
            'Educação Moral e Cívica',
            'Autarquias Locais',
            'Ensino Primário',
            'Propedêutico',
            'Administração Pública',
            'Produção Vegetal',
            'Secretariado',
            'Química',
            'Filosofia',
            'Produção Animal',
        ],
    ];

    public static array $locaisInscricao = [
        'dentro' => 'Dentro do ISP_Bié',
        'fora'   => 'Fora do ISP_Bié',
    ];

    // Cursos com prioridade para salas de maior capacidade
    public static array $cursosPrioritarios = ['Enfermagem'];

    public static array $statusLabels = [
        'pendente'   => 'Pendente',
        'em_analise' => 'Em Análise',
        'aprovada'   => 'Aprovada',
        'rejeitada'  => 'Rejeitada',
        'concluida'  => 'Concluída',
    ];

    public static array $statusColors = [
        'pendente'   => '#f59e0b',
        'em_analise' => '#3b82f6',
        'aprovada'   => '#22c55e',
        'rejeitada'  => '#ef4444',
        'concluida'  => '#7c3aed',
    ];

    // Retorna todos os perfis únicos ordenados alfabeticamente
    public static function todosOsPerfis(): array
    {
        $all = [];
        foreach (static::$perfisCurso as $perfis) {
            foreach ($perfis as $p) {
                $all[$p] = true;
            }
        }
        ksort($all);
        return array_keys($all);
    }

    public function confirmadoPor()
    {
        return $this->belongsTo(\App\Models\User::class, 'pagamento_confirmado_por');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function assinante()
    {
        return $this->belongsTo(User::class, 'assinado_por');
    }

    public function notaLancadaPor()
    {
        return $this->belongsTo(User::class, 'nota_lancada_por');
    }

    public function isAssinada(): bool
    {
        return $this->assinado_em !== null;
    }
}
