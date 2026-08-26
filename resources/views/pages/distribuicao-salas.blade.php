@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Distribuição de Salas — Exame de Acesso',
    'subtitle'   => 'Consulte a sala, data e horário do seu exame, organizados por curso e período.',
    'breadcrumb' => 'Distribuição de Salas',
])

  <section class="py-8 bg-yellow-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-start">
        <svg class="w-6 h-6 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <p class="text-gray-700">
          Procure o seu curso e período abaixo, descarregue o PDF da(s) sala(s) correspondente(s)
          e confirme o seu nome, número de ficha e sala. Leve um documento de identificação no dia do exame.
        </p>
      </div>
    </div>
  </section>

  <section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      @if($grupos->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-10 text-center text-gray-500">
          A distribuição de salas ainda não foi publicada. Volte a consultar mais tarde.
        </div>
      @else
        @foreach($grupos as $curso => $porPeriodo)
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
          <div class="bg-[#1e3a5f] text-white px-6 py-4">
            <h2 class="text-lg font-bold">{{ $curso }}</h2>
          </div>

          @foreach($porPeriodo as $periodo => $salas)
          <div class="border-b last:border-b-0">
            <div class="px-6 py-3 bg-gray-50 border-b">
              <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                {{ $periodo === 'pos-laboral' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-[#1e3a5f]' }}">
                {{ $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
              </span>
            </div>
            <div class="divide-y">
              @foreach($salas as $sala)
              <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-3">
                <div>
                  <div class="font-semibold text-gray-900">{{ $sala->nome }}</div>
                  <div class="text-sm text-gray-500">
                    {{ $sala->data_exame->format('d/m/Y') }} &nbsp;|&nbsp; {{ $sala->horario }}
                    &nbsp;|&nbsp; {{ $sala->candidaturas_count }} candidato(s)
                  </div>
                </div>
                <a href="{{ route('distribuicao-salas.pdf', $sala) }}"
                   class="inline-flex items-center gap-2 bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#0f1f3d] transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                  </svg>
                  Baixar PDF
                </a>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        @endforeach
      @endif

    </div>
  </section>

</div>
@endsection
