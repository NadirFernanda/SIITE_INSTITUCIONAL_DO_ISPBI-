@extends('layouts.site')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-reveal">
    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
      <nav class="text-sm opacity-75 mb-6 text-left">
        <a href="/" class="hover:underline">Início</a> \ Cursos de Graduação
      </nav>
      <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Cursos de Graduação</h1>
      <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      <p class="text-gray-600 max-w-2xl mt-3">Conheça a oferta formativa de graduação do ISP-Bié, organizada por áreas de conhecimento e alinhada às necessidades de desenvolvimento da região e do país.</p>
    </div>
    <section class="mb-16 scroll-reveal">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Estrutura Acadêmica ISPBIÉ -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
          <h2 class="text-3xl font-bold text-[#2563eb] mb-2">Estrutura Acadêmica do ISPBIÉ</h2>
          <p class="text-lg text-gray-700 mb-4 max-w-2xl">Os cursos estão organizados em grandes áreas – engenharias e inovação, ciências sociais e ciências da saúde – facilitando a navegação pelos interesses de cada candidato.</p>
          <div class="grid md:grid-cols-3 gap-6">
            <a href="#engenharias" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform interactive-card">
              <h3 class="text-xl font-bold mb-2 text-white">Engenharias e Inovação Tecnológica</h3>
              <p class="text-sm text-white">Formação de profissionais inovadores para atuar em áreas tecnológicas, engenharia, infraestrutura e transformação digital.</p>
            </a>
            <a href="#sociais" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform interactive-card">
              <h3 class="text-xl font-bold mb-2 text-white">Ciências Sociais, Humanas e Económicas</h3>
              <p class="text-sm text-white">Gestão, comunicação, ciências humanas e sociais, preparando líderes e agentes de transformação social.</p>
            </a>
            <a href="#saude" class="block rounded-lg border bg-gradient-to-r from-blue-700 to-blue-400 p-6 hover:scale-105 transition-transform interactive-card">
              <h3 class="text-xl font-bold mb-2 text-white">Ciências da Saúde</h3>
              <p class="text-sm text-white">Promoção, prevenção e recuperação da saúde, com ênfase no cuidado humanizado e na gestão em saúde.</p>
            </a>
          </div>
        </div>

        <!-- Introdução -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
          <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Formação de Excelência</h2>
          <p class="text-lg text-gray-700 leading-relaxed">
            O Instituto Superior Politécnico do Bié (ISP-Bié) é uma instituição de ensino superior pública, superintendida pelo Ministério do Ensino Superior, Ciência, Tecnologia e Inovação. Foi criado à luz da reorganização da rede de instituições de ensino superior, nos termos da alínea a) do artigo 18º do Decreto Órgãos de gestão nº 285/20 de 29 de outubro, e localiza-se na Rua Padre Fidalgo, entre Artur de Paiva e Francisco de Leite Cardoso, s/n, na cidade do Cuito/Bié, com o número de identificação fiscal 5000308765. Ministra atualmente seis (6) cursos de graduação em seis domínios de formação: Humanidades e Artes; Ciências Sociais, Jornalismo e Informação; Administração, Negócios e Direito; Ciências Médicas e da Saúde; Engenharias e Inovação Tecnológica; Ciências Humanas, Sociais e Económicas; e Ciências da Saúde.
          </p>
        </div>

        <!-- Departamentos -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
          <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Oferta Formativa por Departamento</h2>
          <!-- ...os cards de departamentos foram removidos conforme solicitado... -->
        </div>

        <!-- Cursos -->
        <!-- Engenharias e Inovação Tecnológica -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
          <h2 id="engenharias" class="text-2xl font-bold text-[#2563eb] mt-0 mb-4">Engenharias e Inovação Tecnológica</h2>
          <div class="space-y-8">
        
        <!-- Contabilidade e Administração -->
        <div id="contabilidade" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
          <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 p-6 w-full max-w-full overflow-x-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg md:text-2xl font-bold text-white">Contabilidade e Administração</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold w-max md:ml-4">4 Anos</span>
            </div>
          </div>
          <div class="bg-white p-6 w-full max-w-full overflow-x-hidden">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma profissionais capacitados para atuar nas áreas de contabilidade, gestão empresarial, auditoria, 
              finanças e administração, desenvolvendo competências para a tomada de decisões estratégicas em organizações 
              públicas e privadas.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Áreas de Atuação:</h4>
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
        </div>
      </section>
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
        <div id="informatica" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
          <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 w-full max-w-full overflow-x-hidden">
            <div class="flex items-center space-x-4">
              <div class="bg-white p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg md:text-2xl font-bold text-white">Engenharia Informática</h3>
                <p class="text-white opacity-90">Licenciatura</p>
              </div>
              <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold w-max ml-auto">5 Anos</span>
            </div>
          </div>
          <div class="bg-white p-6 w-full max-w-full overflow-x-hidden">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Prepara profissionais para desenvolver soluções tecnológicas inovadoras, sistemas de informação, aplicações 
              de software, redes de computadores e infraestrutura de TI, atendendo às demandas da transformação digital.
            </p>
            <h4 class="font-bold text-[#2563eb] mb-2">Áreas de Atuação:</h4>
            <ul class="space-y-1 text-gray-700 mb-4">
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
            <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
            <p class="text-gray-700">Engenharias</p>
            <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
            <p class="text-gray-700">Engenharias e Telecomunicações</p>
          </div>
        </div>

        <!-- Engenharia em Recursos Hídricos -->
          </div>

          <!-- Ciências Sociais, Humanas e Económicas -->
          <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
            <h2 id="sociais" class="text-2xl font-bold text-[#2563eb] mt-0 mb-4">Ciências Sociais, Humanas e Económicas</h2>
            <div class="space-y-8">
        <div id="administracao" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
          <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 w-full max-w-full overflow-x-hidden">
            <div class="flex items-center space-x-4">
              <div class="bg-white p-3 rounded-full">
                <svg class="w-8 h-8 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6v2a6 6 0 0012 0V8a6 6 0 00-6-6zm3 8a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg md:text-2xl font-bold text-white">Administração</h3>
                <p class="text-white opacity-90">Licenciatura</p>
              </div>
              <span class="bg-white text-[#15803d] px-4 py-2 rounded-full font-semibold w-max ml-auto">4 Anos</span>
            </div>
          </div>
          <div class="bg-white p-6 w-full max-w-full overflow-x-hidden">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma profissionais para atuar na gestão de organizações, planejamento estratégico, finanças, marketing, recursos humanos e empreendedorismo, promovendo inovação e eficiência.
            </p>
            <h4 class="font-bold text-[#15803d] mb-2">Áreas de Atuação:</h4>
            <ul class="space-y-1 text-gray-700 mb-4">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Gestão Empresarial
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Finanças e Controladoria
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-[#22c55e] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Marketing e Vendas
              </li>
            </ul>
            <h4 class="font-bold text-[#15803d] mb-2">Departamento:</h4>
            <p class="text-gray-700">Ciências Sociais Aplicadas</p>
            <h4 class="font-bold text-[#15803d] mt-3 mb-2">Domínio:</h4>
            <p class="text-gray-700">Gestão e Negócios</p>
          </div>
        </div>
        </div>

        <!-- Comunicação Social -->
        <div id="comunicacao" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
                  <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 w-full max-w-full overflow-x-hidden">
                    <div class="flex items-center space-x-4">
                      <div class="bg-white p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-1a1 1 0 112 0v1zm-1-9a7 7 0 110 14A7 7 0 019 4.07V5a1 1 0 102 0v-.93A7 7 0 0110 4z" clip-rule="evenodd"/>
                        </svg>
                      </div>
                      <div>
                        <h3 class="text-lg md:text-2xl font-bold text-white">Enfermagem Geral</h3>
                        <p class="text-white opacity-90">Licenciatura</p>
                      </div>
                      <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold w-max ml-auto">5 Anos</span>
              Capacita profissionais para atuar nas áreas de jornalismo, relações públicas, publicidade, comunicação 
              organizacional e produção de conteúdo para meios de comunicação tradicionais e digitais.
            </p>
            <h4 class="font-bold text-[#2563eb] mb-2">Áreas de Atuação:</h4>
            <ul class="space-y-1 text-gray-700 mb-4">
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
            <h4 class="font-bold text-[#2563eb] mb-2">Departamento:</h4>
            <p class="text-gray-700">Ciências Humanas, Sociais e Económicas</p>
            <h4 class="font-bold text-[#2563eb] mt-3 mb-2">Domínio:</h4>
            <p class="text-gray-700">Ciências Sociais, Jornalismo e Informação</p>
          </div>
        </div>

        <!-- Psicologia Clínica -->
                  </div>

                  <!-- Ciências da Saúde -->
                  <div class="bg-white rounded-lg shadow-md p-8 mb-12 interactive-card">
                    <h2 id="saude" class="text-2xl font-bold text-[#2563eb] mt-0 mb-4">Ciências da Saúde</h2>
                    <div class="space-y-8">
                <!-- Enfermagem Geral -->
                  </div>
                <div id="enfermagem" class="rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
                  <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 w-full max-w-full overflow-x-hidden" style="background: linear-gradient(to right, #22c55e, #4ade80) !important;">
                    <div class="flex items-center justify-between">
                      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                      <div class="flex items-center space-x-4">
                        <div class="bg-white p-3 rounded-full">
                          <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-1a1 1 0 112 0v1zm-1-9a7 7 0 110 14A7 7 0 019 4.07V5a1 1 0 102 0v-.93A7 7 0 0110 4z" clip-rule="evenodd"/>
                          </svg>
                        </div>
                        <div>
                          <h3 class="text-lg md:text-2xl font-bold text-white">Enfermagem Geral</h3>
                          <p class="text-white opacity-90">Licenciatura</p>
                        </div>
                      </div>
                        <span class="bg-white text-[#2563eb] px-4 py-2 rounded-full font-semibold w-max md:ml-4">5 Anos</span>
                    </div>
                  </div>
                  <div class="bg-white p-6 w-full max-w-full overflow-x-hidden">
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
              <div class="mb-8"></div>
              <div id="psicologia" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow w-full max-w-full interactive-card">
          <div class="bg-gradient-to-r from-red-600 to-red-400 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
              <div class="flex items-center space-x-4">
                <div class="bg-white p-3 rounded-full">
                  <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg md:text-2xl font-bold text-white">Psicologia Clínica</h3>
                  <p class="text-white opacity-90">Licenciatura</p>
                </div>
              </div>
              <span class="bg-white text-[#3B82F6] px-4 py-2 rounded-full font-semibold w-max md:ml-4">5 Anos</span>
            </div>
          </div>
          <div class="p-6 w-full max-w-full overflow-x-hidden">
            <p class="text-gray-700 mb-4 leading-relaxed">
              Forma psicólogos aptos a atuar na promoção da saúde mental, diagnóstico, intervenção terapêutica e 
              acompanhamento psicológico em diversos contextos, contribuindo para o bem-estar individual e coletivo.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h4 class="font-bold text-[#2563eb] mb-2">Íreas de Atuação:</h4>
                  <h4 class="font-bold text-[#2563eb] mb-2">Áreas de Atuação:</h4>
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


      <!-- Divisor visual forte entre seções -->
      <div class="flex justify-center items-center" style="margin-top:7rem; margin-bottom:7rem;">
        <div class="w-full max-w-2xl border-t-8 border-dashed border-[#FFD700] opacity-90"></div>
      </div>
      <!-- Cursos Acreditados - Moderno e Criativo -->
      <section class="mt-16 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-10 rounded-2xl shadow-xl text-white">
        <h2 class="text-3xl font-extrabold mb-6 text-center drop-shadow-lg">Acreditação dos Cursos</h2>
        <p class="text-lg mb-10 text-center opacity-90">Durante a fase de avaliação externa, ocorrida de Junho de 2023 à Junho de 2025, no ISP-Bié foram avaliados 5 cursos de graduação tendo obtido as seguintes percentagens:</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-4xl mx-auto">
          <div class="rounded-xl p-6 flex flex-col items-center shadow-lg hover:scale-105 transition-transform bg-gradient-to-b from-white/10 to-white/0 border border-white/20">
            <span class="text-5xl font-bold text-yellow-200 mb-2 drop-shadow">65,94%</span>
            <span class="text-xl font-semibold text-white">Enfermagem</span>
          </div>
          <div class="rounded-xl p-6 flex flex-col items-center shadow-lg hover:scale-105 transition-transform bg-gradient-to-b from-white/10 to-white/0 border border-white/20">
            <span class="text-5xl font-bold text-pink-200 mb-2 drop-shadow">67,8%</span>
            <span class="text-xl font-semibold text-white">Psicologia</span>
          </div>
          <div class="rounded-xl p-6 flex flex-col items-center shadow-lg hover:scale-105 transition-transform bg-gradient-to-b from-white/10 to-white/0 border border-white/20">
            <span class="text-5xl font-bold text-green-200 mb-2 drop-shadow">68,60%</span>
            <span class="text-xl font-semibold text-white">Engenharia Informática</span>
          </div>
          <div class="rounded-xl p-6 flex flex-col items-center shadow-lg hover:scale-105 transition-transform bg-gradient-to-b from-white/10 to-white/0 border border-white/20">
            <span class="text-5xl font-bold text-blue-200 mb-2 drop-shadow">73,63%</span>
            <span class="text-xl font-semibold text-white">Comunicação Social</span>
          </div>
          <div class="rounded-xl p-6 flex flex-col items-center shadow-lg hover:scale-105 transition-transform bg-gradient-to-b from-white/10 to-white/0 border border-white/20">
            <span class="text-5xl font-bold text-purple-200 mb-2 drop-shadow">73,23%</span>
            <span class="text-xl font-semibold text-white">Contabilidade</span>
          </div>
        </div>
        <p class="mt-10 text-center text-white text-opacity-80 text-base">Esses resultados refletem o compromisso do ISP-Bié com a qualidade, inovação e excelência no ensino superior.</p>
      </section>
    </div>
  </section>

@endsection

