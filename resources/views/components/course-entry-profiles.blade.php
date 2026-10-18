@props(['course', 'label' => null])

@php
    $profiles = \App\Models\Candidatura::$perfisCurso[$course] ?? [];
@endphp

@if($profiles)
<section class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8" aria-label="Perfis de precedência">
    <h2 class="mb-4 flex items-center gap-2 text-lg font-bold uppercase tracking-widest text-[#1e3a5f]">
        <span class="inline-block h-0.5 w-5 bg-[#F05A28]" aria-hidden="true"></span>
        Perfis de Precedência
    </h2>
    <p class="mb-5 text-sm leading-relaxed text-gray-600">
        Perfis do curso de proveniência indicados no formulário de candidatura para {{ $label ?? $course }}.
    </p>
    <ul class="grid gap-2 sm:grid-cols-2">
        @foreach($profiles as $profile)
            <li class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm leading-snug text-slate-700">{{ $profile }}</li>
        @endforeach
    </ul>
    <p class="mt-5 text-sm leading-relaxed text-gray-600">
        Se o seu perfil não estiver listado, consulte as orientações do formulário de candidatura ou contacte a instituição para confirmação.
    </p>
</section>
@endif
