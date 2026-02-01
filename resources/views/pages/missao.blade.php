@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Missão
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Missão</h1>
        <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      </div>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Missão -->
        <div class="lg:col-span-3">
          <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Missão do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-[#2563eb] font-semibold mb-6 leading-relaxed">
                Desenvolver actividades de formação acadêmica e profissional de excelência, da investigação científica e da extensão universitária nas áreas de Engenharias, tecnologias, Ciências Sociais, Administração e Negócios.
              </p>
              
              <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 p-6 rounded-lg">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    Formação de Excelência
                  </h3>
                  <p class="text-gray-700">
                    Proporcionar uma formação técnica, científica e humanística de qualidade superior, preparando profissionais competentes e éticos para os desafios do mercado de trabalho angolano e internacional.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#3B82F6]/10 p-6 rounded-lg">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                      <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                    Investigação Aplicada
                  </h3>
                  <p class="text-gray-700">
                    Desenvolver pesquisas científicas e tecnológicas relevantes que contribuam para a resolução de problemas locais e nacionais, promovendo a inovação e o desenvolvimento sustentável da região do Bié.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    Extensão Universitária
                  </h3>
                  <p class="text-gray-700">
                    Promover ações de extensão universitária que aproximem a instituição da comunidade, difundindo conhecimento, cultura e arte, contribuindo para a transformação social e o desenvolvimento cultural da província.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    Responsabilidade Social
                  </h3>
                  <p class="text-gray-700">
                    Formar cidadãos conscientes, críticos e comprometidos com os valores éticos, a justiça social, a inclusão e o respeito Í  diversidade, capazes de contribuir ativamente para a construção de uma sociedade mais justa e equitativa.
                  </p>
                </div>
              </div>

              <div class="mt-8 p-6 bg-[#2563eb] text-white rounded-lg">
                <h3 class="font-bold text-xl mb-4 text-[#3B82F6]">Compromisso Institucional</h3>
                <p class="leading-relaxed">
                  O Instituto Superior Politécnico do Bié compromete-se a cumprir sua missão através de práticas pedagógicas inovadoras, 
                  investimento contínuo na qualificação do corpo docente, infraestrutura adequada, parcerias estratégicas nacionais e 
                  internacionais, e uma gestão transparente e participativa que coloca o estudante no centro do processo educativo.
                </p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <!-- Footer -->


@endsection

