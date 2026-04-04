@extends('layouts.site')

@section('title', 'Parcerias Institucionais — ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-14">

  @include('partials.page-hero', [
      'title'      => 'Parcerias Institucionais',
      'subtitle'   => 'Entidades públicas, privadas e académicas que colaboram com o ISP-Bié no fortalecimento do ensino, pesquisa e extensão em Angola.',
      'breadcrumb' => 'Parcerias',
  ])

  {{-- Introdução --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-12">
    <h2 class="text-2xl font-bold text-[#1e3a8a] mb-4">Colaboração ao serviço do desenvolvimento</h2>
    <p class="text-gray-700 leading-relaxed mb-3">
      O Instituto Superior Politécnico do Bié acredita que a qualidade do ensino e a relevância da investigação
      dependem de redes de colaboração sólidas. As parcerias institucionais são parte integrante da nossa estratégia
      de desenvolvimento e constituem pontes entre a academia, o mundo do trabalho e a sociedade angolana.
    </p>
    <p class="text-gray-700 leading-relaxed">
      As entidades abaixo listadas colaboram connosco através de protocolos de cooperação, estágios curriculares,
      financiamento de bolsas, pesquisa conjunta e apoio técnico.
    </p>
  </div>

  {{-- Parceiros do Sector Público --}}
  <div class="mb-12">
    <h2 class="text-xl font-bold text-[#F05A28] uppercase tracking-widest mb-6 flex items-center gap-3">
      <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
      Sector Público &amp; Governamental
      <span class="inline-block flex-1 h-px bg-gray-200"></span>
    </h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Gabinete Provincial da Educação do Bié</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Coordenação educativa provincial e política de ensino superior regional.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Hospital Mártires do Cuito</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Parceiro de estágios para cursos da área da saúde e pesquisa clínica.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Centro Materno Infantil do Bié</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Apoio a estágios curriculares e extensão universitária na área da saúde materno-infantil.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Fundo de Apoio Social (FAS)</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Cooperação em projectos de impacto social e apoio a estudantes carenciados.</p>
        </div>
      </div>

    </div>
  </div>

  {{-- Parceiros do Sector Privado --}}
  <div class="mb-12">
    <h2 class="text-xl font-bold text-[#F05A28] uppercase tracking-widest mb-6 flex items-center gap-3">
      <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
      Sector Privado &amp; Empresarial
      <span class="inline-block flex-1 h-px bg-gray-200"></span>
    </h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#0369a1,#0ea5e9);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Standard Bank de Angola</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Apoio financeiro, programas de bolsas de estudo e educação financeira para estudantes.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#dc2626,#f97316);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Unitel</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Conectividade, telecomunicações e apoio tecnológico ao campus universitário.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#059669,#10b981);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6h-2.18c.07-.44.18-.88.18-1.34C18 2.54 15.46 0 12.34 0c-1.67 0-3.16.72-4.25 1.86l-.09.09L3.67 6H2C1.45 6 1 6.45 1 7v13c0 .55.45 1 1 1h18c.55 0 1-.45 1-1V7c0-.55-.45-1-1-1zM9.84 2.98C10.46 2.37 11.37 2 12.34 2 14.35 2 16 3.65 16 5.66c0 .34-.09.66-.2 1H10l-.16-3.68zM19 19H3V8h16v11z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Centro de Emprego e Formação Profissional de Jovens do Bié (Cefejor)</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Inserção profissional de jovens e estágios orientados para o mercado de trabalho regional.</p>
        </div>
      </div>

    </div>
  </div>

  {{-- Parceiros Académicos --}}
  <div class="mb-12">
    <h2 class="text-xl font-bold text-[#F05A28] uppercase tracking-widest mb-6 flex items-center gap-3">
      <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
      Parceiros Académicos
      <span class="inline-block flex-1 h-px bg-gray-200"></span>
    </h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Instituto Superior Politécnico Ndunduma</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Cooperação académica, mobilidade docente e partilha de boas práticas curriculares.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-start gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900 text-sm leading-snug">Instituto Superior Politécnico da Caála</h3>
          <p class="text-xs text-gray-500 mt-1 leading-relaxed">Cooperação académica inter-institucional e partilha de recursos científicos e pedagógicos.</p>
        </div>
      </div>

    </div>
  </div>

  {{-- CTA — proposta de parceria --}}
  <div class="rounded-2xl p-8 sm:p-10 text-center" style="background:linear-gradient(135deg,#1e3a8a 0%,#F05A28 100%);">
    <h2 class="text-white text-xl sm:text-2xl font-bold mb-3">Interesse em ser parceiro do ISP-Bié?</h2>
    <p class="text-white/80 text-sm sm:text-base mb-6 max-w-xl mx-auto leading-relaxed">
      Se a sua instituição, empresa ou organismo tiver interesse em estabelecer uma parceria connosco,
      entre em contacto. Estamos abertos a novas colaborações que beneficiem os nossos estudantes e a comunidade do Bié.
    </p>
    <a href="/contactos"
       class="inline-flex items-center gap-2 bg-white text-[#F05A28] font-bold text-sm px-6 py-3 rounded-xl shadow-lg hover:bg-orange-50 transition-colors duration-200">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
      </svg>
      Contactar o ISP-Bié
    </a>
  </div>

</div>
@endsection
