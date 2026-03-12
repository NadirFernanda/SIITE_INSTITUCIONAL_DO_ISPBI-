@extends('layouts.site')
@section('title', 'Engenharia Informática — ISP-Bié')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
  @include('partials.page-hero', [
    'title'     => 'Engenharia Informática',
    'subtitle'  => 'Software, redes e soluções tecnológicas para a transformação digital.',
    'breadcrumb'=> 'Cursos / Engenharia Informática',
    'gradient'  => 'from-[#1e1b4b] via-[#1D4ED8] to-[#60A5FA]',
    'ctaUrl'    => '/candidaturas',
    'ctaLabel'  => 'Candidatar-me',
  ])

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

    <div class="lg:col-span-2 space-y-8">

      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Sobre o Curso
        </h2>
        <p class="text-gray-600 leading-relaxed mb-3">
          A <strong>Licenciatura em Engenharia Informática</strong> forma especialistas capazes de conceber, desenvolver e
          gerir sistemas de informação, redes de computadores e soluções tecnológicas que impulsionam a digitalização
          de Angola.
        </p>
        <p class="text-gray-600 leading-relaxed">
          Com uma duração de <strong>5 anos</strong>, o programa integra programação, arquitectura de computadores,
          segurança informática, inteligência artificial e gestão de projectos tecnológicos, preparando graduates para
          enfrentar os desafios da 4.ª Revolução Industrial.
        </p>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-5">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Perfil de Saída
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          @foreach([
            ['icon'=>'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'label'=>'Tecnologia de Software', 'desc'=>'Desenvolvimento de aplicações web, mobile e sistemas empresariais de alto desempenho.'],
            ['icon'=>'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18', 'label'=>'Arquitectura de Computadores', 'desc'=>'Projecto e optimização de hardware, processadores e sistemas embarcados.'],
            ['icon'=>'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'label'=>'Redes de Computadores', 'desc'=>'Configuração, gestão e segurança de infra-estruturas de rede LAN, WAN e cloud.'],
            ['icon'=>'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z', 'label'=>'Equipamentos Electrónicos', 'desc'=>'Instalação, manutenção e reparação de equipamentos computacionais e de rede.'],
          ] as $area)
          <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#1D4ED818;">
              <svg class="w-4 h-4" fill="none" stroke="#1D4ED8" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $area['icon'] }}"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-semibold text-[#1e3a5f]">{{ $area['label'] }}</p>
              <p class="text-xs text-gray-500 mt-0.5">{{ $area['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-5">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Competências Desenvolvidas
        </h2>
        <ul class="space-y-3">
          @foreach([
            'Desenvolvimento de aplicações web, mobile e desktop',
            'Administração e segurança de redes de computadores',
            'Implementação de medidas de cibersegurança',
            'Gestão de projectos tecnológicos e inovação',
            'Investigação e desenvolvimento em Tecnologias de Informação',
          ] as $comp)
          <li class="flex items-start gap-2 text-sm text-gray-700">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ $comp }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>

    <aside class="space-y-6">
      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h3 class="text-xs font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">Informações</h3>
        <dl class="space-y-3 text-sm">
          <div class="flex justify-between"><dt class="text-gray-400 font-medium">Duração</dt><dd class="font-semibold text-[#1e3a5f]">5 Anos</dd></div>
          <div class="flex justify-between"><dt class="text-gray-400 font-medium">Vagas</dt><dd class="font-semibold text-[#1e3a5f]">A consultar</dd></div>
          <div class="flex justify-between"><dt class="text-gray-400 font-medium">Departamento</dt><dd class="font-semibold text-[#1e3a5f] text-right">Engenharias</dd></div>
          <div class="flex justify-between"><dt class="text-gray-400 font-medium">Regime</dt><dd class="font-semibold text-[#1e3a5f]">Presencial</dd></div>
        </dl>
      </div>

      <div class="rounded-2xl p-5 text-white" style="background:#1D4ED8;">
        <p class="text-sm font-semibold mb-1">Pronto para se candidatar?</p>
        <p class="text-xs opacity-80 mb-4">Candidaturas abertas para o ano lectivo 2025/26.</p>
        <a href="/candidaturas" class="block w-full text-center bg-white font-bold text-sm py-2.5 rounded-xl hover:bg-gray-100 transition-colors" style="color:#1D4ED8;">
          Candidatar-me agora
        </a>
      </div>

      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h3 class="text-xs font-bold text-[#1e3a5f] uppercase tracking-widest mb-3">Outros Cursos</h3>
        <ul class="space-y-1 text-sm">
          @foreach([
            ['Enfermagem Geral','cursos.enfermagem','#16A34A'],
            ['Psicologia Clínica','cursos.psicologia','#D03B1F'],
            ['Comunicação Social','cursos.comunicacao','#C2710C'],
            ['Contabilidade e Administração','cursos.contabilidade','#92680A'],
            ['Eng. em Recursos Hídricos','cursos.hidricos','#0284C7'],
          ] as [$nome,$route,$cor])
          <li>
            <a href="{{ route($route) }}" class="flex items-center gap-2 py-1.5 px-2 rounded-lg hover:bg-gray-50 text-[#1e3a5f] hover:text-[#F05A28] transition-colors">
              <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:{{ $cor }};"></span>
              {{ $nome }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </aside>
  </div>
</div>
@endsection
