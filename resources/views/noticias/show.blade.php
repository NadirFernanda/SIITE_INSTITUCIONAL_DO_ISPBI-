@extends('layouts.site')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16">
    @include('partials.page-hero', [
        'title'      => $noticia->titulo,
        'subtitle'   => \Carbon\Carbon::parse($noticia->data)->translatedFormat('d \d\e F \d\e Y'),
        'breadcrumb' => 'Notícias',
    ])

    <article class="bg-white rounded-2xl shadow-md overflow-hidden">
        @if($noticia->imagem)
            <div class="relative w-full" style="aspect-ratio:16/9; overflow:hidden;">
                <img src="{{ asset('storage/' . $noticia->imagem) }}"
                     alt="{{ $noticia->titulo }}"
                     class="absolute inset-0 w-full h-full object-contain bg-gray-50">
            </div>
        @endif

        <div class="p-8">
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}
            </div>

            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
                {{ $noticia->texto }}
            </div>

            @if($noticia->pdf || $noticia->documentos->isNotEmpty())
                <div class="mt-8">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Documentos anexos</h3>
                    <div class="flex flex-col gap-2">
                        @if($noticia->pdf)
                        <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank"
                           class="inline-flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-lg hover:bg-red-100 transition font-semibold text-sm">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded">PDF</span>
                            Documento PDF
                        </a>
                        @endif
                        @foreach($noticia->documentos as $doc)
                            @php $ext = $doc->extensao(); $isWord = in_array($ext, ['DOC','DOCX']); @endphp
                            <a href="{{ asset('storage/' . $doc->caminho) }}" target="_blank"
                               class="inline-flex items-center gap-3 px-5 py-3 rounded-lg border font-semibold text-sm transition {{ $isWord ? 'bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100' : 'bg-red-50 border-red-200 text-red-700 hover:bg-red-100' }}">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="inline-block text-xs font-bold px-2 py-0.5 rounded {{ $isWord ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">{{ $ext }}</span>
                                {{ $doc->nome_original }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('noticias') }}" class="inline-flex items-center gap-2 text-[#2563eb] font-semibold hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar para Notícias
                </a>
            </div>
        </div>
    </article>
</div>
@endsection
