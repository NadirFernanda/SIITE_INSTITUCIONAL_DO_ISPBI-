@extends('layouts.portal')

@section('page-title', $noticia->titulo)

@section('content')

<div style="max-width:760px;">

    <div style="margin-bottom:20px;">
        <a href="{{ route('portal.noticias') }}"
            style="display:inline-flex;align-items:center;gap:6px;color:#1e3a5f;text-decoration:none;font-size:0.86rem;font-weight:600;"
            onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Voltar as Noticias
        </a>
    </div>

    <article style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;">

        @if($noticia->imagem)
            <div style="max-height:360px;overflow:hidden;">
                <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="{{ $noticia->titulo }}"
                    style="width:100%;height:360px;object-fit:cover;">
            </div>
        @endif

        <div style="padding:36px 40px;">

            <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;flex-wrap:wrap;">
                <span style="background:#e8f0fe;color:#1e3a5f;padding:3px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Alumni</span>
                @if($noticia->data)
                    <span style="font-size:0.82rem;color:#94a3b8;">{{ $noticia->data->format('d \d\e F \d\e Y') }}</span>
                @endif
            </div>

            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 20px;line-height:1.35;">{{ $noticia->titulo }}</h1>

            @if($noticia->texto)
                <div style="font-size:0.95rem;color:#374151;line-height:1.75;">
                    {!! nl2br(e($noticia->texto)) !!}
                </div>
            @endif

            @if($noticia->pdf)
                <div style="margin-top:28px;padding-top:24px;border-top:1px solid #e2e8f0;">
                    <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank" rel="noopener"
                        style="display:inline-flex;align-items:center;gap:8px;background:#1e3a5f;color:#fff;padding:10px 22px;border-radius:9px;font-weight:600;font-size:0.88rem;text-decoration:none;"
                        onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Baixar PDF
                    </a>
                </div>
            @endif
        </div>
    </article>
</div>

@endsection
