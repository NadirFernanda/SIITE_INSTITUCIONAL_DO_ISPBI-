@extends('layouts.site')

@section('title', 'Artigos Científicos - ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">

    {{-- Hero Banner --}}
    <div class="relative bg-gradient-to-r from-[#1e3a5f] to-[#2563eb] rounded-2xl overflow-hidden mb-10 shadow-xl">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" viewBox="0 0 800 200" preserveAspectRatio="none">
                <circle cx="700" cy="-50" r="200" fill="white"/>
                <circle cx="100" cy="250" r="150" fill="white"/>
            </svg>
        </div>
        <div class="relative z-10 px-6 py-10 sm:px-10 sm:py-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <nav class="text-sm text-blue-200 mb-3">
                    <a href="/" class="hover:text-white transition-colors">Início</a>
                    <span class="mx-2 opacity-50">/</span>
                    <span class="text-white">Artigos Científicos</span>
                </nav>
                <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight">Artigos Científicos</h1>
                <p class="mt-2 text-blue-100 text-base sm:text-lg max-w-xl">
                    Portal de publicações científicas, académicas e de investigação do ISP-Bié
                </p>
            </div>
            <a href="{{ route('revista.submeter') }}"
               class="inline-flex items-center gap-2 bg-[#F05A28] hover:bg-[#d04a1e] text-white font-semibold px-6 py-3 rounded-xl shadow transition-colors duration-200 whitespace-nowrap self-start md:self-auto">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Submeter Artigo
            </a>
        </div>
    </div>

    {{-- Áreas de Conhecimento --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5">
            <div class="w-10 h-10 bg-[#2563eb] rounded-lg flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Engenharias e Tecnologia</h3>
            <p class="text-xs text-gray-600">Informática, Recursos Hídricos, Engenharia Civil e áreas correlatas.</p>
        </div>
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 border border-teal-200 rounded-xl p-5">
            <div class="w-10 h-10 bg-[#0E8F81] rounded-lg flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Ciências da Saúde</h3>
            <p class="text-xs text-gray-600">Psicologia Clínica, saúde pública, interação bio-social e bem-estar.</p>
        </div>
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-5">
            <div class="w-10 h-10 bg-[#F05A28] rounded-lg flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Ciências Sociais, Humanas e Económicas</h3>
            <p class="text-xs text-gray-600">Contabilidade, Administração, Comunicação Social e Ciências do Comportamento.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="p-4 mb-6 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">{{ session('status') }}</div>
    @endif

    {{-- Normas de Submissão --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8 mb-10">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-[#F05A28] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Normas e Instruções para Autores
        </h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Formato</p>
                <p class="text-sm text-gray-700">IMRAD (Introdução, Métodos, Resultados e Discussão). Fonte Times New Roman 12, espaçamento 1,5.</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Extensão</p>
                <p class="text-sm text-gray-700">Entre 4 000 e 8 000 palavras. Resumo de até 250 palavras em português e inglês (abstract).</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Citações</p>
                <p class="text-sm text-gray-700">Norma APA 7.ª edição. Todas as referências devem ser veriíicaveis e completas.</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Prazo</p>
                <p class="text-sm text-gray-700">Submissões abertas em continuidade. Resposta de avaliação em até 60 dias úteis.</p>
            </div>
        </div>
        <div class="mt-5 flex flex-wrap gap-3 items-center">
            <a href="{{ route('revista.submeter') }}" class="inline-flex items-center gap-2 bg-[#F05A28] hover:bg-[#d04a1e] text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Submeter o meu Artigo
            </a>
            <span class="text-xs text-gray-500">Submissões sujeitas a revisão por pares antes da publicação.</span>
        </div>
    </div>

    {{-- Artigos Publicados --}}
    <section class="mb-12">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Artigos Publicados
            </h2>
            <form method="GET" action="{{ route('revista') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 w-full sm:w-auto">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar por título, autor…"
                       class="w-full sm:w-56 px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]" />
                <select name="category" aria-label="Filtrar por área"
                        class="w-full sm:w-auto px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                    <option value="">Todas as áreas</option>
                    <option value="Engenharias e Tecnologia" {{ request('category')=='Engenharias e Tecnologia' ? 'selected' : '' }}>Engenharias e Tecnologia</option>
                    <option value="Ciências da Saúde" {{ request('category')=='Ciências da Saúde' ? 'selected' : '' }}>Ciências da Saúde</option>
                    <option value="Ciências Sociais e Humanas" {{ request('category')=='Ciências Sociais e Humanas' ? 'selected' : '' }}>Ciências Sociais e Humanas</option>
                </select>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-sm font-semibold rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Pesquisar
                </button>
            </form>
        </div>
                @if(isset($articles) && $articles->count())
                    @php
                        if (method_exists($articles, 'getCollection')) {
                            $collection = $articles->getCollection();
                        } else {
                            $collection = collect($articles);
                        }
                        $groups = $collection->groupBy(function($item){ return $item->category ?: 'Sem área de conhecimento'; });
                    @endphp

                    <div class="space-y-10">
                        @foreach($groups as $area => $group)
                            <div>
                                <div class="flex items-center gap-3 mb-5">
                                    <span class="text-base font-bold text-gray-900">{{ $area }}</span>
                                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $group->count() }} artigo(s)</span>
                                </div>
                                <div class="grid gap-4">
                                    @foreach($group as $a)
                                        @php
                                            $cardUrl = $a->link ?: route('revista.show', $a->id);
                                            $external = (bool) $a->link;
                                        @endphp
                                        <a href="{{ $cardUrl }}" @if($external) target="_blank" rel="noopener noreferrer" @endif
                                           class="block group rounded-xl border border-gray-200 hover:border-[#2563eb] hover:shadow-md transition-all duration-200 bg-white no-underline text-current">
                                            <article class="p-5 sm:p-6">
                                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 group-hover:text-[#2563eb] transition-colors leading-snug">{{ $a->title }}</h3>
                                                    <time class="text-xs text-gray-400 whitespace-nowrap flex-shrink-0">{{ $a->published_at ? $a->published_at->format('d/m/Y') : $a->created_at->format('d/m/Y') }}</time>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    <span class="font-medium text-gray-700">{{ $a->author }}</span>
                                                    @if($a->affiliation) <span class="text-gray-400">&mdash; {{ $a->affiliation }}</span>@endif
                                                </p>
                                                @if($a->description)
                                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ Str::limit(strip_tags($a->description), 220) }}</p>
                                                @endif
                                                <div class="mt-4 flex items-center gap-1.5 text-sm text-[#2563eb] font-medium">
                                                    @if($external)
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                        Abrir artigo (link externo)
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                        Ler artigo completo
                                                    @endif
                                                </div>
                                            </article>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $articles->withQueryString()->links() }}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-16 text-center bg-gray-50 border border-dashed border-gray-300 rounded-2xl">
                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        <p class="text-gray-500 text-sm font-medium">Ainda não há artigos publicados.</p>
                        <p class="text-gray-400 text-xs mt-1">Seja o primeiro a submeter um artigo científico.</p>
                        <a href="{{ route('revista.submeter') }}" class="mt-4 inline-flex items-center gap-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-colors">
                            Submeter Artigo
                        </a>
                    </div>
                @endif
    </section>

</div>
@endsection

