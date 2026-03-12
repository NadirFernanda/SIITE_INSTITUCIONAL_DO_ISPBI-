@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
@include('partials.page-hero', [
    'title'      => 'Biblioteca Digital',
    'subtitle'   => 'Acervo digital e recursos bibliográficos do ISP-Bié.',
    'breadcrumb' => 'Biblioteca Digital',
])
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <div class="lg:col-span-3">
                        <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
                            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
                                <div class="mb-6">
                                    <div class="max-w-2xl mx-auto">
                                        <div class="relative">
                                            <input type="text" placeholder="Buscar livros, artigos, periódicos..." class="w-full px-6 py-4 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                                            <svg class="absolute right-4 top-4 w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="text-3xl font-bold text-gray-900 mb-4">Coleções</h2>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow interactive-card">
                                        <div class="w-16 h-16 bg-teal-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Livros</h3>
                                        <p class="text-2xl font-bold text-teal-600">2.500+</p>
                                    </div>

                                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow interactive-card">
                                        <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Artigos</h3>
                                        <p class="text-2xl font-bold text-green-600">1.200+</p>
                                    </div>

                                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow interactive-card">
                                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Periódicos</h3>
                                        <p class="text-2xl font-bold text-blue-600">150+</p>
                                    </div>

                                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow interactive-card">
                                        <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Multimídia</h3>
                                        <p class="text-2xl font-bold text-orange-600">800+</p>
                                    </div>
                                </div>

                                <hr class="my-6">

                                <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white text-center">
                                    <h2 class="text-3xl font-bold mb-4">Acesso Restrito</h2>
                                    <p class="text-xl mb-8">Faça login com suas credenciais ISP-Bié para acessar todo o acervo</p>
                                    <button class="bg-white text-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-teal-50 transition-colors">Fazer Login</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

</div>
@endsection

