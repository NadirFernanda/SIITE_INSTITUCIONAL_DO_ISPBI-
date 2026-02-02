@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Valores
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Valores</h1>
        <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      </div>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Valores -->
        <div class="lg:col-span-3">
          <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Valores do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-[#2563eb] font-semibold mb-6 leading-relaxed">
                O Instituto Superior Politécnico do Bié elege como seus principais valores e princípios norteadores das relações interpessoais e institucionais os seguintes:
              </p>
              
              <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#3B82F6]/10 p-6 rounded-lg border-t-4 border-[#2563eb]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Respeito ao Próximo e à Vida Humana</h3>
                  <p class="text-gray-700 text-center">
                    Valorização da dignidade humana em todas as suas dimensões, promovendo o respeito mútuo e a preservação da vida.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 p-6 rounded-lg border-t-4 border-[#2563eb]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Honestidade e Transparência</h3>
                  <p class="text-gray-700 text-center">
                    Honestidade e transparência em tudo o que fazemos, mantendo a integridade e a confiança em todas as ações institucionais.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg border-t-4 border-[#3B82F6]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Respeito pelas Diferenças</h3>
                  <p class="text-gray-700 text-center">
                    Celebração da diversidade e respeito pelas diferenças, reconhecendo a pluralidade como fonte de enriquecimento mútuo.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#3B82F6]/10 to-[#2563eb]/10 p-6 rounded-lg border-t-4 border-[#3B82F6]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Solidariedade</h3>
                  <p class="text-gray-700 text-center">
                    Promoção da solidariedade e do apoio mútuo, construindo uma comunidade académica colaborativa e acolhedora.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 p-6 rounded-lg border-t-4 border-[#2563eb]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Amor à Pátria, à Instituição e à Extensão Universitária</h3>
                  <p class="text-gray-700 text-center">
                    Compromisso com o desenvolvimento de Angola, valorização da identidade institucional e promoção da extensão universitária.
                  </p>
                </div>

                <div class="bg-gradient-to-br from-[#3B82F6]/10 to-[#3B82F6]/10 p-6 rounded-lg border-t-4 border-[#3B82F6]">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Comprometimento com a Excelência</h3>
                  <p class="text-gray-700 text-center">
                    Busca constante pela excelência em todas as atividades académicas, científicas e administrativas da instituição.
                  </p>
                </div>
              </div>

              <div class="mt-8 p-6 bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white rounded-lg">
                <h3 class="font-bold text-2xl mb-4">Código de Conduta</h3>
                <p class="leading-relaxed">
                  Estes valores fundamentam todas as decisões e ações do ISP-Bié, orientando o comportamento de estudantes, docentes, 
                  funcionários e gestores. Eles representam o alicerce da extensão universitária institucional e o compromisso com uma educação 
                  transformadora que forma profissionais competentes, cidadãos conscientes e agentes de mudança positiva na sociedade angolana.
                </p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

</div> {{-- FECHA o div aberto no início do content --}}

@endsection

