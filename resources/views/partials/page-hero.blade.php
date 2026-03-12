{{--
    Partial reutilizável: Hero banner de topo para páginas internas.
    Parâmetros:
      $title      (string, obrigatório) – Título da página (H1)
      $subtitle   (string, opcional)   – Frase descritiva abaixo do título
      $breadcrumb (string, obrigatório) – Texto do último item do breadcrumb
      $gradient   (string, opcional)   – Classes Tailwind do gradiente (default: from-[#1e3a5f] to-[#2563eb])
      $ctaUrl     (string, opcional)   – URL do botão de ação (CTA)
      $ctaLabel   (string, opcional)   – Texto do CTA (default: 'Saiba Mais')
--}}
<div class="relative bg-gradient-to-r {{ $gradient ?? 'from-[#1e3a5f] to-[#2563eb]' }} rounded-2xl overflow-hidden mb-10 shadow-xl">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg width="100%" height="100%" viewBox="0 0 800 200" preserveAspectRatio="none">
            <circle cx="700" cy="-50" r="200" fill="white"/>
            <circle cx="100" cy="250" r="150" fill="white"/>
        </svg>
    </div>
    <div class="relative z-10 px-6 py-10 sm:px-10 sm:py-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <nav class="text-sm text-blue-200 mb-3" aria-label="Breadcrumb">
                <a href="/" class="hover:text-white transition-colors">Início</a>
                <span class="mx-2 opacity-50">/</span>
                <span class="text-white">{{ $breadcrumb }}</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight">{{ $title }}</h1>
            @if(!empty($subtitle))
                <p class="mt-2 text-blue-100 text-base sm:text-lg max-w-xl">{{ $subtitle }}</p>
            @endif
        </div>
        @if(!empty($ctaUrl))
            <a href="{{ $ctaUrl }}"
               class="inline-flex items-center gap-2 bg-[#F05A28] hover:bg-[#d04a1e] text-white font-semibold px-6 py-3 rounded-xl shadow transition-colors duration-200 whitespace-nowrap self-start md:self-auto">
                {{ $ctaLabel ?? 'Saiba Mais' }}
            </a>
        @endif
    </div>
</div>
