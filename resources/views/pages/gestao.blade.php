@extends('layouts.site')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
    <nav class="text-sm opacity-75 mb-8">
      <a href="/" class="hover:underline">Início</a> \ Gestão e Governança
    </nav>

    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
      <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Gestão e Governança</h1>
      <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      <p class="mt-3 text-gray-600 max-w-2xl">Conheça a estrutura de gestão, os órgãos de decisão e os princípios de governança que garantem transparência, qualidade e responsabilidade institucional no ISP-Bié.</p>
    </div>
  </div>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12 interactive-card">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Estrutura de Governança</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          O Instituto Superior Politécnico do Bié adota uma estrutura de governança baseada em 
          princípios de transparência, participação democrática e eficiência administrativa, 
          garantindo a qualidade do ensino, pesquisa e extensão universitária.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed">
          A gestão institucional está organizada em órgãos colegiados e executivos que trabalham 
          de forma articulada para assegurar o cumprimento da missão e visão do ISP-Bié.
        </p>
      </div>

      <!-- Órgãos de Governança -->
      <div class="mb-12 scroll-reveal">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Órgãos de Governança</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Conselho Superior -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                </svg>
                <h3 class="text-xl font-bold">Conselho Superior</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-gray-700 mb-4">
                Órgão máximo de deliberação e orientação estratégica do Instituto, responsável 
                pela definição de políticas institucionais e aprovação de planos estratégicos.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Definição de políticas institucionais
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Aprovação de planos estratégicos
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Fiscalização da gestão
                </li>
              </ul>
            </div>
          </div>

          <!-- Conselho Científico -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <h3 class="text-xl font-bold">Conselho Científico</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-gray-700 mb-4">
                Responsável pela orientação e supervisão das atividades académicas, científicas 
                e pedagógicas, garantindo a qualidade do ensino e da pesquisa.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Aprovação de cursos e programas
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Avaliação da qualidade académica
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Promoção da investigação
                </li>
              </ul>
            </div>
          </div>

          <!-- Conselho Pedagógico -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
                <h3 class="text-xl font-bold">Conselho Pedagógico</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-gray-700 mb-4">
                Órgão consultivo que acompanha e avalia as atividades pedagógicas, propondo 
                melhorias nos processos de ensino-aprendizagem.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Avaliação do desempenho docente
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Melhoria de metodologias
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Apoio aos estudantes
                </li>
              </ul>
            </div>
          </div>

          <!-- Órgãos de gestão -->
          <!-- Organograma Institucional -->
          <div class="bg-white rounded-lg shadow-md p-8 mb-8 interactive-card">
            <h3 class="text-2xl font-bold text-[#2563eb] mb-6 text-center">Organograma Institucional</h3>
            <div class="flex flex-col items-center">
              <!-- Top Level -->
              <div class="flex flex-col items-center mb-8">
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                  <img src="/images/placeholder-profile.png" alt="Fernando Maia" class="object-cover w-full h-full" />
                </div>
                <div class="text-center">
                  <span class="block font-bold text-lg text-[#2563eb]">Presidente</span>
                  <span class="block text-gray-700">Fernando Maia</span>
                </div>
              </div>
              <!-- Conselho Geral -->
              <div class="flex flex-col items-center mb-8">
                <span class="block font-bold text-[#2563eb]">Conselho Geral</span>
              </div>
              <!-- Vice-Presidentes -->
              <div class="flex flex-wrap justify-center gap-8 mb-8">
                <div class="flex flex-col items-center">
                  <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="/images/placeholder-profile.png" alt="Gervásio Mendes Caluengue" class="object-cover w-full h-full" />
                  </div>
                  <span class="block font-bold text-[#2563eb] text-sm">Vice-Presidente Assuntos Académicos</span>
                  <span class="block text-gray-700 text-sm">Gervásio Mendes Caluengue</span>
                </div>
                <div class="flex flex-col items-center">
                  <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="/images/placeholder-profile.png" alt="Vice Científico" class="object-cover w-full h-full" />
                  </div>
                  <span class="block font-bold text-[#2563eb] text-sm">Vice-Presidente Assuntos Científicos e Pós-graduação</span>
                  <span class="block text-gray-700 text-sm">(Nome)</span>
                </div>
              </div>
              <!-- Conselhos -->
              <div class="flex flex-wrap justify-center gap-8 mb-8">
                <div class="flex flex-col items-center">
                  <span class="block font-bold text-[#2563eb]">Conselho de Direção</span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="block font-bold text-[#2563eb]">Conselho Científico</span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="block font-bold text-[#2563eb]">Conselho Pedagógico</span>
                </div>
              </div>
              <!-- Departamentos e Serviços -->
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
                <!-- Example Department -->
                <div class="flex flex-col items-center">
                  <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="/images/placeholder-profile.png" alt="Ernesto Muhongo" class="object-cover w-full h-full" />
                  </div>
                  <span class="block font-bold text-[#2563eb] text-sm">Departamento dos Assuntos Académicos</span>
                  <span class="block text-gray-700 text-sm">Ernesto Muhongo</span>
                </div>
                <div class="flex flex-col items-center">
                  <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="/images/placeholder-profile.png" alt="Zanilda Gonga" class="object-cover w-full h-full" />
                  </div>
                  <span class="block font-bold text-[#2563eb] text-sm">Departamento de Investigação Científica, Inovação...</span>
                  <span class="block text-gray-700 text-sm">Zanilda Gonga</span>
                </div>
                <div class="flex flex-col items-center">
                  <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="/images/placeholder-profile.png" alt="Neusa Eduardo" class="object-cover w-full h-full" />
                  </div>
                  <span class="block font-bold text-[#2563eb] text-sm">Departamento de Apoio à Direção Geral</span>
                  <span class="block text-gray-700 text-sm">Neusa Eduardo</span>
                </div>
                <!-- Add more departments/services as needed, following the organogram -->
              </div>
              <!-- Add more sections for Secretaria, Recursos Humanos, Jurídico, etc. as per the organogram -->
            </div>
          </div>

          <!-- Vice-Órgãos de gestão -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Vice-Órgãos de gestão</h3>
              </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-4">
                  Órgãos executivos que auxiliam o Presidente em áreas específicas da gestão 
                  institucional, garantindo eficiência e especialização.
                </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Vice-Órgãos de gestão Académica
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Vice-Órgãos de gestão Científica
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Vice-Órgãos de gestão Administrativa
                </li>
              </ul>
            </div>
          </div>

          <!-- Departamentos -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Departamentos</h3>
              </div>
            </div>
            <div class="p-6">
              <p class="text-gray-700 mb-4">
                Unidades académicas responsáveis pela organização e gestão das atividades 
                de ensino, pesquisa e extensão nas suas áreas específicas.
              </p>
              <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  5 Departamentos Académicos
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Coordenação de cursos
                </li>
                <li class="flex items-start">
                  <svg class="w-4 h-4 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Gestão de docentes
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Estrutura Administrativa -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Estrutura Administrativa</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
          
          <!-- Departamentos Administrativos -->
          <div class="bg-white rounded-lg shadow-md p-6 interactive-card">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-[#2563eb] rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-[#2563eb]">Serviços Administrativos</h3>
            </div>
            <ul class="space-y-3 text-gray-700">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Departamento de Recursos Humanos
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Departamento Financeiro e Contabilidade
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Serviços Académicos e Registo
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Gabinete de Comunicação e Imagem
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Tecnologias de Informação
              </li>
            </ul>
          </div>

          <!-- Unidades de Apoio -->
          <div class="bg-white rounded-lg shadow-md p-6 interactive-card">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-[#2563eb] rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-[#2563eb]">Unidades de Apoio</h3>
            </div>
            <ul class="space-y-3 text-gray-700">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Biblioteca Central
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Gabinete de Apoio ao Estudante
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Centro de Investigação e Inovação
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Gabinete de Relações Internacionais
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Ouvidoria
              </li>
            </ul>
          </div>

        </div>
      </div>

      <!-- Princípios de Governança -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Princípios de Governança</h2>
        
        <div class="grid md:grid-cols-4 gap-6">
          <div class="text-center">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Transparência</h4>
            <p class="text-gray-600 text-sm">Prestação de contas e acesso Í  informação</p>
          </div>

          <div class="text-center">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Participação</h4>
            <p class="text-gray-600 text-sm">Envolvimento da comunidade académica</p>
          </div>

          <div class="text-center">
            <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Qualidade</h4>
            <p class="text-gray-600 text-sm">Excelência em todas as atividades</p>
          </div>

          <div class="text-center">
            <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Í‰tica</h4>
            <p class="text-gray-600 text-sm">Integridade e responsabilidade</p>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white p-8 rounded-lg text-center interactive-card">
        <h3 class="text-2xl font-bold mb-4">Conheça Mais Sobre Nossa Gestão</h3>
        <p class="mb-6 text-lg opacity-90">
          Para mais informações sobre a estrutura de governança, documentos institucionais ou 
          para contactar os órgãos de gestão, utilize os nossos canais oficiais.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <a href="/contactos" class="bg-white text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-[#3B82F6] transition-colors">
            Entre em Contacto
          </a>
          <a href="/transparencia" class="bg-[#3B82F6] text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-white transition-colors">
            Transparência
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->


@endsection

