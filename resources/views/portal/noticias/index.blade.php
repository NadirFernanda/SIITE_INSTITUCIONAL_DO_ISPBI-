@extends('layouts.portal')

@section('page-title', 'Noticias Alumni')

@section('content')

<div style="margin-bottom:24px;">
    <h1 style="font-size:1.4rem;font-weight:700;color:#1e3a5f;margin:0 0 4px;">Noticias Alumni</h1>
    <p style="color:#64748b;font-size:0.9rem;margin:0;">Informacoes e actualizacoes exclusivas para alumni do ISP-Bie.</p>
</div>

@if($noticias->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
        <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
            <rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" d="M7 9h10M7 13h6"/>
        </svg>
        <p style="color:#94a3b8;font-size:1rem;margin:0;">Sem noticias disponiveis de momento.</p>
    </div>
@else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-bottom:28px;">
        @foreach($noticias as $noticia)
            <a href="{{ route('portal.noticias.show', $noticia->id) }}"
                style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;text-decoration:none;display:flex;flex-direction:column;transition:box-shadow 0.15s,border-color 0.15s;"
                onmouseover="this.style.boxShadow='0 4px 20px rgba(30,58,95,0.10)';this.style.borderColor='#1e3a5f'"
                onmouseout="this.style.boxShadow='';this.style.borderColor='#e2e8f0'">

                @if($noticia->imagem)
                    <div style="height:180px;overflow:hidden;background:#f1f5f9;">
                        <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="{{ $noticia->titulo }}"
                            style="width:100%;height:100%;object-fit:cover;">
                    </div>
                @else
                    <div style="height:120px;background:linear-gradient(135deg,#1e3a5f 0%,#2a5298 100%);display:flex;align-items:center;justify-content:center;">
                        <svg width="36" height="36" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" d="M7 9h10M7 13h6"/>
                        </svg>
                    </div>
                @endif

                <div style="padding:18px 20px;flex:1;display:flex;flex-direction:column;">
                    <div style="font-size:0.75rem;color:#94a3b8;font-weight:500;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.04em;">
                        {{ $noticia->data ? $noticia->data->format('d/m/Y') : '' }}
                    </div>
                    <h3 style="font-size:0.95rem;font-weight:700;color:#1a2332;margin:0 0 8px;line-height:1.4;">{{ $noticia->titulo }}</h3>
                    @if($noticia->texto)
                        <p style="font-size:0.84rem;color:#64748b;margin:0;line-height:1.5;flex:1;">{{ Str::limit(strip_tags($noticia->texto), 100) }}</p>
                    @endif
                    <div style="margin-top:14px;font-size:0.8rem;color:#1e3a5f;font-weight:600;">Ler mais &rarr;</div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div>
        {{ $noticias->links() }}
    </div>
@endif

@endsection
