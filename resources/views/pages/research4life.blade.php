@extends('layouts.site')

@section('title', 'Research4Life')
@section('meta_description', 'Acesso institucional do ISP-Bié ao Research4Life para estudantes, docentes e investigadores.')
@section('meta_keywords', 'Research4Life, biblioteca digital, bases de dados científicas, ISP-Bié, investigação')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
    @include('partials.page-hero', [
        'title'      => 'Research4Life',
        'subtitle'   => 'Acesso a informação científica e recursos académicos para a comunidade do ISP-Bié.',
        'breadcrumb' => 'Research4Life',
        'ctaUrl'     => 'https://login.research4life.org/tacgw/login.cshtml',
        'ctaLabel'   => 'Aceder ao Research4Life',
    ])

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <section class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 sm:p-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-[#1d4ed8] flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-[#0f1f3d]">O ISP-Bié é membro do Research4Life</h2>
                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Na qualidade de instituição elegível e membro do Research4Life, o Instituto Superior
                            Politécnico do Bié proporciona à sua comunidade académica uma porta de entrada para
                            uma das mais importantes redes internacionais de informação científica.
                        </p>
                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Estudantes, docentes e investigadores podem utilizar este recurso para encontrar
                            literatura científica de qualidade, reforçar trabalhos académicos, apoiar aulas e
                            desenvolver investigação com maior profundidade e credibilidade.
                        </p>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <h3 class="font-semibold text-[#0f1f3d]">Artigos científicos</h3>
                        <p class="mt-1 text-sm text-slate-600">Literatura académica para fundamentar os seus trabalhos.</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <h3 class="font-semibold text-[#0f1f3d]">Revistas e livros</h3>
                        <p class="mt-1 text-sm text-slate-600">Recursos de editoras e bases de dados especializadas.</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <h3 class="font-semibold text-[#0f1f3d]">Apoio à investigação</h3>
                        <p class="mt-1 text-sm text-slate-600">Informação para estudantes, docentes e investigadores.</p>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-[#0f1f3d]">Como aceder</h2>
                <ol class="mt-5 space-y-4 text-slate-600">
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#F05A28] text-sm font-bold text-white">1</span>
                        <span>Clique em <strong class="text-slate-800">Aceder ao Research4Life</strong>.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#F05A28] text-sm font-bold text-white">2</span>
                        <span>Na plataforma oficial, utilize o método de autenticação disponibilizado à instituição.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#F05A28] text-sm font-bold text-white">3</span>
                        <span>Pesquise e consulte os recursos de acordo com as regras de utilização do serviço.</span>
                    </li>
                </ol>
            </section>
        </div>

        <aside class="space-y-6">
            <section class="rounded-2xl bg-[#0f1f3d] p-6 sm:p-8 text-white shadow-lg">
                <h2 class="text-xl font-bold">Acesso institucional</h2>
                <p class="mt-3 text-blue-100 leading-relaxed">
                    O login é processado exclusivamente no site oficial do Research4Life.
                    O ISP-Bié não recolhe nem armazena as suas credenciais nesta página.
                </p>
                <a href="https://login.research4life.org/tacgw/login.cshtml"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#F05A28] px-5 py-3 text-center font-bold text-white transition hover:bg-[#d04a1e] focus:outline-none focus:ring-2 focus:ring-white"
                   aria-label="Abrir o Research4Life numa nova aba">
                    Abrir acesso oficial
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5h5m0 0v5m0-5L10 14"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14v3a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h3"/>
                    </svg>
                </a>
            </section>

            <section class="rounded-2xl border border-orange-200 bg-orange-50 p-6">
                <h2 class="font-bold text-[#9a3412]">Precisa de ajuda?</h2>
                <p class="mt-2 text-sm leading-relaxed text-orange-900">
                    Se não conseguir entrar, contacte a Biblioteca ou os serviços de suporte do ISP-Bié.
                    Não envie a sua palavra-passe por e-mail ou mensagem.
                </p>
                <a href="{{ route('contactos') }}" class="mt-4 inline-flex font-semibold text-[#c2410c] hover:underline">
                    Contactar o ISP-Bié
                    <span aria-hidden="true" class="ml-1">→</span>
                </a>
            </section>
        </aside>
    </div>
</div>
@endsection
