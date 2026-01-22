@extends('layouts.site')

@section('hero')
        @include('partials.hero', [
                'title' => 'Transparência e Governança',
                'subtitle' => 'Acompanhe as ações e decisões da Presidência do ISP-Bié'
        ])
@endsection

@section('content')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <nav class="text-sm opacity-75 mb-8">
                <a href="/" class="hover:underline">Início</a> \ Transparência
            </nav>
  </section>

  <!-- Conteúdo Principal -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Gestão Financeira -->
    <section class="mb-16">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-8">Gestão Financeira</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Orçamento Anual</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Orçamento 2025</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Orçamento 2024</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Orçamento 2023</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Relatórios de Execução</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Execução 4Âº Trimestre 2024</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Execução 3Âº Trimestre 2024</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-gray-700">Relatório Anual 2023</span>
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Download PDF</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Documentos Institucionais -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Documentos Institucionais</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Estatutos</h3>
                    <p class="text-gray-600 mb-4">Estatuto do ISP-Bié e regulamentos</p>
                    <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Consultar â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Atas de Reuniões</h3>
                    <p class="text-gray-600 mb-4">Atas do Conselho Superior</p>
                    <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Consultar â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Relatórios de Gestão</h3>
                    <p class="text-gray-600 mb-4">Relatórios anuais de atividades</p>
                    <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Consultar â†’</a>
                </div>
            </div>
        </section>

        <!-- Contratações Públicas -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Contratações Públicas</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Concursos em Andamento</h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-orange-500 pl-4">
                                <h4 class="font-semibold text-gray-900">Aquisição de Equipamentos Informáticos</h4>
                                <p class="text-sm text-gray-600">Prazo: 20/12/2025</p>
                            </div>
                            <div class="border-l-4 border-teal-500 pl-4">
                                <h4 class="font-semibold text-gray-900">Serviços de Manutenção Predial</h4>
                                <p class="text-sm text-gray-600">Prazo: 15/01/2026</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Contratos Vigentes</h3>
                        <div class="space-y-3">
                            <a href="#" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                                <span class="text-gray-700">Lista de Contratos 2025</span>
                            </a>
                            <a href="#" class="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                                <span class="text-gray-700">Lista de Contratos 2024</span>
                            </a>
                        </div>
                    </div>
                </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 md:p-12 text-white text-center">
      <h2 class="text-3xl font-bold mb-4">Transparência e Governança</h2>
      <p class="text-xl opacity-90 mb-8">Acompanhe as ações e decisões da Presidência do ISP-Bié</p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="#" class="bg-white text-[#2563eb] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
          Portal da Transparência
        </a>
        <a href="/contactos" class="bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#1a2f3d] transition-colors">
          Entre em Contacto
        </a>
      </div>
    </section>
  </div>
@endsection

