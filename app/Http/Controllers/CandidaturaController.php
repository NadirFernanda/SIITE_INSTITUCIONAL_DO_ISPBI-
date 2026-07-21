<?php

namespace App\Http\Controllers;

use App\Mail\CandidaturaReceived;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class CandidaturaController extends Controller
{
    public function store(Request $request)
    {
        $periodo      = $request->input('periodo');
        $periodoLabel = $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';

        // Normalizar BI (maiúsculas, sem espaços) para evitar bypass da validação de duplicados
        $request->merge(['bi' => strtoupper(trim($request->input('bi', '')))]);

        $curso = $request->input('curso');
        $perfisPermitidos = Candidatura::$perfisCurso[$curso] ?? [];
        // Permitir submissão com opção 'Outro' quando o curso não estiver listado
        $allowedCursos = array_merge(Candidatura::$cursos, ['Outro']);
        // Permitir que o perfil seja 'Outro'
        $allowedPerfis = array_merge(Candidatura::todosOsPerfis(), ['Outro']);
        // Permitir 'Outro' entre os valores válidos para perfil quando aplicável
        $perfisValidos = array_merge($perfisPermitidos, ['Outro']);
        $perfilRules = empty($perfisPermitidos)
            ? ['nullable', 'string', 'max:150']
            : ['required', 'string', 'max:150', Rule::in($perfisValidos)];

        $request->validate([
            'nome'                   => 'required|string|max:255',
            'filiacao_pai'           => 'nullable|string|max:255',
            'filiacao_mae'           => 'nullable|string|max:255',
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
            'perfil'                 => $perfilRules,
            'ano_conclusao'          => 'required|integer|min:1990|max:' . date('Y'),
            'estado_financeiro'      => 'required|in:maximo,medio,minimo',
            'trabalhador'            => 'required|in:sim,nao',
            'instituicao_laboral'    => 'nullable|required_if:trabalhador,sim|string|max:255',
            'curso'                  => [
                'required', 'string', Rule::in($allowedCursos),
                Rule::unique('candidaturas')->where(function ($query) use ($request) {
                    return $query->where('bi', $request->input('bi'))
                                 ->where('periodo', $request->input('periodo'));
                }),
            ],
            'periodo'                => 'required|in:regular,pos-laboral',
            'local_inscricao'        => 'required|in:dentro,fora',
        ], [
            'curso.unique'                   => "Já existe uma candidatura com este Bilhete de Identidade para o curso indicado no período {$periodoLabel}. Pode candidatar-se ao mesmo curso no outro período, ou escolher um curso diferente.",
            'perfil.required'                => 'O perfil do curso de origem é obrigatório para o curso seleccionado.',
            'perfil.in'                      => "O perfil académico seleccionado não é compatível com o curso '{$curso}'. Se o seu curso não aparecer nesta lista, dirija-se à instituição para confirmação.",
            'bi.required'                    => 'O Bilhete de Identidade é obrigatório.',
            'data_nascimento.required'       => 'A data de nascimento é obrigatória.',
            'data_nascimento.before_or_equal'=> 'É necessário ter pelo menos 17 anos para se candidatar.',
            'filiacao_pai.required'          => 'O nome do pai é obrigatório.',
            'filiacao_mae.required'          => 'O nome da mãe é obrigatório.',
            'naturalidade_municipio.required'=> 'O município de naturalidade é obrigatório.',
            'naturalidade_provincia.required'=> 'A província de naturalidade é obrigatória.',
            'bi_emitido_em.required'         => 'O local de emissão do BI é obrigatório.',
            'bi_data_emissao.required'       => 'A data de emissão do BI é obrigatória.',
            'sexo.required'                  => 'O sexo é obrigatório.',
            'estado_civil.required'          => 'O estado civil é obrigatório.',
            'necessidade_especial.required'  => 'Este campo é obrigatório. Escreva "Nenhuma" se não aplicável.',
            'residencia_municipio.required'  => 'O município de residência é obrigatório.',
            'residencia_bairro.required'     => 'O bairro/rua de residência é obrigatório.',
            'habilitacoes.required'          => 'As habilitações literárias são obrigatórias.',
            'escola_origem.required'         => 'A escola de proveniência é obrigatória.',
            'ano_conclusao.required'         => 'O ano de conclusão é obrigatório.',
            'estado_financeiro.required'     => 'O estado financeiro da família é obrigatório.',
            'trabalhador.required'           => 'Indique se é trabalhador ou não.',
            'instituicao_laboral.required_if'=> 'Indique o nome da instituição onde trabalha.',
            'periodo.required'               => 'O período de inscrição é obrigatório.',
        ]);

        $data = $request->only([
            'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
            'naturalidade_municipio', 'naturalidade_provincia',
            'bi', 'bi_emitido_em', 'bi_data_emissao',
            'sexo', 'estado_civil', 'necessidade_especial',
            'residencia_municipio', 'residencia_bairro',
            'telefone', 'telefone2', 'email',
            'habilitacoes', 'escola_origem', 'perfil', 'ano_conclusao',
            'estado_financeiro', 'instituicao_laboral',
            'curso', 'periodo', 'local_inscricao',
        ]);
        // Preencher observações padrão quando o candidato indicar 'Outro' no perfil ou no curso
        if (($data['perfil'] ?? '') === 'Outro') {
            if (empty($request->input('observacoes'))) {
                $data['observacoes'] = 'Perfil não listado; candidato orientado a dirigir-se à instituição';
            } else {
                $data['observacoes'] = $request->input('observacoes');
            }
        } elseif (($data['curso'] ?? '') === 'Outro') {
            if (empty($request->input('observacoes'))) {
                $data['observacoes'] = 'Curso não listado; candidato orientado a dirigir-se à instituição';
            } else {
                $data['observacoes'] = $request->input('observacoes');
            }
        } else {
            // Se não for 'Outro' em nenhum dos casos, preservar observações enviadas (se houver)
            if ($request->filled('observacoes')) {
                $data['observacoes'] = $request->input('observacoes');
            }
        }
        $data['trabalhador'] = $request->input('trabalhador') === 'sim';

        $candidatura = Candidatura::create($data);

        try {
            Mail::to('geral@isp-bie.ao')->send(new CandidaturaReceived($candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de candidatura: ' . $e->getMessage());
        }

        try {
            app(WhatsAppService::class)->notificarCandidaturaRecebida($candidatura);
        } catch (\Throwable $e) {
            \Log::error('WhatsApp candidatura recebida: ' . $e->getMessage());
        }

        // URL assinada e com expiração (72h) — só o candidato que acabou de submeter
        // consegue aceder ao comprovativo. Impede enumeração de IDs por terceiros.
        $signedUrl = URL::temporarySignedRoute(
            'candidaturas.comprovativo',
            now()->addHours(72),
            ['candidatura' => $candidatura->id]
        );

        return redirect($signedUrl);
    }

    public function comprovativo(Request $request, Candidatura $candidatura)
    {
        // Verificar assinatura — rejeita acessos directos sem token válido
        if (! $request->hasValidSignature()) {
            abort(403, 'Este link é inválido ou expirou. Se submeteu a candidatura há menos de 72 horas, utilize o link enviado após a submissão.');
        }

        return view('pages.candidatura-sucesso', compact('candidatura'));
    }

    public function downloadPdf(Request $request, Candidatura $candidatura)
    {
        // Mesma protecção: apenas com assinatura válida ou utilizador autenticado (admin/técnico)
        if (! $request->hasValidSignature() && ! auth()->check()) {
            abort(403, 'Acesso não autorizado.');
        }

        app('translator')->setLocale('pt');

        $pdf = Pdf::loadView('pdf.comprovativo', compact('candidatura'))
                  ->setPaper('a4', 'portrait');

        $filename = 'comprovativo-candidatura-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($filename);
    }
}
