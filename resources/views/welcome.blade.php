@extends('layouts.site')

@section('content')
<main id="main-content" tabindex="-1" role="main">

  <!-- Hero institucional moderno + carrossel contido -->
  <section class="relative w-full h-[46vh] sm:h-[50vh] md:h-[42vh] xl:h-[420px] overflow-hidden mt-0 pt-0">
    @if($totalSlides > 0)
      <div x-data="{ current: 0, slides: {{ $totalSlides }}, images: [@foreach($carrosseis as $c)'{{ asset('storage/' . $c->imagem) }}'@if(!$loop->last),@endif @endforeach] }"
           x-init="setInterval(() => { current = (current + 1) % slides }, 5000)"
           class="absolute inset-0">
        <template x-for="(img, idx) in images" :key="idx">
          <div x-show="current === idx" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-cover bg-center" :style="'background-image: url(' + img + ')'"></div>
        </template>
        <div class="absolute inset-0 bg-black/40"></div>
      </div>
      <div class="absolute inset-0 flex items-center">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 w-full">
          <div class="max-w-xs sm:max-w-md md:max-w-xl text-white text-left bg-black/2 rounded-xl p-4 sm:p-6 md:p-8 shadow-lg backdrop-blur-sm">
            <h1 class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl font-bold leading-tight mb-3 sm:mb-4 break-words">
              {{ $hero->titulo }}
            </h1>
            @if($hero->subtitulo)
            <p class="text-sm xs:text-base md:text-lg opacity-90 mb-4 sm:mb-6 break-words">
              {{ $hero->subtitulo }}
            </p>
            @endif
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full max-w-xs sm:max-w-none">
              @if($hero->link && $hero->texto_botao)
                <a href="{{ $hero->link }}"
                   class="inline-flex items-center justify-center
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold
                          px-4 py-2 sm:px-6 sm:py-3 rounded-md transition text-base sm:text-lg w-full sm:w-auto text-center">
                  {{ $hero->texto_botao }}
                </a>
              @elseif($hero->link)
                <a href="{{ $hero->link }}"
                   class="inline-flex items-center justify-center
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold
                          px-4 py-2 sm:px-6 sm:py-3 rounded-md transition text-base sm:text-lg w-full sm:w-auto text-center">
                  CONHEÇA MAIS
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>

    @endif
  </section>

  <!-- Seção de Ícones Institucionais: Missão, Visão, Valores, Pilares -->
<!-- Seção de Ícones Institucionais Compacta - Ícones 15 -->
<section class="py-4 bg-white border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-center">
      <a href="/missao" class="group flex flex-col items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#2563eb]/10 mb-2">
              <svg class="w-10 h-10 text-[#2563eb] group-hover:text-[#3B82F6] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
        </div>
        <span class="font-semibold text-base text-gray-800 group-hover:text-[#2563eb]">Missão</span>
      </a>
      <a href="/visao" class="group flex flex-col items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#2563eb]/10 mb-2">
              <svg class="w-10 h-10 text-[#2563eb] group-hover:text-[#3B82F6] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm0-10a4 4 0 100 8 4 4 0 000-8z"/></svg>
        </div>
        <span class="font-semibold text-base text-gray-800 group-hover:text-[#2563eb]">Visão</span>
      </a>
      <a href="/valores" class="group flex flex-col items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#2563eb]/10 mb-2">
              <svg class="w-10 h-10 text-[#2563eb] group-hover:text-[#3B82F6] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c2.54 0 4.71 1.61 5.5 4.09C13.79 4.61 15.96 3 18.5 3 21.58 3 24 5.42 24 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <span class="font-semibold text-base text-gray-800 group-hover:text-[#2563eb]">Valores</span>
      </a>
      <a href="/pilares" class="group flex flex-col items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#2563eb]/10 mb-2">
              <svg class="w-10 h-10 text-[#2563eb] group-hover:text-[#3B82F6] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M4 22h16V2H4v20zm2-2V4h12v16H6z"/></svg>
        </div>
        <span class="font-semibold text-base text-gray-800 group-hover:text-[#2563eb]">Pilares</span>
      </a>
    </div>
  </div>
</section>

    <!-- Barra azul com redes sociais e busca (estilo USP, ícones grandes, centralizados, azul do site) -->
    <div x-data="{ dark: false }" :class="dark ? 'bg-[#1a237e]' : 'bg-[#2563eb]'" class="py-4 transition-colors duration-500 relative">
      <!-- Botão modo escuro isolado -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
        <button @click="dark = !dark" type="button" aria-label="Alternar modo escuro" class="bg-white/80 hover:bg-white text-[#2563eb] font-bold px-3 py-2 rounded shadow transition-colors duration-300 flex items-center gap-2">
          <svg x-show="!dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364l-1.414 1.414M6.05 17.95l-1.414 1.414M17.95 17.95l-1.414-1.414M6.05 6.05L4.636 7.464"/></svg>
          <svg x-show="dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
          <span x-text="dark ? 'Modo claro' : 'Modo escuro'"></span>
        </button>
      </div>
      <!-- Conteúdo principal -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8 mt-6">
        <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 text-white w-full md:w-auto">
          <span class="font-bold text-lg md:text-xl">SIGA-NOS</span>
          <a href="https://www.facebook.com/search/top?q=instituto%20superior%20polit%C3%A9cnico%20do%20bi%C3%A9" target="_blank" rel="noopener" class="rounded-full bg-white shadow-xl hover:bg-[#2563eb]/20 hover:text-[#2563eb] transition-all transform hover:scale-110 flex items-center justify-center w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 border-2 border-white" aria-label="Facebook">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-[#2563eb] group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.linkedin.com/company/instituto-superior-polit%C3%A9cnico-do-bi%C3%A9" target="_blank" rel="noopener" class="rounded-full bg-white shadow-xl hover:bg-[#2563eb]/20 hover:text-[#2563eb] transition-all transform hover:scale-110 flex items-center justify-center w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 border-2 border-white" aria-label="LinkedIn">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-[#2563eb] group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="https://www.instagram.com/ispbie?igsh=MWpuaWVwMnYyN3c3OA==" target="_blank" rel="noopener" class="rounded-full bg-white shadow-xl hover:bg-[#2563eb]/20 hover:text-[#2563eb] transition-all transform hover:scale-110 flex items-center justify-center w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 border-2 border-white" aria-label="Instagram">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-[#2563eb] group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5" stroke="currentColor" stroke-width="2" fill="none"/>
              <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
              <circle cx="17" cy="7" r="1.5" fill="currentColor"/>
            </svg>
          </a>
          <a href="https://youtube.com/@ispbieoficial?si=s1somPSkOYJ2PxQC" target="_blank" rel="noopener" class="rounded-full bg-white shadow-xl hover:bg-[#2563eb]/20 hover:text-[#2563eb] transition-all transform hover:scale-110 flex items-center justify-center w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 border-2 border-white" aria-label="YouTube">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-[#2563eb] group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
        </div>
        <form action="/busca" method="GET" class="w-full md:w-1/3 max-w-md flex bg-white rounded-full shadow-lg mt-6 md:mt-0 border border-[#0E8F81] focus-within:ring-2 focus-within:ring-[#F05A28] transition-all duration-300">
          <input type="text" name="q" placeholder="Busca institucional..." aria-label="Pesquisar" class="flex-1 px-5 py-3 rounded-l-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#F05A28] bg-transparent text-lg" autocomplete="off">
          <button type="submit" class="px-5 py-3 rounded-r-full bg-[#F05A28] hover:bg-[#2563eb] text-white transition-colors duration-300 flex items-center" aria-label="Buscar">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </button>
        </form>
      </div>
    </div>
  </section>


  <!-- Seção Institucional -->

  <section class="py-8 bg-gray-100">
    <div class="w-full 2xl:max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-12">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 md:mb-8">Notícias Institucionais</h2>
      @component('components.noticias-carousel')
      @endcomponent
    </div>
  </section>

  <!-- Seção Acesso Rápido -->
  <section class="py-8 bg-white border-t border-gray-200">
    <div class="w-full 2xl:max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-12">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 md:mb-8">Acesso rápido</h2>
      
      <!-- Primeira linha -->
      <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-2 md:gap-4 2xl:gap-6 mb-4">
        
        <a href="/resultados" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Portal ISP-Bié">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-4h11v4zm0-5H4V9h11v4zm5 5h-4V9h4v9z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Portal ISP-Bié</span>
        </a>


        <a href="/contactos" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Contactos">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Contactos</span>
        </a>

        <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Webmail (abre em nova aba)">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Webmail</span>
        </a>

        <a href="/alumni" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Alumni">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Alumni</span>
        </a>

        <a href="/revista" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Artigos Científicos">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zM7 12h10v2H7zm0 4h7v2H7z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Artigos Científicos</span>
        </a>

        <a href="/biblioteca" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Biblioteca Digital">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Biblioteca Digital</span>
        </a>

        <a href="/repositorio" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Repositório Académico">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Repositório Académico</span>
        </a>
        <a href="/busca-pessoas" class="flex flex-col items-center group interactive-card rounded-xl shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F05A28]" aria-label="Busca Pessoas">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
              <circle cx="9.5" cy="9.5" r="1.5"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Busca Pessoas</span>
        </a>
      </div>
    </div>
  </section>



  <!-- Seção ISP-Bié em números -->

  <section id="estatisticas" class="py-8 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white scroll-reveal">
    <div class="w-full 2xl:max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-12">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-4 text-white drop-shadow-lg" style="text-shadow: 0 2px 8px #2563eb, 0 1px 0 #fff;">ISP-Bié em números</h2>
      <p class="text-lg mb-8 text-white opacity-100 font-semibold drop-shadow" style="text-shadow: 0 1px 6px #2563eb;">Fonte: Anuário Estatístico ISP-Bié 2024 (fonte de dados 2023).</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($estatisticas as $estatistica)
        <div class="text-center stat-card">
          <div class="text-xl font-extrabold mb-2 text-white drop-shadow" style="letter-spacing:-1px;">{{ $estatistica->titulo }}</div>
          <div class="text-5xl font-bold mb-3" data-counter data-target="{{ $estatistica->valor }}">{{ $estatistica->valor }}</div>
          <div class="text-lg mb-4">{!! nl2br(e($estatistica->descricao)) !!}</div>
          <div class="w-24 h-1 bg-white mx-auto shadow-lg" style="opacity:1;"></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Testemunhos - Carrossel Alpine.js -->
  <!-- Testemunhos -->
  <section class="py-8 bg-gray-50">
    <div class="w-full 2xl:max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-12">
      <div class="text-center mb-8">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Testemunhos
        </h2>
        <p class="text-xl text-gray-600">
          Saiba o que os nossos estudantes dizem sobre nós
        </p>
      </div>

      {{-- Enviar dados reais do admin para o JS --}}
      <script>
        window.TESTEMUNHOS = @json($testemunhos);
      </script>

      <div
        x-data="{
          current: 0,
          testimonials: window.TESTEMUNHOS || [],
          get total() { return this.testimonials.length },
          next() {
            if (this.total === 0) return;
            this.current = (this.current + 1) % this.total;
          },
          prev() {
            if (this.total === 0) return;
            this.current = (this.current - 1 + this.total) % this.total;
          },
          short(text) {
            if (!text) return 'Sem mensagem informada.';
            const maxWords = 15;
            const words = text.split(/\s+/);
            if (words.length > maxWords) {
              return words.slice(0, maxWords).join(' ') + '…';
            }
            return text;
          },
          autoplay: null,
          startAutoplay() {
            if (this.total <= 1) return;
            this.autoplay = setInterval(() => { this.next() }, 4000);
          },
          stopAutoplay() {
            if (this.autoplay) clearInterval(this.autoplay);
          }
        }"
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
        class="relative flex flex-col items-center"
      >
        <div class="w-full max-w-2xl overflow-visible">
          <div class="relative w-full max-w-2xl mx-auto min-h-[360px]">
            <template x-for="(item, idx) in testimonials" :key="item.id ?? idx">
              <div
                x-show="current === idx"
                x-transition:enter="transition-opacity duration-700"
                x-transition:enter-start="opacity-0 translate-x-8"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition-opacity duration-700"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 -translate-x-8"
                class="absolute top-0 left-0 w-full flex justify-center"
                style="min-height:320px;"
              >
                <div class="bg-white rounded-3xl shadow-lg p-8 md:p-10 flex flex-col items-center justify-between mx-auto min-h-[320px] max-w-xl w-full transition-shadow duration-300 hover:shadow-2xl">
                  <div class="flex flex-col items-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center text-white text-lg font-bold mb-4 shadow-md">
                      <span x-text="item.nome.substring(0,2).toUpperCase()"></span>
                    </div>
                    <div class="relative w-full">
                      <svg class="absolute -left-6 -top-2 w-8 h-8 text-[#2563eb] opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M7.17 6.17A7 7 0 0 1 13 19h-2a5 5 0 0 0-5-5V6.17z"/></svg>
                      <p class="text-lg md:text-xl text-gray-700 font-medium italic text-center px-4 leading-relaxed min-h-[72px]">
                        <span x-text="item.trabalha ? short(item.satisfacao || 'Sem mensagem informada.') : 'Procurando emprego.'"></span>
                      </p>
                      <svg class="absolute -right-6 -bottom-2 w-8 h-8 text-[#2563eb] opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M16.83 17.83A7 7 0 0 1 11 5h2a5 5 0 0 0 5 5v7.83z"/></svg>
                    </div>
                  </div>
                  <div class="mt-6 flex flex-col items-center w-full">
                    <h4 class="font-bold text-gray-900 text-lg md:text-xl text-center" x-text="item.nome"></h4>
                    <p class="text-sm md:text-base text-gray-500 text-center mt-1" x-text="(item.curso ? item.curso.replace(/\b\w/g, l => l.toUpperCase()) : 'Ex-Estudante')"></p>
                    <div class="flex items-center justify-center mt-3">
                      <div class="flex text-[#2563eb] text-base md:text-lg">★★★★★</div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>

        <!-- Indicadores de página (dots) -->
        <div class="flex justify-center mt-6 space-x-2">
          <template x-for="(item, idx) in testimonials" :key="idx">
            <button
              @click="current = idx"
              class="w-4 h-4 rounded-full border-2 border-[#3B82F6] transition duration-300 focus:outline-none"
              :class="current === idx ? 'bg-[#3B82F6] shadow-lg scale-110' : 'bg-gray-200 hover:bg-[#2563eb]/30'"
              :aria-label="'Ir para testemunho ' + (idx + 1)"
            ></button>
          </template>
        </div>
        <!-- Botões anterior/próximo removidos -->
      </div>
    </div>
  </section>
  </main>
@endsection