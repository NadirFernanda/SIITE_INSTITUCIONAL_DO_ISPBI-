@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Inovação Tecnológica',
    'subtitle'   => 'Iniciativas e projetos de inovação do ISP-Bié.',
    'breadcrumb' => 'Inovação',
])

    <div class="scroll-reveal">
        <div class="bg-white p-8 rounded-lg shadow-md interactive-card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Em breve</h2>
            <p class="text-gray-700">Conteúdo sobre inovação tecnológica será disponibilizado aqui.</p>
        </div>
    </div>

</div>
@endsection
