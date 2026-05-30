<?php

namespace App\Http\Controllers;

use App\Mail\CandidaturaReceived;
use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class CandidaturaController extends Controller
{
    public function store(Request $request)
    {
        $periodo      = $request->input('periodo');
        $periodoLabel = $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';

        $request->validate([
            'nome'                   => 'required|string|max:255',
            'filiacao_pai'           => 'required|string|max:255',
            'filiacao_mae'           => 'required|string|max:255',
            'data_nascimento'        => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'naturalidade_municipio' => 'required|string|max:255',
            'naturalidade_provincia' => 'required|string|max:255',
            'bi'                     => 'required|string|max:20',
            'bi_emitido_em'          => 'required|string|max:255',
            'bi_data_emissao'        => 'required|date|before:today',
            'sexo'                   => 'required|in:masculino,feminino',
            'estado_civil'           => 'required|string|max:100',
            'necessidade_especial'   => 'required|string|max:255',
            'residencia_municipio'   => 'required|string|max:255',
            'residencia_bairro'      => 'required|string|max:255',
            'telefone'               => 'required|string|max:50',
            'telefone2'              => 'nullable|string|max:50',
            'email'                  => 'required|email|max:255',
            'habilitacoes'           => 'required|string|max:100',
            'escola_origem'          => 'required|string|max:255',
            'ano_conclusao'          => 'required|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'      => 'required|in:maximo,medio,minimo',
            'trabalhador'            => 'required|in:sim,nao',
            'instituicao_laboral'    => 'nullable|required_if:trabalhador,sim|string|max:255',
            'curso'                  => [
                'required', 'string', 'in:' . implode(',', Candidatura::$cursos),
                Rule::unique('candidaturas')->where(function ($query) use ($request) {
                    return $query->where('bi', $request->input('bi'))
                                 ->where('periodo', $request->input('periodo'));
                }),
            ],
            'periodo'                => 'required|in:regular,pos-laboral',
        ], [
            'curso.unique'                       => "Já existe uma candidatura com este Bilhete de Identidade para o curso indicado no período {$periodoLabel}. Pode candidatar-se ao mesmo curso no outro período, ou escolher um curso diferente.",
            'bi.required'                        => 'O Bilhete de Identidade é obrigatório.',
            'data_nascimento.required'            => 'A data de nascimento é obrigatória.',
            'data_nascimento.before_or_equal'     => 'É necessário ter pelo menos 17 anos para se candidatar.',
            'filiacao_pai.required'               => 'O nome do pai é obrigatório.',
            'filiacao_mae.required'               => 'O nome da mãe é obrigatório.',
            'naturalidade_municipio.required'     => 'O município de naturalidade é obrigatório.',
            'naturalidade_provincia.required'     => 'A província de naturalidade é obrigatória.',
            'bi_emitido_em.required'              => 'O local de emissão do BI é obrigatório.',
            'bi_data_emissao.required'            => 'A data de emissão do BI é obrigatória.',
            'sexo.required'                       => 'O sexo é obrigatório.',
            'estado_civil.required'               => 'O estado civil é obrigatório.',
            'necessidade_especial.required'       => 'Este campo é obrigatório. Escreva "Nenhuma" se não aplicável.',
            'residencia_municipio.required'       => 'O município de residência é obrigatório.',
            'residencia_bairro.required'          => 'O bairro/rua de residência é obrigatório.',
            'habilitacoes.required'               => 'As habilitações literárias são obrigatórias.',
            'escola_origem.required'              => 'A escola de proveniência é obrigatória.',
            'ano_conclusao.required'              => 'O ano de conclusão é obrigatório.',
            'estado_financeiro.required'          => 'O estado financeiro da família é obrigatório.',
            'trabalhador.required'                => 'Indique se é trabalhador ou não.',
            'instituicao_laboral.required_if'     => 'Indique o nome da instituição onde trabalha.',
            'periodo.required'                    => 'O período de inscrição é obrigatório.',
        ]);

        $data = $request->only([
            'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
            'naturalidade_municipio', 'naturalidade_provincia',
            'bi', 'bi_emitido_em', 'bi_data_emissao',
            'sexo', 'estado_civil', 'necessidade_especial',
            'residencia_municipio', 'residencia_bairro',
            'telefone', 'telefone2', 'email',
            'habilitacoes', 'escola_origem', 'ano_conclusao',
            'estado_financeiro', 'instituicao_laboral',
            'curso', 'periodo',
        ]);
        $data['trabalhador'] = $request->input('trabalhador') === 'sim';

        $candidatura = Candidatura::create($data);

        try {
            Mail::to('geral@isp-bie.ao')->send(new CandidaturaReceived($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de candidatura: ' . $e->getMessage());
        }

        return redirect()->route('candidaturas')
            ->with('candidatura_success', 'Candidatura submetida com sucesso! Entraremos em contacto em breve.');
    }
}
