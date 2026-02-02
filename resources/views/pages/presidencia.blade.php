@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
    <!-- Breadcrumb -->
    <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Órgãos de gestão
    </nav>

    <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Órgãos de gestão</h1>
        <p class="text-lg text-gray-700 mb-4">Instituto Superior Politécnico do Bié</p>
        <div class="overflow-hidden rounded-xl border border-gray-100">
            <img
                src="{{ asset('images/organigrama.jpeg') }}"
                alt="Organigrama institucional do Instituto Superior Politécnico do Bié"
                class="w-full h-56 md:h-72 object-cover"
            >
        </div>
    </div>

    <!-- Estrutura Organizacional -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Organigrama Institucional -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Organigrama Institucional</h2>
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <img
                        src="{{ asset('images/organigrama-ispbie.png') }}"
                        alt="Organigrama do Instituto Superior Politécnico do Bié"
                        class="w-full h-auto"
                    >
                </div>
            </div>

            <!-- Órgãos de gestão -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-[#2563eb] mb-8">ÓRGÃOS DE GESTÃO</h2>
                <div class="grid md:grid-cols-2 gap-6">

                    <!-- Presidente -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-4">
                            <div class="flex items-center text-white">
                                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                <h3 class="text-xl font-bold">Presidente</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">
                                Órgão executivo máximo responsável pela administração geral do Instituto, 
                                representação institucional e implementação das decisões dos órgãos colegiados.
                            </p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Representação legal do Instituto
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Gestão administrativa e financeira
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Coordenação das políticas institucionais
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Gabinete do Presidente -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
                            <div class="flex items-center text-white">
                                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                                <h3 class="text-xl font-bold">Gabinete do Presidente</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">
                                Órgão de apoio direto ao Presidente, responsável pela coordenação da agenda 
                                executiva e articulação institucional.
                            </p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li>• Chefe de Gabinete</li>
                                <li>• Coordenador Executivo</li>
                                <li>• Assessorias especializadas</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Vice-Órgãos de gestão -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-[#2563eb] mb-8">VICE-ÓRGÃOS DE GESTÃO</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Cada VP aqui mantém o mesmo padrão de código simplificado -->
                    <!-- Exemplo: VP Graduação -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
                            <div class="flex items-center text-white">
                                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                                <h3 class="text-xl font-bold">Graduação</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-700 mb-3">
                                Coordenação dos cursos de graduação e políticas de ensino.
                            </p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li>• Gestão curricular</li>
                                <li>• Qualidade do ensino</li>
                                <li>• Apoio pedagógico</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Adicione os outros VPs de forma similar... -->

                </div>
            </div>

            <!-- CTA de Transparência -->
            <div class="bg-[#2563eb] rounded-2xl p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Governança</h2>
                <p class="text-xl mb-8 opacity-90">
                    Acompanhe as ações e decisões dos Órgãos de gestão do ISP-Bié
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <!-- Botão Portal da Transparência removido -->
                    <a href="/contactos" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold border border-white hover:bg-white hover:text-[#2563eb] transition-colors">
                        Entre em Contacto
                    </a>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

