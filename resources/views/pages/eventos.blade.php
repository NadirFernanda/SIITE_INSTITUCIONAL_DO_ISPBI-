@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="relative bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-6">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
        </svg>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold">Eventos</h1>
          <p class="text-xl mt-2 opacity-90">Agenda Académica do ISP-Bié</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Eventos</span>
      </nav>
    </div>
  </section>

  <!-- Eventos em Destaque -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Eventos em Destaque</h2>
        <div class="h-1 w-24 bg-[#2563eb]"></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Evento Principal -->
        <div class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg overflow-hidden shadow-xl">
          <div class="p-8 text-white">
            <span class="inline-block bg-white/20 px-4 py-2 rounded-full text-sm font-semibold mb-4">EM DESTAQUE</span>
            <h3 class="text-3xl font-bold mb-4">Semana de Integração Académica 2026</h3>
            <p class="text-lg mb-6 opacity-90">
              Recepção aos novos estudantes com palestras, workshops e actividades culturais. 
              Uma semana dedicada Í  integração e boas-vindas Í  comunidade académica do ISP-Bié.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
              <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>15 a 19 de Fevereiro, 2026</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span>Campus ISP-Bié</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>
                <span>Novos Estudantes</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                </svg>
                <span>Presencial</span>
              </div>
            </div>
            <a href="/candidaturas" class="inline-block bg-white text-[#2563eb] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
              Inscrever-se
            </a>
          </div>
        </div>

        <!-- Grid de Eventos Destacados -->
        <div class="grid grid-cols-1 gap-6">
          <!-- Evento 2 -->
          <div class="bg-white border-2 border-[#2563eb] rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between mb-3">
              <span class="inline-block bg-[#2563eb] text-white px-3 py-1 rounded-full text-xs font-semibold">WORKSHOP</span>
              <span class="text-sm text-gray-600">ðŸ“… 28 Jan 2026</span>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-2">Workshop de Metodologias de Investigação</h4>
            <p class="text-gray-600 mb-3">Formação prática para estudantes e docentes sobre métodos de pesquisa científica.</p>
            <div class="flex items-center space-x-4 text-sm text-gray-500">
              <span>ðŸ“ Sala de Conferências</span>
              <span>â° 09h00</span>
            </div>
          </div>

          <!-- Evento 3 -->
          <div class="bg-white border-2 border-[#3B82F6] rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between mb-3">
              <span class="inline-block bg-[#3B82F6] text-white px-3 py-1 rounded-full text-xs font-semibold">PALESTRA</span>
              <span class="text-sm text-gray-600">ðŸ“… 05 Fev 2026</span>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-2">Empreendedorismo e Inovação em Angola</h4>
            <p class="text-gray-600 mb-3">Palestra com empresários de sucesso sobre oportunidades de negócio na província do Bié.</p>
            <div class="flex items-center space-x-4 text-sm text-gray-500">
              <span>ðŸ“ Auditório Principal</span>
              <span>â° 14h00</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Calendário de Eventos -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Próximos Eventos</h2>
        <div class="h-1 w-24 bg-[#2563eb] mb-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Evento 4 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb]"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-semibold">FEIRA</span>
                <span class="text-sm text-gray-600">12 Fev 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Feira de Emprego e Estágios</h4>
              <p class="text-gray-600 mb-4">Empresas locais e nacionais apresentam oportunidades de estágio e emprego.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Pavilhão de Eventos</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>08h00 - 17h00</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Evento 5 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#3B82F6]"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">SEMINÍRIO</span>
                <span class="text-sm text-gray-600">20 Fev 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Saúde Pública no Bié: Desafios e Oportunidades</h4>
              <p class="text-gray-600 mb-4">Seminário com profissionais de saúde sobre a realidade sanitária da província.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Auditório Principal</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>10h00 - 13h00</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Evento 6 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-[#3B82F6] to-[#2563eb]"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">COMPETIÇÍO</span>
                <span class="text-sm text-gray-600">28 Fev 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Hackathon ISP-Bié 2026</h4>
              <p class="text-gray-600 mb-4">Competição de programação e desenvolvimento de soluções tecnológicas inovadoras.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Laboratório de Informática</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>08h00 - 20h00</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Evento 7 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-purple-600 to-pink-500"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-xs font-semibold">CULTURAL</span>
                <span class="text-sm text-gray-600">08 Mar 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Dia Internacional da Mulher</h4>
              <p class="text-gray-600 mb-4">Celebração com palestras, exposições e homenagens Í s mulheres do ISP-Bié.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Campus ISP-Bié</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>Todo o dia</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Evento 8 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-orange-500 to-red-600"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-xs font-semibold">DESPORTIVO</span>
                <span class="text-sm text-gray-600">15 Mar 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Jogos Universitários do Bié</h4>
              <p class="text-gray-600 mb-4">Competição desportiva inter-cursos com futebol, basquete, atletismo e mais.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Campo Desportivo</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>07h00 - 18h00</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Evento 9 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-teal-500 to-cyan-600"></div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-xs font-semibold">CONFERÍŠNCIA</span>
                <span class="text-sm text-gray-600">25 Mar 2026</span>
              </div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Sustentabilidade e Ambiente no Bié</h4>
              <p class="text-gray-600 mb-4">Conferência sobre desafios ambientais e soluções sustentáveis para a região.</p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                  <span>Auditório Principal</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  <span>09h00 - 17h00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-lg p-8 text-white text-center">
        <h3 class="text-2xl font-bold mb-4">Quer propor um evento?</h3>
        <p class="mb-6 text-lg opacity-90">
          Estudantes, docentes e organizações podem submeter propostas de eventos académicos, culturais ou científicos.
        </p>
        <a href="/contactos" class="inline-block bg-white text-[#2563eb] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
          Contactar-nos
        </a>
      </div>
    </div>
  </section>
@endsection

