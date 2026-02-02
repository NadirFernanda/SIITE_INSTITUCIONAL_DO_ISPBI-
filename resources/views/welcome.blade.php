@extends('layouts.site')

@section('content')

  <!-- Carrossel dinâmico do painel administrativo -->
  <div class="scroll-reveal fade-in-up">
    @component('components.carrossel')
    @endcomponent
  </div>


  <!-- Seção Missão, Visão, Valores e Pilares Estratégicos (estilo USP) -->
  <section class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      <div class="flex flex-row items-end justify-center gap-8 md:gap-16 mb-8">
        <!-- Missão -->
        <div class="flex flex-col items-center">
          <a href="/missao" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#0E8F81] transition-colors">Missão</a>
          <a href="/missao" title="Ver Missão">
            <svg width="72" height="72" viewBox="0 0 72 72" fill="none" class="md:w-24 md:h-24">
              <path d="M16 28c0-4.418 3.582-8 8-8h8V12a4 4 0 1 1 8 0v8h8a8 8 0 0 1 8 8v8h8a4 4 0 1 1 0 8h-8v8a8 8 0 0 1-8 8h-8v8a4 4 0 1 1-8 0v-8h-8a8 8 0 0 1-8-8v-8H4a4 4 0 1 1 0-8h12v-8z" fill="#2563eb"/>
            </svg>
          </a>
        </div>
        <!-- Visão -->
        <div class="flex flex-col items-center">
          <a href="/visao" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#2C4A5E] transition-colors">Visão</a>
          <a href="/visao" title="Ver Visão">
            <svg width="72" height="72" viewBox="0 0 72 72" fill="none" class="md:w-24 md:h-24">
              <path d="M16 28c0-4.418 3.582-8 8-8h8V12a4 4 0 1 1 8 0v8h8a8 8 0 0 1 8 8v8h8a4 4 0 1 1 0 8h-8v8a8 8 0 0 1-8 8h-8v8a4 4 0 1 1-8 0v-8h-8a8 8 0 0 1-8-8v-8H4a4 4 0 1 1 0-8h12v-8z" fill="#2563eb"/>
            </svg>
          </a>
        </div>
        <!-- Valores -->
        <div class="flex flex-col items-center">
          <a href="/valores" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#F05A28] transition-colors">Valores</a>
          <a href="/valores" title="Ver Valores">
            <svg width="72" height="72" viewBox="0 0 72 72" fill="none" class="md:w-24 md:h-24">
              <path d="M16 28c0-4.418 3.582-8 8-8h8V12a4 4 0 1 1 8 0v8h8a8 8 0 0 1 8 8v8h8a4 4 0 1 1 0 8h-8v8a8 8 0 0 1-8 8h-8v8a4 4 0 1 1-8 0v-8h-8a8 8 0 0 1-8-8v-8H4a4 4 0 1 1 0-8h12v-8z" fill="#2563eb"/>
            </svg>
          </a>
        </div>
      </div>

        <!-- Pilares Estratégicos -->
        <div class="flex flex-col items-center w-full mt-12">
          <!-- Título -->
          <h2 class="text-2xl md:text-3xl font-bold text-gray-700 mb-8 text-center">Pilares Estratégicos</h2>
          <!-- Puzzle horizontal dos pilares -->
          <div class="flex flex-row flex-wrap justify-center gap-4 md:gap-8 w-full max-w-6xl">
            <!-- Ensino -->
            <div class="flex flex-col items-center">
              <a href="/pilares#ensino" class="group" title="Ver detalhes do pilar Ensino">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 40a10 10 0 0 1 10-10h10V20a10 10 0 1 1 20 0v10h10a10 10 0 0 1 10 10v20a10 10 0 0 1-10 10H20A10 10 0 0 1 10 60V40z" fill="#2563eb"/>
                </svg>
                <span class="absolute w-80 h-80 flex items-center justify-center text-white font-bold text-lg -mt-16 ml-0 group-hover:text-[#FFD700]" style="pointer-events:none;">E</span>
              </a>
              <a href="/pilares#ensino" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors mt-2">Ensino</a>
            </div>
            <!-- Investigação -->
            <div class="flex flex-col items-center">
              <a href="/pilares#investigacao" class="group" title="Ver detalhes do pilar Investigação">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 40a10 10 0 0 1 10-10h10V20a10 10 0 1 1 20 0v10h10a10 10 0 0 1 10 10v20a10 10 0 0 1-10 10H10A10 10 0 0 1 0 60V40z" fill="#2563eb"/>
                </svg>
                <span class="absolute w-80 h-80 flex items-center justify-center text-white font-bold text-lg -mt-16 ml-0 group-hover:text-[#FFD700]" style="pointer-events:none;">I</span>
              </a>
              <a href="/pilares#investigacao" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors mt-2">Investigação</a>
            </div>
            <!-- Extensão Universitária -->
            <div class="flex flex-col items-center">
              <a href="/pilares#extensao-universitaria" class="group" title="Ver detalhes do pilar Extensão Universitária">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 40a10 10 0 0 1 10-10h10V20a10 10 0 1 1 20 0v10h10a10 10 0 0 1 10 10v20a10 10 0 0 1-10 10H10A10 10 0 0 1 0 60V40z" fill="#2563eb"/>
                </svg>
                <span class="absolute w-80 h-80 flex items-center justify-center text-white font-bold text-lg -mt-16 ml-0 group-hover:text-[#FFD700]" style="pointer-events:none;">EU</span>
              </a>
              <a href="/pilares#extensao-universitaria" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors mt-2">Extensão Universitária</a>
            </div>
            <!-- Empreendedorismo e Inovação na Universidade -->
            <div class="flex flex-col items-center">
              <a href="/pilares#empreendedorismo-inovacao" class="group" title="Ver detalhes do pilar Empreendedorismo e Inovação na Universidade">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 40a10 10 0 0 1 10-10h10V20a10 10 0 1 1 20 0v10h10a10 10 0 0 1 10 10v20a10 10 0 0 1-10 10H10A10 10 0 0 1 0 60V40z" fill="#2563eb"/>
                </svg>
                <span class="absolute w-80 h-80 flex items-center justify-center text-white font-bold text-base -mt-16 ml-0 group-hover:text-[#FFD700]" style="pointer-events:none;">EIU</span>
              </a>
              <a href="/pilares#empreendedorismo-inovacao" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors mt-2">Empreendedorismo e Inovação<br>na Universidade</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Barra azul com redes sociais e busca (estilo USP, ícones grandes, centralizados, azul do site) -->
    <div class="bg-[#2563eb] py-8">
      <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="flex items-center gap-8 text-white text-3xl justify-center w-full md:w-auto">
          <span class="font-bold text-lg md:text-xl">SIGA-NOS</span>
          <a href="https://www.facebook.com/search/top?q=instituto%20superior%20polit%C3%A9cnico%20do%20bi%C3%A9" target="_blank" rel="noopener" class="hover:opacity-80 transition-opacity transform transition-transform hover:scale-110" aria-label="Facebook">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.linkedin.com/company/instituto-superior-polit%C3%A9cnico-do-bi%C3%A9" target="_blank" rel="noopener" class="hover:opacity-80 transition-opacity transform transition-transform hover:scale-110" aria-label="LinkedIn">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="https://www.instagram.com/ispbie?igsh=MWpuaWVwMnYyN3c3OA==" target="_blank" rel="noopener" class="hover:opacity-80 transition-opacity transform transition-transform hover:scale-110" aria-label="Instagram">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://youtube.com/@ispbieoficial?si=s1somPSkOYJ2PxQC" target="_blank" rel="noopener" class="hover:opacity-80 transition-opacity transform transition-transform hover:scale-110" aria-label="YouTube">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
        </div>
        <form action="/busca" method="GET" class="w-full md:w-1/3 flex bg-white rounded">
          <input type="text" name="q" placeholder="Busca" class="flex-1 px-4 py-2 rounded-l text-gray-800 focus:outline-none">
          <button type="submit" class="px-4 text-gray-600 hover:text-[#2563eb]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </section>


  <!-- Seção Institucional -->

  <section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-bold text-gray-900 mb-12">Notícias institucionais</h2>
      @component('components.noticias-carousel')
      @endcomponent
    </div>
  </section>

  <!-- Seção Acesso Rápido -->
  <section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-bold text-gray-900 mb-12">Acesso rápido</h2>
      
      <!-- Primeira linha -->
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6 mb-8">
        
        <a href="/portal" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-4h11v4zm0-5H4V9h11v4zm5 5h-4V9h4v9z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Portal ISP-Bié</span>
        </a>


        <a href="/ouvidoria" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Ouvidoria</span>
        </a>

        <a href="https://isp-bie.ao/webmail" target="_blank" rel="noopener" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Webmail</span>
        </a>

        <a href="/alumni" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Alumni</span>
        </a>

        <a href="/revista" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Revista Científica</span>
        </a>

        <a href="/biblioteca" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Biblioteca Digital</span>
        </a>

        <a href="/repositorio" class="flex flex-col items-center group interactive-card">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Repositório Académico</span>
        </a>
        <a href="/busca-pessoas" class="flex flex-col items-center group interactive-card">
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

  <section id="estatisticas" class="py-16 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-extrabold mb-4 text-white drop-shadow-lg" style="text-shadow: 0 2px 8px #2563eb, 0 1px 0 #fff;">ISP-Bié em números</h2>
      <p class="text-lg mb-12 text-white opacity-100 font-semibold drop-shadow" style="text-shadow: 0 1px 6px #2563eb;">Fonte: Anuário Estatístico ISP-Bié 2024 (fonte de dados 2023).</p>
      @php($estatisticas = \App\Models\Estatistica::orderBy('ordem')->get())
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
  <section class="py-16 pb-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
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
            const max = 360;
            return text.length > max ? text.slice(0, max) + '…' : text;
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
        <div class="w-full max-w-xl overflow-hidden">
          <div
            class="flex transition-transform duration-500 ease-out"
            :style="'transform: translateX(-' + (current * 100) + '%)'"
          >
            <template x-for="(item, idx) in testimonials" :key="item.id ?? idx">
              <div class="w-full max-w-xl flex-shrink-0">
                <div class="bg-white rounded-full shadow-md p-4 hover:shadow-xl transition-shadow flex flex-col items-center justify-center mx-auto"
                     :class="'h-40 w-40 md:h-32 md:w-32'">
                  <div class="flex flex-col items-center justify-center">
                    <div
                      class="w-20 h-20 md:w-16 md:h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center text-white text-xl font-bold mb-2"
                      x-text="item.nome.substring(0,2).toUpperCase()">
                    </div>
                    <h4 class="font-bold text-gray-900 text-center" x-text="item.nome"></h4>
                    <p class="text-sm text-gray-600 text-center"
                       x-text="(item.curso ? item.curso.replace(/\b\w/g, l => l.toUpperCase()) : 'Ex-Estudante')"></p>
                  </div>
                  <p class="text-gray-700 italic mt-2 text-center"
                     x-text="item.trabalha ? short(item.satisfacao || 'Sem mensagem informada.') : 'Procurando emprego.'">
                  </p>
                  <div class="flex items-center justify-center mt-2">
                    <div class="flex text-[#3B82F6]">★★★★★</div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>

        <!-- Botões carrossel bolinha -->
        <div class="flex justify-center mt-6 space-x-2">
          <template x-for="(item, idx) in testimonials" :key="idx">
            <button
              @click="current = idx"
              class="w-4 h-4 rounded-full transition border-2 border-[#3B82F6]"
              :class="current === idx ? 'bg-[#3B82F6]' : 'bg-gray-200'"
            ></button>
          </template>
        </div>
        <!-- Botões anterior/próximo -->
        <div class="flex w-full max-w-xl justify-between mt-4 mb-2">
          <button @click="prev"
            class="bg-white shadow px-4 py-2 rounded-full flex items-center justify-center" style="height:32px;width:32px;">
            ‹
          </button>
          <button @click="next"
            class="bg-white shadow px-4 py-2 rounded-full flex items-center justify-center" style="height:32px;width:32px;">
            ›
          </button>
        </div>
      </div>
    </div>
  </section>
@endsection