@extends('layouts.site')

@section('content')

@php
    $inProgress = $projects->get('em_curso') ?? collect();
    $inReview = $projects->get('em_avaliacao') ?? collect();
    $completed = $projects->get('concluido') ?? collect();
@endphp

<div class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Investigação e Inovação</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h2 class="text-xl font-semibold mb-4">Projectos em Curso</h2>
            <div class="space-y-4">
                @forelse($inProgress as $p)
                    <div class="bg-white/90 dark:bg-gray-800 rounded-lg p-4 shadow">
                        <h3 class="font-semibold">{{ $p->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($p->summary, 180) }}</p>
                        @if($p->link)
                            <a href="{{ $p->link }}" class="text-blue-600 hover:underline mt-2 inline-block">Ver mais</a>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Nenhum projecto em curso.</p>
                @endforelse
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Projectos em Avaliação</h2>
            <div class="space-y-4">
                @forelse($inReview as $p)
                    <div class="bg-white/90 dark:bg-gray-800 rounded-lg p-4 shadow">
                        <h3 class="font-semibold">{{ $p->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($p->summary, 180) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Nenhum projecto em avaliação.</p>
                @endforelse
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Projectos Concluídos</h2>
            <div class="space-y-4">
                @forelse($completed as $p)
                    <div class="bg-white/90 dark:bg-gray-800 rounded-lg p-4 shadow">
                        <h3 class="font-semibold">{{ $p->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($p->summary, 180) }}</p>
                        @if($p->link)
                            <a href="{{ $p->link }}" class="text-blue-600 hover:underline mt-2 inline-block">Relatório</a>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Nenhum projecto concluído.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-reveal">

    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Investigação, Inovação e Empreendedorismo</h1>
        <p class="text-lg text-gray-700">Conheça os projetos, publicações e iniciativas do ISP-Bié</p>
    </div>
    <!-- Centro de Inovação e Empreendedorismo -->
    <section class="mb-16 scroll-reveal">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#2563eb] mb-2">Centro de Inovação e Empreendedorismo</h2>
                <p class="text-lg text-gray-700 max-w-2xl">
                    O Centro de Inovação e Empreendedorismo do ISP-Bié promove a cultura de inovação, incubação de startups, apoio a ideias transformadoras e integração entre universidade, empresas e sociedade. Aqui, estudantes e docentes encontram suporte para transformar conhecimento em soluções reais para desafios regionais e globais.
                </p>
            </div>
            <img src="/images/investigacao.jpg" alt="Centro de Inovação" class="w-48 md:w-60 lg:w-72 max-h-48 md:max-h-60 rounded-lg shadow-lg mt-8 md:mt-0 md:ml-12 object-cover" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
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
        </div>
    </section>

    <!-- Projetos em Curso -->
    <section class="mb-16 scroll-reveal">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Projetos em Curso</h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-2">
            <li><span class="font-semibold">AgroTech Bié:</span> Soluções digitais para agricultura sustentável na região.</li>
            <li><span class="font-semibold">Saúde Digital:</span> Plataforma de monitoramento remoto de pacientes em áreas rurais.</li>
            <li><span class="font-semibold">Educação 4.0:</span> Ferramentas tecnológicas para ensino personalizado e inclusivo.</li>
        </ul>
    </section>

    <!-- Projetos em Avaliação -->
    <section class="mb-16 scroll-reveal">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Projetos em Avaliação</h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-2">
            <li><span class="font-semibold">Energia Limpa Bié:</span> Pesquisa sobre microgeração solar em comunidades locais.</li>
            <li><span class="font-semibold">Biotecnologia Aplicada:</span> Desenvolvimento de biofertilizantes regionais.</li>
        </ul>
    </section>

    <!-- Projetos Concluídos -->
    <section class="mb-16 scroll-reveal">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Projetos Concluídos</h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-2">
            <li><span class="font-semibold">Rede de Monitoramento Ambiental:</span> Instalação de sensores para análise da qualidade do ar e da água.</li>
            <li><span class="font-semibold">Empreenda Bié:</span> Programa de capacitação de jovens empreendedores.</li>
        </ul>
    </section>

    <!-- Publicações e Artigos por Área de Conhecimento -->
    <section class="scroll-reveal">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Publicações e Artigos por Área de Conhecimento</h2>
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
    </section>
</div>
@endsection
