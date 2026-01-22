@extends('layouts.site')

@section('content')
    @include('partials.hero', [
        'title' => 'Inovação Tecnológica',
        'subtitle' => 'Conheça as iniciativas e projetos de inovação do ISP-Bié.'
    ])
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Em breve</h2>
            <p class="text-gray-700">Conteúdo sobre inovação tecnológica será disponibilizado aqui.</p>
        </div>
    </div>
@endsection
