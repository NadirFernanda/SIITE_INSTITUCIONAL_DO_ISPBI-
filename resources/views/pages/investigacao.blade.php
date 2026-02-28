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

    <!-- Projectos e listas relacionadas removidas conforme solicitação do utilizador -->

    <!-- Secção de publicações removida conforme solicitação do utilizador -->

</div>

@endsection

