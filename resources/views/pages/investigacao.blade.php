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
                                <li><span class="font-semibold">AgroTech Bié:</span> Soluções digitais para agricultura sustentável na região.</li>
                                <li><span class="font-semibold">Saúde Digital:</span> Plataforma de monitoramento remoto de pacientes em áreas rurais.</li>
                                <li><span class="font-semibold">Educação 4.0:</span> Ferramentas tecnológicas para ensino personalizado e inclusivo.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold mb-2">Projectos em Avaliação</h3>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li><span class="font-semibold">Energia Limpa Bié:</span> Pesquisa sobre microgeração solar em comunidades locais.</li>
                                <li><span class="font-semibold">Biotecnologia Aplicada:</span> Desenvolvimento de biofertilizantes regionais.</li>
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

