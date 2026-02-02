@extends('layouts.site')

@section('content')
  <!-- Banner Institucional -->
  <section class="bg-gradient-to-r from-[#FF9800] to-[#2563eb] text-white py-16 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-4">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
        </svg>
        <div>
          <h1 class="text-4xl font-bold">Mestrado</h1>
          <p class="text-lg opacity-90">Instituto Superior Politécnico do Bié</p>
        </div>
      </div>
      
      <nav class="text-sm opacity-75">
        <a href="/" class="hover:underline">Início</a> \ Mestrado
      </nav>
    </div>
  </section>

  <!-- Conteúdo Principal -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Plano Futuro -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden interactive-card">
        <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-8 text-white text-center">
          <svg class="w-16 h-16 mx-auto mb-4 opacity-90" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
          </svg>
          <h2 class="text-3xl font-bold">Pós-Graduação em Desenvolvimento</h2>
          <p class="text-lg mt-2 opacity-90">Ampliando horizontes académicos</p>
        </div>

        <div class="p-8">
          <div class="bg-gradient-to-br from-[#2563eb]/10 to-[#2563eb]/10 border-l-4 border-[#2563eb] p-6 rounded-lg mb-6">
            <h3 class="text-2xl font-bold text-[#2563eb] mb-4">Plano de Implementação</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              O Instituto Superior Politécnico do Bié está a desenvolver o seu programa de pós-graduação 
              com o objetivo de oferecer formação avançada e especializada. Nos próximos dois anos, 
              está prevista a implementação do <strong class="text-[#2563eb]">Mestrado em Genecologia</strong>.
            </p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border border-gray-200 p-6 rounded-lg">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-[#3B82F6] rounded-full flex items-center justify-center mr-4">
                  <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-[#2563eb]">Período de Implementação</h4>
                  <p class="text-gray-700">2025 - 2027</p>
                </div>
              </div>
            </div>

            <div class="bg-white border border-gray-200 p-6 rounded-lg">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-[#3B82F6] rounded-full flex items-center justify-center mr-4">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-[#2563eb]">Írea de Formação</h4>
                  <p class="text-gray-700">Ciências Médicas e da Saúde</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white p-6 rounded-lg">
            <h4 class="text-xl font-bold mb-3 flex items-center">
              <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
              Mestrado em Genecologia
            </h4>
            <p class="leading-relaxed opacity-90">
              Este programa de mestrado visa formar profissionais altamente qualificados na área de genecologia, 
              contribuindo para o avanço da saúde reprodutiva e genética na província do Bié e em Angola. 
              O curso será desenvolvido com padrões internacionais de qualidade e incluirá componentes 
              teóricos, práticos e de investigação científica.
            </p>
          </div>

          <div class="mt-8 text-center">
            <p class="text-gray-600 mb-4">Para mais informações sobre o desenvolvimento deste programa:</p>
            <a href="/contactos" class="inline-block bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition-all">
              Entre em Contacto
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->


@endsection

