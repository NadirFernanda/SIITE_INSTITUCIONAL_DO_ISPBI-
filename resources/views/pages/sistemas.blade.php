@extends('layouts.site')

@section('content')
<div class="institutional-page">
    @include('partials.page-hero', [
        'title' => 'Sistemas Institucionais',
        'subtitle' => 'Plataformas e serviços digitais — acesso centralizado aos sistemas do ISP-Bié.',
        'breadcrumb' => 'Sistemas',
    ])

    <section class="institutional-card" aria-labelledby="infraestrutura-digital">
        <h2 id="infraestrutura-digital" class="institutional-heading">Infraestrutura Digital</h2>
        <p class="mt-4 max-w-3xl leading-relaxed text-slate-700">
            O ISP-Bié disponibiliza sistemas e plataformas digitais para facilitar o acesso a serviços, informações e recursos acadêmicos. Desenvolvidos com foco em eficiência, segurança e facilidade de uso.
        </p>
    </section>

    <section class="mt-10" aria-labelledby="sistemas-administrativos">
        <h2 id="sistemas-administrativos" class="institutional-heading">Sistemas Administrativos</h2>
        <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="institutional-card flex h-full flex-col">
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#1e3a5f]" aria-hidden="true">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="m18 8.118-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#1e3a5f]">Webmail Institucional</h3>
                <p class="mt-2 flex-1 leading-relaxed text-slate-600">E-mail institucional @ispbie.ao para estudantes e funcionários</p>
                <a href="http://mx100.angoweb.net/webmail" target="_blank" rel="noopener noreferrer"
                    class="mt-6 inline-flex self-start rounded-lg font-semibold text-[#1e3a5f] underline decoration-[#F05A28] underline-offset-4 hover:text-[#2563eb] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#F05A28]">
                    Aceder ao Webmail <span class="sr-only">(abre numa nova janela)</span>
                </a>
            </article>

            <article class="institutional-card flex h-full flex-col">
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#1e3a5f]" aria-hidden="true">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#1e3a5f]">Sistema de RH</h3>
                <p class="mt-2 flex-1 leading-relaxed text-slate-600">Gestão de recursos humanos</p>
                <p class="mt-6 text-sm font-medium text-slate-500">Ligação não indicada nesta página</p>
            </article>

            <article class="institutional-card flex h-full flex-col">
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#1e3a5f]" aria-hidden="true">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3 3-7 3s-7-1.343-7-3zM3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3 3-7 3S3 8.657 3 7zM17 5c0 1.657-3 3-7 3S3 6.657 3 5s3-3 7-3 7 1.343 7 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#1e3a5f]">E-Learning</h3>
                <p class="mt-2 flex-1 leading-relaxed text-slate-600">Plataforma de educação à distância</p>
                <p class="mt-6 text-sm font-medium text-slate-500">Ligação não indicada nesta página</p>
            </article>
        </div>
    </section>

    <section class="institutional-card mt-10" aria-labelledby="seguranca-privacidade">
        <h2 id="seguranca-privacidade" class="institutional-heading">Segurança e Privacidade</h2>
        <p class="mt-4 max-w-3xl leading-relaxed text-slate-700">
            Todos os nossos sistemas utilizam protocolos de segurança avançados para proteger seus dados pessoais e garantir a privacidade das informações acadêmicas.
        </p>
        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <h3 class="font-bold text-[#1e3a5f]">Criptografia SSL</h3>
                <p class="mt-1 text-sm text-slate-600">Dados protegidos</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <h3 class="font-bold text-[#1e3a5f]">Backup Diário</h3>
                <p class="mt-1 text-sm text-slate-600">Segurança de dados</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <h3 class="font-bold text-[#1e3a5f]">Conformidade LGPD</h3>
                <p class="mt-1 text-sm text-slate-600">Privacidade garantida</p>
            </div>
        </div>
    </section>
</div>
@endsection
