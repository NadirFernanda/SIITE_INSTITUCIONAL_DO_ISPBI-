@props([
    'title',
    'description',
    'buttonText',
    'href',
    'secondaryText' => null,
    'secondaryHref' => null,
    'titleId' => null,
])

<section {{ $attributes->class(['institutional-cta rounded-3xl p-7 text-center sm:p-10']) }} @if($titleId) aria-labelledby="{{ $titleId }}" @endif>
    @isset($icon)
        <div class="mx-auto mb-4 flex justify-center text-white" aria-hidden="true">{{ $icon }}</div>
    @endisset
    <h2 @if($titleId) id="{{ $titleId }}" @endif class="text-xl font-bold text-white sm:text-2xl">{{ $title }}</h2>
    <p class="mx-auto mb-6 mt-3 max-w-2xl text-sm leading-relaxed text-white/90 sm:text-base">{{ $description }}</p>
    <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ $href }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-[#1e3a8a] shadow-lg transition-colors hover:bg-orange-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $buttonText }}</a>
        @if($secondaryText && $secondaryHref)
            <a href="{{ $secondaryHref }}" class="inline-flex items-center justify-center rounded-xl border border-white/60 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $secondaryText }}</a>
        @endif
    </div>
</section>
