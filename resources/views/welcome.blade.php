@extends('layouts.site')

@section('content')
<main id="main-content" tabindex="-1" role="main">

  {{-- ─────────────────────────────────────────────────────────────────
       HERO — Carrossel com setas, dots, conteúdo por slide
  ───────────────────────────────────────────────────────────────────── --}}
  @php
    $slidesJson = $totalSlides > 0
      ? $carrosseis->map(fn($c) => [
          'titulo'      => $c->titulo,
          'subtitulo'   => $c->subtitulo ?? '',
          'texto_botao' => $c->texto_botao ?? 'Conheça Mais',
          'link'        => $c->link ?? '',
          'imagem'      => asset('storage/' . $c->imagem),
        ])->toJson(JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP)
      : '[]';
  @endphp
  <section
    data-slides='{!! $slidesJson !!}'
    x-data="{
      current: 0,
      slides: [],
      get total() { return this.slides.length; },
      paused: false,
      init() {
        this.slides = JSON.parse(this.$el.dataset.slides || '[]');
        if (this.total > 1) setInterval(() => { if (!this.paused) this.next(); }, 6000);
      },
      next() { this.current = (this.current + 1) % this.total; },
      prev() { this.current = (this.current - 1 + this.total) % this.total; },
      goto(i)  { this.current = i; }
    }"
    @mouseenter="paused = true" @mouseleave="paused = false"
    class="relative w-full overflow-hidden h-[45vh] min-h-[220px] max-h-[350px] sm:h-[80vh] sm:min-h-[420px] sm:max-h-[900px]"
    aria-label="Carrossel de imagens institucionais">

    {{-- ── Slides de fundo ── --}}
    @if($totalSlides > 0)
      <template x-for="(slide, idx) in slides" :key="idx">
        <div x-show="current === idx"
             x-transition:enter="transition-opacity duration-1000"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-1000"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="absolute inset-0 w-full h-full bg-cover bg-center"
             :style="'background-image:url(' + slide.imagem + ')'"></div>
      </template>
    @else
      <div class="absolute inset-0 bg-gradient-to-br from-[#1e3a8a] to-[#1976d2]"></div>
    @endif

    {{-- ── Overlay escuro gradiente ── --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background:linear-gradient(to top,rgba(5,15,45,0.92) 0%,rgba(5,15,45,0.50) 50%,rgba(0,0,0,0.10) 100%);"></div>

    {{-- ── Seta Anterior ── --}}
    <button x-show="total > 1" @click="prev()" aria-label="Slide anterior"
            class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-20 hidden sm:flex items-center justify-center w-11 h-11 rounded-full text-white backdrop-blur-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#F05A28] bg-white/15 hover:bg-[rgba(240,90,40,0.85)] hover:scale-[1.08]"
            style="border:1px solid rgba(255,255,255,0.30);">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>

    {{-- ── Seta Seguinte ── --}}
    <button x-show="total > 1" @click="next()" aria-label="Próximo slide"
            class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-20 hidden sm:flex items-center justify-center w-11 h-11 rounded-full text-white backdrop-blur-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#F05A28] bg-white/15 hover:bg-[rgba(240,90,40,0.85)] hover:scale-[1.08]"
            style="border:1px solid rgba(255,255,255,0.30);">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- ── Conteúdo: texto + dots + counter ── --}}
    <div class="absolute inset-0 flex items-end z-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 w-full pb-6 sm:pb-10 md:pb-14 lg:pb-16">

        @if($totalSlides > 0)
        {{-- Texto reactivo ao slide actual --}}
        <div class="max-w-2xl">
          <div class="hidden sm:inline-flex items-center gap-2 mb-4 px-3 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase"
               style="background:rgba(240,90,40,0.18);border:1px solid rgba(240,90,40,0.55);color:#ffaa80;">
            <span class="w-1.5 h-1.5 rounded-full bg-[#F05A28] animate-pulse"></span>
            Instituto Superior Politécnico do Bié
          </div>
          <h1 x-text="slides[current] ? slides[current].titulo : ''"
              class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-white mb-3 sm:mb-4"
              style="text-shadow:0 2px 20px rgba(0,0,0,0.5);"></h1>
          <p x-show="slides[current] && slides[current].subtitulo"
             x-text="slides[current] ? slides[current].subtitulo : ''"
             class="text-sm sm:text-lg text-white/80 mb-5 sm:mb-7 leading-relaxed max-w-xl line-clamp-3 sm:line-clamp-none"></p>
          <div class="flex flex-wrap gap-2 sm:gap-3">
            <template x-if="slides[current] && slides[current].link">
              <a :href="slides[current].link"
                 class="inline-flex items-center gap-2 px-5 sm:px-7 py-2.5 sm:py-3 rounded-lg font-semibold text-white text-sm shadow-xl transition-all duration-200 bg-[#F05A28] hover:bg-[#d44d20] hover:-translate-y-0.5">
                <span x-text="slides[current].texto_botao || 'Conheça Mais'"></span>
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </a>
            </template>
            <a href="/cursos"
               class="hidden sm:inline-flex items-center gap-2 px-7 py-3 rounded-lg font-semibold text-white text-sm transition-all duration-200 bg-white/10 hover:bg-white/20"
               style="border:1.5px solid rgba(255,255,255,0.4);">
              Cursos Oferecidos
            </a>
          </div>
        </div>
        @else
        <div class="max-w-2xl">
          <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4" style="text-shadow:0 2px 20px rgba(0,0,0,0.5);">Instituto Superior Politécnico do Bié</h1>
          <a href="/cursos" class="inline-flex items-center gap-2 px-7 py-3 rounded-lg font-semibold text-white text-sm" style="background:#F05A28;">Conhecer os Cursos</a>
        </div>
        @endif



      </div>
    </div>
  </section>

  <!-- Barra institucional moderna -->
  <div style="background:linear-gradient(135deg,#1e3a8a 0%,#1565c0 60%,#1976d2 100%);border-bottom:3px solid #F05A28;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Mobile: coluna central com links + sociais. Desktop: linha única --}}
      <div class="flex flex-col items-center gap-3 py-3 sm:flex-row sm:justify-between sm:gap-2 sm:py-3">

        {{-- Links institucionais --}}
        <div class="flex items-center justify-between w-full sm:w-auto sm:justify-start gap-0.5 sm:gap-1 flex-nowrap">
          <a href="/missao" class="group flex items-center gap-1 sm:gap-1.5 px-1.5 sm:px-3 py-1 sm:py-2 rounded-lg transition-all duration-200 bg-white/10 hover:bg-[#F05A28]">  
            <div class="flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 rounded-full flex-shrink-0" style="background:rgba(255,255,255,0.2);">
              <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="white" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <span class="text-xs font-bold text-white tracking-wide">Missão</span>
          </a>
          <a href="/visao" class="group flex items-center gap-1 sm:gap-1.5 px-1.5 sm:px-3 py-1 sm:py-2 rounded-lg transition-all duration-200 bg-white/10 hover:bg-[#F05A28]">  
            <div class="flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 rounded-full flex-shrink-0" style="background:rgba(255,255,255,0.2);">
              <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="white" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
            </div>
            <span class="text-xs font-bold text-white tracking-wide">Visão</span>
          </a>
          <a href="/valores" class="group flex items-center gap-1 sm:gap-1.5 px-1.5 sm:px-3 py-1 sm:py-2 rounded-lg transition-all duration-200 bg-white/10 hover:bg-[#F05A28]">  
            <div class="flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 rounded-full flex-shrink-0" style="background:rgba(255,255,255,0.2);">
              <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="white" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c2.54 0 4.71 1.61 5.5 4.09C13.79 4.61 15.96 3 18.5 3 21.58 3 24 5.42 24 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <span class="text-xs font-bold text-white tracking-wide">Valores</span>
          </a>
          <a href="/pilares" class="group flex items-center gap-1 sm:gap-1.5 px-1.5 sm:px-3 py-1 sm:py-2 rounded-lg transition-all duration-200 bg-white/10 hover:bg-[#F05A28]">  
            <div class="flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 rounded-full flex-shrink-0" style="background:rgba(255,255,255,0.2);">
              <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="white" viewBox="0 0 24 24"><path d="M2 20h2V8H2v12zm4 0h2v-8H6v8zm4 0h2V4h-2v16zm4 0h2v-6h-2v6zm4 0h2V10h-2v10z"/></svg>
            </div>
            <span class="text-xs font-bold text-white tracking-wide">Pilares</span>
          </a>
        </div>

        {{-- Lado direito: sociais + busca --}}
        <div class="flex items-center justify-between w-full sm:w-auto sm:justify-end gap-2">

          {{-- Redes sociais --}}
          <div class="flex items-center gap-3 sm:gap-1">
            <a href="https://www.facebook.com/search/top?q=instituto%20superior%20polit%C3%A9cnico%20do%20bi%C3%A9" target="_blank" rel="noopener" aria-label="Facebook"
               class="flex items-center justify-center w-8 h-8 rounded-full transition-all duration-200 bg-white/[.18] hover:bg-[#F05A28] hover:scale-[1.15]">  
              <svg class="w-3.5 h-3.5" fill="white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="https://www.linkedin.com/company/instituto-superior-polit%C3%A9cnico-do-bi%C3%A9" target="_blank" rel="noopener" aria-label="LinkedIn"
               class="flex items-center justify-center w-8 h-8 rounded-full transition-all duration-200 bg-white/[.18] hover:bg-[#F05A28] hover:scale-[1.15]">  
              <svg class="w-3.5 h-3.5" fill="white" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <a href="https://www.instagram.com/ispbie?igsh=MWpuaWVwMnYyN3c3OA==" target="_blank" rel="noopener" aria-label="Instagram"
               class="flex items-center justify-center w-8 h-8 rounded-full transition-all duration-200 bg-white/[.18] hover:bg-[#F05A28] hover:scale-[1.15]">  
              <svg class="w-3.5 h-3.5" fill="white" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5" stroke="white" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="white" stroke-width="2" fill="none"/><circle cx="17" cy="7" r="1.5" fill="white"/></svg>
            </a>
            <a href="https://youtube.com/@ispbieoficial?si=s1somPSkOYJ2PxQC" target="_blank" rel="noopener" aria-label="YouTube"
               class="flex items-center justify-center w-8 h-8 rounded-full transition-all duration-200 bg-white/[.18] hover:bg-[#F05A28] hover:scale-[1.15]">  
              <svg class="w-3.5 h-3.5" fill="white" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
          </div>

          {{-- Separador (desktop only) --}}
          <div class="hidden sm:block w-px h-6 flex-shrink-0" style="background:rgba(255,255,255,0.3);"></div>

          {{-- Campo de busca --}}
          <form action="/busca" method="GET" class="flex items-center rounded-full overflow-hidden transition-all duration-300 bg-white/[.15] border border-white/30 focus-within:bg-white/25 focus-within:border-white/60">
            <svg class="w-3.5 h-3.5 ml-3 flex-shrink-0" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="opacity:0.7;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="q" placeholder="Pesquisar..." aria-label="Pesquisar"
                   class="bg-transparent text-white text-xs px-2 py-2 focus:outline-none w-24 sm:w-36" style="color:white;" autocomplete="off">
            <button type="submit" aria-label="Buscar" class="flex items-center justify-center h-full px-2.5 text-white transition-colors flex-shrink-0 bg-[#F05A28] hover:bg-[#d44d20]">
              <svg class="w-3 h-3" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
          </form>

        </div>

      </div>
    </div>
  </div>

  {{-- ─────────────────────────────────────────────────────────────────
       NOTÍCIAS EM DESTAQUE
  ───────────────────────────────────────────────────────────────────── --}}
  <section class="py-8 sm:py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div class="flex items-end justify-between mb-6 sm:mb-10">
        <div>
          <p class="text-xs font-bold tracking-widest uppercase mb-1" style="color:#F05A28;">Actualidade</p>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight">Notícias Institucionais</h2>
        </div>
        <a href="/noticias" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold transition-colors text-[#2563eb] hover:text-[#1e4db7]">
          Ver todas
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
      @component('components.noticias-carousel')
      @endcomponent
    </div>
  </section>

  {{-- ─────────────────────────────────────────────────────────────────
       ACESSO RÁPIDO
  ───────────────────────────────────────────────────────────────────── --}}
  <section class="py-8 sm:py-14 border-t border-gray-100" style="background:#f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div class="mb-6 sm:mb-10">
        <p class="text-xs font-bold tracking-widest uppercase mb-1" style="color:#F05A28;">Serviços</p>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Acesso Rápido</h2>
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-3 md:gap-4">

        <a href="/resultados" aria-label="Portal ISP-Bié"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-4h11v4zm0-5H4V9h11v4zm5 5h-4V9h4v9z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Portal ISP-Bié</span>
        </a>

        <a href="/contactos" aria-label="Contactos"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Contactos</span>
        </a>

        <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener noreferrer" aria-label="Webmail (abre em nova aba)"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Webmail</span>
        </a>

        <a href="/alumni" aria-label="Alumni"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Alumni</span>
        </a>

        <a href="/revista" aria-label="Artigos Científicos"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zM7 12h10v2H7zm0 4h7v2H7z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Artigos Científicos</span>
        </a>

        <a href="/biblioteca" aria-label="Biblioteca Digital"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Biblioteca Digital</span>
        </a>

        <a href="/repositorio" aria-label="Repositório Académico"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Repositório Académico</span>
        </a>

        <a href="/busca-pessoas" aria-label="Busca de Pessoas"
           class="flex flex-col items-center gap-2 p-3 sm:p-5 bg-white rounded-xl border border-gray-100 shadow-sm text-center focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 transition-all duration-[180ms] hover:-translate-y-1 hover:shadow-[0_10px_24px_rgba(37,99,235,0.13)] hover:border-[rgba(37,99,235,0.28)]">
          <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex-shrink-0" style="background:#eff6ff;">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#2563eb" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
          </div>
          <span class="text-xs font-semibold text-gray-700 leading-tight">Busca de Pessoas</span>
        </a>

      </div>
    </div>
  </section>



  {{-- ─────────────────────────────────────────────────────────────────
       ISP-BIÉ EM NÚMEROS
  ───────────────────────────────────────────────────────────────────── --}}
  <section id="estatisticas" class="py-10 sm:py-16 text-white scroll-reveal" style="background:linear-gradient(135deg,#1e3a8a 0%,#1565c0 60%,#1976d2 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div class="mb-12 text-center">
        <p class="text-xs font-bold tracking-widest uppercase mb-2" style="color:#ffaa80;">Dados Institucionais</p>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-2">ISP-Bié em números</h2>
        <p class="text-sm text-white/70 max-w-md mx-auto">Fonte: Anuário Estatístico ISP-Bié 2024 (dados referentes a 2023).</p>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @foreach($estatisticas as $estatistica)
        <div class="stat-card text-center rounded-2xl px-4 sm:px-8 py-6 sm:py-8" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);backdrop-filter:blur(4px);">
          <div class="text-xs sm:text-sm font-bold uppercase tracking-widest mb-2 sm:mb-3 text-white/70">{{ $estatistica->titulo }}</div>
          <div class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-2 sm:mb-3 text-white" data-counter data-target="{{ $estatistica->valor }}" style="letter-spacing:-2px;">{{ $estatistica->valor }}</div>
          <div class="w-12 h-0.5 mx-auto mb-3" style="background:rgba(240,90,40,0.8);"></div>
          <div class="text-sm text-white/80 leading-relaxed">{!! nl2br(e($estatistica->descricao)) !!}</div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ─────────────────────────────────────────────────────────────────
       TESTEMUNHOS
  ───────────────────────────────────────────────────────────────────── --}}
  <section class="py-10 sm:py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div class="text-center mb-8 sm:mb-12">
        <p class="text-xs font-bold tracking-widest uppercase mb-2" style="color:#F05A28;">Comunidade</p>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3">Testemunhos</h2>
        <p class="text-gray-500 text-base max-w-md mx-auto">O que os nossos estudantes dizem sobre nós</p>
      </div>

      {{-- Dados dos testemunhos para o Alpine via data attribute (sem inline script) --}}
      <div
        data-testimonials='@json($testemunhos)'
        x-data="{
          current: 0,
          testimonials: [],
          get total() { return this.testimonials.length },
          init() {
            this.testimonials = JSON.parse(this.$el.dataset.testimonials || '[]');
            this.startAutoplay();
          },
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
          <div class="relative w-full max-w-2xl mx-auto" style="min-height:clamp(260px,60vw,360px);">
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
                style="min-height:clamp(240px,55vw,320px);"
              >
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-5 sm:p-8 md:p-10 flex flex-col items-center justify-between mx-auto max-w-xl w-full transition-shadow duration-300 hover:shadow-2xl" style="min-height:clamp(240px,55vw,320px);">
                  <div class="flex flex-col items-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center text-white text-lg font-bold mb-4 shadow-md">
                      <span x-text="item.nome.substring(0,2).toUpperCase()"></span>
                    </div>
                    <div class="relative w-full">
                      <svg class="hidden sm:block absolute -left-6 -top-2 w-8 h-8 text-[#2563eb] opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M7.17 6.17A7 7 0 0 1 13 19h-2a5 5 0 0 0-5-5V6.17z"/></svg>
                      <p class="text-base sm:text-lg md:text-xl text-gray-700 font-medium italic text-center px-1 sm:px-4 leading-relaxed">
                        <span x-text="item.trabalha ? short(item.satisfacao || 'Sem mensagem informada.') : 'Procurando emprego.'"></span>
                      </p>
                      <svg class="hidden sm:block absolute -right-6 -bottom-2 w-8 h-8 text-[#2563eb] opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M16.83 17.83A7 7 0 0 1 11 5h2a5 5 0 0 0 5 5v7.83z"/></svg>
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

        <!-- Contador + botão ver mais -->
        <div class="flex flex-col items-center gap-3 mt-5">
          <p class="text-sm text-gray-400" x-text="(current + 1) + ' de ' + total + ' testemunhos'"></p>
          <a href="/alumni"
             class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white transition-all duration-200 shadow-md hover:shadow-lg bg-[#F05A28] hover:bg-[#d44d20] hover:-translate-y-px">
            Ver todos os testemunhos
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>
  </main>
@endsection