@extends('layouts.site')

@section('content')


@php
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
        'gradientFrom' => 'blue-700',
        'gradientTo' => 'blue-500',
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
    <div class="rounded-2xl shadow-xl transform hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between animated-gradient"
         style="background-image: linear-gradient(90deg, var(--tw-gradient-from, theme('colors.{{ $curso['gradientFrom'] }}')), var(--tw-gradient-to, theme('colors.{{ $curso['gradientTo'] }}')));">
        <div class="rounded-2xl shadow-xl transform hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between animated-gradient group"
            style="background-image: linear-gradient(90deg, var(--tw-gradient-from, theme('colors.{{ $curso['gradientFrom'] }}')), var(--tw-gradient-to, theme('colors.{{ $curso['gradientTo'] }}')));">
        <div>
            <!-- Ícones de áreas -->
            <div class="flex gap-3 mb-4">
                @foreach ($curso['areas'] as $area)
                <div class="flex flex-col items-center text-white text-sm">
                    <span class="flex items-center justify-center w-12 h-12 rounded-full bg-white/20 mb-1 icon-animate">
                        @if(View::exists('components.heroicon-o-' . ($area['icon'] ?? '')))
                            <x-dynamic-component :component="'heroicon-o-' . $area['icon']" class="w-6 h-6" />
                        @else
                            <span class="w-6 h-6"></span>
                        @endif
                    </span>
                    <span>{{ $area['name'] }}</span>
                </div>
                @endforeach
            </div>

            <!-- Título do curso -->
                <h3 class="text-2xl font-bold text-white mb-2 transition-all duration-300 group-hover:scale-105 group-hover:text-yellow-100 group-hover:drop-shadow-lg">{{ $curso['title'] }}</h3>

            <!-- Departamento e domínio -->
            <p class="text-white/90 mb-4">
                <span class="font-semibold">{{ $curso['department'] }}</span> - {{ $curso['domain'] ?? '' }}
            </p>

            <!-- Descrição resumida -->
            <p class="text-white/80 mb-6">{{ $curso['description'] }}</p>
        </div>

        <!-- Botão Saiba Mais -->
            <a href="{{ $curso['link'] ?? '#' }}" 
               class="mt-auto inline-block bg-white text-gray-800 font-semibold py-2 px-5 rounded-full text-center shadow transition-all duration-300 hover:bg-yellow-100 hover:scale-110 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-300">
                Saiba Mais
            </a>
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }
        .group:hover .group-hover\:text-yellow-100 {
            color: #fef9c3;
        }
        .group:hover .group-hover\:drop-shadow-lg {
            filter: drop-shadow(0 4px 16px rgba(0,0,0,0.18));
        }
    </style>
    </div>
    @endforeach
</div>

@endsection

