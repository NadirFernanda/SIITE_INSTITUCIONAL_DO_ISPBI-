@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
@include('partials.page-hero', [
    'title'      => 'Busca de Pessoas',
    'subtitle'   => 'Encontre docentes, funcionários e pesquisadores do ISP-Bié.',
    'breadcrumb' => 'Busca de Pessoas',
])

    <div class="py-4 scroll-reveal">
        <div class="max-w-3xl mx-auto mb-16">
            <div class="bg-white p-8 rounded-lg shadow-md interactive-card">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pesquisar</h2>
                <div class="space-y-4">
                    <div>
                        <label for="pesquisa_nome" class="block text-gray-700 font-semibold mb-2">Nome</label>
                        <input id="pesquisa_nome" type="text" placeholder="Digite o nome..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <div>
                        <label for="pesquisa_categoria" class="block text-gray-700 font-semibold mb-2">Categoria</label>
                        <select id="pesquisa_categoria" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option>Todas</option>
                            <option>Docentes</option>
                            <option>Funcionários</option>
                            <option>Pesquisadores</option>
                        </select>
                    </div>
                    <div>
                        <label for="pesquisa_departamento" class="block text-gray-700 font-semibold mb-2">Departamento</label>
                        <select id="pesquisa_departamento" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
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

        <section class="scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Diretório por Departamento</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Engenharias</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Eng. Informática</li>
                        <li>• Eng. Recursos Hídricos</li>
                        <li>• Eng. Civil</li>
                    </ul>
                    <button class="mt-4 text-teal-600 hover:text-teal-700 font-medium">Ver todos →</button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Ciências Sociais</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Comunicação Social</li>
                        <li>• Psicologia</li>
                    </ul>
                    <button class="mt-4 text-teal-600 hover:text-teal-700 font-medium">Ver todos →</button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card">
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

</div>
@endsection

