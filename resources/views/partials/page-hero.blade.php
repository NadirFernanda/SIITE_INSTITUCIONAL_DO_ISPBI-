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
<div class="relative bg-gradient-to-br {{ $gradient ?? 'from-[#0f1f3d] via-[#1e3a5f] to-[#1d4ed8]' }} rounded-2xl overflow-hidden mb-10 shadow-xl">
    {{-- Decorative elements --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full opacity-10" style="background:radial-gradient(circle,#ffffff,transparent 70%)"></div>
        <div class="absolute -bottom-12 -left-10 w-56 h-56 rounded-full opacity-10" style="background:radial-gradient(circle,#ffffff,transparent 70%)"></div>
        <div class="absolute top-1/2 left-1/3 w-96 h-24 opacity-5" style="background:linear-gradient(90deg,#F05A28,transparent);transform:rotate(-15deg);"></div>
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
