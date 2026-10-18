@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <div class="institutional-page">
    @include('partials.page-hero', [
        'title' => 'Testemunho Alumni',
        'subtitle' => 'História de um(a) ex-estudante do ISP-Bié',
        'breadcrumb' => 'Testemunho',
        'parentUrl' => route('alumni'),
        'parentLabel' => 'Alumni',
    ])
</div>

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
