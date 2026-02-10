<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white text-[#2563eb] px-3 py-2 rounded shadow z-60">Saltar para o conteúdo</a>
<div class="hidden md:block w-full fixed left-0 top-0" style="background:#0E8F81;height:4px;z-index:52;"></div>
<div class="hidden md:block w-full fixed left-0 top-0" style="background:#F05A28;height:4px;top:4px;z-index:51;"></div>

<!-- Barra inferior institucional em cinza claro - Desktop apenas -->
<div class="hidden md:flex w-full" style="background:#f3f4f6;color:#183153;font-size:1.01rem;padding:7px 2vw;align-items:center;justify-content:space-between;max-width:100vw;margin:0 auto;min-height:36px;">
  <div class="flex flex-wrap items-center gap-2">
    <a href="/contactos" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contacto"><span>📷</span> Contacto</a>
    <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Abrir Webmail (abre em nova aba)"><span>✉️</span> Webmail</a>
    <a href="/servicos" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Serviços"><span>🗞️</span> Serviços</a>
  </div>
  <div class="flex flex-wrap items-center gap-2">
    <!-- <a href="/presidencia" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>🏛️</span> Órgãos de gestão</a> -->

    <!-- Dropdown Infraestrutura Digital - Barra cinza (Desktop) -->
    <div x-data="{ openInfra: false }" class="relative">
            <button @click="openInfra = !openInfra" @keydown.escape="openInfra = false"
              class="flex items-center gap-1 hover:underline hover:text-[#2563eb] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
              :aria-expanded="openInfra ? 'true' : 'false'" aria-haspopup="true" aria-controls="infra-dropdown">
        <span>⚙️</span> Infraestrutura Digital
        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
            <div id="infra-dropdown" x-show="openInfra" @click.away="openInfra = false" x-cloak
              class="absolute right-0 mt-2 w-64 bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 z-50 p-2 text-sm">
        <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white font-semibold">Página de Sistemas</a>
        <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer" aria-label="Abrir SGF (abre em nova aba)"
          class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
          Sistema de Gestão de Facturas (SGF)
        </a>
      </div>
    </div>

    <a href="/candidaturas" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]">
      <span>📝</span> Candidaturas
    </a>

    <!-- Links de estudantes movidos para a barra inferior -->
    <a href="/calendario-academico" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] whitespace-nowrap">
      <span>📅</span> Calendário Académico
    </a>
    <a href="/guia-estudante" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] whitespace-nowrap">
      <span>📖</span> Guia do Estudante
    </a>
    <a href="/resultados" class="flex items-center gap-1 hover:underline hover:text-[#2563eb] whitespace-nowrap">
      <span>📊</span> Resultados de Exames
    </a>
  </div>
</div>

<!-- Bloco institucional com navbar + menu mobile no mesmo x-data -->
<div x-data="{ mobileMenuOpen: false, openExtMobile: false, openMobile: false, openInfraMobile: false }">
  <div class="w-full bg-[#2563eb]" style="background:#2563eb!important;color:#fff!important;">
    <div class="w-full 2xl:max-w-screen-2xl mx-auto flex flex-row items-center justify-between px-2 sm:px-4 py-2">
    <!-- Logo e nome -->
    <a href="/" class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
      <div class="flex items-center justify-center rounded-md sm:rounded-lg shadow-sm px-1.5 py-1 sm:px-2 sm:py-1.5" style="background:transparent!important;">
        <img src="/images/logo.png" alt="ISP-Bié" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain flex-shrink-0" style="background:transparent!important;" onerror="this.style.display='none'">
      </div>
      <span class="text-white font-bold text-xs sm:text-sm md:text-base lg:text-xl tracking-tight truncate">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
    </a>
    
    <!-- Botão hamburger (Mobile) -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen ? 'true' : 'false'" aria-controls="mobile-menu" aria-label="Abrir menu principal" class="lg:hidden text-white p-2 hover:bg-white/10 rounded-lg transition-colors flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    
    <!-- Menu principal (Desktop) -->
    <nav role="navigation" aria-label="Navegação principal" class="hidden lg:flex flex-row items-center space-x-4 xl:space-x-6 mb-0 pb-0 border-b-0">
      <a href="/cursos" class="flex items-center space-x-1 text-white font-semibold uppercase text-xs tracking-wide hover:text-[#FFD700] transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Cursos">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor"/><path d="M16 3v4M8 3v4" stroke="currentColor"/></svg></span>
        <span>Cursos</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-1 text-white font-semibold uppercase text-xs tracking-wide hover:text-[#FFD700] transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Pesquisa e Inovação">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m4 0a4 4 0 11-8 0 4 4 0 018 0z"/><path d="M12 12v2m0 4h.01"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <!-- Dropdown Institucional - Desktop -->
      <div x-data="{ open: false }" class="relative inline-block">
        <button @click="open = !open" @keydown.escape="open = false"
          class="flex items-center gap-1 text-white hover:text-[#FFD700] font-semibold uppercase text-xs tracking-wide focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
          :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true" aria-controls="institucional-dropdown">
          <span><svg class="w-5 h-5 mr-1" fill="white" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h2V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2a2 2 0 0 1 2 2v14H3zm2-2h14V7a1 1 0 0 0-1-1h-2v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V6H4a1 1 0 0 0-1 1v12zm4-12V4h6v3H7z"/></svg></span> INSTITUCIONAL
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
                          <div id="institucional-dropdown" x-show="open" @click.away="open = false" x-cloak
                            class="absolute left-1/2 -translate-x-1/2 mt-8 max-w-screen-lg w-[54rem] bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 z-50 px-12 py-8 overflow-x-auto">
                <div class="grid grid-cols-3 gap-x-16 gap-y-3">
                  <a href="/sobre-ispbie" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Sobre o ISP-Bié</a>
                  <a href="/missao" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Missão</a>
                  <a href="/visao" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Visão</a>
                  <a href="/valores" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Valores</a>
                  <a href="/presidencia" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Órgãos de gestão</a>
                  <a href="/noticias" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Notícias</a>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-6 text-center">

                </div>
        </div>
      </div>
      <!-- Dropdown Extensão Universitária - Desktop -->
      <div x-data="{ openExt: false }" class="relative inline-block">
        <button @click="openExt = !openExt" @keydown.escape="openExt = false"
                class="flex items-center gap-1 text-white hover:text-[#FFD700] font-semibold uppercase text-xs tracking-wide"
                :aria-expanded="openExt ? 'true' : 'false'" aria-haspopup="true">
          <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
               <div x-show="openExt" @click.away="openExt = false" x-cloak
                 class="absolute left-0 mt-2 w-64 bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 z-50 p-2">
          <div class="grid grid-cols-1 gap-2">
            <a href="/cultura" class="block px-4 py-2 font-bold rounded hover:bg-[#2563eb] hover:text-white">Extensão Universitária</a>
            <a href="/estagios" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Estágios</a>
            <a href="/alumni" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Alumni</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <!-- Menu Mobile (off-canvas) -->
  <div id="mobile-menu" role="dialog" aria-modal="false" aria-label="Menu principal" x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-50 flex lg:hidden overflow-x-hidden w-full max-w-full">
    <!-- Fundo branco acessível -->
    <div class="absolute inset-0 bg-white opacity-95 backdrop-filter blur-lg" @click="mobileMenuOpen = false; openExtMobile = false; openMobile = false; openInfraMobile = false;"></div>
    <!-- Painel lateral com efeito glassmorphism, sombra e detalhes dourados -->
    <div class="relative ml-auto w-full max-w-xs h-full bg-white/70 shadow-2xl flex flex-col py-10 px-6 space-y-3 overflow-y-auto animate-slide-in-right border-l-4 border-[#FFD700] rounded-l-2xl text-base sm:text-sm z-[60]" style="backdrop-filter: blur(12px);">
      <button @click="mobileMenuOpen = false; openExtMobile = false; openMobile = false; openInfraMobile = false;" class="self-end text-gray-700 p-2 hover:bg-gray-100 rounded-lg mb-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Fechar menu">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      <!-- Links principais padronizados -->
      <a href="/cursos" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Ensino">
        <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="#2563eb"/><path d="M16 3v4M8 3v4" stroke="#2563eb"/></svg></span>
        <span>Ensino</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Pesquisa e Inovação">
        <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#2563eb"/><path d="M12 9v3l2 2" stroke="#2563eb"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <a href="/noticias" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Notícias">
        <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#2563eb"/><path d="M7 9h10M7 13h6" stroke="#2563eb"/></svg></span>
        <span>Notícias</span>
      </a>
      <a href="/candidaturas" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Candidaturas">
        <span>
          <svg class="w-7 h-7" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M9 12h6M9 16h6M9 8h6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
        <span>Candidaturas</span>
      </a>
      <!-- Dropdown Extensão Universitária - Mobile (padronizado) -->
      <div class="relative lg:hidden">
        <button @click="openExtMobile = !openExtMobile"
                class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded transition-colors w-full">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="7" width="16" height="10" rx="2" stroke="#2563eb"/><path d="M8 3v4M16 3v4" stroke="#2563eb"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
           <div x-show="openExtMobile" x-cloak
             class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2 z-[70]" style="position:relative;">
          <a href="/estagios" role="menuitem" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Estágios</a>
          <a href="/alumni" role="menuitem" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Alumni</a>
          </div>
      </div>
      

      <!-- Links extras -->
      <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Links Rápidos</h3>
        <a href="/contactos" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contacto">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" stroke="#2563eb"/><rect x="9" y="10" width="6" height="4" rx="1" stroke="#2563eb"/></svg></span>
          <span>Contacto</span>
        </a>
        <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" aria-label="Abrir Webmail (abre em nova aba)" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#2563eb"/><path d="M4 6l8 7 8-7" stroke="#2563eb"/></svg></span>
          <span>Webmail</span>
        </a>
        <a href="/servicos" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="10" rx="2" stroke="#2563eb"/><path d="M8 11h8" stroke="#2563eb"/></svg></span>
          <span>Serviços</span>
        </a>
        <a href="/presidencia" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="6" y="8" width="12" height="8" rx="2" stroke="#2563eb"/><path d="M12 4v4" stroke="#2563eb"/></svg></span>
          <span>Órgãos de Gestão</span>
        </a>
        <!-- ...primeiro dropdown Institucional removido... -->

        <!-- Dropdown Institucional - Mobile -->
        <div class="relative lg:hidden mt-2">
          <button @click="openMobile = !openMobile"
                  class="flex items-center gap-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded w-full font-semibold">
            <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="10" rx="2" stroke="#2563eb"/><path d="M8 3v4M16 3v4" stroke="#2563eb"/></svg></span>
            <span>Institucional</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div x-show="openMobile" x-cloak
            class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-4 grid grid-cols-2 gap-2">
            <a href="/sobre-ispbie" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Sobre o ISP-Bié</a>
            <a href="/missao" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Missão</a>
            <a href="/visao" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Visão</a>
            <a href="/valores" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Valores</a>
            <a href="/presidencia" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Órgãos de gestão</a>
            <a href="/noticias" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white">Notícias</a>
          </div>
        </div>

        <!-- Dropdown Infraestrutura Digital - Mobile -->
        <div class="relative lg:hidden mt-2">
          <button @click="openInfraMobile = !openInfraMobile"
                  class="flex items-center gap-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded w-full font-semibold">
            <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#2563eb"/><path d="M12 8v4l3 3" stroke="#2563eb"/></svg></span>
            <span>Infraestrutura Digital</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openInfraMobile" x-cloak
            class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2 text-sm">
            <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white font-semibold">Página de Sistemas</a>
            <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer" aria-label="Abrir SGF (abre em nova aba)" class="block px-3 py-2 rounded hover:bg-[#2563eb] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
              Sistema de Gestão de Facturas (SGF)
            </a>
          </div>
        </div>
      </div>
      
      <!-- Calendário e Guias - Mobile, mesmo nível -->
      <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Estudantes</h3>
        <a href="/calendario-academico" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#2563eb"/><path d="M7 9h10M7 13h6" stroke="#2563eb"/></svg></span>
          <span>Calendário Académico</span>
        </a>
        <a href="/guia-estudante" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#2563eb"/><path d="M8 10h8M8 14h6" stroke="#2563eb"/></svg></span>
          <span>Guia do Estudante</span>
        </a>
        <a href="/resultados" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="10" rx="2" stroke="#2563eb"/><path d="M8 11h8" stroke="#2563eb"/></svg></span>
          <span>Resultados de Exames</span>
        </a>
      </div>
    </div>
  </div>
</div>

<style>
    /* Prevent dropdown from being cut off at the screen edge */
    @media (max-width: 1200px) {
      .navbar-dropdown-large {
        max-width: 95vw !important;
        width: 95vw !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
      }
    }
  [x-cloak] { display: none !important; }
  
  .homepage-nav {
    background-color: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
  }
</style>

