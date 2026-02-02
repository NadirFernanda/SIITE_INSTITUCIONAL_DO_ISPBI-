@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Cultura e Extensão
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Cultura e Extensão</h1>
        <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      </div>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Extensão Universitária: Transformando Realidades</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
          O Instituto Superior Politécnico do Bié entende a extensão universitária como um compromisso estratégico para promover impacto social, cultural e econômico na província. Nossas ações vão além da sala de aula, conectando saber acadêmico a soluções inovadoras para desafios reais, sempre em diálogo com a comunidade e parceiros institucionais.
        </p>
      </div>

      <!-- Áreas de Atuação -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Áreas de Atuação</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Cultura e Identidade -->
          <div id="artes" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
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

          <!-- Apoio à Comunidade -->
          <div id="extensao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-4">
              <div class="flex items-center text-white">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                <h3 class="text-xl font-bold">Apoio à Comunidade</h3>
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
          <div id="eventos" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
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
          <div id="musica" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
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
          <div id="desporto" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
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
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
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


      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white p-8 rounded-lg text-center scroll-reveal">
        <h3 class="text-2xl font-bold mb-4">Participe das Nossas Atividades de Extensão</h3>
        <p class="mb-6 text-lg opacity-90">
          Junte-se à comunidade ISP-Bié e contribua para o desenvolvimento social e cultural da província do Bié.
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


      <!-- Plano de Extensão Universitária -->
      <section class="mt-16 bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Plano de Extensão Universitária</h2>
        <p class="text-lg text-gray-700 mb-4">
          O Plano de Extensão Universitária do ISP-Bié estrutura e direciona projetos e programas que promovem inclusão, desenvolvimento sustentável e formação cidadã. Ele prioriza a inovação social, a integração com o setor produtivo e a valorização das potencialidades locais, articulando ensino, pesquisa e extensão para resultados concretos na sociedade.
        </p>
        <ul class="list-disc pl-6 text-gray-700 space-y-2">
          <li>Atividades culturais e artísticas para fortalecer identidade regional.</li>
          <li>Projetos de educação ambiental, saúde e cidadania.</li>
          <li>Capacitação profissional e estímulo ao empreendedorismo.</li>
          <li>Redes colaborativas com escolas, ONGs e empresas.</li>
        </ul>
      </section>

      <!-- Projetos de Extensão Universitária em Curso -->
      <section class="mb-12">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Projetos de Extensão Universitária em Curso</h2>
        <div class="grid md:grid-cols-2 gap-8">
          <div class="bg-gray-50 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Cultura Viva Bié</h3>
            <p class="text-gray-700">Resgate e valorização das manifestações culturais e artísticas da província, com oficinas, exposições e festivais.</p>
          </div>
          <div class="bg-gray-50 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Educação para a Cidadania</h3>
            <p class="text-gray-700">Ações educativas em escolas públicas, promovendo direitos humanos, ética e participação social.</p>
          </div>
          <div class="bg-gray-50 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Saúde em Movimento</h3>
            <p class="text-gray-700">Campanhas de prevenção, atendimento básico e orientação em saúde para comunidades rurais.</p>
          </div>
          <div class="bg-gray-50 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Empreende Bié</h3>
            <p class="text-gray-700">Capacitação de jovens e mulheres para o empreendedorismo e geração de renda local.</p>
          </div>
        </div>
      </section>

      <!-- Parcerias -->
      <section class="mb-12">
        <h2 class="text-2xl font-bold text-[#2563eb] mb-4">Parcerias</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Secretaria Provincial de Cultura</h3>
            <p class="text-gray-700">Promoção conjunta de eventos culturais e apoio a projetos de valorização do patrimônio local.</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">ONGs e Associações Comunitárias</h3>
            <p class="text-gray-700">Desenvolvimento de ações sociais, ambientais e educacionais em parceria com organizações do terceiro setor.</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="font-semibold text-lg text-[#2563eb] mb-2">Empresas Locais</h3>
            <p class="text-gray-700">Fomento ao empreendedorismo, estágios e projetos de inovação em colaboração com o setor produtivo.</p>
          </div>
        </div>
      </section>

    </div>
  </section>

  <!-- Footer -->


@endsection

