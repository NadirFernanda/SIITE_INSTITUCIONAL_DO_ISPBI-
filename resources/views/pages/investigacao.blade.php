@extends('layouts.site')

@section('content')

@php
    // Make view resilient when controller does not provide $projects
    $projectsCollection = $projects ?? collect();
    $inProgress = $projectsCollection->get('em_curso') ?? collect();
    $inReview = $projectsCollection->get('em_avaliacao') ?? collect();
    $completed = $projectsCollection->get('concluido') ?? collect();
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Investigação, Inovação e Empreendedorismo',
    'subtitle'   => 'Conheça os projetos, publicações e iniciativas do ISP-Bié.',
    'breadcrumb' => 'Investigação',
])

    <!-- Feature panels -->
    <section class="mb-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 text-center interactive-card">
            <h3 class="font-bold text-xl text-[#2563eb] mb-2">Incubadora de Startups</h3>
            <p class="text-gray-600">Apoio a projetos inovadores, mentorias, networking e acesso a investidores.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center interactive-card">
            <h3 class="font-bold text-xl text-[#2563eb] mb-2">Laboratórios de Prototipagem</h3>
            <p class="text-gray-600">Espaços equipados para desenvolvimento de protótipos, testes e experimentação.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center interactive-card">
            <h3 class="font-bold text-xl text-[#2563eb] mb-2">Desafios e Hackathons</h3>
            <p class="text-gray-600">Eventos para estimular soluções criativas e colaboração multidisciplinar.</p>
        </div>
    </section>

        <!-- Projectos e publicações: replicado com o layout da página 'Visão' -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg mb-8 interactive-card transition-all duration-200 hover:shadow-xl hover:-translate-y-1">
                    <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Projectos</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold text-[#2563eb] mb-2">Projectos em Curso</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Cuidados Continuados em Doenças Crónicas:</span> intervenção em adultos com doenças crónicas não transmissíveis na comunidade do Bairro Cantíflas, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Enfermagem Materna e Hemorragias Obstétricas:</span> práticas de enfermagem em mulheres com hemorragias no peri-parto, parto e puerpério na Maternidade do Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Impacto do Alcoolismo na Juventude:</span> estudo das consequências do alcoolismo na população jovem do Bairro Cantíflas, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Consultório de Enfermagem:</span> criação de um consultório para cuidados de enfermagem e promoção da saúde.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Comportamento do Consumidor:</span> fatores que influenciam o comportamento de compra dos clientes da empresa C.V. &amp; Filhos, Lda.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Gabinete de Assessoria Contabilística:</span> criação de um gabinete de apoio às empresas nos serviços de contabilidade.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Consultório de Orientação Psicológica:</span> criação de um serviço de apoio psicológico à comunidade académica e local.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Rádio Internet ISP-Bié:</span> criação de uma rádio digital para comunicação científica, educativa e institucional.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Qualidade das Águas Subterrâneas do Cuito-Bié:</span> avaliação da água para consumo humano nas áreas circundantes aos cemitérios.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Sistema de Alerta de Inundações de Cangote:</span> redução do risco de cheias na localidade de Cangote, Município do Cuito-Bié.</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-[#2563eb] mb-2">Projectos em Avaliação</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Observatório Académico do Corredor do Lobito:</span> plataforma de pesquisa multidisciplinar para recolha e análise de dados socioeconómicos, ambientais e tecnológicos, apoiando a tomada de decisão.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Incubadora de Negócios Locais:</span> programa de apoio a empreendedores e pequenas empresas ao longo do Corredor do Lobito, promovendo inovação e geração de emprego.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Segurança Ferroviária no Corredor do Lobito:</span> iniciativas de sensibilização sobre segurança ferroviária e oportunidades económicas, com produção de conteúdos para rádio, televisão e redes sociais.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Sustentabilidade Ambiental no Corredor do Lobito:</span> implementação de projetos de gestão sustentável da água (ETAR) e mitigação de riscos ambientais associados à erosão, poluição e uso de recursos hídricos.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Monitoramento Hidrometeorológico do Rio Cuquema:</span> proposta de monitoramento sem uso de sensores remotos na bacia hidrográfica do rio Cuquema, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Análise do Impacto da Marca d’Água Digital em Imagens Médicas:</span> estudo do impacto no diagnóstico assistido por computador de cancros cerebrais.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Modernização da Sala de Informática do ISP-Bié:</span> apetrechamento tecnológico para apoio ao ensino e à investigação.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Laboratório de Simulação Clínica do ISP-Bié:</span> apetrechamento e modernização para formação prática na área da saúde.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Laboratório de Hidrologia:</span> reforço técnico-científico do laboratório do curso de Engenharia em Recursos Hídricos.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Capacitação Científica de Docentes do ISPB:</span> fortalecimento das competências em elaboração de projetos de investigação.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Modernização da Biblioteca do ISP-Bié:</span> reforço da infraestrutura de apoio académico.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Sala de Análise de Dados Qualitativos e Quantitativos:</span> criação e apetrechamento de espaço dedicado à análise científica de dados.</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-[#2563eb] mb-2">Projectos Concluídos</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Rede de Monitoramento Ambiental:</span> instalação de sensores para análise da qualidade do ar e da água.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700"><span class="font-semibold">Empreenda Bié:</span> programa de capacitação de jovens empreendedores.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicações removidas por solicitação do utilizador -->
            </div>
        </section>

    <!-- Secção de publicações removida conforme solicitação do utilizador -->

</div>

@endsection

