@extends('layouts.site')


@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    <nav class="text-sm opacity-80 mb-10">
      <a href="/" class="hover:underline text-[#2563eb]">Início</a> <span class="mx-2 text-gray-400">/</span> <span class="font-semibold text-gray-700">Sistemas</span>
    </nav>
    <div class="bg-white rounded-2xl shadow-xl p-10 mb-14 interactive-card border-t-8 border-[#2563eb]">
      <h1 class="text-4xl md:text-5xl font-extrabold text-[#2563eb] mb-3 tracking-tight">Sistemas Institucionais</h1>
      <p class="text-xl text-gray-700 mb-2">Plataformas e Serviços Digitais do ISP-Bié</p>
      <p class="text-base text-gray-500">Acesso centralizado aos principais sistemas acadêmicos, administrativos e de suporte.</p>
    </div>

  <!-- Introdução -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-5">Infraestrutura Digital</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-2">
          O ISP-Bié disponibiliza sistemas e plataformas digitais para facilitar o acesso a serviços, informações e recursos acadêmicos. Desenvolvidos com foco em eficiência, segurança e facilidade de uso.
        </p>
      </div>
      <div class="flex justify-center items-center mb-10">
        <div class="w-full max-w-2xl border-t-4 border-dashed border-[#2563eb] opacity-40"></div>
      </div>
    </div>
  </section>

  <!-- Sistemas Académicos -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-14 text-center">Sistemas Académicos</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        
        <!-- Portal do Estudante -->
        <div class="bg-white rounded-2xl shadow-lg flex flex-col h-full min-h-[420px] w-full hover:scale-[1.03] transition-transform duration-200 interactive-card">
          <div class="flex flex-col items-center justify-center bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-8 pb-4" style="min-height:180px; width:100%;">
            <svg class="w-16 h-16 mb-2 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
            <h3 class="text-2xl font-bold text-white mb-1 tracking-tight">Portal do Estudante</h3>
            <p class="text-white text-sm opacity-90 mb-2">Sistema Académico Online</p>
          </div>
          <div class="flex-1 flex flex-col justify-between p-7">
            <ul class="space-y-3 text-gray-700 mb-7">
              <li class="flex items-center gap-2">
                   <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Consulta de notas e frequências
              </li>
              <li class="flex items-center gap-2">
                   <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Matrícula e inscrição em disciplinas
              </li>
              <li class="flex items-center gap-2">
                   <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Histórico académico
              </li>
              <li class="flex items-center gap-2">
                 <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Horários e calendário académico
              </li>
            </ul>
            <div class="mt-auto">
              <a href="#" class="w-full block text-center bg-[#2563eb] text-white py-3 rounded-xl font-semibold shadow hover:bg-[#3B82F6] transition-colors focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-label="Aceder ao Portal do Estudante">
                Aceder ao Portal
              </a>
            </div>
          </div>
        </div>

        <!-- Biblioteca Digital -->
        <div class="bg-white rounded-2xl shadow-lg flex flex-col h-full min-h-[420px] w-full hover:scale-[1.03] transition-transform duration-200 interactive-card">
          <div class="flex flex-col items-center justify-center bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-8 pb-4" style="min-height:180px; width:100%;">
            <svg class="w-16 h-16 mb-2 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
            </svg>
            <h3 class="text-2xl font-bold text-white mb-1 tracking-tight">Biblioteca Digital</h3>
            <p class="text-white text-sm opacity-90 mb-2">Acervo Online</p>
          </div>
          <div class="flex-1 flex flex-col justify-between p-7">
            <ul class="space-y-3 text-gray-700 mb-7">
              <li class="flex items-center gap-2">
                 <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Catálogo online de livros
              </li>
              <li class="flex items-center gap-2">
                 <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Reserva e renovação de empréstimos
              </li>
              <li class="flex items-center gap-2">
                 <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Acesso a periódicos e artigos
              </li>
              <li class="flex items-center gap-2">
                 <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                E-books e recursos digitais
              </li>
            </ul>
            <div class="mt-auto">
              <a href="/biblioteca" class="w-full block text-center bg-[#2563eb] text-white py-3 rounded-xl font-semibold shadow hover:bg-[#3B82F6] transition-colors focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-label="Aceder à Biblioteca Digital">
                Aceder à Biblioteca
              </a>
            </div>
          </div>
        </div>

        <!-- Repositório Institucional -->
        <div class="bg-white rounded-2xl shadow-lg flex flex-col h-full min-h-[420px] w-full hover:scale-[1.03] transition-transform duration-200 interactive-card">
          <div class="flex flex-col items-center justify-center bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-8 pb-4" style="min-height:180px; width:100%;">
            <svg class="w-16 h-16 mb-2 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2h-1.528A6 6 0 004 9.528V4z"/>
              <path fill-rule="evenodd" d="M8 10a4 4 0 00-3.446 6.032l-1.261 1.26a1 1 0 101.414 1.415l1.261-1.261A4 4 0 108 10zm-2 4a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-2xl font-bold text-white mb-1 tracking-tight">Repositório</h3>
            <p class="text-white text-sm opacity-90 mb-2">Produção Científica</p>
          </div>
          <div class="flex-1 flex flex-col justify-between p-7">
            <ul class="space-y-3 text-gray-700 mb-7">
              <li class="flex items-center gap-2">
                <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Trabalhos de conclusão de curso
              </li>
              <li class="flex items-center gap-2">
                <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Dissertações de mestrado
              </li>
              <li class="flex items-center gap-2">
                <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Publicações científicas
              </li>
              <li class="flex items-center gap-2">
                <svg class="w-7 h-7 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Material didático
              </li>
            </ul>
            <div class="mt-auto">
              <a href="/repositorio" class="w-full block text-center bg-[#2563eb] text-white py-3 rounded-xl font-semibold shadow hover:bg-[#3B82F6] transition-colors focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-label="Aceder ao Repositório Institucional">
                Aceder ao Repositório
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Sistemas Administrativos -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-14 text-center">Sistemas Administrativos</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Webmail -->
        <div class="bg-white p-7 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#2563eb] interactive-card">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
              </svg>
            </div>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Webmail Institucional</h3>
          <p class="text-sm text-gray-600 mb-4">E-mail institucional @ispbie.ao para estudantes e funcionários</p>
          <a href="https://isp-bie.ao/webmail" target="_blank" rel="noopener" class="text-[#2563eb] hover:text-[#2563eb] font-semibold text-sm">
            Aceder
          </a>
        </div>

        <!-- Portal Financeiro -->
        <div class="bg-white p-7 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#3B82F6] interactive-card">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Portal Financeiro</h3>
          <p class="text-sm text-gray-600 mb-4">Consulta de propinas e pagamentos</p>
          <a href="#" class="text-[#3B82F6] hover:text-[#2563eb] font-semibold text-sm">
            Aceder
          </a>
        </div>

        <!-- Sistema RH -->
        <div class="bg-white p-7 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#2563eb] interactive-card">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
              </svg>
            </div>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Sistema de RH</h3>
          <p class="text-sm text-gray-600 mb-4">Gestão de recursos humanos</p>
          <a href="#" class="text-[#2563eb] hover:text-[#2563eb] font-semibold text-sm">
            Aceder
          </a>
        </div>

        <!-- Plataforma de Aprendizagem -->
        <div class="bg-white p-7 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#3B82F6] interactive-card">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
              </svg>
            </div>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">E-Learning</h3>
          <p class="text-sm text-gray-600 mb-4">Plataforma de educação à distância</p>
          <a href="#" class="text-[#3B82F6] hover:text-[#2563eb] font-semibold text-sm">
            Aceder
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- Aplicações Mobile -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-14 text-center">Aplicações Mobile</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
        
        <div class="bg-white rounded-xl shadow-lg overflow-hidden interactive-card">
          <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-8 text-white">
            <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/>
            </svg>
            <h3 class="text-2xl font-bold mb-2">App ISP-Bié</h3>
            <p class="opacity-90">Disponível para Android e iOS</p>
          </div>
          <div class="p-7">
            <ul class="space-y-3 text-gray-700 mb-6">
              <li class="flex items-start">
                <svg class="w-7 h-7 text-[#2563eb] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Acesso rápido a serviços</span>
              </li>
              <li class="flex items-start">
                <svg class="w-7 h-7 text-[#2563eb] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Notificações em tempo real</span>
              </li>
              <li class="flex items-start">
                <svg class="w-7 h-7 text-[#2563eb] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Carteira digital do estudante</span>
              </li>
            </ul>
            <div class="flex gap-3">
              <a href="#" class="flex-1 bg-black text-white py-2 px-4 rounded-lg text-center text-sm font-semibold hover:bg-gray-800 transition-colors">
                Google Play
              </a>
              <a href="#" class="flex-1 bg-black text-white py-2 px-4 rounded-lg text-center text-sm font-semibold hover:bg-gray-800 transition-colors">
                App Store
              </a>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-8 text-white">
            <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-2xl font-bold mb-2">Suporte Técnico</h3>
            <p class="opacity-90">Central de Ajuda</p>
          </div>
          <div class="p-7">
            <div class="space-y-4 mb-6">
              <div class="flex items-start">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                  <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-800">FAQ</h4>
                  <p class="text-sm text-gray-600">Perguntas frequentes</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                  <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-800">Chat Online</h4>
                  <p class="text-sm text-gray-600">Atendimento em tempo real</p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                  <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-800">Tutoriais</h4>
                  <p class="text-sm text-gray-600">Guias passo a passo</p>
                </div>
              </div>
            </div>
            <a href="/contactos" class="block w-full text-center bg-[#2563eb] text-white py-3 rounded-xl font-semibold hover:bg-[#3B82F6] transition-colors focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-label="Contactar Suporte Técnico">
              Contactar Suporte
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Segurança e Privacidade -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-14 text-white shadow-xl">
        <div class="max-w-3xl mx-auto text-center">
          <svg class="w-16 h-16 mx-auto mb-7" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <h2 class="text-3xl md:text-4xl font-bold mb-5">Segurança e Privacidade</h2>
          <p class="text-lg opacity-90 mb-7">
            Todos os nossos sistemas utilizam protocolos de segurança avançados para proteger seus dados pessoais e garantir a privacidade das informações acadêmicas.
          </p>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
              <p class="font-semibold mb-1">Criptografia SSL</p>
              <p class="text-sm opacity-80">Dados protegidos</p>
            </div>
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
              <p class="font-semibold mb-1">Backup Diário</p>
              <p class="text-sm opacity-80">Segurança de dados</p>
            </div>
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
              <p class="font-semibold mb-1">Conformidade LGPD</p>
              <p class="text-sm opacity-80">Privacidade garantida</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

