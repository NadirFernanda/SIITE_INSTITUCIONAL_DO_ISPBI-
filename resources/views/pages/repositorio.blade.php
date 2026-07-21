@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Repositório Académico',
    'subtitle'   => 'Teses, dissertações e produção científica do ISP-Bié.',
    'breadcrumb' => 'Repositório Académico',
])
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <div class="lg:col-span-3">
                        <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
                            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
                                <div class="mb-6">
                                    <div class="max-w-2xl mx-auto">
                                        <div class="relative">
                                            <input type="text" placeholder="Buscar trabalhos, autores, orientadores..." class="w-full px-6 py-4 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                                            <svg class="absolute right-4 top-4 w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="text-3xl font-bold text-gray-900 mb-4">Coleções por Curso</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Contabilidade e Administração</h3>
                                        <p class="text-gray-600 mb-2">45 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>

                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Engenharia Informática</h3>
                                        <p class="text-gray-600 mb-2">38 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>

                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Eng. Recursos Hídricos</h3>
                                        <p class="text-gray-600 mb-2">32 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>

                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Comunicação Social</h3>
                                        <p class="text-gray-600 mb-2">28 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>

                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Psicologia</h3>
                                        <p class="text-gray-600 mb-2">25 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>

                                    <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Enfermagem Geral</h3>
                                        <p class="text-gray-600 mb-2">30 trabalhos</p>
                                        <span class="text-teal-600 font-medium">Ver todos →</span>
                                    </a>
                                </div>

                                <hr class="my-6">

                                <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] rounded-xl p-8 text-white text-center">
                                    <h2 class="text-3xl font-bold mb-4">Depositar Trabalho</h2>
                                    <p class="text-xl mb-8">Contribua para o repositório institucional</p>
                                    <button class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors">Fazer Depósito</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

</div>
@endsection



