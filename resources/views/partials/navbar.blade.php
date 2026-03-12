<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white text-[#1e3a5f] px-3 py-2 rounded shadow z-60">Saltar para o conteúdo</a>
<div class="block w-full fixed left-0 top-0" style="background:#2979FF;height:4px;z-index:52;"></div>
<div class="block w-full fixed left-0 top-0" style="background:#F05A28;height:4px;top:4px;z-index:51;"></div>

<!-- Barra inferior institucional - Desktop (agora em azul com texto branco) -->
<div class="hidden md:flex w-full" style="background:#0f1f3d;color:#ffffff;font-size:1.01rem;align-items:center;justify-content:space-between;max-width:100vw;margin:0 auto;min-height:36px;padding:7px 0;">
  <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
  <div class="flex flex-wrap items-center gap-2">
    <a href="/contactos" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contacto">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2l2 5 3-1 3 1 2-5h2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/></svg>
      Contacto
    </a>
    <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Abrir Webmail (abre em nova aba)">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Webmail
    </a>
    <a href="/servicos" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Serviços">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2 3h6a2 2 0 012 2v7a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Serviços
    </a>
  </div>
  <div class="flex flex-wrap items-center gap-2">
    <!-- <a href="/presidencia" class="flex items-center gap-1 hover:underline hover:text-[#F05A28]"><span>🏛️</span> Órgãos de gestão</a> -->

    <!-- Dropdown Infraestrutura Digital - Barra cinza (Desktop) -->
    <div x-data="{ openInfra: false }" class="relative">
              <button @click="openInfra = !openInfra" @keydown.escape="openInfra = false"
                class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
                :aria-expanded="openInfra ? 'true' : 'false'" aria-haspopup="true" aria-controls="infra-dropdown">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" stroke-linecap="round" stroke-linejoin="round"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2h-.5a2 2 0 01-2-2v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2v-.5a2 2 0 012-2h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82L2.4 4.83A2 2 0 015.23 2l.06.06a1.65 1.65 0 001.82.33h.01A1.65 1.65 0 019 2.88V3a2 2 0 012-2h.5a2 2 0 012 2v.09c.35.14.68.34 1 .6.33.28.62.6.86.95.25.36.44.75.57 1.17.13.42.2.86.2 1.31v.5a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33L19.4 4.83A2 2 0 0121.83 7.66l-.06.06a1.65 1.65 0 00-.33 1.82 1.65 1.65 0 001.51 1H21a2 2 0 012 2v.5a2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              Infraestrutura Digital
        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
            <div id="infra-dropdown" x-show="openInfra" @click.away="openInfra = false" x-cloak
              class="absolute right-0 mt-2 w-64 bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 z-50 p-2 text-sm">
        <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white font-semibold">Página de Sistemas</a>
        <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer" aria-label="Abrir SGF (abre em nova aba)"
          class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
          Sistema de Gestão de Facturas (SGF)
        </a>
      </div>
    </div>

      <a href="/candidaturas" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7h10M7 11h10M7 15h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Candidaturas
    </a>

    <!-- Links de estudantes movidos para a barra inferior -->
    <a href="/calendario-academico" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Calendário Académico
    </a>
    <a href="/guia-estudante" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 12v8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Guia do Estudante
    </a>
    <a href="/resultados" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v18h18" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 13v6M12 9v10M17 5v14" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Resultados de Exames
    </a>
  </div>
  </div>
</div>

<!-- Bloco institucional com navbar + menu mobile no mesmo x-data -->
<div x-data="{ mobileMenuOpen: false, openExtMobile: false, openMobile: false, openInfraMobile: false }">
  <div class="w-full bg-gray-800" style="background: #ffffff !important; color: #1e3a5f !important; border-bottom: 3px solid #F05A28 !important;">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex flex-row items-center justify-between py-1 sm:py-2">
    <!-- Logo e nome -->
    <a href="/" class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
      <div class="flex items-center justify-center rounded-md sm:rounded-lg shadow-sm px-1.5 py-0.5 sm:px-2 sm:py-1.5" style="background:transparent!important;">
        <img src="/images/logo.png" alt="ISP-Bié" class="w-6 h-6 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain flex-shrink-0" style="background:transparent!important;" onerror="this.style.display='none'">
      </div>
      <div class="min-w-0">
        <span class="block lg:hidden text-xs font-normal text-[#1e3a5f] truncate">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
      </div>
    </a>
    
    <!-- Botão hamburger (Mobile) -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen ? 'true' : 'false'" aria-controls="mobile-menu" aria-label="Abrir menu principal" class="lg:hidden text-[#1e3a5f] p-2 hover:bg-[#1e3a5f]/10 rounded-lg transition-colors flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    
    <!-- Menu principal (Desktop) -->
    <nav role="navigation" aria-label="Navegação principal" class="hidden lg:flex flex-row items-center space-x-4 xl:space-x-6 mb-0 pb-0 border-b-0">
      <a href="/cursos" class="flex items-center space-x-1 text-[#1e3a5f] font-normal uppercase text-sm tracking-wide hover:text-[#F05A28] transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Cursos">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor"/><path d="M16 3v4M8 3v4" stroke="currentColor"/></svg></span>
        <span>Cursos</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-1 text-[#1e3a5f] font-normal uppercase text-sm tracking-wide hover:text-[#F05A28] transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Pesquisa e Inovação">
        <span><svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <!-- Dropdown Institucional - Desktop -->
      <div x-data="{ open: false }" class="relative inline-block">
        <button @click="open = !open" @keydown.escape="open = false"
          class="flex items-center gap-1 text-[#1e3a5f] hover:text-[#F05A28] font-normal uppercase text-sm tracking-wide focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
          :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true" aria-controls="institucional-dropdown">
          <span><svg class="w-5 h-5 mr-1 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h2V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2a2 2 0 0 1 2 2v14H3zm2-2h14V7a1 1 0 0 0-1-1h-2v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V6H4a1 1 0 0 0-1 1v12zm4-12V4h6v3H7z"/></svg></span> INSTITUCIONAL
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
                          <div id="institucional-dropdown" x-show="open" @click.away="open = false" x-cloak
                            class="absolute left-1/2 -translate-x-1/2 mt-8 max-w-screen-lg w-[54rem] bg-[#1e3a5f] text-white rounded-lg shadow-lg border border-transparent z-50 px-12 py-8 overflow-x-auto">
                <div class="grid grid-cols-3 gap-x-16 gap-y-3">
                  <a href="/sobre-ispbie" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Sobre o ISP-Bié</a>
                  <a href="/missao" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Missão</a>
                  <a href="/visao" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Visão</a>
                  <a href="/valores" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Valores</a>
                  <a href="/presidencia" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Órgãos de gestão</a>
                  <a href="/noticias" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Notícias</a>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-6 text-center">

                </div>
        </div>
      </div>
      <!-- Dropdown Extensão Universitária - Desktop -->
      <div x-data="{ openExt: false }" class="relative inline-block">
        <button @click="openExt = !openExt" @keydown.escape="openExt = false"
          class="flex items-center gap-1 text-[#1e3a5f] hover:text-[#F05A28] font-normal uppercase text-sm tracking-wide"
                :aria-expanded="openExt ? 'true' : 'false'" aria-haspopup="true">
          <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
               <div x-show="openExt" @click.away="openExt = false" x-cloak
                 class="absolute left-0 mt-2 w-64 bg-[#1e3a5f] text-white rounded-lg shadow-lg border border-transparent z-50 p-2">
          <div class="grid grid-cols-1 gap-2">
            <a href="/cultura" class="block px-4 py-2 font-bold rounded hover:bg-[#1e3a5f] hover:text-white">Extensão Universitária</a>
            <a href="/estagios" class="block px-4 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Estágios</a>
            <a href="/alumni" class="block px-4 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Alumni</a>
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
      <a href="/cursos" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] font-normal text-base hover:text-[#F05A28] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Ensino">
        <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="#1e3a5f"/><path d="M16 3v4M8 3v4" stroke="#1e3a5f"/></svg></span>
        <span>Ensino</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] font-normal text-base hover:text-[#F05A28] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Pesquisa e Inovação">
        <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#1e3a5f"/><path d="M12 9v3l2 2" stroke="#1e3a5f"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <a href="/noticias" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] font-normal text-base hover:text-[#F05A28] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Notícias">
        <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#1e3a5f"/><path d="M7 9h10M7 13h6" stroke="#1e3a5f"/></svg></span>
        <span>Notícias</span>
      </a>
      <a href="/candidaturas" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] font-normal text-base hover:text-[#F05A28] hover:bg-gray-50 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Candidaturas">
        <span>
          <svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <rect x="3" y="5" width="18" height="12" rx="2" stroke="#1e3a5f" fill="none"/>
            <path d="M7 9h10M7 13h6" stroke="#1e3a5f" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
        <span>Candidaturas</span>
      </a>
      <!-- Dropdown Extensão Universitária - Mobile (padronizado) -->
      <div class="relative lg:hidden">
        <button @click="openExtMobile = !openExtMobile"
          class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] font-normal hover:text-[#F05A28] hover:bg-gray-50 rounded transition-colors w-full">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="7" width="16" height="10" rx="2" stroke="#1e3a5f"/><path d="M8 3v4M16 3v4" stroke="#1e3a5f"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
           <div x-show="openExtMobile" x-cloak
             class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2 z-[70]" style="position:relative;">
          <a href="/estagios" role="menuitem" class="block px-4 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Estágios</a>
          <a href="/alumni" role="menuitem" class="block px-4 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Alumni</a>
          </div>
      </div>
      

      <!-- Links extras -->
      <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Links Rápidos</h3>
        <a href="/contactos" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contacto">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" stroke="#1e3a5f"/><rect x="9" y="10" width="6" height="4" rx="1" stroke="#1e3a5f"/></svg></span>
          <span>Contacto</span>
        </a>
        <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" aria-label="Abrir Webmail (abre em nova aba)" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#1e3a5f"/><path d="M4 6l8 7 8-7" stroke="#1e3a5f"/></svg></span>
          <span>Webmail</span>
        </a>
        <a href="/servicos" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="10" rx="2" stroke="#1e3a5f"/><path d="M8 11h8" stroke="#1e3a5f"/></svg></span>
          <span>Serviços</span>
        </a>
        <a href="/presidencia" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="6" y="8" width="12" height="8" rx="2" stroke="#1e3a5f"/><path d="M12 4v4" stroke="#1e3a5f"/></svg></span>
          <span>Órgãos de Gestão</span>
        </a>
        <!-- ...primeiro dropdown Institucional removido... -->

        <!-- Dropdown Institucional - Mobile -->
        <div class="relative lg:hidden mt-2">
            <button @click="openMobile = !openMobile"
              class="flex items-center gap-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded w-full font-normal">
            <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="10" rx="2" stroke="#1e3a5f"/><path d="M8 3v4M16 3v4" stroke="#1e3a5f"/></svg></span>
            <span>Institucional</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div x-show="openMobile" x-cloak
            class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-4 grid grid-cols-2 gap-2">
            <a href="/sobre-ispbie" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Sobre o ISP-Bié</a>
            <a href="/missao" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Missão</a>
            <a href="/visao" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Visão</a>
            <a href="/valores" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Valores</a>
            <a href="/presidencia" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Órgãos de gestão</a>
            <a href="/noticias" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white">Notícias</a>
          </div>
        </div>

        <!-- Dropdown Infraestrutura Digital - Mobile -->
        <div class="relative lg:hidden mt-2">
            <button @click="openInfraMobile = !openInfraMobile"
              class="flex items-center gap-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded w-full font-normal">
            <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#1e3a5f"/><path d="M12 8v4l3 3" stroke="#1e3a5f"/></svg></span>
            <span>Infraestrutura Digital</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openInfraMobile" x-cloak
            class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2 text-sm">
            <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white font-semibold">Página de Sistemas</a>
            <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer" aria-label="Abrir SGF (abre em nova aba)" class="block px-3 py-2 rounded hover:bg-[#1e3a5f] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
              Sistema de Gestão de Facturas (SGF)
            </a>
          </div>
        </div>
      </div>
      
      <!-- Calendário e Guias - Mobile, mesmo nível -->
      <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Estudantes</h3>
        <a href="/calendario-academico" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#1e3a5f"/><path d="M7 9h10M7 13h6" stroke="#1e3a5f"/></svg></span>
          <span>Calendário Académico</span>
        </a>
        <a href="/guia-estudante" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#1e3a5f"/><path d="M8 10h8M8 14h6" stroke="#1e3a5f"/></svg></span>
          <span>Guia do Estudante</span>
        </a>
        <a href="/resultados" class="flex items-center space-x-3 py-2 px-4 text-[#1e3a5f] hover:text-[#F05A28] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="10" rx="2" stroke="#1e3a5f"/><path d="M8 11h8" stroke="#1e3a5f"/></svg></span>
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


