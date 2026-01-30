@php
        $testemunhos = \App\Models\Alumnus::where('publicado', 1)->whereNotNull('testemunho')->orderByDesc('id')->take(10)->get();
@endphp
@if($testemunhos->count())
<div class="relative w-full max-w-7xl mx-auto my-12" x-data="{ current: 0, total: {{ $testemunhos->count() }} }" x-init="setInterval(() => { current = (current + 1) % total }, 7000)">
        <div class="overflow-hidden rounded-2xl shadow-lg bg-white">
                <div class="flex transition-transform duration-700" :style="'transform: translateX(-' + (current * 100) + '%)'">
                        @foreach($testemunhos as $t)
                                <div class="min-w-full flex flex-col justify-between p-6 hover:shadow-xl transition-shadow">
                                        <div class="flex items-center mb-4">
                                                <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                                        {{ strtoupper(mb_substr($t->nome, 0, 2, 'UTF-8')) }}
                                                </div>
                                                <div class="ml-4">
                                                        <h4 class="font-bold text-gray-900">{{ $t->nome }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $t->curso ?? $t->cargo }}</p>
                                                </div>
                                        </div>
                                        <p class="text-gray-700 italic mb-4">"{{ $t->testemunho }}"</p>
                                        <div class="flex text-[#3B82F6]">
                                                @for($i = 0; $i < ($t->satisfacao ?? 5); $i++)
                                                        <span>★</span>
                                                @endfor
                                        </div>
                                </div>
                        @endforeach
                </div>
        </div>
        <!-- Navegação -->
        <div class="flex justify-center mt-4 space-x-2">
                <template x-for="i in total" :key="i">
                        <button @click="current = i - 1" :class="{'bg-[#2563eb]': current === (i-1), 'bg-gray-300': current !== (i-1)}" class="w-3 h-3 rounded-full focus:outline-none"></button>
                </template>
        </div>
</div>
@else
<div class="text-center text-gray-500 py-12">Nenhum testemunho publicado ainda.</div>
@endif
