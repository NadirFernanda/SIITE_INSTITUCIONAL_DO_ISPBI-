@extends('layouts.site')
@section('title', 'Contabilidade e Administração — ISP-Bié')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
  @include('partials.page-hero', [
    'title'     => 'Contabilidade e Administração',
    'subtitle'  => 'Gestão de recursos, finanças e apoio à decisão económica.',
    'breadcrumb'=> 'Cursos / Contabilidade e Administração',
    'gradient'  => 'from-[#451a03] via-[#92680A] to-[#FFD700]',
    'ctaUrl'    => '/candidaturas',
    'ctaLabel'  => 'Candidatar-me',
  ])

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

    {{-- Coluna principal --}}
    <div class="lg:col-span-2 space-y-8">

      {{-- Sobre o Curso --}}
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Sobre o Curso
        </h2>
        <p class="text-gray-600 leading-relaxed mb-3">
          O curso de <strong>Licenciatura em Contabilidade e Administração</strong> prepara profissionais capazes de gerir
          recursos financeiros e humanos em organizações públicas e privadas, contribuindo para a tomada de decisões
          económicas fundamentadas.
        </p>
        <p class="text-gray-600 leading-relaxed">
          Com duração de <strong>4 anos</strong>, o currículo integra contabilidade geral e analítica, finanças
          empresariais, auditoria, gestão estratégica e direito comercial. O futuro licenciado está habilitado a exercer
          funções de liderança e consultoria nas mais diversas organizações angolanas e internacionais.
        </p>
      </div>

      {{-- Perfil de Saída --}}
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-5">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Perfil de Saída
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          @foreach([
            ['icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label'=>'Finanças em Sentido Amplo', 'desc'=>'Gestão de activos, passivos e tesouraria em organizações de diversas dimensões.'],
            ['icon'=>'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z', 'label'=>'Direcção de Processos Económicos', 'desc'=>'Planificação, controlo e optimização dos processos produtivos e administrativos.'],
            ['icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label'=>'Gestão Empresarial', 'desc'=>'Liderança estratégica de empresas, organizações não-governamentais e entidades públicas.'],
            ['icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label'=>'Auditoria', 'desc'=>'Revisão de contas, conformidade legal e emissão de relatórios financeiros certificados.'],
          ] as $area)
          <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#92680A18;">
              <svg class="w-4 h-4" fill="none" stroke="#92680A" stroke-width="1.5" viewBox="0 0 24 24">
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

      {{-- Competências --}}
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-5">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Competências Desenvolvidas
        </h2>
        <ul class="space-y-3">
          @foreach([
            'Domínio da contabilidade geral e analítica segundo normas IFRS',
            'Elaboração e interpretação de relatórios financeiros',
            'Realização de auditorias internas e externas',
            'Gestão estratégica de empresas e organizações',
            'Docência e investigação nas ciências económicas',
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

    {{-- Sidebar --}}
    <aside class="space-y-6">

      {{-- Info Panel --}}
      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h3 class="text-xs font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">Informações</h3>
        <dl class="space-y-3 text-sm">
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#92680A] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Duração</dt><dd class="font-semibold text-[#1e3a5f]">4 Anos</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#92680A] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Vagas</dt><dd class="font-semibold text-[#1e3a5f]">40 por ano</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#92680A] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 21V7a2 2 0 012-2h14a2 2 0 012 2v14"/><path stroke-linecap="round" d="M9 21v-8h6v8"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Departamento</dt><dd class="font-semibold text-[#1e3a5f]">Ciências Humanas, Sociais e Económicas</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#92680A] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Regime</dt><dd class="font-semibold text-[#1e3a5f]">Presencial — Diurno</dd></div>
          </div>
        </dl>
      </div>

      {{-- CTA --}}
      <div class="rounded-2xl p-5 text-white" style="background:#92680A;">
        <p class="text-sm font-semibold mb-1">Pronto para se candidatar?</p>
        <p class="text-xs opacity-80 mb-4">Candidaturas abertas para o ano lectivo 2025/26.</p>
        <a href="/candidaturas" class="block w-full text-center bg-white font-bold text-sm py-2.5 rounded-xl hover:bg-gray-100 transition-colors" style="color:#92680A;">
          Candidatar-me agora
        </a>
      </div>

      {{-- Outros Cursos --}}
      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h3 class="text-xs font-bold text-[#1e3a5f] uppercase tracking-widest mb-3">Outros Cursos</h3>
        <ul class="space-y-1 text-sm">
          @foreach([
            ['Enfermagem Geral','cursos.enfermagem','#16A34A'],
            ['Psicologia Clínica','cursos.psicologia','#D03B1F'],
            ['Comunicação Social','cursos.comunicacao','#C2710C'],
            ['Engenharia Informática','cursos.informatica','#1D4ED8'],
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
