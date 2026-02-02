@extends('layouts.site')

@section('content')
  <!-- Banner Institucional -->
  <section class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-4">
        <!-- Ícone de lupa (search) outline, sem fundo, harmônico com os demais -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <div>
          <h1 class="text-4xl font-bold">Pesquisa e Inovação</h1>
          <p class="text-lg opacity-90">Instituto Superior Politécnico do Bié</p>
        </div>
      </div>
      
      <nav class="text-sm opacity-75">
        <a href="/" class="hover:underline">Início</a> \ Pesquisa e Inovação
      </nav>
    </div>
  </section>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12 interactive-card">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Compromisso com a Investigação Científica</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          O Instituto Superior Politécnico do Bié promove a investigação científica como pilar fundamental 
          para o desenvolvimento regional e nacional, incentivando a produção de conhecimento aplicado que 
          contribua para a resolução de problemas sociais, económicos e ambientais da província do Bié.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          Através de parcerias estratégicas, infraestrutura adequada e apoio aos investigadores, o ISP-Bié 
          estimula a inovação tecnológica e a transferência de conhecimento para a sociedade.
        </p>
        <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-6 rounded-lg mt-6 interactive-card">
          <h3 class="text-xl font-bold text-white mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            Lançamento da Carreira de Investigadores 2026/2027
          </h3>
          <p class="text-white text-lg leading-relaxed">
            Com o lançamento da <strong>Carreira de Investigadores do Ensino Superior</strong> previsto para 
            o ano académico 2026/2027, o ISP-Bié intensificará significativamente as suas atividades de investigação, 
            promovendo projetos científicos de qualidade e consolidando a instituição como centro de referência 
            em pesquisa aplicada na província do Bié.
          </p>
        </div>
      </div>

      <!-- Íreas de Investigação -->
      <div class="mb-12 scroll-reveal">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Íreas Prioritárias de Investigação</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Engenharias -->
          <div id="software" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Engenharias</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Desenvolvimento de software
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Sistemas de informação
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Infraestruturas tecnológicas
                </li>
              </ul>
            </div>
          </div>

          <!-- Recursos Hídricos -->
          <div id="hidricos" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Recursos Hídricos</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Gestão sustentável da água
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Saneamento básico
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Tratamento de efluentes
                </li>
              </ul>
            </div>
          </div>

          <!-- Ciências Sociais -->
          <div id="comunicacao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Ciências Sociais</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Desenvolvimento regional
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Extensão universitária e identidade
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Comunicação comunitária
                </li>
              </ul>
            </div>
          </div>

          <!-- Administração e Negócios -->
          <div id="inovacao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                  <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Administração e Negócios</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Gestão empresarial
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Empreendedorismo
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Desenvolvimento económico
                </li>
              </ul>
            </div>
          </div>

          <!-- Saúde Mental -->
          <div id="saude" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Saúde Mental</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Saúde comunitária
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Intervenções psicológicas
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Bem-estar psicológico
                </li>
              </ul>
            </div>
          </div>

          <!-- Inovação Educacional -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <h3 class="text-xl font-bold">Inovação Educacional</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Metodologias ativas
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Tecnologias educacionais
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Avaliação educacional
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Infraestrutura de Investigação -->
      <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-[#2563eb] rounded-full flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2563eb]">Laboratórios</h3>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Laboratórios equipados com tecnologia moderna para apoiar investigações nas áreas de 
            engenharia, informática, recursos hídricos e ciências da saúde, proporcionando aos 
            estudantes e investigadores um ambiente adequado para experimentação e desenvolvimento de projetos.
          </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-[#2563eb] rounded-full flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2563eb]">Biblioteca e Repositório</h3>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Acervo bibliográfico digital e físico com acesso a publicações científicas, revistas 
            especializadas e repositório institucional para preservação e disseminação da produção 
            académica do ISP-Bié, facilitando o acesso ao conhecimento.
          </p>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white p-8 rounded-lg text-center">
        <h3 class="text-2xl font-bold mb-4">Seja Parte da Nossa Comunidade de Investigação</h3>
        <p class="mb-6 text-lg opacity-90">
          O ISP-Bié convida docentes, estudantes e parceiros a colaborar em projetos de investigação 
          que contribuam para o desenvolvimento da província do Bié e de Angola.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <a href="/contactos" class="bg-[#3B82F6] text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-white transition-colors">
            Entre em Contacto
          </a>
          <a href="/revista" class="bg-white text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-[#3B82F6] transition-colors">
            Revista Científica
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->


@endsection

