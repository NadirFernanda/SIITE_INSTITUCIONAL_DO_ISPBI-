@extends('layouts.site')


@section('content')
<div class="institutional-page">
@include('partials.page-hero', [
    'title'      => 'Valores',
    'subtitle'   => 'Os princípios que orientam a qualidade académica, a inovação, a inclusão e a responsabilidade institucional do ISP-Bié.',
    'breadcrumb' => 'Valores',
])
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Valores -->
        <div class="lg:col-span-3">
          <div class="institutional-card">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Valores do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-black mb-6 leading-relaxed">
                O Instituto Superior Politécnico do Bié orienta a sua actuação pelos seguintes valores:
              </p>
              
              <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <div id="excelencia" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#2563eb] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Excelência</h3>
                  <p class="text-gray-700 text-center">
                    Compromisso com padrões elevados de qualidade académica e científica.
                  </p>
                </div>

                <div id="inovacao" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#2563eb] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Inovação</h3>
                  <p class="text-gray-700 text-center">
                    Adopção de tecnologias emergentes e metodologias activas.
                  </p>
                </div>

                <div id="inclusao" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#3B82F6] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Inclusão</h3>
                  <p class="text-gray-700 text-center">
                    Promoção da equidade de género, acesso e diversidade.
                  </p>
                </div>

                <div id="sustentabilidade" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#3B82F6] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Sustentabilidade</h3>
                  <p class="text-gray-700 text-center">
                    Responsabilidade ambiental e social.
                  </p>
                </div>

                <div id="etica" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#2563eb] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Ética</h3>
                  <p class="text-gray-700 text-center">
                    Integridade, transparência e responsabilidade institucional.
                  </p>
                </div>

                <div id="cidadania" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#3B82F6] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#3B82F6] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Cidadania</h3>
                  <p class="text-gray-700 text-center">
                    Compromisso com o desenvolvimento comunitário.
                  </p>
                </div>

                <div id="cooperacao" class="bg-white border border-slate-200 shadow-sm p-6 rounded-lg border-t-4 border-[#2563eb] interactive-card">
                  <div class="flex items-center justify-center w-16 h-16 bg-[#2563eb] rounded-full mb-4 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 014 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                  </div>
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 text-center">Cooperação</h3>
                  <p class="text-gray-700 text-center">
                    Trabalho colaborativo com parceiros nacionais e internacionais.
                  </p>
                </div>
              </div>

              <div class="mt-8 p-6 bg-[#1e3a5f] text-white rounded-lg">
                <h3 class="font-bold text-2xl mb-4">Código de Conduta</h3>
                <p class="leading-relaxed">
                  Estes valores orientam o comportamento de estudantes, docentes, funcionários e gestores, e fundamentam o compromisso do ISP-Bié com uma educação de qualidade e o desenvolvimento da sociedade angolana.
                </p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

</div>
@endsection
