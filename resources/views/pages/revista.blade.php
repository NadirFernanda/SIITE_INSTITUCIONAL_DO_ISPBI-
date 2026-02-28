@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
        <nav class="text-sm opacity-75 mb-8">
            <a href="/" class="hover:underline">Início</a> \ Revista Científica
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
            <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Revista Científica</h1>
            <p class="text-lg text-gray-700">Publicações científicas e académicas do Instituto Superior Politécnico do Bié</p>
            <p class="mt-3 text-gray-600 max-w-2xl">A Revista reúne artigos, comunicados e estudos produzidos por docentes, investigadores e estudantes das áreas de Engenharias, Ciências Sociais, Gestão e áreas afins.</p>
        </div>

        @if(session('status'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            </div>
        @endif

        <!-- Conteúdo Principal -->
        <section class="py-16 bg-white scroll-reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <div class="lg:col-span-3">
                        <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
                            <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Última Edição</h2>
                            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                                <div class="grid md:grid-cols-3 gap-6 items-start">
                                    <div class="col-span-1">
                                        <div class="w-full h-64 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-lg flex items-center justify-center text-white">
                                            <span class="text-6xl font-bold">Vol. 1</span>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Volume 1, Número 1 (2026)</h3>
                                        <p class="text-gray-600 mb-4">Edição inaugural da Revista Científica do ISP-Bié com artigos selecionados por áreas de conhecimentos.</p>
                                        <div class="flex gap-3">
                                            <a href="#" class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700">Acessar Edição</a>
                                            <a href="#" class="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50">Índice Completo</a>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-6">

                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Submissão de Artigos</h3>
                                <p class="text-gray-700 mb-4">A Revista Científica do ISP-Bié aceita submissões de artigos nas áreas de Engenharias e Tecnologia, Ciências da Saúde e Ciências Humanas, Sociais e Econômicas.</p>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('revista.submeter') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Submeter Artigo</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Artigos Publicados</h2>
                    <form method="GET" action="{{ route('revista') }}" class="flex items-center gap-2">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar artigos, autor, título..." class="px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        <select name="category" aria-label="Filtrar por área" class="px-3 py-2 border rounded-lg shadow-sm">
                            <option value="">Todas as áreas</option>
                            <option value="Engenharias e Tecnologia" {{ request('category')=='Engenharias e Tecnologia' ? 'selected' : '' }}>Engenharias e Tecnologia</option>
                            <option value="Ciências da Saúde" {{ request('category')=='Ciências da Saúde' ? 'selected' : '' }}>Ciências da Saúde</option>
                            <option value="Ciências Sociais e Humanas" {{ request('category')=='Ciências Sociais e Humanas' ? 'selected' : '' }}>Ciências Sociais e Humanas</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Pesquisar</button>
                    </form>
                </div>
                @if(isset($articles) && $articles->count())
                    @php
                        // Group articles by category (keep compatibility if paginator)
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
                                <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $area }}</h3>
                                <div class="grid gap-6">
                                    @foreach($group as $a)
                                        @php
                                            $cardUrl = $a->link ?: route('revista.show', $a->id);
                                            $external = (bool) $a->link;
                                        @endphp
                                        <a href="{{ $cardUrl }}" @if($external) target="_blank" rel="noopener" @endif class="block transform transition-all duration-200 hover:-translate-y-1 hover:shadow-lg rounded-lg no-underline text-current">
                                            <article class="bg-white border rounded-lg p-6 shadow-sm">
                                                <div class="flex flex-col md:flex-row md:justify-between">
                                                    <div>
                                                        <h3 class="text-xl font-semibold text-gray-900">{{ $a->title }}</h3>
                                                        <p class="text-sm text-gray-600">Autor: {{ $a->author }} @if($a->affiliation) — {{ $a->affiliation }}@endif</p>
                                                    </div>
                                                    <div class="mt-3 md:mt-0 text-sm text-gray-500">{{ $a->published_at ? $a->published_at->format('d F, Y') : $a->created_at->format('d F, Y') }}</div>
                                                </div>
                                                <p class="mt-4 text-gray-700">{{ Str::limit(strip_tags($a->description), 220) }}</p>
                                                <div class="mt-4">
                                                    <span class="text-sm text-blue-600 hover:underline">{{ $external ? 'Abrir artigo (Link externo)' : 'Ver detalhes' }}</span>
                                                </div>
                                            </article>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $articles->withQueryString()->links() }}
                    </div>
                @else
                    <div class="p-6 bg-gray-50 border rounded">Ainda não há artigos publicados.</div>
                @endif
            </div>
        </section>

    <!-- Footer -->

@endsection

