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
                            <h3 class="text-xl font-semibold mb-2">Projectos em Curso</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li>Cuidados Continuados em Doenças Crónicas: Intervenção em adultos com doenças crónicas não transmissíveis na comunidade do Bairro Cantíflas, Cuito-Bié.</li>
                                <li>Enfermagem Materna e Hemorragias Obstétricas: Práticas de enfermagem em mulheres com hemorragias no peri-parto, parto e puerpério na Maternidade do Cuito-Bié.</li>
                                <li>Impacto do Alcoolismo na Juventude: Estudo das consequências do alcoolismo na população jovem do Bairro Cantíflas, Cuito-Bié.</li>
                                <li>Consultório de Enfermagem: Criação de um consultório para cuidados de enfermagem e promoção da saúde.</li>
                                <li>Comportamento do Consumidor: Fatores que influenciam o comportamento de compra dos clientes da empresa C.V. &amp; Filhos, Lda.</li>
                                <li>Gabinete de Assessoria Contabilística: Criação de um gabinete de apoio às empresas nos serviços de contabilidade.</li>
                                <li>Consultório de Orientação Psicológica: Criação de um serviço de apoio psicológico à comunidade académica e local.</li>
                                <li>Rádio Internet ISP-Bié: Criação de uma rádio digital para comunicação científica, educativa e institucional.</li>
                                <li>Qualidade das Águas Subterrâneas do Cuito-Bié: Avaliação da água para consumo humano nas áreas circundantes aos cemitérios.</li>
                                <li>Sistema de Alerta de Inundações de Cangote: Redução do risco de cheias na localidade de Cangote, Município do Cuito-Bié.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold mb-2">Projectos em Avaliação</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li>Observatório Académico do Corredor do Lobito: Plataforma de pesquisa multidisciplinar para recolha e análise de dados socioeconómicos, ambientais e tecnológicos, apoiando a tomada de decisão.</li>
                                <li>Incubadora de Negócios Locais: Programa de apoio a empreendedores e pequenas empresas ao longo do Corredor do Lobito, promovendo inovação e geração de emprego.</li>
                                <li>Segurança Ferroviária no Corredor do Lobito: Iniciativas de sensibilização sobre segurança ferroviária e oportunidades económicas, com produção de conteúdos para rádio, televisão e redes sociais.</li>
                                <li>Sustentabilidade Ambiental no Corredor do Lobito: Implementação de projetos de gestão sustentável da água (ETAR) e mitigação de riscos ambientais associados à erosão, poluição e uso de recursos hídricos.</li>
                                <li>Monitoramento Hidrometeorológico do Rio Cuquema: Proposta de monitoramento sem uso de sensores remotos na bacia hidrográfica do rio Cuquema, Cuito-Bié.</li>
                                <li>Análise do Impacto da Marca d’Água Digital em Imagens Médicas: Estudo do impacto no diagnóstico assistido por computador de cancros cerebrais.</li>
                                <li>Modernização da Sala de Informática do ISP-Bié: Apetrechamento tecnológico para apoio ao ensino e à investigação.</li>
                                <li>Laboratório de Simulação Clínica do ISP-Bié: Apetrechamento e modernização para formação prática na área da saúde.</li>
                                <li>Laboratório de Hidrologia: Reforço técnico-científico do laboratório do curso de Engenharia em Recursos Hídricos.</li>
                                <li>Capacitação Científica de Docentes do ISPB: Fortalecimento das competências em elaboração de projetos de investigação.</li>
                                <li>Modernização da Biblioteca do ISP-Bié: Reforço da infraestrutura de apoio académico.</li>
                                <li>Sala de Análise de Dados Qualitativos e Quantitativos: Criação e apetrechamento de espaço dedicado à análise científica de dados.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold mb-2">Projectos Concluídos</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li><span class="font-semibold">Rede de Monitoramento Ambiental:</span> Instalação de sensores para análise da qualidade do ar e da água.</li>
                                <li><span class="font-semibold">Empreenda Bié:</span> Programa de capacitação de jovens empreendedores.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
                    <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Publicações e Artigos por Área de Conhecimento</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Engenharias e Tecnologia</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                                <li>"Soluções IoT para Agricultura Familiar" – Revista de Inovação Tecnológica, 2025.</li>
                                <li>"Modelagem de Estruturas Sustentáveis" – Congresso Nacional de Engenharia, 2024.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Ciências da Saúde</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                                <li>"Telemedicina em Regiões Remotas" – Jornal de Saúde Pública, 2025.</li>
                                <li>"Prevenção de Doenças Tropicais" – Simpósio Internacional de Saúde, 2024.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Ciências Sociais e Humanas</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                                <li>"Inclusão Digital em Comunidades Rurais" – Revista de Educação e Sociedade, 2025.</li>
                                <li>"Empreendedorismo Social no Bié" – Fórum de Desenvolvimento Regional, 2024.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Gestão e Administração</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                                <li>"Gestão de Projetos de Inovação" – Encontro Nacional de Administração, 2025.</li>
                                <li>"Finanças para Startups" – Revista Angolana de Negócios, 2024.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Secção de publicações removida conforme solicitação do utilizador -->

</div>

@endsection

