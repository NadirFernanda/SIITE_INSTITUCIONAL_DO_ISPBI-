@props([
    'title',
    'duration',
    'department',
    'domain',
    'areas' => [],
    'gradientFrom' => 'blue-500',
    'gradientTo' => 'blue-400',
    'link' => null,
])

@php
if (!function_exists('heroicon')) {
    function heroicon($icon) {
        $icons = [
            'heart' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.54 0-2.94.792-3.75 2.016C11.94 4.542 10.54 3.75 9 3.75c-2.761 0-5 2.015-5 4.5 0 7.22 8 11.25 8 11.25s8-4.03 8-11.25z"/></svg>',
            'users' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-6.13a4 4 0 11-8 0 4 4 0 018 0zm6 10v-2a4 4 0 00-3-3.87M3 20v-2a4 4 0 013-3.87"/></svg>',
            'building-office' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21V5a2 2 0 012-2h2a2 2 0 012 2v16m0 0h4m-4 0v-4a2 2 0 012-2h4a2 2 0 012 2v4m0 0h4m-4 0V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v16"/></svg>',
            'chat-bubble-left' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0 4.556 4.694 8.25 10.5 8.25 1.2 0 2.36-.14 3.45-.4.41-.09.85.04 1.13.36l2.12 2.12a.75.75 0 001.28-.53v-2.25c0-.41.34-.75.75-.75h.75c.41 0 .75-.34.75-.75V12c0-4.556-4.694-8.25-10.5-8.25S2.25 7.444 2.25 12z"/></svg>',
            'clipboard-check' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m-6 8h6a2 2 0 002-2V7a2 2 0 00-2-2h-1.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v11a2 2 0 002 2z"/></svg>',
            'brain' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4a4 4 0 00-4 4v8a4 4 0 008 0V8a4 4 0 00-4-4z"/></svg>',
            'newspaper' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 19.5h-15A1.5 1.5 0 013 18V6a1.5 1.5 0 011.5-1.5h15A1.5 1.5 0 0121 6v12a1.5 1.5 0 01-1.5 1.5z"/></svg>',
            'megaphone' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 8.25V5.25A2.25 2.25 0 0012.75 3h-1.5A2.25 2.25 0 009 5.25v3m6 0v7.5m0 0a2.25 2.25 0 01-2.25 2.25h-1.5A2.25 2.25 0 019 15.75v-7.5m6 0H9"/></svg>',
            'chart-bar' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 13h4v6H7zm6-8h4v14h-4z"/></svg>',
            'code' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></svg>',
            'server' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="20" height="8" x="2" y="4" rx="2"/><rect width="20" height="8" x="2" y="12" rx="2"/><path d="M6 8h.01M6 16h.01"/></svg>',
            'shield-check' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 4v5c0 5.25-3.75 9.75-8 11-4.25-1.25-8-5.75-8-11V7l8-4z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>',
            'clipboard-list' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2"/></svg>',
            'cash' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="3"/><path d="M6 6v12M18 6v12"/></svg>',
            'calculator' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M8 6h8M8 10h8M8 14h8M8 18h8"/></svg>',
            'chart-line' => '<svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 17l6-6 4 4 8-8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21H3"/></svg>',
        ];
        return $icons[$icon] ?? '';
    }
}
@endphp

<div class="bg-gradient-to-r from-{{ $gradientFrom }} to-{{ $gradientTo }} rounded-2xl p-7 shadow-xl backdrop-blur-md transition-transform transform hover:scale-105 hover:shadow-2xl relative overflow-hidden group">
    <!-- Título e Duração -->
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-2xl font-bold text-white drop-shadow">{{ $title }}</h3>
        <span class="text-xs font-semibold text-white/80 bg-white/10 px-3 py-1 rounded-full">{{ $duration }}</span>
    </div>
    <p class="text-sm text-white/80 mb-2">
        <span class="font-semibold">Departamento:</span> {{ $department }}<br>
        <span class="font-semibold">Domínio:</span> {{ $domain }}
    </p>
    <!-- Áreas de Atuação com ícones -->
    @if(count($areas) > 0)
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($areas as $area)
                <span class="flex items-center gap-1 bg-white/20 text-white text-xs font-medium px-2 py-1 rounded-full shadow-sm">
                    {!! heroicon($area['icon'] ?? '') !!}
                    {{ $area['name'] ?? $area }}
                </span>
            @endforeach
        </div>
    @endif
    <!-- Descrição -->
    <p class="text-white/90 text-sm leading-relaxed mb-5">{{ $slot }}</p>
    <!-- Botão Saiba Mais -->
    @if($link)
        <a href="{{ $link }}" class="inline-block mt-2 px-5 py-2 rounded-full bg-white/90 text-gray-800 font-bold shadow hover:bg-white hover:scale-105 transition-all">Saiba mais</a>
    @endif
    <!-- Efeito visual decorativo -->
    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl opacity-60 group-hover:opacity-80 transition-all"></div>
</div>
