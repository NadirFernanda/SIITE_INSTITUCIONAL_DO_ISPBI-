@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Notícias',
    'subtitle'   => 'Notícias, comunicados e actividades do ISP-Bié.',
    'breadcrumb' => 'Notícias',
])
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12">Notícias Recentes</h2>
      <div class="grid md:grid-cols-3 gap-8">
        @forelse($noticias as $noticia)
          <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all flex flex-col interactive-card">
            {{-- 16:9 aspect-ratio container — image is never cropped, always fully visible --}}
            <div class="relative w-full" style="aspect-ratio:16/9; overflow:hidden;">
              @if($noticia->imagem)
                <img src="{{ asset('storage/' . $noticia->imagem) }}"
                     alt="{{ $noticia->titulo }}"
                     class="absolute inset-0 w-full h-full object-contain bg-gray-50">
              @else
                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#2563eb] to-[#3B82F6]">
                  <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
                </div>
              @endif
            </div>
            <div class="p-6 flex-1 flex flex-col">
              <div class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}</div>
              <h3 class="text-xl font-bold text-[#2563eb] mb-3">{{ $noticia->titulo }}</h3>
              <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($noticia->texto), 120) }}</p>
              <a href="{{ route('noticias.show', $noticia->id) }}" class="text-[#2563eb] font-semibold hover:underline mt-auto">Ver mais →</a>
            </div>
          </article>
        @empty
          <div class="col-span-3 text-center text-gray-500 py-12">Nenhuma notícia publicada.</div>
        @endforelse
      </div>

</div>
@endsection
