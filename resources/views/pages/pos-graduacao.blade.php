@extends('layouts.site')

@section('content')
    <div class="institutional-page">
        @include('partials.page-hero', [
            'title' => 'Pós-Graduação',
            'subtitle' => 'Informações sobre cursos de pós-graduação do ISP-Bié.',
            'breadcrumb' => 'Pós-Graduação',
        ])
    </div>

    <div class="institutional-page scroll-reveal">
        <div class="institutional-card interactive-card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Em breve</h2>
            <p class="text-gray-700">Conteúdo sobre pós-graduação será disponibilizado aqui.</p>
        </div>
    </div>
@endsection
