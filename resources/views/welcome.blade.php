@extends('layouts.site')

@section('content')

  <!-- Carrossel dinâmico do painel administrativo -->
  @component('components.carrossel')
  @endcomponent


  <!-- Seção Missão, Visão, Valores e Pilares Estratégicos (estilo USP) -->
  <section class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      <div class="flex flex-wrap items-end justify-between mb-8">
        <div class="flex flex-row space-x-3 md:space-x-12 items-end justify-between w-full">
          <div class="flex flex-col items-center flex-1">
            <a href="/missao" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#0E8F81] transition-colors">Missão</a>
            <a href="/missao" title="Ver Missão">
              <svg width="48" height="48" viewBox="0 0 80 80" fill="none" class="md:w-20 md:h-20"><rect width="80" height="80" rx="16" fill="#0E8F81"/><path d="M20 40h40v8H20z" fill="#fff"/></svg>
            </a>
          </div>
          <div class="flex flex-col items-center flex-1">
            <a href="/visao" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#2C4A5E] transition-colors">Visão</a>
            <a href="/visao" title="Ver Visão">
              <svg width="48" height="48" viewBox="0 0 80 80" fill="none" class="md:w-20 md:h-20"><rect width="80" height="80" rx="16" fill="#2C4A5E"/><path d="M20 40h40v8H20z" fill="#fff"/></svg>
            </a>
          </div>
          <div class="flex flex-col items-center flex-1">
            <a href="/valores" class="text-lg md:text-2xl font-bold text-gray-700 mb-2 hover:text-[#F05A28] transition-colors">Valores</a>
            <a href="/valores" title="Ver Valores">
              <svg width="48" height="48" viewBox="0 0 80 80" fill="none" class="md:w-20 md:h-20"><rect width="80" height="80" rx="16" fill="#F05A28"/><path d="M20 40h40v8H20z" fill="#fff"/></svg>
            </a>
          </div>
        </div>

        <!-- Pilares Estratégicos -->
        <div class="flex flex-col items-center w-full mt-12">
          <!-- Título -->
          <h2 class="text-2xl md:text-3xl font-bold text-gray-700 mb-8 text-center">Pilares Estratégicos</h2>

          <!-- Cards dos pilares -->
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 w-full max-w-6xl">
            <!-- Ensino -->
            <div class="flex flex-col items-center text-center">
              <a href="/pilares#ensino" class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#2563eb] flex items-center justify-center shadow-lg mb-4 hover:bg-blue-700 transition-colors" title="Ver detalhes do pilar Ensino">
                <span class="text-white font-bold text-base md:text-lg">E</span>
              </a>
              <a href="/pilares#ensino" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors">Ensino</a>
            </div>

            <!-- Investigação -->
            <div class="flex flex-col items-center text-center">
              <a href="/pilares#investigacao" class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#2563eb] flex items-center justify-center shadow-lg mb-4 hover:bg-blue-700 transition-colors" title="Ver detalhes do pilar Investigação">
                <span class="text-white font-bold text-base md:text-lg">I</span>
              </a>
              <a href="/pilares#investigacao" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors">Investigação</a>
            </div>

            <!-- Extensão Universitária -->
            <div class="flex flex-col items-center text-center">
              <a href="/pilares#extensao-universitaria" class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#2563eb] flex items-center justify-center shadow-lg mb-4 hover:bg-blue-700 transition-colors" title="Ver detalhes do pilar Extensão Universitária">
                <span class="text-white font-bold text-base md:text-lg">EU</span>
              </a>
              <a href="/pilares#extensao-universitaria" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors">Extensão Universitária</a>
            </div>

            <!-- Empreendedorismo e Inovação na Universidade -->
            <div class="flex flex-col items-center text-center">
              <a href="/pilares#empreendedorismo-inovacao" class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#2563eb] flex items-center justify-center shadow-lg mb-4 hover:bg-blue-700 transition-colors" title="Ver detalhes do pilar Empreendedorismo e Inovação na Universidade">
                <span class="text-white font-bold text-sm md:text-base">EIU</span>
              </a>
              <a href="/pilares#empreendedorismo-inovacao" class="text-gray-800 font-semibold text-base hover:text-[#2563eb] transition-colors">
                Empreendedorismo e Inovação<br>na Universidade
              </a>
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
          <a href="https://facebook.com" target="_blank" class="hover:opacity-80 transition-opacity" aria-label="Facebook">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://twitter.com" target="_blank" class="hover:opacity-80 transition-opacity" aria-label="Twitter">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
          </a>
          <a href="mailto:contacto@ispbie.ao" class="hover:opacity-80 transition-opacity" aria-label="Email">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </a>
          <a href="https://linkedin.com" target="_blank" class="hover:opacity-80 transition-opacity" aria-label="LinkedIn">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="https://instagram.com" target="_blank" class="hover:opacity-80 transition-opacity" aria-label="Instagram">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://youtube.com" target="_blank" class="hover:opacity-80 transition-opacity" aria-label="YouTube">
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
        
        <a href="/portal" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-4h11v4zm0-5H4V9h11v4zm5 5h-4V9h4v9z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Portal ISP-Bié</span>
        </a>


        <a href="/ouvidoria" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Ouvidoria</span>
        </a>

        <a href="/webmail" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Webmail</span>
        </a>

        <a href="/alumni" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Alumni</span>
        </a>

        <a href="/revista" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Revista Científica</span>
        </a>

        <a href="/biblioteca" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Biblioteca Digital</span>
        </a>

        <a href="/repositorio" class="flex flex-col items-center group">
          <div class="w-20 h-20 mb-3 text-[#2563eb] group-hover:text-[#2563eb] transition-colors">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-center text-gray-800 group-hover:text-[#2563eb]">Repositório Académico</span>
        </a>
        <a href="/busca-pessoas" class="flex flex-col items-center group">
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

  <!-- Seção Serviços ao Estudante -->
  <section class="py-16" style="background:#e0e7ff; color:#222;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-bold mb-4">Serviços ao Estudante</h2>
      <p class="text-lg mb-12 opacity-90">O ISP-Bié ao seu serviço</p>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Serviço 1: Apoio Psicológico -->
        <a href="/inclusao#apoio" class="group">
          <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 hover:bg-[#3b82f6] transition-all">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="background:#bcd0fa;">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Apoio Psicológico</h3>
            <p class="text-sm opacity-90">Gabinete de apoio à saúde mental e bem-estar estudantil</p>
          </div>
        </a>

        <!-- Serviço 2: Bolsas de Estudo -->
        <a href="/inclusao#bolsas" class="group">
          <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 hover:bg-[#3b82f6] transition-all">
            <div class="w-16 h-16" style="background:#bcd0fa;" class="rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Bolsas de Estudo</h3>
            <p class="text-sm opacity-90">Programas de apoio financeiro para estudantes</p>
          </div>
        </a>

        <!-- Serviço 3: Biblioteca -->
        <a href="/biblioteca" class="group">
          <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 hover:bg-[#3b82f6] transition-all">
            <div class="w-16 h-16" style="background:#bcd0fa;" class="rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Biblioteca</h3>
            <p class="text-sm opacity-90">Acesso a recursos bibliográficos e digitais</p>
          </div>
        </a>

        <!-- Serviço 4: Portal do Estudante -->
        <a href="/portal" class="group">
          <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 hover:bg-[#3b82f6] transition-all">
            <div class="w-16 h-16" style="background:#bcd0fa;" class="rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Portal do Estudante</h3>
            <p class="text-sm opacity-90">Acesso a notas, horários e serviços académicos</p>
          </div>
        </a>

      </div>
    </div>
  </section>


  <!-- Seção ISP-Bié em números -->

  <section id="estatisticas" class="py-16 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-extrabold mb-4 text-white drop-shadow-lg" style="text-shadow: 0 2px 8px #2563eb, 0 1px 0 #fff;">ISP-Bié em números</h2>
      <p class="text-lg mb-12 text-white opacity-100 font-semibold drop-shadow" style="text-shadow: 0 1px 6px #2563eb;">Fonte: Anuário Estatístico ISP-Bié 2024 (fonte de dados 2023).</p>
      @php($estatisticas = \App\Models\Estatistica::orderBy('ordem')->get())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($estatisticas as $estatistica)
        <div class="text-center">
          <div class="text-xl font-extrabold mb-2 text-white drop-shadow" style="letter-spacing:-1px;">{{ $estatistica->titulo }}</div>
          <div class="text-5xl font-bold mb-3">{{ $estatistica->valor }}</div>
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
          testimonials: window.TESTEMUNHOS,
          next() { this.current = (this.current + 1) % this.testimonials.length },
          prev() { this.current = (this.current - 1 + this.testimonials.length) % this.testimonials.length },
          verMais() {
            console.log('Ver mais testemunhos')
          },
          autoplay: null,
          startAutoplay() {
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

        <div class="relative w-full max-w-xl min-h-[220px]">
        <template x-for="(item, idx) in testimonials" :key="item.id ?? idx">
          <div
            x-show="current === idx"
            x-transition:enter="transform transition ease-out duration-500"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-500"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-full opacity-0"
            class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow w-full max-w-xl absolute inset-0"
          >
            <div class="flex items-center mb-4">
              <div
                class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6]
                       rounded-full flex items-center justify-center text-white
                       text-xl font-bold"
                x-text="item.nome.substring(0,2).toUpperCase()">
              </div>
              <div class="ml-4">
                <h4 class="font-bold text-gray-900" x-text="item.nome"></h4>
                <p class="text-sm text-gray-600"
                   x-text="(item.curso ? item.curso.replace(/\b\w/g, l => l.toUpperCase()) : 'Ex-Estudante')"></p>
              </div>
            </div>
            <p class="text-gray-700 italic mb-4"
               x-text="item.trabalha
                 ? (item.satisfacao || 'Sem mensagem informada.')
                 : 'Procurando emprego.'">
            </p>
            <div class="flex text-[#3B82F6]">★★★★★</div>
          </div>
        </template>
        </div>

        <!-- Botões -->
        <div class="flex w-full max-w-xl justify-between mt-4 mb-2">
          <button @click="prev"
            class="bg-white shadow px-4 py-2 rounded flex items-center justify-center" style="height:40px;">
            ‹
          </button>
          <button @click="next"
            class="bg-white shadow px-4 py-2 rounded flex items-center justify-center" style="height:40px;">
            ›
          </button>
        </div>
        <div class="flex justify-center mt-6 space-x-2">
          <template x-for="(item, idx) in testimonials" :key="idx">
            <button
              @click="current = idx"
              class="w-3 h-3 rounded-full transition"
              :class="current === idx ? 'bg-[#3B82F6]' : 'bg-gray-300'"
            ></button>
          </template>
        </div>
        <div class="flex justify-center mt-8">
          <button
            @click="verMais()"
            class="px-6 py-3 bg-[#3B82F6] text-white font-semibold rounded-lg hover:bg-[#2563eb] transition"
          >
            Ver mais testemunhos
          </button>
        </div>

      </div>
    </div>
  </section>
@endsection