@php
use Illuminate\Support\Str;
@endphp

<div class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-12">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Notícias Institucionais</h2>
      <div class="h-1 w-24 bg-[#3B82F6]"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      @forelse($noticias as $noticia)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          @if($noticia->imagem)
            <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="{{ $noticia->titulo }}" class="h-64 w-full object-cover">
          @else
            <div class="h-64 bg-gradient-to-br from-[#3B82F6] to-[#FFA500] flex items-center justify-center">
              <span class="text-5xl text-white font-bold">📰</span>
            </div>
          @endif
          <div class="p-6">
            <div class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $noticia->titulo }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($noticia->texto), 120) }}</p>
            <a href="{{ route('noticias') }}" class="text-[#2563eb] font-semibold hover:underline">Ler mais →</a>
          </div>
        </div>
      @empty
        <div class="col-span-3 text-center text-gray-500 py-12">Nenhuma notícia institucional publicada ainda.</div>
      @endforelse
    </div>
  </div>
</div>
