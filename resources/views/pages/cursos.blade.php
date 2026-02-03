@extends('layouts.site')

@section('content')


@php
if (!function_exists('heroicon')) {
    function heroicon($icon) {
        $icons = [
            'heart' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.54 0-2.94.792-3.75 2.016C11.94 4.542 10.54 3.75 9 3.75c-2.761 0-5 2.015-5 4.5 0 7.22 8 11.25 8 11.25s8-4.03 8-11.25z"/></svg>',
            'users' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-6.13a4 4 0 11-8 0 4 4 0 018 0zm6 10v-2a4 4 0 00-3-3.87M3 20v-2a4 4 0 013-3.87"/></svg>',
            'clipboard-list' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2"/></svg>',
            'heart-pulse' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.97 0-9-4.03-9-9 0-2.21 1.79-4 4-4 1.66 0 3.09 1.02 3.7 2.5h1.6C13.91 9.02 15.34 8 17 8c2.21 0 4 1.79 4 4 0 4.97-4.03 9-9 9z"/></svg>',
            'chat-bubble-left' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0 4.556 4.694 8.25 10.5 8.25 1.2 0 2.36-.14 3.45-.4.41-.09.85.04 1.13.36l2.12 2.12a.75.75 0 001.28-.53v-2.25c0-.41.34-.75.75-.75h.75c.41 0 .75-.34.75-.75V12c0-4.556-4.694-8.25-10.5-8.25S2.25 7.444 2.25 12z"/></svg>',
            'newspaper' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 19.5h-15A1.5 1.5 0 013 18V6a1.5 1.5 0 011.5-1.5h15A1.5 1.5 0 0121 6v12a1.5 1.5 0 01-1.5 1.5z"/></svg>',
            'computer-desktop' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>',
            'calculator' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M8 6h8M8 10h8M8 14h8M8 18h8"/></svg>',
            'briefcase' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7V6a2 2 0 012-2h8a2 2 0 012 2v1m-12 0h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2zm2 4h8"/></svg>',
            'chart-bar' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 13h4v6H7zm6-8h4v14h-4z"/></svg>',
            'code' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></svg>',
            'server' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="20" height="8" x="2" y="4" rx="2"/><rect width="20" height="8" x="2" y="12" rx="2"/><path d="M6 8h.01M6 16h.01"/></svg>',
            'shield-check' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 4v5c0 5.25-3.75 9.75-8 11-4.25-1.25-8-5.75-8-11V7l8-4z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>',
            'faucet' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 0a6 6 0 016 6v2a6 6 0 01-6 6m0-8a6 6 0 00-6 6v2a6 6 0 006 6m0-8v8"/></svg>',
            'drop' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 0a7 7 0 017 7v2a7 7 0 01-7 7m0-8a7 7 0 00-7 7v2a7 7 0 007 7m0-8v8"/></svg>',
            'building' => '<svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21V5a2 2 0 012-2h2a2 2 0 012 2v16m0 0h4m-4 0v-4a2 2 0 012-2h4a2 2 0 012 2v4m0 0h4m-4 0V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v16"/></svg>',
        ];
        return $icons[$icon] ?? '';
    }
}
$cursos = [
    [
        'title' => 'Enfermagem Geral',
        'description' => 'Forma profissionais aptos a atuar na promoção, prevenção, recuperação e reabilitação da saúde, com foco no cuidado humanizado e na gestão em saúde.',
        'department' => 'Ciências da Saúde',
        'domain' => 'Ciências Médicas e da Saúde',
        'duration' => '5 Anos',
        'gradientFrom' => 'green-700',
        'gradientTo' => 'green-500',
        'areas' => [
            ['name' => 'Enfermagem Hospitalar', 'icon' => 'heart'],
            ['name' => 'Saúde Pública', 'icon' => 'users'],
            ['name' => 'Gestão em Saúde', 'icon' => 'clipboard-list'],
        ],
        'link' => '#enfermagem'
    ],
    [
        'title' => 'Psicologia Clínica',
        'description' => 'Forma psicólogos aptos a atuar na promoção da saúde mental, diagnóstico, intervenção terapêutica e acompanhamento psicológico em diversos contextos.',
        'department' => 'Ciências da Saúde',
        'domain' => 'Ciências Médicas e da Saúde',
        'duration' => '5 Anos',
        'gradientFrom' => 'red-600',
        'gradientTo' => 'red-400',
        'areas' => [
            ['name' => 'Psicologia Clínica', 'icon' => 'heart-pulse'],
            ['name' => 'Saúde Mental Comunitária', 'icon' => 'users'],
            ['name' => 'Psicoterapia', 'icon' => 'chat-bubble-left'],
        ],
        'link' => '#psicologia'
    ],
    [
        'title' => 'Comunicação Social',
        'description' => 'Capacita profissionais para atuar em jornalismo, relações públicas, publicidade, comunicação organizacional e produção de conteúdo digital.',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'domain' => 'Ciências Sociais, Jornalismo e Informação',
        'duration' => '4 Anos',
        'gradientFrom' => 'orange-500',
        'gradientTo' => 'orange-400',
        'areas' => [
            ['name' => 'Jornalismo', 'icon' => 'newspaper'],
            ['name' => 'Relações Públicas', 'icon' => 'users'],
            ['name' => 'Comunicação Digital', 'icon' => 'computer-desktop'],
        ],
        'link' => '#comunicacao'
    ],
    [
        'title' => 'Contabilidade e Administração',
        'description' => 'Forma profissionais capacitados para atuar nas áreas de contabilidade, gestão empresarial, auditoria, finanças e administração.',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'domain' => 'Administração, Negócios e Direito',
        'duration' => '4 Anos',
        'gradientFrom' => 'yellow-500',
        'gradientTo' => 'yellow-400',
        'areas' => [
            ['name' => 'Contabilidade e Auditoria', 'icon' => 'calculator'],
            ['name' => 'Gestão Empresarial', 'icon' => 'briefcase'],
            ['name' => 'Consultoria Financeira', 'icon' => 'chart-bar'],
        ],
        'link' => '#contabilidade'
    ],
    [
        'title' => 'Engenharia Informática',
        'description' => 'Prepara profissionais para desenvolver soluções tecnológicas inovadoras, sistemas de informação, redes de computadores e infraestrutura de TI.',
        'department' => 'Engenharias',
        'domain' => 'Engenharias e Telecomunicações',
        'duration' => '5 Anos',
        // Azul lapiseira institucional
        'gradientFrom' => '[#2C4A5E]',
        'gradientTo' => '[#0E8F81]',
        'areas' => [
            ['name' => 'Desenvolvimento de Software', 'icon' => 'code'],
            ['name' => 'Redes e Sistemas', 'icon' => 'server'],
            ['name' => 'Segurança da Informação', 'icon' => 'shield-check'],
        ],
        'link' => '#informatica'
    ],
    [
        'title' => 'Engenharia em Recursos Hídricos',
        'description' => 'Forma engenheiros especializados na gestão sustentável dos recursos hídricos, desenvolvimento de infraestruturas hidráulicas e saneamento básico.',
        'department' => 'Engenharias',
        'domain' => 'Engenharias e Telecomunicações',
        'duration' => '6 Anos',
        'gradientFrom' => 'cyan-500',
        'gradientTo' => 'blue-400',
        'areas' => [
            ['name' => 'Gestão de Recursos Hídricos', 'icon' => 'faucet'],
            ['name' => 'Saneamento e Tratamento de Água', 'icon' => 'drop'],
            ['name' => 'Infraestruturas Hidráulicas', 'icon' => 'building'],
        ],
        'link' => '#hidricos'
    ],
];
@endphp


<style>
@keyframes gradient-move {
  0%, 100% {background-position: 0% 50%;}
  50% {background-position: 100% 50%;}
}
.animated-gradient {
  background-size: 200% 200%!important;
  animation: gradient-move 6s ease-in-out infinite;
}
.icon-animate {
  transition: transform 0.3s cubic-bezier(.4,2,.6,1), filter 0.3s;
}
.icon-animate:hover {
  transform: scale(1.18) rotate(-8deg);
  filter: drop-shadow(0 0 6px rgba(255,255,255,0.7));
}
</style>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 sm:px-6 lg:px-8 py-8">
    @foreach ($cursos as $curso)
    <div class="rounded-2xl shadow-xl transform hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between min-h-[520px]
                bg-gradient-to-r from-{{ $curso['gradientFrom'] == 'green-700' ? 'green-800' : $curso['gradientFrom'] }} to-{{ $curso['gradientTo'] == 'green-500' ? 'green-600' : $curso['gradientTo'] }} animated-gradient group">
            <div class="relative z-10">
                <!-- Ícones de áreas -->
                @if(count($curso['areas']) > 0)
                <div class="flex gap-3 mb-4 flex-wrap">
                    @foreach ($curso['areas'] as $area)
                    <div class="flex flex-col items-center text-white text-sm w-24">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-white/20 mb-1 icon-animate">
                            @if(View::exists('components.heroicon-o-' . ($area['icon'] ?? '')))
                                <x-dynamic-component :component="'heroicon-o-' . $area['icon']" class="w-6 h-6" />
                            [
                                'title' => 'Engenharia Civil',
                                'description' => 'Forma engenheiros para projetar, construir e gerenciar obras de infraestrutura urbana, rodoviária e predial.',
                                'department' => 'Engenharias',
                                'domain' => 'Engenharias e Telecomunicações',
                                'duration' => '5 Anos',
                                // Azul mais claro/descarregado
                                'gradientFrom' => '[#4B6A88]',
                                'gradientTo' => '[#B0C4DE]',
                                'areas' => [
                                    ['name' => 'Estruturas', 'icon' => 'cube-transparent'],
                                    ['name' => 'Geotecnia', 'icon' => 'globe-alt'],
                                    ['name' => 'Transportes', 'icon' => 'truck'],
                                    ['name' => 'Construção Civil', 'icon' => 'building-office-2'],
                                ],
                                'link' => '#civil'
                            ],
            </h3>

            <!-- Departamento e domínio -->
            <p class="text-white/90 mb-4">
                <span class="font-semibold">{{ $curso['department'] }}</span> - {{ $curso['domain'] ?? '' }}
            </p>

            <!-- Descrição resumida -->
            <p class="text-white/80 mb-6">{{ $curso['description'] }}</p>

            <!-- Botão Saiba Mais -->
            <div class="flex-1 flex flex-col justify-end">
                <a href="{{ $curso['link'] ?? '#' }}" 
                   class="inline-block bg-white text-gray-800 font-semibold py-2 px-5 rounded-full text-center shadow transition-all duration-300 
                          hover:bg-yellow-100 hover:text-gray-900 hover:scale-110 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    Saiba Mais
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

