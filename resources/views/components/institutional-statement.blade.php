@props(['title'])

<section {{ $attributes->class(['mt-8 rounded-2xl bg-[#1e3a5f] p-6 text-white shadow-sm sm:p-8']) }}>
    <h3 class="mb-4 text-xl font-bold text-white sm:text-2xl">{{ $title }}</h3>
    <div class="leading-relaxed text-white/95">{{ $slot }}</div>
</section>
