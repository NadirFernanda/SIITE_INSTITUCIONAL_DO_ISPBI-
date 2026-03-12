@extends('layouts.site')

@section('title', 'Busca na Biblioteca - ISP-Bié')

@section('content')

    <!-- Cabeçalho em card -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6 scroll-reveal">
        <div class="bg-white rounded-lg shadow-md p-8 interactive-card">
            <h1 class="text-3xl font-bold text-[#2563eb] mb-2">Busca na Biblioteca</h1>
            <p class="text-gray-600">Pesquise no catálogo da biblioteca.</p>
        </div>
    </div>

    <div class="bg-white border-b scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Busca na Biblioteca</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-reveal">
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white p-8 rounded-lg shadow-md interactive-card">
                <div class="mb-6">
                    <div class="relative">
                        <input type="text" placeholder="Título, autor, ISBN, palavra-chave..." class="w-full px-6 py-4 pr-12 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="absolute right-4 top-4 w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Tipo de Material</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Todos</option>
                            <option>Livros</option>
                            <option>Periódicos</option>
                            <option>Artigos</option>
                            <option>Teses</option>
                            <option>Multimídia</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Área do Conhecimento</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Todas</option>
                            <option>Engenharia</option>
                            <option>Ciências Sociais</option>
                            <option>Gestão</option>
                            <option>Saúde</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Disponibilidade</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Todos</option>
                            <option>Disponível</option>
                            <option>Emprestado</option>
                            <option>Reservado</option>
                        </select>
                    </div>
                </div>

                <button class="mt-6 w-full bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Buscar no Catálogo
                </button>
            </div>
        </div>

        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Acesso Rápido</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center interactive-card">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Novos Livros</h3>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center interactive-card">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Mais Requisitados</h3>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center interactive-card">
                    <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">E-books</h3>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center interactive-card">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Periódicos</h3>
                </a>
            </div>
        </section>

        <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white text-center scroll-reveal">
            <h2 class="text-3xl font-bold mb-4">Não encontrou o que procura?</h2>
            <p class="text-xl mb-8">Solicite ao bibliotecário</p>
            <button class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                Fazer Solicitação
            </button>
        </div>
    </div>


@endsection

