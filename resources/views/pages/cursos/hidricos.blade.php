@extends('layouts.site')
@section('title', 'Eng. em Recursos Hídricos — ISP-Bié')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
  @include('partials.page-hero', [
    'title'     => 'Eng. em Recursos Hídricos',
    'subtitle'  => 'Gestão sustentável da água e infraestruturas hidráulicas de Angola.',
    'breadcrumb'=> 'Cursos / Engenharia em Recursos Hídricos',
    'gradient'  => 'from-[#0c4a6e] via-[#0284C7] to-[#38BDF8]',
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
          A <strong>Licenciatura em Engenharia em Recursos Hídricos</strong> prepara engenheiros altamente qualificados
          para gerir e preservar os recursos hídricos de Angola — um dos maiores patrimónios naturais do país —,
          garantindo o acesso sustentável à água potável e ao saneamento básico.
        </p>
        <p class="text-gray-600 leading-relaxed">
          Com duração de <strong>6 anos</strong>, o plano curricular cobre hidrologia, hidráulica, gestão de bacias
          hidrográficas, tratamento de águas residuais, impacto ambiental e construção de infraestruturas hidráulicas,
          respondendo às necessidades críticas de desenvolvimento nacional.
        </p>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-5">
          <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Perfil de Saída
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          @foreach([
            ['icon'=>'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'label'=>'Gestão de Recursos Hídricos', 'desc'=>'Inventário, monitorização e administração sustentável de bacias hidrográficas e aquíferos.'],
            ['icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'label'=>'Saneamento e Tratamento de Água', 'desc'=>'Projecto e operação de sistemas de abastecimento de água e estações de tratamento.'],
            ['icon'=>'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z', 'label'=>'Infraestruturas Hidráulicas', 'desc'=>'Projecto, construção e fiscalização de barragens, canais de irrigação e redes de distribuição.'],
            ['icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7', 'label'=>'Estudos de Avaliação de Recursos', 'desc'=>'Análise hidrológica, modelação numérica e avaliação de impacte ambiental de projectos.'],
          ] as $area)
          <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#0284C718;">
              <svg class="w-4 h-4" fill="none" stroke="#0284C7" stroke-width="1.5" viewBox="0 0 24 24">
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
            'Projecto e fiscalização de obras de hidráulica e irrigação',
            'Avaliação do impacto ambiental de projectos hídricos',
            'Gestão integrada de bacias hidrográficas',
            'Planeamento e implantação de sistemas de saneamento básico',
            'Investigação e inovação em recursos naturais e ambientais',
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
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#0284C7] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Duração</dt><dd class="font-semibold text-[#1e3a5f]">6 Anos</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#0284C7] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Vagas</dt><dd class="font-semibold text-[#1e3a5f]">40 por ano</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#0284C7] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 21V7a2 2 0 012-2h14a2 2 0 012 2v14"/><path stroke-linecap="round" d="M9 21v-8h6v8"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Departamento</dt><dd class="font-semibold text-[#1e3a5f]">Engenharias</dd></div>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#0284C7] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
            <div><dt class="text-gray-400 text-[11px]">Regime</dt><dd class="font-semibold text-[#1e3a5f]">Presencial — Diurno</dd></div>
          </div>
        </dl>
      </div>

      <div class="rounded-2xl p-5 text-white" style="background:#0284C7;">
        <p class="text-sm font-semibold mb-1">Pronto para se candidatar?</p>
        <p class="text-xs opacity-80 mb-4">Candidaturas abertas para o ano lectivo 2025/26.</p>
        <a href="/candidaturas" class="block w-full text-center bg-white font-bold text-sm py-2.5 rounded-xl hover:bg-gray-100 transition-colors" style="color:#0284C7;">
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
            ['Engenharia Informática','cursos.informatica','#1D4ED8'],
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
