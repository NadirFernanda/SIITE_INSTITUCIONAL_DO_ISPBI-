<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white text-[#1e3a5f] px-3 py-2 rounded shadow z-60">Saltar para o conteúdo</a>

<header x-data="{ mobileMenuOpen: false, openExtMobile: false, openMobile: false, openInfraMobile: false, openInfra: false, openInst: false, openExt: false }"
        class="sticky top-0 z-50 shadow-sm">
  <!-- Barra de acento — topo da página -->
  <div style="background:#F05A28;height:3px;"></div>

  <!-- Barra de utilidade - Desktop -->
  <div class="hidden md:flex w-full" style="background:#0f1f3d;color:#ffffff;">
  <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between text-xs font-medium tracking-wide py-2">
  <div class="flex flex-wrap items-center gap-2">
    <a href="{{ route('contactos') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contacto">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2l2 5 3-1 3 1 2-5h2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/></svg>
      Contacto
    </a>
    <a href="http://mx100.angoweb.net/webmail" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Abrir Webmail (abre em nova aba)">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Webmail
    </a>
    <a href="{{ route('servicos') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Serviços">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2 3h6a2 2 0 012 2v7a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Serviços
    </a>
  </div>
  <div class="flex flex-wrap items-center gap-2">
    <!-- <a href="/presidencia" class="flex items-center gap-1 hover:underline hover:text-[#F05A28]"><span>🏛️</span> Órgãos de gestão</a> -->

    <!-- Dropdown Infraestrutura Digital - Barra cinza (Desktop) -->
    <div data-dd class="relative">
              <button @click.stop="openInfra = !openInfra; openInst = false; openExt = false" @keydown.escape="openInfra = false"
                class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
                :aria-expanded="openInfra ? 'true' : 'false'" aria-haspopup="true" aria-controls="infra-dropdown">
              <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8M12 17v4"/></svg>
              Infraestrutura Digital
        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
            <div id="infra-dropdown" x-show="openInfra" x-cloak
              class="absolute right-0 mt-2 w-64 bg-[#1e3a5f] text-white rounded-lg shadow-lg border border-transparent z-50 p-2 text-sm">
        <a href="{{ route('sistemas') }}" class="block px-3 py-2 rounded hover:bg-[#2a4d78] hover:text-white font-semibold">Página de Sistemas</a>
        <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer" aria-label="Abrir SGF (abre em nova aba)"
          class="block px-3 py-2 rounded hover:bg-[#2a4d78] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
          Sistema de Gestão de Facturas (SGF)
        </a>
      </div>
    </div>

      <a href="{{ route('candidaturas') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7h10M7 11h10M7 15h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Candidaturas
    </a>

    <!-- Links de estudantes movidos para a barra inferior -->
    <a href="{{ route('calendario-academico') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Calendário Académico
    </a>
    <a href="{{ route('guia-estudante') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 12v8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Guia do Estudante
    </a>
    <a href="{{ route('resultados') }}" class="flex items-center gap-1 text-[#a8c4e0] hover:underline hover:text-[#F05A28] whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v18h18" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 13v6M12 9v10M17 5v14" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Resultados de Exames
    </a>
    @auth
      @if(Auth::user()->hasRole('alumni') && Auth::user()->aprovado)
        <a href="{{ route('portal.dashboard') }}"
           class="flex items-center gap-1.5 px-3 py-1 rounded-md text-white font-bold text-xs whitespace-nowrap transition-opacity hover:opacity-90"
           style="background:#F05A28;">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Portal Alumni
        </a>
      @endif
    @else
      <a href="{{ route('portal.login') }}"
         class="flex items-center gap-1.5 px-3 py-1 rounded-md text-white font-bold text-xs whitespace-nowrap transition-opacity hover:opacity-90"
         style="background:#F05A28;">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        Portal Alumni
      </a>
    @endauth
  </div>
  </div>
</div>

  <!-- Barra institucional — logo + navegação -->
  <div class="w-full bg-white" style="border-bottom: 2px solid #F05A28;">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex flex-row items-center justify-between py-1 sm:py-2">
    <!-- Logo e nome -->
    <a href="{{ url('/') }}" class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
      <div class="flex items-center justify-center rounded-md sm:rounded-lg shadow-sm px-1.5 py-0.5 sm:px-2 sm:py-1.5" style="background:transparent!important;">
        <img src="/images/logo.png" alt="ISP-Bié" class="w-6 h-6 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain flex-shrink-0" style="background:transparent!important;" onerror="this.style.display='none'">
      </div>
      <div class="min-w-0">
        <span class="block lg:hidden text-[10px] font-semibold text-[#1e3a5f] uppercase tracking-widest truncate">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
      </div>
    </a>
    
    <!-- Botão hamburger (Mobile) -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen ? 'true' : 'false'" aria-controls="mobile-menu" aria-label="Abrir menu principal" class="lg:hidden text-[#1e3a5f] p-2 hover:bg-[#1e3a5f]/10 rounded-lg transition-colors flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    
    <!-- Menu principal (Desktop) -->
    <nav role="navigation" aria-label="Navegação principal" class="hidden lg:flex flex-row items-center space-x-4 xl:space-x-6 mb-0 pb-0 border-b-0">
      <a href="{{ route('cursos') }}" class="flex items-center space-x-1 font-semibold uppercase text-[13px] tracking-widest transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28] text-[#1e3a5f] hover:text-[#F05A28]" aria-label="Cursos">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor"/><path d="M16 3v4M8 3v4" stroke="currentColor"/></svg></span>
        <span>Cursos</span>
      </a>
      <a href="{{ route('investigacao') }}" class="flex items-center space-x-1 font-semibold uppercase text-[13px] tracking-widest transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28] text-[#1e3a5f] hover:text-[#F05A28]" aria-label="Pesquisa e Inovação">
        <span><svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <!-- Dropdown Institucional - Desktop -->
      <div data-dd class="relative inline-block">
        <button @click.stop="openInst = !openInst; openInfra = false; openExt = false" @keydown.escape="openInst = false"
          class="flex items-center gap-1 text-[#1e3a5f] hover:text-[#F05A28] font-semibold uppercase text-[13px] tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]"
          :aria-expanded="openInst ? 'true' : 'false'" aria-haspopup="true" aria-controls="institucional-dropdown">
          <span><svg class="w-5 h-5 mr-1 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h2V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2a2 2 0 0 1 2 2v14H3zm2-2h14V7a1 1 0 0 0-1-1h-2v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V6H4a1 1 0 0 0-1 1v12zm4-12V4h6v3H7z"/></svg></span> INSTITUCIONAL
          <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
                          <div id="institucional-dropdown" x-show="openInst" x-cloak
                            class="absolute left-1/2 -translate-x-1/2 mt-8 max-w-screen-lg w-[54rem] bg-[#1e3a5f] text-white rounded-lg shadow-lg border border-transparent z-50 px-12 py-8 overflow-x-auto">
                <div class="grid grid-cols-3 gap-x-16 gap-y-3">
                  <a href="{{ route('institucional') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Sobre o ISP-Bié</a>
                  <a href="{{ route('missao') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Missão</a>
                  <a href="{{ route('visao') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Visão</a>
                  <a href="{{ route('valores') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Valores</a>
                  <a href="{{ route('presidencia') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Órgãos de gestão</a>
                  <a href="{{ route('noticias') }}" class="block px-0 py-1 rounded hover:bg-[#1e3a5f] hover:text-white">Notícias</a>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-6 text-center">

                </div>
        </div>
      </div>
      <!-- Dropdown Extensão Universitária - Desktop -->
      <div data-dd class="relative inline-block">
        <button @click.stop="openExt = !openExt; openInfra = false; openInst = false" @keydown.escape="openExt = false"
          class="flex items-center gap-1 text-[#1e3a5f] hover:text-[#F05A28] font-semibold uppercase text-[13px] tracking-widest"
                :aria-expanded="openExt ? 'true' : 'false'" aria-haspopup="true">
          <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
               <div x-show="openExt" x-cloak
                 class="absolute left-0 mt-2 w-64 bg-[#1e3a5f] text-white rounded-lg shadow-lg border border-transparent z-50 p-2">
          <div class="grid grid-cols-1 gap-2">
            <a href="{{ route('cultura') }}" class="block px-4 py-2 rounded hover:bg-[#2a4d78] hover:text-white">Cultura e Extensão</a>
            <a href="{{ route('estagios') }}" class="block px-4 py-2 rounded hover:bg-[#2a4d78] hover:text-white">Estágios</a>
            <a href="{{ route('alumni') }}" class="block px-4 py-2 rounded hover:bg-[#2a4d78] hover:text-white">Alumni</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  
  <!-- ═══════════════════════════════════════════════════════════
       MENU MOBILE — off-canvas lateral
       ═══════════════════════════════════════════════════════════ -->
  <div id="mobile-menu"
       role="dialog" aria-modal="true" aria-label="Menu principal"
       x-show="mobileMenuOpen" x-cloak
       class="fixed inset-0 z-[100] flex lg:hidden">

    {{-- Overlay escuro semi-transparente, fecha ao clicar --}}
    <div class="absolute inset-0 bg-black/40 transition-opacity duration-300"
         @click="mobileMenuOpen = false; openExtMobile = false; openMobile = false; openInfraMobile = false;"
         aria-hidden="true"></div>

    {{-- Painel lateral direito --}}
    <div class="relative ml-auto w-[min(88vw,360px)] h-full bg-white shadow-2xl flex flex-col overflow-hidden"
         style="border-left: 3px solid #F05A28;">

      {{-- ── Header do painel ── --}}
      <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100" style="background:#0f1f3d;">
        <div class="flex items-center gap-2">
          <img src="/images/logo.png" alt="ISP-Bié" class="w-8 h-8 object-contain" onerror="this.style.display='none'">
          <span class="text-white text-[11px] font-bold uppercase tracking-widest leading-tight">ISP-Bié</span>
        </div>
        <button @click="mobileMenuOpen = false; openExtMobile = false; openMobile = false; openInfraMobile = false;"
                class="text-white/80 hover:text-white p-1.5 rounded-md hover:bg-white/10 transition-colors focus:outline-none focus:ring-2 focus:ring-white/50"
                aria-label="Fechar menu">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      {{-- ── Corpo com scroll ── --}}
      <nav class="flex-1 overflow-y-auto py-3" role="navigation" aria-label="Menu mobile">

        {{-- Macro helper: link simples --}}
        {{-- ── Secção PRINCIPAL ── --}}
        <p class="px-5 pt-2 pb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">Principal</p>

        <a href="{{ route('cursos') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors rounded-none focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5 12.083 12.083 0 015.84 10.578L12 14z"/>
          </svg>
          <span>Cursos</span>
        </a>

        <a href="{{ route('investigacao') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
          </svg>
          <span>Pesquisa e Inovação</span>
        </a>

        <a href="{{ route('noticias') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" d="M7 9h10M7 13h6"/>
          </svg>
          <span>Notícias</span>
        </a>

        <a href="{{ route('candidaturas') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4M7 4H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-2M9 4a2 2 0 002 2h2a2 2 0 002-2M9 4a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
          <span>Candidaturas</span>
        </a>

        {{-- ── Dropdown: Institucional ── --}}
        <div>
          <button @click="openMobile = !openMobile"
                  class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors w-full focus:outline-none focus:bg-orange-50">
            <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V8a2 2 0 012-2h4V3h6v3h4a2 2 0 012 2v13H3z"/>
            </svg>
            <span>Institucional</span>
            <svg class="w-4 h-4 ml-auto text-gray-400 transition-transform duration-200 flex-shrink-0" :class="openMobile ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openMobile" x-cloak
               x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
               class="bg-gray-50 border-y border-gray-100">
            <a href="{{ route('institucional') }}" class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Sobre o ISP-Bié</a>
            <a href="{{ route('missao') }}"       class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Missão</a>
            <a href="{{ route('visao') }}"        class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Visão</a>
            <a href="{{ route('valores') }}"      class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Valores</a>
            <a href="{{ route('presidencia') }}"  class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Órgãos de Gestão</a>
          </div>
        </div>

        {{-- ── Dropdown: Extensão Universitária ── --}}
        <div>
          <button @click="openExtMobile = !openExtMobile"
                  class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors w-full focus:outline-none focus:bg-orange-50">
            <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
            </svg>
            <span>Extensão Universitária</span>
            <svg class="w-4 h-4 ml-auto text-gray-400 transition-transform duration-200 flex-shrink-0" :class="openExtMobile ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openExtMobile" x-cloak
               x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
               class="bg-gray-50 border-y border-gray-100">
            <a href="{{ route('cultura') }}"   class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Cultura e Extensão</a>
            <a href="{{ route('estagios') }}"  class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Estágios</a>
            <a href="{{ route('alumni') }}"    class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Alumni</a>
          </div>
        </div>

        {{-- ── Dropdown: Infraestrutura Digital ── --}}
        <div>
          <button @click="openInfraMobile = !openInfraMobile"
                  class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors w-full focus:outline-none focus:bg-orange-50">
            <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8M12 17v4"/>
            </svg>
            <span>Infraestrutura Digital</span>
            <svg class="w-4 h-4 ml-auto text-gray-400 transition-transform duration-200 flex-shrink-0" :class="openInfraMobile ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openInfraMobile" x-cloak
               x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
               class="bg-gray-50 border-y border-gray-100">
            <a href="{{ route('sistemas') }}" class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">Página de Sistemas</a>
            <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener noreferrer"
               class="mobile-sub-link flex items-center gap-2 pl-12 pr-5 py-2.5 text-sm text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors">
              SGF — Gestão de Facturas
              <svg class="w-3 h-3 ml-auto flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
          </div>
        </div>

        {{-- ── Separador: Estudantes ── --}}
        <div class="mx-5 my-3 border-t border-gray-100"></div>
        <p class="px-5 pb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">Estudantes</p>

        <a href="{{ route('calendario-academico') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/>
          </svg>
          <span>Calendário Académico</span>
        </a>

        <a href="{{ route('guia-estudante') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"/>
          </svg>
          <span>Guia do Estudante</span>
        </a>

        <a href="{{ route('resultados') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/><path stroke-linecap="round" d="M7 13v6M12 9v10M17 5v14"/>
          </svg>
          <span>Resultados de Exames</span>
        </a>

        {{-- ── Separador: Links Rápidos ── --}}
        <div class="mx-5 my-3 border-t border-gray-100"></div>
        <p class="px-5 pb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">Links Rápidos</p>

        <a href="{{ route('contactos') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3l2 4-3 2a11 11 0 005 5l2-3 4 2v3a2 2 0 01-2 2A16 16 0 013 5z"/>
          </svg>
          <span>Contacto</span>
        </a>

        <a href="http://mx100.angoweb.net/webmail" target="_blank" rel="noopener noreferrer"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <rect x="2" y="4" width="20" height="16" rx="2"/><path stroke-linecap="round" d="M2 7l10 7 10-7"/>
          </svg>
          <span>Webmail</span>
          <svg class="w-3 h-3 ml-auto flex-shrink-0 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>

        <a href="{{ route('servicos') }}"
           class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
          <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
          <span>Carta de Serviços</span>
        </a>

        {{-- ── Portal Alumni ── --}}
        <div class="mx-5 my-3 border-t border-gray-100"></div>
        <p class="px-5 pb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">Alumni</p>

        @auth
          @if(Auth::user()->hasRole('alumni') && Auth::user()->aprovado)
            <a href="{{ route('portal.dashboard') }}"
               class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#F05A28] hover:bg-orange-50 transition-colors focus:outline-none focus:bg-orange-50">
              <svg class="w-4 h-4 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span class="font-semibold">Portal Alumni</span>
            </a>
          @endif
        @else
          <a href="{{ route('portal.login') }}"
             class="mobile-nav-link group flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-[#1e3a5f] hover:bg-orange-50 hover:text-[#F05A28] transition-colors focus:outline-none focus:bg-orange-50">
            <svg class="w-4 h-4 flex-shrink-0 text-gray-400 group-hover:text-[#F05A28] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <span>Portal Alumni — Entrar</span>
          </a>
        @endauth

        {{-- Espaçamento no fundo do scroll --}}
        <div class="h-6"></div>
      </nav>

      {{-- ── Rodapé do painel ── --}}
      <div class="px-5 py-3 border-t border-gray-100 bg-gray-50 flex items-center gap-2">
        <div class="w-1.5 h-1.5 rounded-full bg-[#F05A28]"></div>
        <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Instituto Superior Politécnico do Bié</span>
      </div>
    </div>
  </div>
</header>

<style>
  [x-cloak] { display: none !important; }

  /* Linha esquerda colorida nos links activos do mobile */
  .mobile-nav-link:focus-visible {
    outline: 2px solid #F05A28;
    outline-offset: -2px;
  }

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

  .homepage-nav {
    background-color: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
  }
</style>




