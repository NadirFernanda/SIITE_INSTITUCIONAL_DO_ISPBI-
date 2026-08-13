<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Candidatura extends Model
{
    protected $table = 'candidaturas';

    protected $fillable = [
        'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
        'naturalidade_municipio', 'naturalidade_provincia',
        'bi', 'bi_emitido_em', 'bi_data_emissao',
        'sexo', 'estado_civil', 'necessidade_especial',
        'residencia_municipio', 'residencia_bairro',
        'telefone', 'telefone2', 'email', 'autorizacao_assinatura', 'autorizacao_assinatura_em',
        'habilitacoes', 'escola_origem', 'perfil', 'local_inscricao', 'pagamento_confirmado', 'pagamento_confirmado_em', 'pagamento_confirmado_por', 'ano_conclusao',
        'estado_financeiro', 'trabalhador', 'instituicao_laboral',
        'curso', 'periodo', 'observacoes',
        'status', 'notas_admin',
        'sala_id', 'numero_lugar', 'codigo_exame',
        'assinado_por', 'assinado_em', 'assinatura_codigo',
        'nota_exame', 'nota_lancada_por', 'nota_lancada_em',
        'folha_impressa_por', 'folha_impressa_em',
        'comprovativo_gerado_por', 'comprovativo_gerado_em',
        'whatsapp_comprovativo_enviado_at', 'whatsapp_comprovativo_falhou_em',
        'comprovativo_impresso_presencialmente_por', 'comprovativo_impresso_presencialmente_em',
        'whatsapp_recebida_enviado_at', 'whatsapp_recebida_falhou_em',
        'whatsapp_pagamento_enviado_at', 'whatsapp_pagamento_falhou_em',
    ];

    protected $casts = [
        'data_nascimento'  => 'date',
        'bi_data_emissao'  => 'date',
        'trabalhador'           => 'boolean',
        'pagamento_confirmado'  => 'boolean',
        'pagamento_confirmado_em' => 'datetime',
        'autorizacao_assinatura'    => 'boolean',
        'autorizacao_assinatura_em' => 'datetime',
        'codigo_exame'      => 'string',
        'nota_exame'       => 'float',
        'nota_lancada_em'  => 'datetime',
        'assinado_em'      => 'datetime',
        'folha_impressa_em'       => 'datetime',
        'comprovativo_gerado_em'  => 'datetime',
        'whatsapp_comprovativo_enviado_at' => 'datetime',
        'whatsapp_comprovativo_falhou_em'  => 'datetime',
        'comprovativo_impresso_presencialmente_em' => 'datetime',
        'whatsapp_recebida_enviado_at'  => 'datetime',
        'whatsapp_recebida_falhou_em'   => 'datetime',
        'whatsapp_pagamento_enviado_at' => 'datetime',
        'whatsapp_pagamento_falhou_em'  => 'datetime',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    public static array $cursos = [
        'Contabilidade e Administração',
        'Engenharia Informática',
        'Engenharia em Recursos Hídricos',
        'Comunicação Social',
        'Psicologia',
        'Enfermagem',
    ];

    // Perfis de acesso por curso (conforme documento oficial)
    public static array $perfisCurso = [
        'Comunicação Social' => [
            'Comunicação Social',
            'Pré-Escolar',
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
            'Técnico de Informática',
        ],
        'Contabilidade e Administração' => [
            'Informática de Gestão',
            'Pré-Escolar',
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
            'Secretariado',
            'Administração Pública',
            'Instalação Eléctrica',
            'Construção Civil',
            'Técnico de Informática',
            'Técnico de Gestão Agrícola',
            'Electromecânica',
            'Ensino Primário',
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
            'Fisioterapia',
            'Técnico de Farmácia',
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
            'Técnico de Gestão Agrícola',
            'Electromecânica',
            'Gestão do Ambiente',
        ],
        'Engenharia Informática' => [
            'Informática de Gestão',
            'Matemática e Física',
            'Ciências Físicas e Biológicas',
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
            'Técnico de Informática',
            'Técnico de Gestão Agrícola',
            'Electromecânica',
            'Electrónica',
            'Ensino Primário',
        ],
        'Psicologia' => [
            'Análises Clínicas',
            'Ciências Humanas',
            'Ciências Económicas e Jurídicas',
            'História e Geografia',
            'Ciências Físicas e Biológicas',
            'Educador Social',
            'Enfermagem Geral',
            'Educação Moral e Cívica',
            'Autarquias Locais',
            'Propedêutico',
            'Administração Pública',
            'Produção Vegetal',
            'Secretariado',
            'Técnico de Secretariado',
            'Química',
            'Filosofia',
            'Produção Animal',
        ],
    ];

    public static array $locaisInscricao = [
        'dentro' => 'Dentro do ISP_Bié',
        'fora'   => 'Fora do ISP_Bié',
    ];

    // Cursos com prioridade para salas de maior capacidade.
    // A ordem do array É a ordem de prioridade: Enfermagem primeiro, depois Psicologia.
    public static array $cursosPrioritarios = ['Enfermagem', 'Psicologia'];

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

    /**
     * Pesquisa textual case-insensitive, tolerante à ordem das palavras.
     *
     * Duas correcções sobre um simples where(...,'like',...):
     * 1) Em PostgreSQL (produção) o LIKE é case-sensitive por omissão — ao contrário do
     *    MySQL/SQLite usados noutros ambientes — o que fazia a pesquisa por nome/BI falhar
     *    sempre que a maiúscula/minúscula não coincidisse exactamente.
     * 2) O termo é dividido em palavras e cada uma tem de aparecer nalgum dos campos
     *    (não necessariamente todas no mesmo campo, nem pela ordem exacta), para permitir
     *    encontrar "João Kalunga" mesmo que o nome completo seja "João André Kalunga".
     */
    public function scopeBuscaTexto($query, string $termo, array $camposTexto, bool $incluirId = true)
    {
        $termo = trim($termo);
        if ($termo === '') {
            return $query;
        }

        $palavras = preg_split('/\s+/', mb_strtolower($termo, 'UTF-8'));

        return $query->where(function ($r) use ($palavras, $termo, $camposTexto, $incluirId) {
            foreach ($palavras as $palavra) {
                $r->where(function ($sub) use ($palavra, $camposTexto) {
                    foreach ($camposTexto as $campo) {
                        $sub->orWhereRaw("LOWER({$campo}) LIKE ?", ['%' . $palavra . '%']);
                    }
                });
            }
            if ($incluirId && is_numeric($termo)) {
                $r->orWhere('id', (int) $termo);
            }
        });
    }

    public function isAssinada(): bool
    {
        return $this->assinado_em !== null;
    }

    public static function gerarCodigoExame(): string
    {
        do {
            $code = 'E' . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('codigo_exame', $code)->exists());

        return $code;
    }

    public function atribuirCodigoExame(): string
    {
        if ($this->codigo_exame) {
            return $this->codigo_exame;
        }

        $this->codigo_exame = self::gerarCodigoExame();
        $this->save();

        return $this->codigo_exame;
    }
}


