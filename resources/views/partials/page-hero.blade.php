{{--
    Partial reutilizável: Hero banner de topo para páginas internas.
    Parâmetros:
      $title      (string, obrigatório) – Título da página (H1)
      $subtitle   (string, opcional)   – Frase descritiva abaixo do título
      $breadcrumb (string, obrigatório) – Texto do último item do breadcrumb
      $gradient   (string, opcional)   – Classes Tailwind do gradiente (default: from-[#0f1f3d] via-[#1e3a5f] to-[#1d4ed8])
      $ctaUrl     (string, opcional)   – URL do botão de ação (CTA)
      $ctaLabel   (string, opcional)   – Texto do CTA (default: 'Saiba Mais')
--}}
<div class="relative bg-gradient-to-br {{ $gradient ?? 'from-[#0f1f3d] via-[#1e3a5f] to-[#1d4ed8]' }} rounded-2xl overflow-hidden mb-10 shadow-2xl">

    {{-- Decorative glow circles --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full opacity-[0.12]" style="background:radial-gradient(circle,#ffffff,transparent 65%)"></div>
        <div class="absolute -bottom-16 -left-12 w-64 h-64 rounded-full opacity-[0.10]" style="background:radial-gradient(circle,#60a5fa,transparent 65%)"></div>
        <div class="absolute top-1/2 left-1/4 w-[480px] h-28 opacity-[0.06]" style="background:linear-gradient(90deg,#F05A28,transparent 70%);transform:rotate(-12deg);"></div>
        <div class="absolute -bottom-6 right-1/4 w-48 h-48 rounded-full opacity-[0.08]" style="background:radial-gradient(circle,#F05A28,transparent 65%)"></div>
    </div>

    <div class="relative z-10 px-6 py-12 sm:px-10 sm:py-14 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-4" aria-label="Breadcrumb">
                <a href="/" class="hover:text-white transition-colors duration-150 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Início
                </a>
                <svg class="w-3 h-3 opacity-40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">{{ $breadcrumb }}</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight" style="text-shadow:0 2px 20px rgba(0,0,0,0.4);">{{ $title }}</h1>
            @if(!empty($subtitle))
                <p class="mt-3 text-blue-100 text-base sm:text-lg max-w-2xl leading-relaxed opacity-90">{{ $subtitle }}</p>
            @endif
        </div>
        @if(!empty($ctaUrl))
            <a href="{{ $ctaUrl }}"
               class="group inline-flex items-center gap-2 bg-[#F05A28] hover:bg-[#d04a1e] text-white font-bold px-8 py-4 rounded-xl shadow-lg transition-all duration-200 hover:shadow-2xl hover:-translate-y-1 whitespace-nowrap self-start md:self-auto">
                {{ $ctaLabel ?? 'Saiba Mais' }}
                <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        @endif
    </div>

    {{-- Bottom accent bar --}}
    <div class="absolute bottom-0 left-0 right-0 h-[3px]" style="background:linear-gradient(90deg,transparent,#F05A28 30%,#60a5fa 70%,transparent);"></div>
</div>
