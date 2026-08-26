@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Lista Provisória dos Candidatos Inscritos — Exame de Acesso 2026/2027',
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
          e confirme o seu nome, número de ficha e sala. <strong>No dia do exame, leve o comprovativo de inscrição</strong> —
          não é necessário documento de identificação.
        </p>
      </div>
    </div>
  </section>

  {{-- Pesquisa por número de ficha --}}
  <section class="py-10 bg-white border-b">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-lg font-bold text-gray-900 mb-3 text-center">Encontre a sua sala pelo número de ficha</h2>
      <form method="GET" action="{{ route('distribuicao-salas') }}" class="flex flex-col sm:flex-row gap-2">
        <input type="text" name="ficha" value="{{ $pesquisado }}" placeholder="Ex: 01839" inputmode="numeric"
               class="min-w-0 flex-1 border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:border-transparent">
        <button type="submit"
                class="w-full sm:w-auto bg-[#F05A28] text-white px-6 py-3 rounded-lg font-bold hover:bg-[#d44d20] transition-colors flex-shrink-0">
          Pesquisar
        </button>
      </form>

      @if($resultado)
        @if($resultado['status'] === 'invalido' || $resultado['status'] === 'nao_encontrado')
          <div class="mt-4 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-sm">
            Não encontrámos nenhum candidato com o número de ficha <strong>{{ $pesquisado }}</strong>. Verifique o número e tente novamente.
          </div>
        @elseif($resultado['status'] === 'pagamento_pendente')
          <div class="mt-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg p-4 text-sm">
            Encontrámos a candidatura de <strong>{{ mb_strtoupper($resultado['candidatura']->nome, 'UTF-8') }}</strong>,
            mas o pagamento ainda não está confirmado, por isso ainda não tem sala atribuída. Regularize o pagamento junto dos Serviços Académicos.
          </div>
        @elseif($resultado['status'] === 'sem_sala')
          <div class="mt-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg p-4 text-sm">
            Encontrámos a candidatura de <strong>{{ mb_strtoupper($resultado['candidatura']->nome, 'UTF-8') }}</strong>,
            mas ainda não tem sala atribuída. Volte a consultar mais tarde ou contacte os Serviços Académicos.
          </div>
        @elseif($resultado['status'] === 'encontrado')
          @php $c = $resultado['candidatura']; $sala = $c->sala; @endphp
          <div class="mt-4 bg-green-50 border border-green-300 rounded-lg p-5">
            <div class="flex items-center gap-2 text-green-700 font-bold mb-3">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              Sala encontrada!
            </div>
            <div class="grid grid-cols-2 gap-y-2 text-sm">
              <div class="text-gray-500">Nome</div>
              <div class="font-semibold text-gray-900 text-right">{{ mb_strtoupper($c->nome, 'UTF-8') }}</div>
              <div class="text-gray-500">N.º Ficha</div>
              <div class="font-semibold text-gray-900 text-right">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</div>
              <div class="text-gray-500">Curso</div>
              <div class="font-semibold text-gray-900 text-right">{{ $c->curso }}</div>
              <div class="text-gray-500">Período</div>
              <div class="font-semibold text-gray-900 text-right">{{ $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</div>
              <div class="text-gray-500">Sala</div>
              <div class="font-semibold text-gray-900 text-right">{{ $sala->nome }}</div>
              <div class="text-gray-500">Data / Horário</div>
              <div class="font-semibold text-gray-900 text-right">{{ $sala->data_exame->format('d/m/Y') }} — {{ $sala->horario }}</div>
            </div>
            <a href="{{ route('distribuicao-salas.pdf', $sala) }}"
               class="mt-4 w-full inline-flex items-center justify-center gap-2 bg-[#1e3a5f] text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#0f1f3d] transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
              </svg>
              Baixar PDF da Sala {{ $sala->nome }}
            </a>
          </div>
        @endif
      @endif
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
