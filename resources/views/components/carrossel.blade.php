@php
    $carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->get();
@endphp
<div class="relative" x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % {{ $carrosseis->count() }} }, 5000)">
    <div class="relative h-[300px] sm:h-[400px] lg:h-[500px] overflow-hidden">
        @foreach($carrosseis as $index => $carrossel)
            <div x-show="currentSlide === {{ $index }}" x-cloak class="absolute inset-0 transition-opacity duration-700">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $carrossel->imagem) }}');"></div>
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="relative h-full flex items-center justify-center">
                    <div class="text-center text-white px-4 max-w-4xl">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-4">{{ $carrossel->titulo }}</h2>
                        @if($carrossel->subtitulo)
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 sm:mb-6">{{ $carrossel->subtitulo }}</p>
                        @endif
                        @if($carrossel->link && $carrossel->texto_botao)
                        <a href="{{ $carrossel->link }}" class="inline-block bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#d94b1f] transition-colors">
                            {{ $carrossel->texto_botao }}
                        </a>
                        @elseif($carrossel->link)
                        <a href="{{ $carrossel->link }}" class="inline-block bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#d94b1f] transition-colors">
                            CONHEÇA MAIS
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Setas de navegação -->
        <button @click="currentSlide = (currentSlide + {{ $carrosseis->count() }} - 1) % {{ $carrosseis->count() }}" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow focus:outline-none z-20">
            <svg class="w-6 h-6 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="currentSlide = (currentSlide + 1) % {{ $carrosseis->count() }}" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow focus:outline-none z-20">
            <svg class="w-6 h-6 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <!-- Indicadores do carrossel -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
            <template x-for="i in {{ $carrosseis->count() }}" :key="i">
                <button @click="currentSlide = i - 1" :class="{'bg-white': currentSlide === (i-1), 'bg-gray-400': currentSlide !== (i-1)}" class="w-3 h-3 rounded-full mx-1 focus:outline-none"></button>
            </template>
        </div>
    </div>
</div>
