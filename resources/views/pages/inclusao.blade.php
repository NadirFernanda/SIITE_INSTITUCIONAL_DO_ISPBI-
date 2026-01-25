@extends('layouts.site')


@section('hero')
  @include('partials.hero', [
    'title' => 'Inclusão e Pertencimento',
    'subtitle' => 'Instituto Superior Politécnico do Bié'
  ])
@endsection

@section('content')

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Compromisso com a Diversidade e Inclusão</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          O Instituto Superior Politécnico do Bié reconhece a diversidade como um valor fundamental 
          e promove um ambiente académico inclusivo, acolhedor e respeitoso para todos os membros da 
          comunidade universitária, independentemente de origem, género, condição social, deficiência 
          ou qualquer outra característica.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed">
          Trabalhamos para garantir que todos os estudantes, docentes e funcionários se sintam valorizados, 
          respeitados e parte integrante da família ISP-Bié, criando condições para o pleno desenvolvimento 
          do potencial de cada pessoa.
        </p>
      </div>

      <!-- Pilares da Inclusão -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Pilares da Inclusão</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Acessibilidade -->
          <div id="acessibilidade" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Acessibilidade</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Infraestruturas adaptadas
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Recursos pedagógicos inclusivos
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Tecnologias assistivas
                </li>
              </ul>
            </div>
          </div>

          <!-- Equidade de Género -->
          <div id="genero" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Equidade de Género</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Igualdade de oportunidades
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Combate Í  discriminação
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Empoderamento feminino
                </li>
              </ul>
            </div>
          </div>

          <!-- Apoio Estudantil -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Apoio Estudantil</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Apoio psicológico
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Apoio financeiro (bolsas)
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Orientação académica
                </li>
              </ul>
            </div>
          </div>

          <!-- Diversidade Cultural -->
          <div id="diversidade" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Diversidade Cultural</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Celebração da diversidade
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Intercâmbio cultural
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Respeito Í s tradições
                </li>
              </ul>
            </div>
          </div>

          <!-- Inclusão Socioeconómica -->
          <div id="bolsas" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Inclusão Socioeconómica</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Programas de bolsas
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Apoio alimentar
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Acesso a materiais didáticos
                </li>
              </ul>
            </div>
          </div>

          <!-- Saúde Mental -->
          <div id="apoio" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Saúde Mental</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Gabinete de apoio psicológico
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Grupos de apoio
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Campanhas de sensibilização
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Programas e Iniciativas -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Programas e Iniciativas</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
          
          <!-- Programa 1 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Programa de Tutoria</h3>
              <p class="text-gray-700 mb-4">
                Sistema de tutores que acompanham estudantes com necessidades especiais ou dificuldades de 
                adaptação, oferecendo suporte académico personalizado e facilitando a integração na vida universitária.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Programa Permanente
              </div>
            </div>
          </div>

          <!-- Programa 2 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Semana da Inclusão</h3>
              <p class="text-gray-700 mb-4">
                Evento anual dedicado Í  sensibilização sobre diversidade e inclusão, com palestras, 
                workshops, testemunhos e atividades que promovem a consciencialização e o respeito 
                pelas diferenças.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Evento Anual
              </div>
            </div>
          </div>

          <!-- Programa 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Espaços Seguros</h3>
              <p class="text-gray-700 mb-4">
                Ambientes acolhedores e seguros no campus onde estudantes podem partilhar experiências, 
                procurar apoio e encontrar comunidades de pessoas com vivências similares, promovendo 
                o sentimento de pertencimento.
              </p>
              <div class="flex items-center text-[#3B82F6] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Disponível Permanentemente
              </div>
            </div>
          </div>

          <!-- Programa 4 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#3B82F6] to-[#3B82F6] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Bolsas de Estudo</h3>
              <p class="text-gray-700 mb-4">
                Programa de bolsas destinado a estudantes de baixa renda, estudantes com deficiência 
                e grupos vulneráveis, garantindo acesso equitativo ao ensino superior de qualidade.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Candidaturas Anuais
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Código de Conduta -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Código de Conduta Inclusivo</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
          O ISP-Bié adota um código de conduta que promove o respeito, a dignidade e a não-discriminação 
          em todos os espaços universitários. Qualquer forma de assédio, bullying, discriminação ou 
          comportamento excludente é firmemente repudiada e sujeita a medidas disciplinares.
        </p>
        
        <div class="grid md:grid-cols-3 gap-6">
          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Respeito Mútuo</h4>
            <p class="text-gray-600 text-sm">Tratar todos com dignidade e consideração</p>
          </div>

          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Tolerância Zero</h4>
            <p class="text-gray-600 text-sm">Contra discriminação e assédio</p>
          </div>

          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Denúncia Segura</h4>
            <p class="text-gray-600 text-sm">Canais confidenciais de apoio</p>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] text-white p-8 rounded-lg text-center">
        <h3 class="text-2xl font-bold mb-4">Juntos Construímos um Campus Mais Inclusivo</h3>
        <p class="mb-6 text-lg opacity-90">
          O ISP-Bié valoriza cada membro da sua comunidade. Se necessitar de apoio ou tiver sugestões 
          para melhorar a inclusão no campus, entre em contacto connosco.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <a href="/contactos" class="bg-white text-[#3B82F6] px-8 py-3 rounded-full font-semibold hover:bg-[#3B82F6] hover:text-[#2563eb] transition-colors">
            Entre em Contacto
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->


@endsection

