@extends('layouts.site')

@section('content')
    @include('partials.hero', [
        'title' => 'Pós-Graduação',
        'subtitle' => 'Informações sobre cursos de pós-graduação do ISP-Bié.'
    ])

    <div class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Em breve</h2>
            <p class="text-gray-700">Conteúdo sobre pós-graduação será disponibilizado aqui.</p>
        </div>
    </div>
@endsection
