@extends('layouts.site')


@section('hero')
    @include('partials.hero', [
        'title' => 'Cultura e Extensão',
        'subtitle' => 'Instituto Superior Politécnico do Bié'
    ])
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Cultura e Extensão
      </nav>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Compromisso com a Comunidade</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          A extensão universitária do Instituto Superior Politécnico do Bié representa a ponte entre 
          o conhecimento académico e as necessidades da comunidade, promovendo a transformação social 
          através de ações culturais, educativas e de desenvolvimento comunitário.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed">
          Valorizamos a cultura local, preservamos as tradições do Bié e incentivamos a participação 
          activa dos estudantes e docentes em projetos que beneficiem directamente a população da província.
        </p>
      </div>

      <!-- Íreas de Actuação -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Íreas de Actuação</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Cultura e Identidade -->
          <div id="artes" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Cultura e Identidade</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Preservação cultural do Bié
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Valorização das tradições
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Festivais e eventos culturais
                </li>
              </ul>
            </div>
          </div>

          <!-- Apoio Í  Comunidade -->
          <div id="extensao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Apoio Í  Comunidade</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Programas sociais
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Ações de solidariedade
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Desenvolvimento comunitário
                </li>
              </ul>
            </div>
          </div>

          <!-- Educação Popular -->
          <div id="eventos" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <h3 class="text-xl font-bold">Educação Popular</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Cursos de formação
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Workshops comunitários
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Capacitação profissional
                </li>
              </ul>
            </div>
          </div>

          <!-- Artes e Espetáculos -->
          <div id="musica" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                </svg>
                <h3 class="text-xl font-bold">Artes e Espetáculos</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Teatro universitário
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Grupos musicais
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Exposições artísticas
                </li>
              </ul>
            </div>
          </div>

          <!-- Desporto e Saúde -->
          <div id="desporto" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-bold">Desporto e Saúde</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Atividades desportivas
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Campanhas de saúde
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Promoção do bem-estar
                </li>
              </ul>
            </div>
          </div>

          <!-- Meio Ambiente -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"/>
                  <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                </svg>
                <h3 class="text-xl font-bold">Meio Ambiente</h3>
              </div>
            </div>
            <div class="p-6">
              <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Educação ambiental
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Sustentabilidade
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Preservação ecológica
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Projetos em Destaque -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Projetos em Destaque</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
          
          <!-- Projeto 1 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Alfabetização Comunitária</h3>
              <p class="text-gray-700 mb-4">
                Programa de alfabetização de adultos nas comunidades periféricas do Cuito, oferecendo 
                educação básica e competências de leitura e escrita para cidadãos que não tiveram acesso 
                Í  educação formal.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Projeto Permanente
              </div>
            </div>
          </div>

          <!-- Projeto 2 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Festival Cultural do Bié</h3>
              <p class="text-gray-700 mb-4">
                Evento anual que celebra a cultura, tradições e arte do Bié, reunindo comunidades, 
                artistas locais, grupos de dança tradicionais e exposições culturais que valorizam a 
                identidade da província.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Evento Anual
              </div>
            </div>
          </div>

          <!-- Projeto 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Saúde para Todos</h3>
              <p class="text-gray-700 mb-4">
                Campanhas de saúde preventiva, rastreios médicos gratuitos e ações de sensibilização 
                sobre doenças comuns, realizadas em parceria com o curso de Psicologia Clínica e 
                instituições de saúde locais.
              </p>
              <div class="flex items-center text-[#3B82F6] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Trimestral
              </div>
            </div>
          </div>

          <!-- Projeto 4 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 bg-gradient-to-br from-[#3B82F6] to-[#3B82F6] flex items-center justify-center">
              <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-[#2563eb] mb-3">Tecnologia e Inclusão Digital</h3>
              <p class="text-gray-700 mb-4">
                Formação básica em informática e literacia digital para jovens e adultos da comunidade, 
                promovendo a inclusão digital e capacitando cidadãos para o mercado de trabalho tecnológico.
              </p>
              <div class="flex items-center text-[#2563eb] font-semibold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Mensal
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Participação Estudantil -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Participação Estudantil</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
          Os estudantes do ISP-Bié são incentivados a participar activamente nos programas de extensão, 
          aplicando os conhecimentos adquiridos em sala de aula na resolução de problemas reais da comunidade. 
          Esta experiência prática enriquece a formação académica e desenvolve competências de cidadania e 
          responsabilidade social.
        </p>
        
        <div class="grid md:grid-cols-3 gap-6">
          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Voluntariado</h4>
            <p class="text-gray-600 text-sm">Oportunidades de serviço comunitário</p>
          </div>

          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Estágios</h4>
            <p class="text-gray-600 text-sm">Experiência prática na comunidade</p>
          </div>

          <div class="text-center p-4">
            <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h4 class="font-bold text-[#2563eb] mb-2">Projetos</h4>
            <p class="text-gray-600 text-sm">Desenvolvimento de soluções locais</p>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white p-8 rounded-lg text-center">
        <h3 class="text-2xl font-bold mb-4">Participe das Nossas Atividades de Extensão</h3>
        <p class="mb-6 text-lg opacity-90">
          Junte-se Í  comunidade ISP-Bié e contribua para o desenvolvimento social e cultural da província do Bié.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <a href="/contactos" class="bg-white text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-[#2563eb] hover:text-white transition-colors">
            Entre em Contacto
          </a>
          <a href="/eventos" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-[#2563eb] transition-colors">
            Próximos Eventos
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->


@endsection

