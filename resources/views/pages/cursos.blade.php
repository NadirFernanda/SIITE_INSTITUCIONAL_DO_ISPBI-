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
        'description' => 'Prepara profissionais para o cuidado integral de pessoas, famílias e comunidade, com competências em diagnóstico, tratamento, investigação, gestão e educação em enfermagem nos três níveis de atenção.',
        'department' => 'Ciências da Saúde',
        'domain' => 'Ciências Médicas e da Saúde',
        'duration' => '5 Anos',
        'gradientFromHex' => '#16A34A', // verde institucional
        'gradientToHex' => '#4ADE80',   // verde claro
        'areas' => [
            ['name' => 'O Cuidado de enfermagem', 'icon' => 'heart'],
            ['name' => 'A pessoa (família, comunidade)', 'icon' => 'users'],
            ['name' => 'A saúde', 'icon' => 'heart-pulse'],
            ['name' => 'O ambiente', 'icon' => 'drop'],
        ],
        'link' => 'cursos.enfermagem'
    ],
    [
        'title' => 'Psicologia Clínica',
        'description' => 'O licenciado em Psicologia é um profissional que avalia, diagnostica e intervém no desenvolvimento psicológico, promovendo o bem‑estar individual e colectivo. Atua na prevenção, orientação e resolução de problemas em contextos educativos, clínicos, organizacionais e comunitários, desenvolvendo programas, investigações e estratégias de formação, sempre com ética, trabalho multidisciplinar e comunicação eficaz.',
        'department' => 'Ciências da Saúde',
        'domain' => 'Ciências Médicas e da Saúde',
        'duration' => '5 Anos',
        'gradientFromHex' => '#C62828', // vermelho institucional
        'gradientToHex' => '#F05A28',   // laranja institucional
        'areas' => [
            ['name' => 'Psicologia Clínica e da Saúde', 'icon' => 'heart-pulse'],
            ['name' => 'Psicologia Educativa e do Desenvolvimento', 'icon' => 'chat-bubble-left'],
            ['name' => 'Psicologia do Trabalho e Social', 'icon' => 'users'],
        ],
        'link' => 'cursos.psicologia'
    ],
    [
        'title' => 'Comunicação Social',
        'description' => 'O licenciado em Psicologia é um profissional que avalia, diagnostica e intervém no desenvolvimento psicológico, promovendo o bem‑estar individual e colectivo. Atua na prevenção, orientação e resolução de problemas em contextos educativos, clínicos, organizacionais e comunitários, desenvolvendo programas, investigações e estratégias de formação, sempre com ética, trabalho multidisciplinar e comunicação eficaz.',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'domain' => 'Ciências Sociais, Jornalismo e Informação',
        'duration' => '4 Anos',
        'gradientFromHex' => '#F59E42', // laranja institucional
        'gradientToHex' => '#FBBF24',   // laranja claro
        'areas' => [
            ['name' => 'Jornalismo', 'icon' => 'newspaper'],
            ['name' => 'Relações Públicas', 'icon' => 'users'],
            ['name' => 'Comunicação Digital', 'icon' => 'computer-desktop'],
        ],
        'link' => 'cursos.comunicacao'
    ],
    [
        'title' => 'Contabilidade e Administração',
        'description' => 'Forma profissionais em contabilidade, gestão, auditoria e finanças, preparados para orientar a gestão empresarial, direção económica e exercer funções docentes e de auditoria com base em práticas modernas.',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'domain' => 'Administração, Negócios e Direito',
        'duration' => '4 Anos',
        'gradientFromHex' => '#B8860B', // dourado escuro
        'gradientToHex' => '#FFD700',   // amarelo institucional
        'areas' => [
            ['name' => 'Contabilidade e Auditoria', 'icon' => 'calculator'],
            ['name' => 'Gestão Empresarial', 'icon' => 'briefcase'],
            ['name' => 'Consultoria Financeira', 'icon' => 'chart-bar'],
        ],
        'link' => 'cursos.contabilidade'
    ],
    [
        'title' => 'Engenharia Informática',
        'description' => 'Prepara engenheiros em software, arquitetura de computadores, redes e equipamentos eletrónicos, capazes de projetar, desenvolver e gerir soluções informáticas em diversos sectores.',
        'department' => 'Engenharias',
        'domain' => 'Engenharias e Telecomunicações',
        'duration' => '5 Anos',
        'gradientFromHex' => '#2563EB', // azul navbar institucional
        'gradientToHex' => '#60A5FA',   // azul claro
        'areas' => [
            ['name' => 'Desenvolvimento de Software', 'icon' => 'code'],
            ['name' => 'Redes e Sistemas', 'icon' => 'server'],
            ['name' => 'Segurança da Informação', 'icon' => 'shield-check'],
        ],
        'link' => 'cursos.informatica'
    ],
    [
        'title' => 'Engenharia em Recursos Hídricos',
        'description' => 'Forma engenheiros para a gestão sustentável dos recursos hídricos, planeamento e projeto de infraestruturas, avaliação ambiental, pesquisa e ação em saneamento, energia e consultoria.',
        'department' => 'Engenharias',
        'domain' => 'Engenharias e Telecomunicações',
        'duration' => '6 Anos',
        'gradientFromHex' => '#0EA5E9', // azul água (sky-500)
        'gradientToHex' => '#38BDF8',   // azul claro (sky-400)
        'areas' => [
            ['name' => 'Gestão de Recursos Hídricos', 'icon' => 'faucet'],
            ['name' => 'Saneamento e Tratamento de Água', 'icon' => 'drop'],
            ['name' => 'Infraestruturas Hidráulicas', 'icon' => 'building'],
        ],
        'link' => 'cursos.hidricos'
    ],
];

$accredited = [
    ['title' => 'ENFERMAGEM', 'percent' => '65,94%'],
    ['title' => 'PSICOLOGIA', 'percent' => '67,8%'],
    ['title' => 'Engenharia Informática', 'percent' => '68,60%'],
    ['title' => 'Comunicação Social', 'percent' => '73.63%'],
    ['title' => 'Contabilidade', 'percent' => '73,23%'],
];

@endphp

<div x-data="{ dark: false }" class="relative">
    <button @click="dark = !dark" class="absolute right-6 top-4 z-20 px-4 py-2 rounded-lg font-semibold shadow bg-gray-900 text-white hover:bg-gray-700 transition">
        <span x-show="!dark">🌙 Ativar modo escuro</span>
        <span x-show="dark">☀️ Desativar modo escuro</span>
    </button>

    <div :class="dark ? 'bg-gray-900' : ''" class="min-h-screen transition-colors duration-300">


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
            <div :class="dark ? 'bg-gray-800 text-gray-100 border border-gray-700' : 'text-white'"
                :style="dark ? '' : 'background-color: {{ $curso['gradientFromHex'] }}; border: 2px solid {{ $curso['gradientToHex'] }};'"
                class="rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg transition-all duration-300 p-6 flex flex-col justify-between group h-full min-h-[200px]">

                <div class="relative z-10 flex flex-col h-full">
                    <!-- Conteúdo do card com espaçamento melhorado -->
                    <div class="flex flex-col gap-3 h-full">
                        <!-- Título do curso (forçar ordem 1) -->
                        <div class="order-1">
                            <h3 :class="dark ? 'text-yellow-300' : 'text-white'" class="text-xl font-bold mb-1 transition-all duration-300 group-hover:scale-105 group-hover:text-yellow-100 group-hover:drop-shadow-lg leading-tight">
                                {{ $curso['title'] }}
                            </h3>
                        </div>

                        <!-- Perfis de saída / Áreas (após o título) - ordem 2 -->
                        <div class="order-2">
                            @if(count($curso['areas']) > 0)
                            <div :class="dark ? 'text-gray-100 font-semibold text-sm mb-2' : 'text-white font-semibold text-sm mb-2'">Perfil de saída</div>
                            <div class="flex gap-4 mb-3 flex-wrap items-start">
                                @foreach ($curso['areas'] as $area)
                                <div :class="dark ? 'text-gray-100' : 'text-white'" class="flex flex-col items-start text-sm w-auto min-w-[140px]">
                                    <span class="flex items-center justify-center w-10 h-10 rounded-full mb-2 icon-animate" :class="dark ? 'bg-gray-700' : 'bg-white/20'">
                                        {!! heroicon($area['icon'] ?? '') !!}
                                    </span>
                                    <span class="text-left text-sm leading-snug">{{ $area['name'] }}</span>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Departamento e domínio - ordem 3 -->
                        <div class="order-3">
                            <p :class="dark ? 'text-gray-200' : 'text-white/90'" class="mb-2 text-base">
                                @php
                                    $omitDomain = false;
                                    if(isset($curso['domain'])) {
                                        $dept = trim($curso['department'] ?? '');
                                        $dom = trim($curso['domain'] ?? '');
                                        if(($dept === 'Ciências da Saúde' && $dom === 'Ciências Médicas e da Saúde') || ($dept === 'Ciências Humanas, Sociais e Económicas' && $dom === 'Ciências Sociais, Jornalismo e Informação')) {
                                            $omitDomain = true;
                                        }
                                    }
                                @endphp

                                @if($omitDomain)
                                    <span class="font-semibold">{{ $curso['department'] }}</span>
                                @else
                                    <span class="font-semibold">{{ $curso['department'] }}</span>@if(!empty($curso['domain'])) - {{ $curso['domain'] }}@endif
                                @endif
                            </p>
                        </div>

                        <!-- Descrição resumida - ordem 4 (empurrada para baixo) -->
                        <div class="order-4 mt-auto">
                            <p :class="dark ? 'text-gray-300' : 'text-white/80'" class="mb-0 text-sm leading-relaxed">{{ $curso['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>

        <!-- Cursos Acreditados -->
        <section class="mt-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Cursos Acreditados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($accredited as $ac)
                        <div class="bg-white/90 dark:bg-gray-800 rounded-lg shadow p-5 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $ac['title'] }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Acreditação oficial</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <span class="inline-flex items-center justify-center px-3 py-2 rounded-full bg-[#2563eb] text-white font-bold text-lg">{{ $ac['percent'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
</div>

@endsection

