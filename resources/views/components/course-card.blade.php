@props([
    'title',
    'duration',
    'department',
    'domain',
    'areas' => [],
    'gradientFrom' => 'blue-500',
    'gradientTo' => 'blue-400',
])

<div class="bg-gradient-to-r from-{{ $gradientFrom }} to-{{ $gradientTo }} rounded-xl p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl">
    <!-- Título e Duração -->
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>
        <span class="text-sm font-medium text-white/80">{{ $duration }}</span>
    </div>

    <!-- Departamento e Domínio -->
    <p class="text-sm text-white/80 mb-4">
        <span class="font-semibold">Departamento:</span> {{ $department }}<br>
        <span class="font-semibold">Domínio:</span> {{ $domain }}
    </p>

    <!-- Áreas de Atuação -->
    @if(count($areas) > 0)
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($areas as $area)
                <span class="bg-white/20 text-white text-xs font-medium px-2 py-1 rounded-full">{{ $area }}</span>
            @endforeach
        </div>
    @endif

    <!-- Descrição -->
    <p class="text-white/90 text-sm leading-relaxed">{{ $slot }}</p>
</div>
