@extends('layouts.site')


@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Notícias
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Notícias</h1>
        <p class="text-lg text-gray-700">Notícias, comunicados e contacto com as notícias</p>
      </div>

  <!-- Notícias Recentes -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12">Notícias Recentes</h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Notícia 1 -->
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb]"></div>
          <div class="p-6">
            <div class="text-sm text-gray-500 mb-2">14 de Dezembro de 2025</div>
            <h3 class="text-xl font-bold text-[#2563eb] mb-3">ISP-Bié Abre Candidaturas para 2026</h3>
            <p class="text-gray-600 mb-4">
              Processo de candidatura está aberto com 240 vagas distribuídas pelos 6 cursos de graduação.
            </p>
            <a href="#" class="text-[#2563eb] font-semibold hover:underline">Ler mais →</a>
          </div>
        </article>

        <!-- Notícia 2 -->
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="h-48 bg-gradient-to-br from-[#9C27B0] to-[#673AB7]"></div>
          <div class="p-6">
            <div class="text-sm text-gray-500 mb-2">10 de Dezembro de 2025</div>
            <h3 class="text-xl font-bold text-[#2563eb] mb-3">Convênio com Universidade Argentina</h3>
            <p class="text-gray-600 mb-4">
              ISP-Bié assina protocolo de cooperação para intercâmbio acadêmico e científico.
            </p>
            <a href="#" class="text-[#2563eb] font-semibold hover:underline">Ler mais â†’</a>
          </div>
        </article>

        <!-- Notícia 3 -->
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#3B82F6]"></div>
          <div class="p-6">
            <div class="text-sm text-gray-500 mb-2">5 de Dezembro de 2025</div>
            <h3 class="text-xl font-bold text-[#2563eb] mb-3">Novos Laboratórios Inaugurados</h3>
            <p class="text-gray-600 mb-4">
              Modernização das instalações reforça qualidade do ensino em Enfermagem e Engenharia.
            </p>
            <a href="#" class="text-[#2563eb] font-semibold hover:underline">Ler mais â†’</a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- Comunicados Oficiais -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12">Comunicados Oficiais</h2>
      
      <div class="space-y-4">
        
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all interactive-card">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center mb-2">
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold mr-3">URGENTE</span>
                <span class="text-sm text-gray-500">12 de Dezembro de 2025</span>
              </div>
              <h3 class="text-xl font-bold text-[#2563eb] mb-2">
                Calendário Acadêmico 2026 - Retificação de Datas
              </h3>
              <p class="text-gray-600">
                Os Órgãos de gestão do ISP-Bié informam sobre alteração nas datas de início do ano letivo 2026.
              </p>
            </div>
            <a href="#" class="ml-4 bg-[#2563eb] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1a2f3d] transition-colors whitespace-nowrap">
              Ver Comunicado
            </a>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all interactive-card">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center mb-2">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold mr-3">AVISO</span>
                <span class="text-sm text-gray-500">8 de Dezembro de 2025</span>
              </div>
              <h3 class="text-xl font-bold text-[#2563eb] mb-2">
                Período de Matrícula - 2ª Fase
              </h3>
              <p class="text-gray-600">
                Abertura da segunda fase de matrículas para o ano letivo 2026. Consulte os prazos e procedimentos.
              </p>
            </div>
            <a href="#" class="ml-4 bg-[#2563eb] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1a2f3d] transition-colors whitespace-nowrap">
              Ver Comunicado
            </a>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all interactive-card">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center mb-2">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold mr-3">INFORMAÇÃO</span>
                <span class="text-sm text-gray-500">1 de Dezembro de 2025</span>
              </div>
              <h3 class="text-xl font-bold text-[#2563eb] mb-2">
                Resultados do Concurso de Admissão 2025
              </h3>
              <p class="text-gray-600">
                Lista de candidatos aprovados no concurso de admissão está disponível para consulta.
              </p>
            </div>
            <a href="#" class="ml-4 bg-[#2563eb] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1a2f3d] transition-colors whitespace-nowrap">
              Ver Comunicado
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Kit de Notícias -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12 text-center">Kit de Notícias</h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <a href="#" class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] p-6 rounded-lg text-white hover:shadow-xl transition-all group interactive-card">
          <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-xl font-bold mb-2">Logotipos</h3>
          <p class="text-sm opacity-90">Versões oficiais em alta resolução</p>
        </a>

        <a href="#" class="bg-gradient-to-br from-[#2563eb] to-[#2563eb] p-6 rounded-lg text-white hover:shadow-xl transition-all group interactive-card">
          <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
            <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
          </svg>
          <h3 class="text-xl font-bold mb-2">Documentos</h3>
          <p class="text-sm opacity-90">Estatutos, relatórios e publicações</p>
        </a>

        <a href="#" class="bg-gradient-to-br from-[#9C27B0] to-[#673AB7] p-6 rounded-lg text-white hover:shadow-xl transition-all group interactive-card">
          <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm3 2h6v4H7V5zm8 8v2h1v-2h-1zm-2-2H7v4h6v-4zm2 0h1V9h-1v2zm1-4V5h-1v2h1zM5 5v2H4V5h1zm0 4H4v2h1V9zm-1 4h1v2H4v-2z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-xl font-bold mb-2">Fotos</h3>
          <p class="text-sm opacity-90">Galeria de imagens institucionais</p>
        </a>

        <a href="#" class="bg-gradient-to-br from-[#2563eb] to-[#2563eb] p-6 rounded-lg text-white hover:shadow-xl transition-all group interactive-card">
          <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
          </svg>
          <h3 class="text-xl font-bold mb-2">Vídeos</h3>
          <p class="text-sm opacity-90">Conteúdo audiovisual institucional</p>
        </a>

      </div>
    </div>
  </section>

  <!-- Contacto com as Notícias -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-12 text-white interactive-card">
        <div class="grid md:grid-cols-2 gap-12">
          
          <div>
            <h2 class="text-3xl font-bold mb-6">Contacto para as Notícias</h2>
            <p class="text-lg opacity-90 mb-8">
              Para entrevistas, esclarecimentos ou solicitação de informações, contacte o nosso 
              Gabinete de Comunicação e Notícias.
            </p>
            
            <div class="space-y-4">
              <div class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                <div>
                  <p class="font-semibold">Email</p>
                  <a href="mailto:noticias@ispbie.ao" class="opacity-90 hover:opacity-100">noticias@ispbie.ao</a>
                </div>
              </div>

              <div class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                <div>
                  <p class="font-semibold">Telefone</p>
                  <p class="opacity-90">(244) 922 408 061</p>
                </div>
              </div>

              <div class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <div>
                  <p class="font-semibold">Horário de Atendimento</p>
                  <p class="opacity-90">Segunda a Sexta, 8h00-17h00</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white/10 backdrop-blur rounded-lg p-8">
            <h3 class="text-2xl font-bold mb-6">Solicitar Entrevista</h3>
            <form class="space-y-4">
              <div>
                <input type="text" placeholder="Nome do Jornalista" required class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 text-white focus:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50">
              </div>
              <div>
                <input type="text" placeholder="Órgão de Comunicação" required class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 text-white focus:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50">
              </div>
              <div>
                <input type="email" placeholder="Email" required class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 text-white focus:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50">
              </div>
              <div>
                <textarea rows="4" placeholder="Assunto da entrevista / solicitação" required class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 text-white focus:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50"></textarea>
              </div>
              <button type="submit" class="w-full bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">
                Enviar Solicitação
              </button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>

@endsection

