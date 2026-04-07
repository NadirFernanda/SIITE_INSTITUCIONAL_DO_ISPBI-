<div
    class="relative w-full max-w-5xl mx-auto my-12"
    x-data="{
        current: 0,
        total: {{ $noticiasRecentes->count() }},
        autoplay: null,
        next() { this.current = (this.current + 1) % this.total },
        goTo(i) { this.current = i },
        startAutoplay() {
            if (this.total > 1) {
                this.autoplay = setInterval(() => { this.next() }, 6000);
            }
        },
        stopAutoplay() {
            if (this.autoplay) clearInterval(this.autoplay);
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
>
    <div class="overflow-hidden rounded-2xl shadow-lg bg-white">
        <div class="flex transition-transform duration-700 ease-out" :style="'transform: translateX(-' + (current * 100) + '%)'">
            @foreach($noticiasRecentes as $noticia)
                <div class="min-w-full flex flex-col md:flex-row">
                    @if($noticia->imagem)
                        <div class="md:w-1/2 h-64 md:h-80 bg-cover bg-center" style="background-image:url('{{ asset('storage/' . $noticia->imagem) }}')"></div>
                    @else
                        <div class="md:w-1/2 h-64 md:h-80 bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 p-8 flex flex-col justify-between">
                        <div>
                            <span class="block text-xs text-gray-500 mb-1">{{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}</span>
                            <h3 class="text-2xl font-bold text-[#2563eb] mb-2">{{ $noticia->titulo }}</h3>
                            <p class="text-gray-700 text-base mb-4">{{ Str::limit($noticia->texto, 180) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Navegação -->
    <div class="flex justify-center mt-4 space-x-2">
        <template x-for="i in total" :key="i">
            <button
                @click="goTo(i - 1)"
                :class="{'bg-[#2563eb]': current === (i-1), 'bg-gray-300': current !== (i-1)}"
                class="w-3 h-3 rounded-full focus:outline-none"
            ></button>
        </template>
    </div>

    <!-- Botão fora do carrossel, abaixo das bolinhas -->
    <div class="flex flex-col items-center gap-3 mt-5">
        <a href="/noticias"
           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white transition-all duration-200 shadow-md hover:shadow-lg bg-[#F05A28] hover:bg-[#d44d20] hover:-translate-y-[1px]">
            Ler mais notícias
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</div>
