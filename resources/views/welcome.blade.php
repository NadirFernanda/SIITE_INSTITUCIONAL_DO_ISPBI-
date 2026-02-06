@extends('layouts.site')

@section('content')

<!-- Hero institucional moderno + carrossel contido -->
<section class="relative w-full h-[46vh] sm:h-[50vh] md:h-[42vh] xl:h-[420px] overflow-hidden" x-cloak>
  @php
    $carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->take(5)->get();
    $totalSlides = $carrosseis->count();
    $hero = $carrosseis->first();
  @endphp
  @if($totalSlides > 0)
    <div x-data="{ current: 0, slides: {{ $totalSlides }}, images: [@foreach($carrosseis as $c)'{{ asset('storage/' . $c->imagem) }}'@if(!$loop->last),@endif @endforeach] }"
         x-init="setInterval(() => { current = (current + 1) % slides }, 5000)"
         class="absolute inset-0">
      <template x-for="(img, idx) in images" :key="idx">
        <div x-show="current === idx" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-cover bg-center" :style="'background-image: url(' + img + ')'"></div>
      </template>
      <div class="absolute inset-0 bg-black/40"></div>
    </div>
    <div class="absolute inset-0 flex items-center">
      <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 w-full">
        <div class="max-w-xs sm:max-w-md md:max-w-xl text-white text-left bg-black/2 rounded-xl p-4 sm:p-6 md:p-8 shadow-lg backdrop-blur-sm">
          <h1 class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl font-bold leading-tight mb-3 sm:mb-4 break-words">
            {{ $hero->titulo }}
          </h1>
          @if($hero->subtitulo)
          <p class="text-sm xs:text-base md:text-lg opacity-90 mb-4 sm:mb-6 break-words">
            {{ $hero->subtitulo }}
          </p>
          @endif
          <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full max-w-xs sm:max-w-none">
            @if($hero->link && $hero->texto_botao)
              <a href="{{ $hero->link }}"
                 class="inline-flex items-center justify-center
                        bg-blue-600 hover:bg-blue-700
                        text-white font-semibold
                        px-4 py-2 sm:px-6 sm:py-3 rounded-md transition text-base sm:text-lg w-full sm:w-auto text-center">
                {{ $hero->texto_botao }}
              </a>
            @elseif($hero->link)
              <a href="{{ $hero->link }}"
                 class="inline-flex items-center justify-center
                        bg-blue-600 hover:bg-blue-700
                        text-white font-semibold
                        px-4 py-2 sm:px-6 sm:py-3 rounded-md transition text-base sm:text-lg w-full sm:w-auto text-center">
                CONHEÇA MAIS
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
</section>

<!-- ... aqui segue o resto do teu código sem alterações ... -->

<!-- Testemunhos - Carrossel Alpine.js -->
<section class="py-12 bg-gray-50" x-cloak>
  <div 
    x-data="testemunhosCarousel()"
    x-init="init()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()"
    class="w-full 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-12"
  >
    <!-- Cabeçalho -->
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
        Testemunhos
      </h2>
      <p class="text-lg text-gray-600">
        Saiba o que os nossos estudantes dizem sobre nós
      </p>
    </div>
    <!-- Card -->
    <div x-show="total > 0" class="max-w-2xl mx-auto bg-white rounded-3xl shadow-lg p-8 md:p-12 border border-gray-200 relative">
      <p class="text-lg md:text-xl text-gray-700 italic text-center leading-relaxed mb-8 min-h-[96px]"
         x-text="currentItem.texto">
      </p>
      <div class="text-center">
        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gradient-to-br from-[#2563eb] to-[#3B82F6] flex items-center justify-center text-white font-bold text-xl">
          <span x-text="currentItem.iniciais"></span>
        </div>
        <h4 class="font-bold text-gray-900 text-lg" x-text="currentItem.nome"></h4>
        <p class="text-sm text-gray-500 mt-1" x-text="currentItem.curso"></p>
        <div class="flex justify-center mt-3 text-[#2563eb]">
          ★★★★★
        </div>
      </div>
      <button @click="prev"
              class="absolute left-4 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100">
        ‹
      </button>
      <button @click="next"
              class="absolute right-4 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100">
        ›
      </button>
    </div>
    <p x-show="total === 0" class="text-center text-gray-500 italic">
      Ainda não existem testemunhos publicados.
    </p>
  </div>
</section>

<!-- Adicionar o script Alpine.js para testemunhos -->
@push('scripts')
<script>
function testemunhosCarousel() {
  return {
    items: @json($testemunhos),
    currentIndex: 0,
    get total() {
      return this.items.length;
    },
    autoplay: null,
    get currentItem() {
      return this.items[this.currentIndex] || {};
    },
    init() {
      this.startAutoplay();
    },
    startAutoplay() {
      if (this.total > 1) {
        this.autoplay = setInterval(() => this.next(), 5000);
      }
    },
    stopAutoplay() {
      if (this.autoplay) clearInterval(this.autoplay);
    },
    prev() {
      this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
    },
    next() {
      this.currentIndex = (this.currentIndex + 1) % this.total;
    }
  }
}
</script>
@endpush

@endsection