<!-- Barra de links importantes (azul escuro elegante) - Desktop apenas -->
<div class="hidden md:block" style="background:#183153;border-bottom:1px solid #1e293b;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-end py-2 space-x-4 text-xs overflow-x-auto">
      <a href="/calendario-academico" class="flex items-center space-x-1 text-gray-100 hover:text-[#60a5fa] transition-colors whitespace-nowrap">
        <span class="inline-block align-middle"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg></span>
        <span>Calendário Académico</span>
      </a>
      <a href="/guia-estudante" class="flex items-center space-x-1 text-gray-100 hover:text-[#60a5fa] transition-colors whitespace-nowrap">
        <span class="inline-block align-middle"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg></span>
        <span>Guia do Estudante</span>
      </a>
      <a href="/resultados" class="flex items-center space-x-1 text-gray-100 hover:text-[#60a5fa] transition-colors whitespace-nowrap">
        <span class="inline-block align-middle"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg></span>
        <span>Resultados de Exames</span>
      </a>
    </div>
  </div>
</div>

<!-- Barra inferior institucional em cinza claro - Desktop apenas -->
<div class="hidden md:flex" style="background:#f3f4f6;color:#183153;font-size:1rem;padding:4px 8px;align-items:center;justify-content:space-between;width:100%;">
  <div class="flex flex-wrap items-center gap-4">
    <a href="/contactos" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>📷</span> Contacto</a>
    <a href="/webmail" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>✉️</span> Webmail</a>
    <a href="/servicos" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>🗞️</span> Serviços</a>
  </div>
  <div class="flex flex-wrap items-center gap-4">
    <!-- <a href="/presidencia" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>🏛️</span> Órgãos de gestão</a> -->
    <a href="/cursos" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"><span>🦉</span> Cursos</a>

    <!-- Dropdown Infraestrutura Digital - Barra cinza (Desktop) -->
    <div x-data="{ openInfra: false }" class="relative">
      <button @click="openInfra = !openInfra" @keydown.escape="openInfra = false"
              class="flex items-center gap-1 hover:underline hover:text-[#2563eb]"
              :aria-expanded="openInfra ? 'true' : 'false'" aria-haspopup="true">
        <span>⚙️</span> Infraestrutura Digital
        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
      <div x-show="openInfra" @click.away="openInfra = false" x-cloak
           class="absolute right-0 mt-2 w-64 bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 z-50 p-2 text-sm">
        <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-gray-100 font-semibold">Página de Sistemas</a>
        <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener"
           class="block px-3 py-2 rounded hover:bg-gray-100">
          Sistema de Gestão de Facturas (SGF)
        </a>
      </div>
    </div>

    <a href="/candidaturas" class="flex items-center gap-1 hover:underline hover:text-[#2563eb]">
      <span>📝</span> Candidaturas
    </a>
  </div>
</div>

<!-- Bloco institucional com navbar + menu mobile no mesmo x-data -->
<div x-data="{ mobileMenuOpen: false }">
  <div class="w-full bg-[#2563eb]" style="background:#2563eb!important;color:#fff!important;">
    <div class="max-w-7xl mx-auto flex flex-row items-center justify-between px-3 sm:px-4 py-2">
    <!-- Logo e nome -->
    <a href="/" class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
      <img src="/images/logo.png" alt="ISP-Bié" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain flex-shrink-0" style="background:transparent!important;" onerror="this.style.display='none'">
      <span class="text-white font-bold text-xs sm:text-sm md:text-base lg:text-xl tracking-tight truncate">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
    </a>
    
    <!-- Botão hamburger (Mobile) -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white p-2 hover:bg-white/10 rounded-lg transition-colors flex-shrink-0">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    
    <!-- Menu principal (Desktop) -->
    <nav class="hidden lg:flex flex-row items-center space-x-4 xl:space-x-6">
      <a href="/cursos" class="flex items-center space-x-1 text-white font-semibold uppercase text-xs tracking-wide hover:text-[#FFD700] transition-colors whitespace-nowrap">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor"/><path d="M16 3v4M8 3v4" stroke="currentColor"/></svg></span>
        <span>Ensino</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-1 text-white font-semibold uppercase text-xs tracking-wide hover:text-[#FFD700] transition-colors whitespace-nowrap">
        <span><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m4 0a4 4 0 11-8 0 4 4 0 018 0z"/><path d="M12 12v2m0 4h.01"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <!-- Dropdown Institucional - Desktop -->
      <div x-data="{ open: false }" class="relative inline-block">
        <button @click="open = !open" @keydown.escape="open = false"
                class="flex items-center gap-1 text-white hover:text-[#FFD700] font-semibold uppercase text-xs tracking-wide"
                :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true">
          <span><svg class="w-5 h-5 mr-1" fill="white" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h2V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2a2 2 0 0 1 2 2v14H3zm2-2h14V7a1 1 0 0 0-1-1h-2v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V6H4a1 1 0 0 0-1 1v12zm4-12V4h6v3H7z"/></svg></span> INSTITUCIONAL
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
              <div x-show="open" @click.away="open = false" x-cloak
                   class="absolute left-1/2 -translate-x-1/2 mt-8 max-w-screen-lg w-[54rem] bg-[#183153] text-white rounded-lg shadow-lg border border-gray-700 z-50 px-12 py-8 overflow-x-auto">
                <div class="grid grid-cols-3 gap-x-16 gap-y-3">
                  <a href="/institucional" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Sobre o ISP-Bié</a>
                  <a href="/missao" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Missão</a>
                  <a href="/visao" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Visão</a>
                  <a href="/valores" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Valores</a>
                  <a href="/presidencia" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Órgãos de gestão</a>
                  <a href="/noticias" class="block px-0 py-1 rounded hover:bg-[#2563eb] hover:text-white">Comunicação</a>
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
             class="absolute left-0 mt-2 w-64 bg-[#183153] text-white rounded-lg shadow-lg border border-gray-700 z-50 p-2">
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
  <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-50 flex lg:hidden overflow-x-hidden w-full max-w-full">
    <!-- Fundo escuro institucional com gradiente -->
    <div class="absolute inset-0" style="background: linear-gradient(180deg, #2563eb 0%, #ffffff 100%); opacity: 0.96; backdrop-filter: blur(12px);" @click="mobileMenuOpen = false"></div>
    <!-- Painel lateral com efeito glassmorphism, sombra e detalhes dourados -->
    <div class="relative ml-auto w-full max-w-xs h-full bg-white/70 shadow-2xl flex flex-col py-8 px-5 space-y-2 overflow-y-auto animate-slide-in-right border-l-4 border-[#FFD700] rounded-l-2xl" style="backdrop-filter: blur(12px);">
      <button @click="mobileMenuOpen = false" class="self-end text-gray-700 p-2 hover:bg-gray-100 rounded-lg mb-2" aria-label="Fechar menu">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      <!-- Links principais -->
      <a href="/cursos" class="flex items-center space-x-3 py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-gray-800">
        <span><svg class="w-5 h-5" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor"/><path d="M16 3v4M8 3v4" stroke="currentColor"/></svg></span>
        <span>Ensino</span>
      </a>
      <a href="/investigacao" class="flex items-center space-x-3 py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-gray-800">
        <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#2563eb"/><path d="M12 9v3l2 2" stroke="#2563eb"/></svg></span>
        <span>Pesquisa e Inovação</span>
      </a>
      <!-- Dropdown Extensão Universitária - Mobile -->
      <div x-data="{ openExtMobile: false }" class="relative lg:hidden mt-2">
        <button @click="openExtMobile = !openExtMobile"
                class="flex items-center gap-3 py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-gray-800 w-full">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="7" width="16" height="10" rx="2" stroke="#2563eb"/><path d="M8 3v4M16 3v4" stroke="#2563eb"/></svg></span>
          <span>Extensão Universitária</span>
          <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="openExtMobile" @click.away="openExtMobile = false" x-cloak
             class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2">
          <a href="/cultura" class="block px-3 py-2 rounded hover:bg-gray-100 font-bold">Extensão Universitária</a>
          <a href="/alumni" class="block px-3 py-2 rounded hover:bg-gray-100">Alumni</a>
        </div>
      </div>
      <a href="/noticias" class="flex items-center space-x-3 py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-gray-800">
        <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#2563eb"/><path d="M7 9h10M7 13h6" stroke="#2563eb"/></svg></span>
        <span>Comunicação</span>
      </a>

      <!-- Links extras -->
      <div class="border-t border-gray-200 pt-4 mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Links Rápidos</h3>
        <a href="/contactos" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
          <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" stroke="#2563eb"/><rect x="9" y="10" width="6" height="4" rx="1" stroke="#2563eb"/></svg></span>
          <span>Contacto</span>
        </a>
        <a href="/webmail" class="flex items-center space-x-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded">
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
        <!-- Dropdown Institucional - Desktop -->
        <div x-data="{ open: false }" class="relative">
          <button @click="open = !open" @keydown.escape="open = false"
                  class="flex items-center gap-1 text-white hover:text-[#FFD700] font-semibold uppercase tracking-wide"
                  :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true">
            <span>🏢</span> Institucional
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <!-- Dropdown Menu -->
             <div x-show="open" @click.away="open = false" x-cloak
               class="absolute left-0 mt-8 w-96 bg-[#183153] text-white rounded-lg shadow-lg border border-gray-700 z-50 p-4">
            <div class="grid grid-cols-2 gap-2">
              <a href="/institucional" class="block px-4 py-2 font-bold rounded hover:bg-[#2563eb] hover:text-white">Sobre o ISP-Bié</a>
              <a href="/missao" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Missão</a>
              <a href="/visao" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Visão</a>
              <a href="/valores" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Valores</a>
              <!-- <a href="/presidencia" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Órgãos de gestão</a> -->
              <a href="/estatisticas" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white">Estatísticas</a>
              <a href="/transparencia" class="block px-4 py-2 rounded hover:bg-[#2563eb] hover:text-white col-span-2 text-center">Transparência</a>
            </div>
          </div>
        </div>

        <!-- Dropdown Institucional - Mobile -->
        <div x-data="{ openMobile: false }" class="relative lg:hidden mt-2">
          <button @click="openMobile = !openMobile"
                  class="flex items-center gap-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded w-full font-semibold">
            <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="10" rx="2" stroke="#2563eb"/><path d="M8 3v4M16 3v4" stroke="#2563eb"/></svg></span>
            <span>Institucional</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div x-show="openMobile" @click.away="openMobile = false" x-cloak
               class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-4 grid grid-cols-2 gap-2">
            <a href="/institucional" class="block px-3 py-2 rounded hover:bg-gray-100">Sobre o ISP-Bié</a>
            <a href="/missao" class="block px-3 py-2 rounded hover:bg-gray-100">Missão</a>
            <a href="/visao" class="block px-3 py-2 rounded hover:bg-gray-100">Visão</a>
            <a href="/valores" class="block px-3 py-2 rounded hover:bg-gray-100">Valores</a>
            <!-- <a href="/presidencia" class="block px-3 py-2 rounded hover:bg-gray-100">Órgãos de gestão</a> -->
            <a href="/estatisticas" class="block px-3 py-2 rounded hover:bg-gray-100">Estatísticas</a>
            <a href="/transparencia" class="block px-3 py-2 rounded hover:bg-gray-100">Transparência</a>
          </div>
        </div>

        <!-- Dropdown Infraestrutura Digital - Mobile -->
        <div x-data="{ openInfraMobile: false }" class="relative lg:hidden mt-2">
          <button @click="openInfraMobile = !openInfraMobile"
                  class="flex items-center gap-3 py-2 px-4 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded w-full font-semibold">
            <span><svg class="w-5 h-5" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7" stroke="#2563eb"/><path d="M12 8v4l3 3" stroke="#2563eb"/></svg></span>
            <span>Infraestrutura Digital</span>
            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div x-show="openInfraMobile" @click.away="openInfraMobile = false" x-cloak
               class="mt-2 w-full bg-white text-[#183153] rounded-lg shadow-lg border border-gray-200 p-2 grid grid-cols-1 gap-2 text-sm">
            <a href="/sistemas" class="block px-3 py-2 rounded hover:bg-gray-100 font-semibold">Página de Sistemas</a>
            <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener" class="block px-3 py-2 rounded hover:bg-gray-100">
              Sistema de Gestão de Facturas (SGF)
            </a>
          </div>
        </div>
      </div>
      
      <!-- Calendário e Guias -->
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

