@extends('layouts.site')


@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Cursos Online
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Cursos Online</h1>
        <p class="text-lg text-gray-700">Educação à Distância - Em Desenvolvimento</p>
      </div>

  <!-- Projeto em Desenvolvimento -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] rounded-2xl p-12 text-white text-center mb-12 interactive-card">
          <svg class="w-20 h-20 mx-auto mb-6" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
          </svg>
          <h2 class="text-4xl font-bold mb-4">Projeto em Implementação</h2>
          <p class="text-xl opacity-95 max-w-2xl mx-auto">
            O ISP-Bié está a trabalhar na criação de uma plataforma de ensino à distância para 
            democratizar o acesso ao ensino superior de qualidade na província do Bié e em toda Angola.
          </p>
        </div>

        <div class="prose prose-lg max-w-none text-gray-700">
          <p class="text-lg leading-relaxed mb-6">
            A modalidade de <strong>Ensino Online</strong> representa um passo estratégico na missão do ISP-Bié 
            de expandir o acesso à educação superior. Estamos a desenvolver uma infraestrutura tecnológica 
            robusta e a preparar conteúdos pedagógicos de excelência para oferecer cursos totalmente online 
            e semipresenciais.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Cronograma de Implementação -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12 text-center">Fases de Implementação</h2>
      
      <div class="overflow-x-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10 xl:gap-16 min-w-[340px] md:min-w-0" id="fases-implementacao-cards">
        
        <div class="bg-white rounded-lg shadow-md p-6 w-[320px] md:w-auto mx-auto cursor-pointer fase-card interactive-card" tabindex="0" style="margin-bottom: 1.5rem; max-width: 340px;">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">1</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3 text-center">Fase Atual</h3>
          <h4 class="font-semibold text-center mb-3 text-gray-700">Desenvolvimento da Plataforma</h4>
          <ul class="space-y-2 text-sm text-gray-600">
            <li>✔ Estudo de viabilidade concluído</li>
            <li>✔ Aquisição de infraestrutura tecnológica</li>
            <li>⏳ Desenvolvimento da plataforma LMS</li>
            <li>⏳ Formação de tutores online</li>
          </ul>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 w-[320px] md:w-auto mx-auto cursor-pointer fase-card interactive-card" tabindex="0" style="margin-bottom: 1.5rem; max-width: 340px;">
          <div class="w-16 h-16 bg-gradient-to-br from-[#9C27B0] to-[#673AB7] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">2</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3 text-center">A Anunciar</h3>
          <h4 class="font-semibold text-center mb-3 text-gray-700">Criação de Conteúdos</h4>
          <ul class="space-y-2 text-sm text-gray-600">
            <li>📚 Produção de videoaulas</li>
            <li>📚 Materiais didáticos digitais</li>
            <li>📚 Atividades interativas</li>
            <li>📚 Sistema de avaliação online</li>
          </ul>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 w-[320px] md:w-auto mx-auto cursor-pointer fase-card interactive-card" tabindex="0" style="margin-bottom: 1.5rem; max-width: 340px;">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">3</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3 text-center">A Anunciar</h3>
          <h4 class="font-semibold text-center mb-3 text-gray-700">Testes Piloto</h4>
          <ul class="space-y-2 text-sm text-gray-600">
            <li>🔍 Testes com grupo reduzido</li>
            <li>🔍 Avaliação de usabilidade</li>
            <li>🔍 Ajustes e melhorias</li>
            <li>🔍 Validação pedagógica</li>
          </ul>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 w-[320px] md:w-auto mx-auto cursor-pointer fase-card interactive-card" tabindex="0" style="margin-bottom: 1.5rem; max-width: 340px;">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">4</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3 text-center">A Anunciar</h3>
          <h4 class="font-semibold text-center mb-3 text-gray-700">Lançamento Oficial</h4>
          <ul class="space-y-2 text-sm text-gray-600">
            <li>🚀 Abertura de matrículas</li>
            <li>🚀 Primeiras turmas online</li>
            <li>🚀 Suporte técnico dedicado</li>
            <li>🚀 Monitoramento contínuo</li>
          </ul>
        </div>

      </div>
        </div>
      </div>
    <script>
      // Adiciona rolagem suave ao clicar em cada card das fases de implementação
      document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.fase-card');
        cards.forEach(card => {
          card.addEventListener('click', function() {
            card.scrollIntoView({ behavior: 'smooth', block: 'start' });
          });
          card.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
              card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          });
        });
      });
    </script>
  </section>

  <!-- Cursos Planejados -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-4 text-center">Cursos em Desenvolvimento</h2>
      <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">
        Os seguintes cursos estão a ser preparados para oferta na modalidade online e semipresencial
      </p>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Administração Pública -->
        <div class="bg-gradient-to-br from-[#3B82F6] to-[#2563eb] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Administração Pública</h3>
          <p class="opacity-90 mb-4">Curso de graduação focado em gestão pública e políticas governamentais</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: Online + Presencial</span>
        </div>

        <!-- Gestão de Recursos Humanos -->
        <div class="bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Gestão de RH</h3>
          <p class="opacity-90 mb-4">Formação em gestão de pessoas e desenvolvimento organizacional</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: 100% Online</span>
        </div>

        <!-- Engenharia Informática -->
        <div class="bg-gradient-to-br from-[#9C27B0] to-[#673AB7] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Engenharia Informática</h3>
          <p class="opacity-90 mb-4">Desenvolvimento de software, sistemas e redes de computadores</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: 100% Online</span>
        </div>

        <!-- Contabilidade -->
        <div class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Contabilidade</h3>
          <p class="opacity-90 mb-4">Formação em ciências contábeis e auditoria</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: Online + Presencial</span>
        </div>

        <!-- Marketing Digital -->
        <div class="bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Marketing Digital</h3>
          <p class="opacity-90 mb-4">Curso de especialização em marketing e comunicação digital</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: 100% Online</span>
        </div>

        <!-- Comunicação Social -->
        <div class="bg-gradient-to-br from-[#3B82F6] to-[#2563eb] rounded-lg p-6 text-white interactive-card">
          <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-2xl font-bold mb-3">Comunicação Social</h3>
          <p class="opacity-90 mb-4">Jornalismo, relações públicas e produção de conteúdo digital</p>
          <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Modalidade: Online + Presencial</span>
        </div>

      </div>
    </div>
  </section>

  <!-- Vantagens do Ensino Online -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12 text-center">Vantagens do Ensino Online</h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#3B82F6] to-[#2563eb] rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="font-bold text-lg text-[#2563eb] mb-2">Flexibilidade</h3>
          <p class="text-gray-600">Estude no seu próprio ritmo e horário</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="font-bold text-lg text-[#2563eb] mb-2">Acessibilidade</h3>
          <p class="text-gray-600">Aprenda de qualquer lugar de toda Angola</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#9C27B0] to-[#673AB7] rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="font-bold text-lg text-[#2563eb] mb-2">Economia</h3>
          <p class="text-gray-600">Reduza custos com deslocação e estadia</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
          </div>
          <h3 class="font-bold text-lg text-[#2563eb] mb-2">Qualidade</h3>
          <p class="text-gray-600">Mesma excelência do ensino presencial</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Cadastro de Interesse -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-12 text-white">
        <h2 class="text-3xl font-bold mb-4 text-center">Manifeste o Seu Interesse</h2>
        <p class="text-lg opacity-90 mb-8 text-center">
          Seja notificado quando os cursos online estiverem disponíveis
        </p>

        <form class="space-y-6">
          @csrf
            <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label for="cursos_name" class="block text-sm font-semibold mb-2">Nome Completo *</label>
              <input id="cursos_name" type="text" required class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white">
            </div>
            <div>
              <label for="cursos_email" class="block text-sm font-semibold mb-2">Email *</label>
              <input id="cursos_email" type="email" required class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white">
            </div>
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label for="cursos_phone" class="block text-sm font-semibold mb-2">Telefone</label>
              <input id="cursos_phone" type="tel" placeholder="(244) 900 000 000" class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white">
            </div>
            <div>
              <label for="cursos_provincia" class="block text-sm font-semibold mb-2">Província</label>
              <select id="cursos_provincia" class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white">
                <option value="">Selecione</option>
                <option value="bie">Bié</option>
                <option value="huambo">Huambo</option>
                <option value="moxico">Moxico</option>
                <option value="luanda">Luanda</option>
                <option value="outra">Outra</option>
              </select>
            </div>
          </div>

          <div>
            <label for="cursos_curso" class="block text-sm font-semibold mb-2">Curso de Interesse *</label>
            <select id="cursos_curso" required class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white">
              <option value="">Selecione um curso</option>
              <option value="administracao">Administração Pública</option>
              <option value="rh">Gestão de Recursos Humanos</option>
            <option value="informatica">Engenharia Informática</option>
              <option value="contabilidade">Contabilidade</option>
              <option value="marketing">Marketing Digital</option>
              <option value="comunicacao">Comunicação Social</option>
              <option value="outro">Outro</option>
            </select>
          </div>

          <div class="flex items-start">
            <input type="checkbox" required class="mt-1 mr-3">
            <label class="text-sm">
              Autorizo o ISP-Bié a enviar-me informações sobre os cursos online e novidades da instituição. *
            </label>
          </div>

          <button type="submit" class="w-full bg-white text-[#2563eb] py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all">
            Cadastrar Interesse
          </button>
        </form>
      </div>
    </div>
  </section>

@endsection

