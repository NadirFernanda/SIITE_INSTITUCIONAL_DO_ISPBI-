{{-- Hero institucional reutilizável --}}
<div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16 w-full">
    <h1 class="text-5xl font-bold mb-4 px-6 max-w-7xl mx-auto">{{ $title ?? '' }}</h1>
    @if (!empty($subtitle))
        <p class="text-xl text-white opacity-90 px-6 max-w-7xl mx-auto">{{ $subtitle }}</p>
    @endif
</div>
