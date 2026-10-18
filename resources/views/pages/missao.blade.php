@extends('layouts.site')


@section('content')
<div class="institutional-page">
@include('partials.page-hero', [
    'title'      => 'Missão',
    'subtitle'   => 'Conheça a missão institucional que orienta a formação, a investigação e a extensão universitária do ISP-Bié.',
    'breadcrumb' => 'Missão',
])
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Missão -->
        <div class="lg:col-span-3">
          <div class="institutional-card">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Missão do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-black mb-6 leading-relaxed">
                Formar profissionais competentes, éticos e inovadores, promover a investigação aplicada e contribuir para o desenvolvimento sustentável da Província do Bié e de Angola, através de ensino de qualidade, modernização tecnológica com forte ligação à sociedade.
              </p>
              
              <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div id="formacao-excelencia" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    Formação de Excelência
                  </h3>
                  <p class="text-gray-700">
                    Formar profissionais competentes, éticos e inovadores através de um ensino de qualidade, preparado para responder aos desafios de Angola e do mundo.
                  </p>
                </div>

                <div id="investigacao-aplicada" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                      <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                    Investigação Aplicada
                  </h3>
                  <p class="text-gray-700">
                    Promover investigação aplicada que gere conhecimento, inovação e soluções para os desafios da Província do Bié e de Angola.
                  </p>
                </div>

                <div id="extensao-universitaria" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    Extensão Universitária
                  </h3>
                  <p class="text-gray-700">
                    Modernizar tecnologicamente a instituição e aproximar o ensino da sociedade, respondendo às necessidades da comunidade.
                  </p>
                </div>

                <div id="responsabilidade-social" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    Responsabilidade Social
                  </h3>
                  <p class="text-gray-700">
                    Contribuir para o desenvolvimento sustentável do Bié e de Angola, com responsabilidade ética, social e ambiental.
                  </p>
                </div>
              </div>

              <x-institutional-statement title="Compromisso Institucional">
                <p class="leading-relaxed">
                  O Instituto Superior Politécnico do Bié compromete-se a cumprir sua missão através de práticas pedagógicas inovadoras, 
                  investimento contínuo na qualificação do corpo docente, infraestrutura adequada, parcerias estratégicas nacionais e 
                  internacionais, e uma gestão transparente e participativa que coloca o estudante no centro do processo educativo.
                </p>
              </x-institutional-statement>
            </div>
          </div>
        </div>
        
      </div>
    </div>

</div>
@endsection
