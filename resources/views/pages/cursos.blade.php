@extends('layouts.site')


@section('hero')
    @include('partials.hero', [
        'title' => 'Cursos de Graduação',
        'subtitle' => 'Instituto Superior Politécnico do Bié'
    ])
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Cursos de Graduação
      </nav>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Estrutura Acadêmica ISPBIÉ -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Estrutura Acadêmica do ISPBIÉ</h2>
        <div class="grid md:grid-cols-3 gap-6">
          <a href="#engenharias" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform">
            <h3 class="text-xl font-bold mb-2 text-black">Engenharias e Inovação Tecnológica</h3>
            <p class="opacity-90 text-sm text-black">Formação de profissionais inovadores para atuar em áreas tecnológicas, engenharia, infraestrutura e transformação digital.</p>
          </a>
          <a href="#sociais" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform">
            <h3 class="text-xl font-bold mb-2 text-black">Ciências Sociais, Humanas e Económicas</h3>
            <p class="opacity-90 text-sm text-black">Gestão, comunicação, ciências humanas e sociais, preparando líderes e agentes de transformação social.</p>
          </a>
          <a href="#saude" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform">
            <h3 class="text-xl font-bold mb-2 text-black">Ciências da Saúde</h3>
            <p class="opacity-90 text-sm text-black">Promoção, prevenção e recuperação da saúde, com ênfase no cuidado humanizado e na gestão em saúde.</p>
          </a>
        </div>
      </div>
      
      <!-- Introdução -->
      <div class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Formação de Excelência</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
          O Instituto Superior Politécnico do Bié oferece cursos de graduação em seis domínios de formação, 
          distribuídos em cinco Departamentos de Ensino e Investigação, com foco na formação técnica, científica 
          e humanística de profissionais qualificados para atender Í s demandas do mercado de trabalho angolano.
        </p>
      </div>

      <!-- Departamentos -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Oferta Formativa por Departamento</h2>
        <!-- ...os cards de departamentos foram removidos conforme solicitado... -->
      </div>

      <!-- Cursos -->
      <!-- Engenharias e Inovação Tecnológica -->
      <h2 id="engenharias" class="text-2xl font-bold text-[#2563eb] mt-12 mb-4">Engenharias e Inovação Tecnológica</h2>
      <div class="space-y-8 mb-12">
        
        <!-- Contabilidade e Administração -->
        <div id="contabilidade" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
          <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white">Contabilidade e Administração</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold">4 Anos</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma profissionais capacitados para atuar nas áreas de contabilidade, gestão empresarial, auditoria, 
              finanças e administração, desenvolvendo competências para a tomada de decisões estratégicas em organizações 
              públicas e privadas.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                <ul class="space-y-1 text-gray-700">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Contabilidade e Auditoria
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Gestão Empresarial
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Consultoria Financeira
                  </li>
                </ul>
              </div>
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
                <p class="text-gray-700">Ciências Humanas, Sociais e Económicas</p>
                <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
                <p class="text-gray-700">Administração, Negócios e Direito</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Engenharia Informática -->
        <div id="informatica" class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
          <div class="p-6" style="background: linear-gradient(to right, #1d4ed8, #3b82f6) !important;">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white drop-shadow-[0_1px_2px_rgba(0,0,0,0.7)]">Engenharia Informática</h3>
                  <p class="text-white opacity-90 drop-shadow-[0_1px_2px_rgba(0,0,0,0.7)]">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold">5 Anos</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Prepara profissionais para desenvolver soluções tecnológicas inovadoras, sistemas de informação, aplicações 
              de software, redes de computadores e infraestrutura de TI, atendendo Í s demandas da transformação digital.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                <ul class="space-y-1 text-gray-700">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Desenvolvimento de Software
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Redes e Sistemas
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Segurança da Informação
                  </li>
                </ul>
              </div>
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
                <p class="text-gray-700">Engenharias</p>
                <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
                <p class="text-gray-700">Engenharias e Telecomunicações</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Engenharia em Recursos Hídricos -->
          </div>

          <!-- Ciências Sociais, Humanas e Económicas -->
          <h2 id="sociais" class="text-2xl font-bold text-[#2563eb] mt-12 mb-4">Ciências Sociais, Humanas e Económicas</h2>
          <div class="space-y-8 mb-12">
        <div id="hidricos" class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
          <div class="p-6" style="background: linear-gradient(to right, #38bdf8, #60a5fa) !important;">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white">Engenharia em Recursos Hídricos</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold">6 Anos</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma engenheiros especializados na gestão sustentável dos recursos hídricos, desenvolvimento de 
              infraestruturas hidráulicas, tratamento de água e saneamento básico, essenciais para o desenvolvimento regional.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                <ul class="space-y-1 text-gray-700">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Gestão de Recursos Hídricos
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Saneamento e Tratamento de Ígua
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Infraestruturas Hidráulicas
                  </li>
                </ul>
              </div>
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
                <p class="text-gray-700">Engenharias</p>
                <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
                <p class="text-gray-700">Engenharias e Telecomunicações</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Comunicação Social -->
        <div id="comunicacao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
          <div class="bg-gradient-to-r from-orange-500 to-orange-400 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white">Comunicação Social</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold">4 Anos</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Capacita profissionais para atuar nas áreas de jornalismo, relações públicas, publicidade, comunicação 
              organizacional e produção de conteúdo para meios de comunicação tradicionais e digitais.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                <ul class="space-y-1 text-gray-700">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Jornalismo e Produção de Conteúdo
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Relações Públicas
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Comunicação Digital
                  </li>
                </ul>
              </div>
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
                <p class="text-gray-700">Ciências Humanas, Sociais e Económicas</p>
                <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
                <p class="text-gray-700">Ciências Sociais, Jornalismo e Informação</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Psicologia Clínica -->
                  </div>

                  <!-- Ciências da Saúde -->
                  <h2 id="saude" class="text-2xl font-bold text-[#2563eb] mt-12 mb-4">Ciências da Saúde</h2>
                  <div class="space-y-8 mb-12">
                <!-- Enfermagem Geral -->
                  </div>
                <div id="enfermagem" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                  <div class="p-6" style="background: linear-gradient(to right, #22c55e, #4ade80) !important;">
                    <div class="flex items-center justify-between">
                      <div class="flex items-center space-x-4">
                        <div class="bg-white p-3 rounded-full">
                          <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-1a1 1 0 112 0v1zm-1-9a7 7 0 110 14A7 7 0 019 4.07V5a1 1 0 102 0v-.93A7 7 0 0110 4z" clip-rule="evenodd"/>
                          </svg>
                        </div>
                        <div>
                          <h3 class="text-2xl font-bold text-white">Enfermagem Geral</h3>
                          <p class="text-white opacity-90">Licenciatura</p>
                        </div>
                      </div>
                      <span class="bg-white text-[#22c55e] px-4 py-2 rounded-full font-semibold">5 Anos</span>
                    </div>
                  </div>
                  <div class="p-6">
                    <p class="text-gray-700 mb-4 leading-relaxed">
                      Forma profissionais aptos a atuar na promoção, prevenção, recuperação e reabilitação da saúde, em hospitais, clínicas e comunidades, com foco no cuidado humanizado e na gestão em saúde.
                    </p>
                    <div class="grid md:grid-cols-2 gap-4">
                      <div>
                        <h4 class="font-bold text-[#22c55e] mb-2">Áreas de Atuação:</h4>
                        <ul class="space-y-1 text-gray-700">
                          <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Enfermagem Hospitalar
                          </li>
                          <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Saúde Pública
                          </li>
                          <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Gestão em Saúde
                          </li>
                        </ul>
                      </div>
                      <div>
                        <h4 class="font-bold text-[#22c55e] mb-2">Departamento:</h4>
                        <p class="text-gray-700">Ciências da Saúde</p>
                        <h4 class="font-bold text-[#22c55e] mt-3 mb-2">Domínio:</h4>
                        <p class="text-gray-700">Ciências Médicas e da Saúde</p>
                      </div>
                    </div>
                  </div>
                </div>
        <div id="psicologia" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
          <div class="bg-gradient-to-r from-red-600 to-red-400 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white">Psicologia Clínica</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#3B82F6] px-4 py-2 rounded-full font-semibold">5 Anos</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma psicólogos aptos a atuar na promoção da saúde mental, diagnóstico, intervenção terapêutica e 
              acompanhamento psicológico em diversos contextos, contribuindo para o bem-estar individual e coletivo.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                <ul class="space-y-1 text-gray-700">
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Psicologia Clínica
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Saúde Mental Comunitária
                  </li>
                  <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Psicoterapia
                  </li>
                </ul>
              </div>
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
                <p class="text-gray-700">Ciências da Saúde</p>
                <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
                <p class="text-gray-700">Ciências Médicas e da Saúde</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Informações Adicionais -->
      <div class="mt-12 bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white p-8 rounded-lg">
        <h3 class="text-2xl font-bold mb-4 text-white">Informações sobre Candidaturas</h3>
        <div class="grid md:grid-cols-3 gap-6">
          <div>
            <h4 class="font-bold text-lg mb-2 text-white">Requisitos de Acesso</h4>
            <p class="text-sm text-white">Conclusão do ensino médio ou equivalente com certificação válida.</p>
          </div>
          <div>
            <h4 class="font-bold text-lg mb-2 text-white">Processo de Candidatura</h4>
            <p class="text-sm text-white">Inscrições online através do portal do estudante durante o período de candidaturas.</p>
          </div>
          <div>
            <h4 class="font-bold text-lg mb-2 text-white">Mais Informações</h4>
            <a href="/candidaturas" class="inline-block bg-[#FFD700] text-[#1e293b] px-6 py-2 rounded-full font-semibold hover:bg-white hover:text-[#2563eb] transition-colors">
              Candidatar-se
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection

