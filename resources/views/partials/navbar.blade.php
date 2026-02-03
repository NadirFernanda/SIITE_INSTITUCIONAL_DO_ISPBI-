<header
  x-data="{
    mobile:false,
    institucional:false,
    infra:false
  }"
  class="w-full"
>

  <!-- BARRA INSTITUCIONAL (CINZA) – DESKTOP -->
  <div
    class="hidden md:flex items-center justify-between
           bg-gray-100 text-[#183153]
           text-base lg:text-[1.05rem]
           py-2 px-6 lg:px-12"
  >
    <!-- ESQUERDA -->
    <div class="flex items-center gap-4 flex-wrap">
      <a href="/contactos" class="hover:text-[#2563eb]">📷 Contacto</a>
      <a href="https://isp-bie.ao/webmail" target="_blank" class="hover:text-[#2563eb]">✉️ Webmail</a>
      <a href="/servicos" class="hover:text-[#2563eb]">🗞️ Serviços</a>
    </div>

    <!-- DIREITA -->
    <div class="flex items-center gap-4 flex-wrap">
      <!-- INFRAESTRUTURA DIGITAL -->
      <div class="relative">
        <button
          @click="infra = !infra"
          class="flex items-center gap-1 hover:text-[#2563eb]"
        >
          ⚙️ Infraestrutura Digital
          <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <div
          x-show="infra"
          @click.away="infra=false"
          x-cloak
          class="absolute right-0 mt-2 w-64
                 bg-white text-[#183153]
                 rounded-lg shadow-lg border z-50"
        >
          <a href="/sistemas" class="block px-4 py-2 hover:bg-[#2563eb] hover:text-white font-semibold">
            Página de Sistemas
          </a>
          <a href="https://sgf.isp-bie.ao/" target="_blank"
             class="block px-4 py-2 hover:bg-[#2563eb] hover:text-white">
            Sistema de Gestão de Facturas
          </a>
        </div>
      </div>

      <a href="/candidaturas" class="hover:text-[#2563eb]">📝 Candidaturas</a>
      <a href="/calendario-academico" class="hover:text-[#2563eb]">📅 Calendário</a>
      <a href="/guia-estudante" class="hover:text-[#2563eb]">📖 Guia</a>
      <a href="/resultados" class="hover:text-[#2563eb]">📊 Resultados</a>
    </div>
  </div>

  <!-- NAVBAR AZUL PRINCIPAL -->
  <div class="bg-[#2563eb] border-b border-blue-700">
    <div
      class="max-w-screen-2xl mx-auto
             flex items-center justify-between
             px-4 sm:px-6 lg:px-10 py-3"
    >

      <!-- LOGO + NOME -->
      <a href="/" class="flex items-center gap-3 min-w-0">
        <div class="bg-white rounded-lg shadow-md px-2 py-1 flex items-center justify-center">
          <img
            src="/images/logo.png"
            alt="ISP-Bié"
            class="w-9 h-9 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain"
          >
        </div>

        <span class="text-white font-bold
                     text-xs sm:text-sm md:text-base lg:text-xl
                     tracking-tight truncate">
          INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ
        </span>
      </a>

      <!-- BOTÃO MOBILE -->
      <button
        @click="mobile = true"
        class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10"
        aria-label="Abrir menu"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      <!-- MENU DESKTOP -->
      <nav class="hidden lg:flex items-center gap-6 uppercase text-xs font-semibold">
        <a href="/cursos" class="hover:text-[#FFD700] transition">Cursos</a>
        <a href="/investigacao" class="hover:text-[#FFD700] transition">Pesquisa e Inovação</a>

        <!-- INSTITUCIONAL -->
        <div class="relative">
          <button
            @click="institucional = !institucional"
            class="flex items-center gap-1 hover:text-[#FFD700] transition"
          >
            Institucional
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div
            x-show="institucional"
            @click.away="institucional=false"
            x-cloak
            class="absolute left-1/2 -translate-x-1/2 mt-4
                   w-80 bg-white text-[#183153]
                   rounded-lg shadow-xl border
                   p-4 grid grid-cols-2 gap-2 z-50"
          >
            <a href="/sobre-ispbie" class="dropdown-link">Sobre</a>
            <a href="/missao" class="dropdown-link">Missão</a>
            <a href="/visao" class="dropdown-link">Visão</a>
            <a href="/valores" class="dropdown-link">Valores</a>
            <a href="/presidencia" class="dropdown-link col-span-2 text-center">
              Órgãos de Gestão
            </a>
          </div>
        </div>

        <a href="/noticias" class="hover:text-[#FFD700] transition">Notícias</a>
      </nav>
    </div>
  </div>

  <!-- MENU MOBILE (OFF-CANVAS) -->
  <div
    x-show="mobile"
    x-cloak
    class="fixed inset-0 z-50 flex lg:hidden"
  >
    <!-- BACKDROP -->
    <div
      class="absolute inset-0 bg-black/40"
      @click="mobile=false"
    ></div>

    <!-- PAINEL -->
    <div
      class="relative ml-auto w-72 h-full
             bg-white shadow-xl
             p-6 space-y-4"
    >
      <button @click="mobile=false" class="text-right w-full font-bold">✕</button>

      <a href="/cursos" class="block font-semibold">Cursos</a>
      <a href="/investigacao" class="block font-semibold">Pesquisa e Inovação</a>
      <a href="/noticias" class="block font-semibold">Notícias</a>

      <hr>

      <a href="/contactos">Contacto</a>
      <a href="/calendario-academico">Calendário Académico</a>
      <a href="/guia-estudante">Guia do Estudante</a>
      <a href="/resultados">Resultados</a>
    </div>
  </div>

</header>

<style>
  [x-cloak] { display: none !important; }

  .dropdown-link {
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    transition: 0.2s;
  }
  .dropdown-link:hover {
    background: #2563eb;
    color: #fff;
  }
</style>
