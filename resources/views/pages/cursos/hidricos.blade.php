@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#0EA5E9] mb-4">Engenharia em Recursos Hídricos</h1>

    <div class="text-sm font-semibold text-gray-700 mb-2">Algumas áreas de actuação</div>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-4 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#0EA5E9]/20 flex items-center justify-center">🚰</div>
            <div>
                <div class="font-semibold">Gestão de Recursos Hídricos</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#0EA5E9]/20 flex items-center justify-center">💧</div>
            <div>
                <div class="font-semibold">Saneamento e Tratamento de Água</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#0EA5E9]/20 flex items-center justify-center">🏗️</div>
            <div>
                <div class="font-semibold">Infraestruturas Hidráulicas</div>
            </div>
        </div>
    </div>

    <p class="text-sm text-gray-600 mb-4"><span class="font-semibold">Engenharias</span> - Engenharias e Telecomunicações</p>

    <p class="text-gray-700">Forma engenheiros especializados na gestão sustentável dos recursos hídricos, desenvolvimento de infraestruturas hidráulicas e saneamento básico.</p>

</div>

@endsection
