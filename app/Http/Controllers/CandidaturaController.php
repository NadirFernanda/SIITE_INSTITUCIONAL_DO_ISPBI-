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
        $periodo = $request->input('periodo');
        $periodoLabel = $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';

        $request->validate([
            'nome'                    => 'required|string|max:255',
            'filiacao_pai'            => 'nullable|string|max:255',
            'filiacao_mae'            => 'nullable|string|max:255',
            'data_nascimento'         => 'nullable|date|before:today',
            'naturalidade_municipio'  => 'nullable|string|max:255',
            'naturalidade_provincia'  => 'nullable|string|max:255',
            'bi'                      => 'required|string|max:20',
            'bi_emitido_em'           => 'nullable|string|max:255',
            'bi_data_emissao'         => 'nullable|date|before:today',
            'sexo'                    => 'nullable|in:masculino,feminino',
            'estado_civil'            => 'nullable|string|max:100',
            'necessidade_especial'    => 'nullable|string|max:255',
            'residencia_municipio'    => 'nullable|string|max:255',
            'residencia_bairro'       => 'nullable|string|max:255',
            'telefone'                => 'required|string|max:50',
            'telefone2'               => 'nullable|string|max:50',
            'email'                   => 'required|email|max:255',
            'habilitacoes'            => 'nullable|string|max:100',
            'escola_origem'           => 'nullable|string|max:255',
            'ano_conclusao'           => 'nullable|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'       => 'nullable|in:maximo,medio,minimo',
            'trabalhador'             => 'nullable|in:sim,nao',
            'instituicao_laboral'     => 'nullable|string|max:255',
            'curso'                   => [
                'required', 'string', 'in:' . implode(',', Candidatura::$cursos),
                // Bloquear duplicado: mesmo BI + mesmo período + mesmo curso
                Rule::unique('candidaturas')->where(function ($query) use ($request) {
                    return $query->where('bi', $request->input('bi'))
                                 ->where('periodo', $request->input('periodo'));
                }),
            ],
            'periodo'                 => 'nullable|in:regular,pos-laboral',
            'observacoes'             => 'nullable|string|max:2000',
        ], [
            'curso.unique'  => "Já existe uma candidatura com este Bilhete de Identidade para o curso indicado no período {$periodoLabel}. Pode candidatar-se ao mesmo curso no outro período, ou escolher um curso diferente.",
            'bi.required'   => 'O Bilhete de Identidade é obrigatório.',
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
            'curso', 'periodo', 'observacoes',
        ]);
        // Converter trabalhador para boolean
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
