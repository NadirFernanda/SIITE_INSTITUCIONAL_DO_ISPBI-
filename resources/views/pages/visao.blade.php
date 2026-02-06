@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Visão
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Visão</h1>
        <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
        <p class="mt-3 text-gray-600 max-w-2xl">Uma visão de futuro que posiciona o ISP-Bié como referência em formação superior, produção científica e impacto social.</p>
      </div>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Visão -->
        <div class="lg:col-span-3">
          <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Visão do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-black mb-6 leading-relaxed">
                Em 10 anos, o Instituto Superior Politécnico do Bié deverá ser reconhecido como uma instituição de referência e excelência na formação académica, produção científica e resolução de problemas sociais na província do Bié.
              </p>
              
              <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div id="excelencia-academica" class="bg-gradient-to-br from-[#2563eb]/10 to-[#3B82F6]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Excelência Académica
                  </h3>
                  <p class="text-gray-700">
                    Consolidar-se como uma instituição de referência nacional em formação superior, com programas académicos de alta qualidade, corpo docente qualificado e infraestrutura moderna que proporcione experiências de aprendizagem transformadoras.
                  </p>
                </div>

                <div id="reconhecimento-internacional" class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                    Reconhecimento Internacional
                  </h3>
                  <p class="text-gray-700">
                    Estabelecer parcerias estratégicas com instituições de ensino superior internacionais, promovendo intercâmbios académicos, pesquisas colaborativas e mobilidade estudantil que ampliem os horizontes da comunidade académica.
                  </p>
                </div>

                <div id="pesquisa-inovacao" class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                    </svg>
                    Pesquisa e Inovação
                  </h3>
                  <p class="text-gray-700">
                    Tornar-se um polo de produção científica e inovação tecnológica na região, desenvolvendo pesquisas aplicadas que gerem soluções para os desafios do desenvolvimento sustentável e contribuam para o avanço do conhecimento.
                  </p>
                </div>

                <div id="diversidade-inclusao" class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                      <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                    </svg>
                    Diversidade e Inclusão
                  </h3>
                  <p class="text-gray-700">
                    Promover um ambiente académico plural, inclusivo e respeitoso, que valorize a diversidade cultural, étnica, de género e social, garantindo igualdade de oportunidades e formando cidadãos conscientes da importância da convivência harmoniosa.
                  </p>
                </div>

                <div id="sustentabilidade-ambiental" class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                    </svg>
                    Sustentabilidade Ambiental
                  </h3>
                  <p class="text-gray-700">
                    Incorporar práticas sustentáveis em todas as atividades institucionais, promovendo a consciência ambiental, a preservação dos recursos naturais e o desenvolvimento de tecnologias verdes que contribuam para um futuro mais sustentável.
                  </p>
                </div>

                <div id="impacto-regional" class="bg-gradient-to-br from-[#3B82F6]/10 to-[#3B82F6]/10 p-6 rounded-lg interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                    Impacto Regional
                  </h3>
                  <p class="text-gray-700">
                    Ser o principal motor de desenvolvimento socioeconómico da província do Bié, formando profissionais qualificados, gerando conhecimento aplicado e promovendo ações de extensão que melhorem a qualidade de vida da população local.
                  </p>
                </div>
              </div>

              <div class="mt-8 p-6 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white rounded-lg">
                <h3 class="font-bold text-xl mb-4">Horizonte 2030</h3>
                <p class="leading-relaxed">
                  Até 2030, o ISP-Bié aspira ser reconhecido como uma das principais instituições de ensino superior de Angola, 
                  distinguindo-se pela qualidade da formação oferecida, pela relevância das pesquisas desenvolvidas, pelo impacto 
                  positivo na comunidade e pelo compromisso inabalável com a sustentabilidade, a diversidade e a excelência em 
                  todas as suas dimensões.
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

