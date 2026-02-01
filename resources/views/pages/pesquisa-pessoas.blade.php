@extends('layouts.site')


@section('content')
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Busca de Pessoas</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-8">
        <div class="bg-white rounded-lg shadow-md p-8 mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Busca de Pessoas</h1>
            <p class="text-lg text-gray-700">Encontre docentes, funcionários e pesquisadores</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto mb-16">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pesquisar</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nome</label>
                        <input type="text" placeholder="Digite o nome..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Categoria</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option>Todas</option>
                            <option>Docentes</option>
                            <option>Funcionários</option>
                            <option>Pesquisadores</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Departamento</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option>Todos</option>
                            <option>Engenharias</option>
                            <option>Ciências Sociais</option>
                            <option>Gestão</option>
                            <option>Administrativo</option>
                        </select>
                    </div>
                    <button class="w-full bg-teal-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                        Buscar
                    </button>
                </div>
            </div>
        </div>

        <section>
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Diretório por Departamento</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Engenharias</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Eng. Informática</li>
                        <li>• Eng. Recursos Hídricos</li>
                        <li>• Eng. Civil</li>
                    </ul>
                    <button class="mt-4 text-teal-600 hover:text-teal-700 font-medium">Ver todos →</button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Ciências Sociais</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Comunicação Social</li>
                        <li>• Psicologia</li>
                    </ul>
                    <button class="mt-4 text-teal-600 hover:text-teal-700 font-medium">Ver todos →</button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Gestão</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Contabilidade</li>
                        <li>• Administração</li>
                    </ul>
                    <button class="mt-4 text-teal-600 hover:text-teal-700 font-medium">Ver todos →</button>
                </div>
            </div>
        </section>
    </div>
@endsection

