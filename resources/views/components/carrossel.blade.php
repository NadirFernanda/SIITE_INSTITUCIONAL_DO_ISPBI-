@php
    $carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->get();
    $totalSlides = $carrosseis->count();
@endphp

@if($totalSlides > 0)
<div class="relative w-full" x-data="{ currentSlide: 0 }" x-init="if ({{ $totalSlides }} > 1) { setInterval(() => { currentSlide = (currentSlide + 1) % {{ $totalSlides }} }, 5000) }">
    <div class="relative h-full min-h-[120px] max-h-[200px] sm:max-h-full sm:min-h-[320px] md:min-h-[400px] lg:min-h-[420px] xl:min-h-[480px] 2xl:min-h-[520px] overflow-hidden w-full">
        @foreach($carrosseis as $index => $carrossel)
            <div x-show="currentSlide === {{ $index }}" x-cloak class="absolute inset-0 transition-opacity duration-700 flex items-center justify-center">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $carrossel->imagem) }}');"></div>
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="relative h-full flex items-center justify-center w-full">
                    <div class="text-center text-white px-2 sm:px-6 md:px-12 max-w-4xl mx-auto drop-shadow-lg">
                        <h2 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-4 leading-tight md:leading-tight">{{ $carrossel->titulo }}</h2>
                        @if($carrossel->subtitulo)
                        <p class="text-sm sm:text-lg md:text-xl lg:text-2xl mb-4 sm:mb-6 leading-snug md:leading-normal">{{ $carrossel->subtitulo }}</p>
                        @endif
                        @php $safeLink = ($carrossel->link && filter_var($carrossel->link, FILTER_VALIDATE_URL) && preg_match('/^https?:\/\//i', $carrossel->link)) ? $carrossel->link : null; @endphp
                        @if($safeLink && $carrossel->texto_botao)
                        <a href="{{ $safeLink }}" rel="noopener noreferrer" class="inline-block bg-[#2563eb] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg font-semibold hover:bg-[#d94b1f] transition-colors text-sm sm:text-base">
                            {{ $carrossel->texto_botao }}
                        </a>
                        @elseif($safeLink)
                        <a href="{{ $safeLink }}" rel="noopener noreferrer" class="inline-block bg-[#2563eb] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg font-semibold hover:bg-[#d94b1f] transition-colors text-sm sm:text-base">
                            CONHEÇA MAIS
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Setas de navegação -->
        <button @click="currentSlide = (currentSlide + {{ $totalSlides }} - 1) % {{ $totalSlides }}" class="absolute left-2 sm:left-4 2xl:left-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 sm:p-3 shadow focus:outline-none z-20" x-show="{{ $totalSlides }} > 1">
            <svg class="w-6 h-6 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="currentSlide = (currentSlide + 1) % {{ $totalSlides }}" class="absolute right-2 sm:right-4 2xl:right-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 sm:p-3 shadow focus:outline-none z-20" x-show="{{ $totalSlides }} > 1">
            <svg class="w-6 h-6 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <!-- Indicadores do carrossel -->
        <div class="absolute bottom-2 sm:bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 sm:space-x-3" x-show="{{ $totalSlides }} > 1">
            <template x-for="i in {{ $totalSlides }}" :key="i">
                <button @click="currentSlide = i - 1" :class="{'bg-white': currentSlide === (i-1), 'bg-gray-400': currentSlide !== (i-1)}" class="w-3 h-3 rounded-full mx-1 focus:outline-none"></button>
            </template>
        </div>
    </div>
</div>
@else
    <!-- Fallback simples quando não há slides publicados -->
    <div class="relative h-full min-h-[120px] max-h-[200px] sm:max-h-full sm:min-h-[320px] md:min-h-[400px] lg:min-h-[420px] xl:min-h-[480px] 2xl:min-h-[520px] flex items-center justify-center bg-gray-100">
        <p class="text-gray-500 text-center px-4">Em breve, conteúdos em destaque do ISP-Bié serão apresentados aqui.</p>
    </div>
@endif
