@extends('layouts.site')

@section('content')
    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">Pós-Graduação</h1>
            <p class="text-xl text-blue-100">Informações sobre cursos de pós-graduação do ISP-Bié.</p>
        </div>
    </div>

    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Pós-Graduação</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Em breve</h2>
            <p class="text-gray-700">Conteúdo sobre pós-graduação será disponibilizado aqui.</p>
        </div>
    </div>
@endsection
