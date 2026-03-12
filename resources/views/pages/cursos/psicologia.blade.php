@extends('layouts.site')
@section('title', 'Psicologia Clínica — ISP-Bié')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
@include('partials.page-hero', ['title'=>'Psicologia Clínica','subtitle'=>'Avaliação, diagnóstico e intervenção para o bem-estar humano.','breadcrumb'=>'Psicologia Clínica','gradient'=>'from-[#7f1d1d] via-[#C62828] to-[#F05A28]','ctaUrl'=>'/candidaturas','ctaLabel'=>'Candidatar-me'])
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  <div class="lg:col-span-2 space-y-8">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Sobre o Curso</h2>
      <p class="text-gray-600 leading-relaxed">O licenciado em Psicologia é um profissional que avalia, diagnostica e intervém no desenvolvimento psicológico, promovendo o bem-estar individual e colectivo. Actua na prevenção, orientação e resolução de problemas em contextos educativos, clínicos, organizacionais e comunitários, desenvolvendo programas, investigações e estratégias de formação, com ética e trabalho multidisciplinar.</p>
    </section>
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Perfil de Saída</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C6282818;"><svg class="w-4 h-4" fill="none" stroke="#C62828" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.54 0-2.94.792-3.75 2.016C11.94 4.542 10.54 3.75 9 3.75c-2.761 0-5 2.015-5 4.5 0 7.22 8 11.25 8 11.25s8-4.03 8-11.25z"/></svg></div><p class="text-sm font-medium text-gray-700">Psicologia Clínica e da Saúde</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C6282818;"><svg class="w-4 h-4" fill="none" stroke="#C62828" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div><p class="text-sm font-medium text-gray-700">Psicologia Educativa e do Desenvolvimento</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C6282818;"><svg class="w-4 h-4" fill="none" stroke="#C62828" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-5.13a4 4 0 110-8 4 4 0 010 8z"/></svg></div><p class="text-sm font-medium text-gray-700">Psicologia do Trabalho e Social</p></div>
        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50"><div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#C6282818;"><svg class="w-4 h-4" fill="none" stroke="#C62828" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2"/></svg></div><p class="text-sm font-medium text-gray-700">Avaliação Psicológica</p></div>
      </div>
    </section>
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
      <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4 flex items-center gap-2"><span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Competências Desenvolvidas</h2>
      <ul class="space-y-2">
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Diagnóstico e intervenção em saúde mental</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Aplicação de testes e escalas de avaliação psicológica</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Orientação vocacional e apoio ao desenvolvimento</li>
        <li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Investigação em ciências do comportamento</li>
      </ul>
    </section>
  </div>
  <aside class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h3 class="text-sm font-bold text-[#1e3a5f] uppercase tracking-widest mb-4">Informações</h3>
      <dl class="space-y-3 text-sm">
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Duração</dt><dd class="font-semibold text-[#1e3a5f]">5 Anos</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Vagas</dt><dd class="font-semibold text-[#1e3a5f]">40 vagas</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Departamento</dt><dd class="font-semibold text-[#1e3a5f] text-right">Ciências da Saúde</dd></div>
        <div class="flex justify-between"><dt class="text-gray-400 font-medium">Regime</dt><dd class="font-semibold text-[#1e3a5f]">Presencial</dd></div>
      </dl>
    </div>
    <div class="rounded-2xl p-6 text-white" style="background:#C62828;">
      <h3 class="font-bold text-lg mb-2">Interessado?</h3>
      <p class="text-sm text-white/80 mb-4">Inicie o processo de candidatura ao curso de Psicologia Clínica.</p>
      <a href="/candidaturas" class="inline-block w-full text-center bg-white font-semibold text-sm py-2.5 rounded-xl transition hover:bg-gray-50" style="color:#C62828;">Candidatar-me agora</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h3 class="text-sm font-bold text-[#1e3a5f] uppercase tracking-widest mb-3">Outros Cursos</h3>
      <nav class="space-y-1 text-sm">
        <a href="{{ route('cursos.enfermagem') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Enfermagem Geral</a>
        <a href="{{ route('cursos.comunicacao') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Comunicação Social</a>
        <a href="{{ route('cursos.contabilidade') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Contabilidade e Administração</a>
        <a href="{{ route('cursos.informatica') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Engenharia Informática</a>
        <a href="{{ route('cursos.hidricos') }}" class="block py-1.5 px-3 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-[#F05A28] transition">Eng. em Recursos Hídricos</a>
      </nav>
    </div>
  </aside>
</div>
</div>
@endsection
