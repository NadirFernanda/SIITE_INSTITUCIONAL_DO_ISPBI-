@extends('layouts.site')


@section('content')
<div class="institutional-page">
@include('partials.page-hero', [
    'title'      => 'Visão',
    'subtitle'   => 'A visão que orienta o ISP-Bié até 2031 como instituição de referência nacional em inovação, ensino, investigação e empreendedorismo.',
    'breadcrumb' => 'Visão',
])
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Coluna Visão -->
        <div class="lg:col-span-3">
          <div class="institutional-card">
            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Visão do ISP-Bié</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
              <p class="text-xl text-black mb-6 leading-relaxed">
                Ser até 2031, uma instituição de referência nacional em inovação STEAM, ensino híbrido, investigação aplicada e empreendedorismo, reconhecida pela qualidade académica, impacto regional e compromisso com a inclusão social.
              </p>
              
              <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div id="excelencia-academica" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Inovação STEAM
                  </h3>
                  <p class="text-gray-700">
                    Ser uma referência nacional em inovação STEAM, promovendo a integração de ciência, tecnologia, engenharia, artes e matemática.
                  </p>
                </div>

                <div id="reconhecimento-internacional" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                    Ensino Híbrido
                  </h3>
                  <p class="text-gray-700">
                    Desenvolver modelos de ensino híbrido que ampliem o acesso, a flexibilidade e a qualidade das experiências de aprendizagem.
                  </p>
                </div>

                <div id="pesquisa-inovacao" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                    </svg>
                    Investigação Aplicada
                  </h3>
                  <p class="text-gray-700">
                    Promover investigação aplicada que produza conhecimento e soluções relevantes para os desafios da região e do país.
                  </p>
                </div>

                <div id="diversidade-inclusao" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                      <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                    </svg>
                    Empreendedorismo
                  </h3>
                  <p class="text-gray-700">
                    Estimular o empreendedorismo, a criatividade e a transformação de ideias inovadoras em iniciativas com impacto.
                  </p>
                </div>

                <div id="sustentabilidade-ambiental" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                    </svg>
                    Qualidade Académica
                  </h3>
                  <p class="text-gray-700">
                    Ser reconhecida pela qualidade académica e pela excelência do ensino, da investigação e da formação.
                  </p>
                </div>

                <div id="impacto-regional" class="institutional-feature-card interactive-card">
                  <h3 class="font-bold text-lg text-[#2563eb] mb-3 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                    Impacto Regional e Inclusão Social
                  </h3>
                  <p class="text-gray-700">
                    Gerar impacto regional e promover a inclusão social, contribuindo para o desenvolvimento da comunidade.
                  </p>
                </div>
              </div>

              <x-institutional-statement title="Horizonte 2031">
                <p class="leading-relaxed">
                  Até 2031, o ISP-Bié aspira ser uma instituição de referência nacional em inovação STEAM, ensino híbrido, investigação aplicada e empreendedorismo, reconhecida pela qualidade académica, impacto regional e compromisso com a inclusão social.
                </p>
              </x-institutional-statement>
            </div>
          </div>
        </div>
        
      </div>
    </div>

</div>
@endsection
