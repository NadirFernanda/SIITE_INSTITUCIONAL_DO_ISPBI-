@extends('layouts.site')
@section('title', 'Comunicação Social — ISP-Bié')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
@include('partials.page-hero', ['title'=>'Comunicação Social','subtitle'=>'Gestão, produção e mediação da comunicação pública e jornalística.','breadcrumb'=>'Comunicação Social','gradient'=>'from-[#78350f] via-[#C2710C] to-[#FBBF24]','ctaUrl'=>'/candidaturas','ctaLabel'=>'Candidatar-me'])
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  <div class="lg:col-span-2 space-y-8">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Sobre o Curso</h2>
      <p class="text-gray-600 leading-relaxed">O licenciado em Comunicação Social é um profissional capacitado para gerir, planear e produzir comunicação pública. Actua em jornalismo, publicidade, assessoria, mediação social, investigação e docência, desenvolvendo estratégias e conteúdos em diferentes linguagens e meios, promovendo participação e desenvolvimento social responsável.</p>
    </section>
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Perfil de Saída</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C2710C18;"><svg class="w-4 h-4" fill="none" stroke="#C2710C" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 19.5h-15A1.5 1.5 0 013 18V6a1.5 1.5 0 011.5-1.5h15A1.5 1.5 0 0121 6v12a1.5 1.5 0 01-1.5 1.5z"/></svg></div><p class="text-sm font-medium text-gray-700">Comunicação Jornalística</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C2710C18;"><svg class="w-4 h-4" fill="none" stroke="#C2710C" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7V6a2 2 0 012-2h8a2 2 0 012 2v1m-12 0h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z"/></svg></div><p class="text-sm font-medium text-gray-700">Comunicação Empresarial</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C2710C18;"><svg class="w-4 h-4" fill="none" stroke="#C2710C" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-5.13a4 4 0 110-8 4 4 0 010 8z"/></svg></div><p class="text-sm font-medium text-gray-700">Comunicação Comunitária</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C2710C18;"><svg class="w-4 h-4" fill="none" stroke="#C2710C" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg></div><p class="text-sm font-medium text-gray-700">Relações Públicas</p></div>
      </div>
    </section>
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Competências Desenvolvidas</h2>
      <ul class="space-y-2">
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Produção e edição de conteúdos jornalísticos multimédia</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Gestão de redes sociais e comunicação digital</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Assessoria de imprensa e relações institucionais</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Investigação em comunicação e opinião pública</li>
      </ul>
    </section>
  </div>
  <aside class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h3 class="text-sm font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">Informações</h3>
      <dl class="space-y-3 text-sm">
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Duração</dt><dd class="font-semibold text-[#1e3a5f]">4 Anos</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Vagas</dt><dd class="font-semibold text-[#1e3a5f]">40 vagas</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Departamento</dt><dd class="font-semibold text-[#1e3a5f] text-right">Ciências Humanas, Sociais e Económicas</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Regime</dt><dd class="font-semibold text-[#1e3a5f]">Presencial</dd></div>
      </dl>
    </div>
    <div class="rounded-2xl p-6 text-white" style="background:#C2710C;">
      <h3 class="font-bold text-lg mb-2">Interessado?</h3>
      <p class="text-sm text-white/80 mb-4">Inicie o processo de candidatura ao curso de Comunicação Social.</p>
      <a href="/candidaturas" class="inline-block w-full text-center bg-white font-semibold text-sm py-2.5 rounded-xl transition hover:bg-gray-50" style="color:#C2710C;">Candidatar-me agora</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h3 class="text-sm font-bold text-[#1e3a5f] uppercase tracking-widest mb-3">Outros Cursos</h3>
      <nav class="space-y-1 text-sm">
        <a href="{{ route('cursos.enfermagem') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Enfermagem Geral</a>
        <a href="{{ route('cursos.psicologia') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Psicologia Clínica</a>
        <a href="{{ route('cursos.contabilidade') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Contabilidade e Administração</a>
        <a href="{{ route('cursos.informatica') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Engenharia Informática</a>
        <a href="{{ route('cursos.hidricos') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Eng. em Recursos Hídricos</a>
      </nav>
    </div>
  </aside>
</div>
</div>
@endsection
