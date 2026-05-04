@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="relative bg-gradient-to-r from-[#3B82F6] to-[#FFA500] text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-4">
        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
        </svg>
        <div>
          <h1 class="text-3xl md:text-4xl font-bold">Testemunho Alumni</h1>
          <p class="text-lg mt-1 opacity-90">História de um(a) ex-estudante do ISP-Bié</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <a href="{{ route('alumni') }}" class="hover:underline">Alumni</a>
        <span class="mx-2">/</span>
        <span>Testemunho</span>
      </nav>
    </div>
  </section>

  <!-- Conteúdo do Testemunho -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 border border-gray-100 interactive-card">
        <div class="flex items-center gap-6 mb-6">
          <div class="w-20 h-20 rounded-full bg-[#2563eb] flex items-center justify-center text-white text-3xl font-bold">
            ✓
          </div>
          <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Alumni</h2>
            <p class="text-gray-700 text-base">
              {{ $alumnus->curso }}
              @if($alumnus->ano)
                &bull; Turma de {{ $alumnus->ano }}
              @endif
            </p>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-4">
          @php
            $satisfacao = trim((string) $alumnus->satisfacao);
            $hasDepoimento = $satisfacao && !preg_match('/^\d+$/', $satisfacao);
          @endphp

          @if($hasDepoimento)
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Mensagem do Alumni</h3>
            <p class="text-lg text-gray-700 leading-relaxed">“{{ $satisfacao }}”</p>
          @else
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Situação Profissional</h3>
            <p class="text-lg text-gray-700 leading-relaxed">Procurando emprego e novas oportunidades profissionais.</p>
          @endif
        </div>

        <div class="mt-8 flex items-center justify-between text-sm text-gray-500">
          <a href="{{ route('alumni') }}" class="inline-flex items-center text-[#2563eb] hover:text-[#1d4ed8] font-semibold">
            ← Voltar para Alumni
          </a>
          <a href="/" class="hover:underline">Ir para a página inicial</a>
        </div>
      </div>
    </div>
  </section>
@endsection
