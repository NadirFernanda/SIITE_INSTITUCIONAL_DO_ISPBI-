@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto mt-10 p-8 bg-white rounded-lg shadow scroll-reveal">
    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Painel Administrativo</h1>
        <p class="text-lg text-gray-700">Bem-vindo ao dashboard de administração do ISP-Bié</p>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-blue-700">Dashboard</h2>
    <p class="mb-6 text-gray-700">Aqui você pode gerenciar conteúdos, usuários, configurações e visualizar estatísticas do site.</p>
    <ul class="space-y-3">
        <li><a href="#" class="text-blue-600 hover:underline">Gerenciar Usuários</a></li>
        <li><a href="#" class="text-blue-600 hover:underline">Gerenciar Posts</a></li>
        <li><a href="#" class="text-blue-600 hover:underline">Gerenciar Páginas</a></li>
        <li><a href="#" class="text-blue-600 hover:underline">Configurações do Site</a></li>
    </ul>
</div>
@endsection
