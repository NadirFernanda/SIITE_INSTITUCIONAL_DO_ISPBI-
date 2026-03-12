@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
@include('partials.page-hero', [
    'title'      => 'Busca no Site',
    'subtitle'   => 'Pesquise conteúdos, notícias e páginas do ISP-Bié.',
    'breadcrumb' => 'Busca',
])

      @if(request('q'))
        <div class="bg-white rounded-lg shadow-md p-6 interactive-card">
          <h2 class="text-2xl font-bold text-[#2563eb] mb-3">Termo pesquisado</h2>
          <p class="text-gray-700">Você pesquisou por: <span class="font-semibold">{{ request('q') }}</span></p>
          <p class="text-gray-600 mt-4 text-sm">Em breve, a busca exibirá resultados de notícias, cursos e páginas institucionais relacionados a este termo.</p>
        </div>
      @endif
  </div>

</div>
@endsection
