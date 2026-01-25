@extends('layouts.site')

@section('hero')
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 py-12 text-center text-white">
        <h1 class="text-4xl font-bold mb-2">Painel Administrativo</h1>
        <p class="text-lg opacity-80">Bem-vindo ao dashboard de administração do ISP-Bié</p>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-lg shadow">
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
