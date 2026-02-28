@extends('layouts.site')

@section('content')

@php
    // Make view resilient when controller does not provide $projects
    $projectsCollection = $projects ?? collect();
    $inProgress = $projectsCollection->get('em_curso') ?? collect();
    $inReview = $projectsCollection->get('em_avaliacao') ?? collect();
    $completed = $projectsCollection->get('concluido') ?? collect();
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-reveal">

    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Investigação, Inovação e Empreendedorismo</h1>
        <p class="text-lg text-gray-700">Conheça os projetos, publicações e iniciativas do ISP-Bié</p>
    </div>

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
                <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg mb-8">
                    <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Projectos</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold text-[#2563eb] mb-2">Projectos em Curso</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Cuidados Continuados em Doenças Crónicas: Intervenção em adultos com doenças crónicas não transmissíveis na comunidade do Bairro Cantíflas, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Enfermagem Materna e Hemorragias Obstétricas: Práticas de enfermagem em mulheres com hemorragias no peri-parto, parto e puerpério na Maternidade do Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Impacto do Alcoolismo na Juventude: Estudo das consequências do alcoolismo na população jovem do Bairro Cantíflas, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Consultório de Enfermagem: Criação de um consultório para cuidados de enfermagem e promoção da saúde.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Comportamento do Consumidor: Fatores que influenciam o comportamento de compra dos clientes da empresa C.V. &amp; Filhos, Lda.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Gabinete de Assessoria Contabilística: Criação de um gabinete de apoio às empresas nos serviços de contabilidade.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Consultório de Orientação Psicológica: Criação de um serviço de apoio psicológico à comunidade académica e local.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Rádio Internet ISP-Bié: Criação de uma rádio digital para comunicação científica, educativa e institucional.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Qualidade das Águas Subterrâneas do Cuito-Bié: Avaliação da água para consumo humano nas áreas circundantes aos cemitérios.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Sistema de Alerta de Inundações de Cangote: Redução do risco de cheias na localidade de Cangote, Município do Cuito-Bié.</div>
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
                                    <div class="text-gray-700">Observatório Académico do Corredor do Lobito: Plataforma de pesquisa multidisciplinar para recolha e análise de dados socioeconómicos, ambientais e tecnológicos, apoiando a tomada de decisão.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Incubadora de Negócios Locais: Programa de apoio a empreendedores e pequenas empresas ao longo do Corredor do Lobito, promovendo inovação e geração de emprego.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Segurança Ferroviária no Corredor do Lobito: Iniciativas de sensibilização sobre segurança ferroviária e oportunidades económicas, com produção de conteúdos para rádio, televisão e redes sociais.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Sustentabilidade Ambiental no Corredor do Lobito: Implementação de projetos de gestão sustentável da água (ETAR) e mitigação de riscos ambientais associados à erosão, poluição e uso de recursos hídricos.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Monitoramento Hidrometeorológico do Rio Cuquema: Proposta de monitoramento sem uso de sensores remotos na bacia hidrográfica do rio Cuquema, Cuito-Bié.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Análise do Impacto da Marca d’Água Digital em Imagens Médicas: Estudo do impacto no diagnóstico assistido por computador de cancros cerebrais.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Modernização da Sala de Informática do ISP-Bié: Apetrechamento tecnológico para apoio ao ensino e à investigação.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Laboratório de Simulação Clínica do ISP-Bié: Apetrechamento e modernização para formação prática na área da saúde.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Laboratório de Hidrologia: Reforço técnico-científico do laboratório do curso de Engenharia em Recursos Hídricos.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Capacitação Científica de Docentes do ISPB: Fortalecimento das competências em elaboração de projetos de investigação.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Modernização da Biblioteca do ISP-Bié: Reforço da infraestrutura de apoio académico.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-gray-700">Sala de Análise de Dados Qualitativos e Quantitativos: Criação e apetrechamento de espaço dedicado à análise científica de dados.</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-[#2563eb] mb-2">Projectos Concluídos</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li><span class="font-semibold">Rede de Monitoramento Ambiental:</span> Instalação de sensores para análise da qualidade do ar e da água.</li>
                                <li><span class="font-semibold">Empreenda Bié:</span> Programa de capacitação de jovens empreendedores.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Publicações removidas por solicitação do utilizador -->
            </div>
        </section>

    <!-- Secção de publicações removida conforme solicitação do utilizador -->

</div>

@endsection

