@extends('layouts.site')


@section('hero')
    @include('partials.hero', [
        'title' => 'Presidência',
        'subtitle' => 'Instituto Superior Politécnico do Bié'
    ])
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Presidência
      </nav>

  <!-- Estrutura Organizacional -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Presidência -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8">PRESIDÊNCIA</h2>
        
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

          <!-- Gabinete -->
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
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Chefe de Gabinete
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Coordenador Executivo
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Assessorias especializadas
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Vice-Presidências -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8">VICE-PRESIDÊNCIAS</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- VP Graduação -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
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

          <!-- VP Pós-Graduação -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#3B82F6] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <h3 class="text-xl font-bold">Pós-Graduação</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-sm text-gray-700 mb-3">
                Gestão dos programas de mestrado e formação avançada.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li>• Programas de mestrado</li>
                <li>• Especialização</li>
                <li>• Formação continuada</li>
              </ul>
            </div>
          </div>

          <!-- VP Pesquisa -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#9C27B0] to-[#673AB7] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7zm2 6.172V4h2v4.172a3 3 0 00.879 2.12l1.027 1.028a4 4 0 00-2.171.102l-.47.156a4 4 0 01-2.53 0l-.563-.187a1.993 1.993 0 00-.114-.035l1.063-1.063A3 3 0 009 8.172z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Pesquisa e Inovação</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-sm text-gray-700 mb-3">
                Promoção da investigação científica e desenvolvimento tecnológico.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li>• Projetos de pesquisa</li>
                <li>• Inovação tecnológica</li>
                <li>• Publicações científicas</li>
              </ul>
            </div>
          </div>

          <!-- VP Cultura -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Extensão Universitária</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-sm text-gray-700 mb-3">
                Ações de extensão universitária e integração com a comunidade.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li>• Projetos de extensão</li>
                <li>• Atividades culturais</li>
                <li>• Responsabilidade social</li>
              </ul>
            </div>
          </div>

          <!-- VP Inclusão -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Inclusão</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-sm text-gray-700 mb-3">
                Políticas de acessibilidade, diversidade e equidade.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li>• Acessibilidade</li>
                <li>• Diversidade</li>
                <li>• Ações afirmativas</li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Órgãos Ligados à Presidência -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8">ÓRGÃOS LIGADOS À PRESIDÊNCIA</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <a href="/ouvidoria" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Ouvidoria</h3>
            </div>
            <p class="text-sm text-gray-600">Canal de comunicação entre a comunidade e a administração</p>
          </a>

          <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Secretaria Geral</h3>
            </div>
            <p class="text-sm text-gray-600">Gestão administrativa e documentação institucional</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Procuradoria</h3>
            </div>
            <p class="text-sm text-gray-600">Assessoria jurídica e defesa dos interesses institucionais</p>
          </div>

          <a href="/alumni" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Alumni ISP-Bié</h3>
            </div>
            <p class="text-sm text-gray-600">Relação com ex-alunos e rede de egresso</p>
          </a>

          <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                  <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Superintendências</h3>
            </div>
            <p class="text-sm text-gray-600">Órgãos de gestão executiva especializada</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Coordenadorias</h3>
            </div>
            <p class="text-sm text-gray-600">Coordenação de áreas técnicas e administrativas</p>
          </div>

          <a href="/biblioteca" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Biblioteca Digital</h3>
            </div>
            <p class="text-sm text-gray-600">Gestão do acervo bibliográfico e recursos digitais</p>
          </a>

          <a href="/estatisticas" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <div class="flex items-center mb-3">
              <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
              </div>
              <h3 class="font-bold text-gray-800">Gestão de Indicadores</h3>
            </div>
            <p class="text-sm text-gray-600">Monitoramento e análise de desempenho institucional</p>
          </div>

        </div>
      </div>

      <!-- CTA -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-12 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Transparência e Governança</h2>
        <p class="text-xl mb-8 opacity-90">
          Acompanhe as ações e decisões da Presidência do ISP-Bié
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <div class="flex justify-center space-x-6 w-full">
            <div class="flex justify-center space-x-6 w-full">
              <a href="/transparencia" class="bg-white text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-[#3B82F6] transition-colors">
                Portal da Transparência
              </a>
              <a href="/contactos" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-[#2563eb] transition-colors">
                Entre em Contacto
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection

