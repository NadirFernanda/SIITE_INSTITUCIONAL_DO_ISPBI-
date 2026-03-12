@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
@include('partials.page-hero', [
    'title'      => 'Sistemas Institucionais',
    'subtitle'   => 'Plataformas e serviços digitais — acesso centralizado aos sistemas do ISP-Bié.',
    'breadcrumb' => 'Sistemas',
])

  <!-- Introdução -->
  <section class="py-12 bg-white">
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
  <!-- Sistemas Académicos (conteúdo removido conforme solicitado) -->

  <!-- Sistemas Administrativos -->
  <section class="py-12 bg-white">
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
          <a href="http://www.isp-bie.ao/webmail" target="_blank" rel="noopener" class="text-[#2563eb] hover:text-[#2563eb] font-semibold text-sm">
            Aceder
          </a>
        </div>

        <!-- SGF (Portal Financeiro) -->
        <div class="bg-white p-7 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#3B82F6] interactive-card">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">SGF</h3>
          <p class="text-sm text-gray-600 mb-4">Consulta de propinas e pagamentos</p>
          <a href="https://sgf.isp-bie.ao/" target="_blank" rel="noopener" class="text-[#3B82F6] hover:text-[#2563eb] font-semibold text-sm">
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

  <!-- Aplicações Mobile e Suporte Técnico (removidos conforme solicitado) -->

  <!-- Segurança e Privacidade -->
  <section class="py-12 bg-white">
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

</div>
@endsection

