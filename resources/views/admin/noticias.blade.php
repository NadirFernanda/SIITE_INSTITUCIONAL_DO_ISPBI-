@extends('layouts.admin')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:1.75rem;font-weight:800;color:#1a202c;margin:0 0 4px;">Notícias</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">{{ $noticias->count() }} notícia{{ $noticias->count() !== 1 ? 's' : '' }} no total</p>
        </div>
        <a href="{{ route('admin.noticias.create') }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#1e3a5f;color:#fff;font-weight:700;font-size:0.95rem;padding:11px 22px;border-radius:10px;text-decoration:none;box-shadow:0 2px 8px rgba(21,101,192,0.25);transition:background 0.2s;"
           onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nova Notícia
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#0f1f3d;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($noticias->isEmpty())
    <div style="background:#fff;border-radius:16px;box-shadow:0 1px 8px rgba(0,0,0,0.07);padding:64px 32px;text-align:center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><rect x="3" y="5" width="18" height="14" rx="2"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="7" y1="13" x2="13" y2="13"/></svg>
        <p style="color:#94a3b8;font-size:1.05rem;margin:0;">Nenhuma notícia cadastrada ainda.</p>
        <a href="{{ route('admin.noticias.create') }}" style="display:inline-block;margin-top:18px;background:#1e3a5f;color:#fff;font-weight:600;padding:10px 24px;border-radius:8px;text-decoration:none;font-size:0.95rem;">Criar primeira notícia</a>
    </div>
    @else

    {{-- Cards grid --}}
    <div style="display:grid;gap:16px;">
        @foreach($noticias as $noticia)
        <div style="background:#fff;border-radius:14px;box-shadow:0 1px 6px rgba(0,0,0,0.07);border:1px solid #e2e8f0;padding:20px 24px;display:flex;align-items:flex-start;gap:20px;transition:box-shadow 0.2s;"
             onmouseover="this.style.boxShadow='0 4px 18px rgba(21,101,192,0.10)'" onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.07)'">

            {{-- Thumbnail or placeholder --}}
            <div style="flex-shrink:0;width:64px;height:64px;border-radius:10px;overflow:hidden;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
                @if($noticia->imagem)
                    <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="" style="width:64px;height:64px;object-fit:cover;">
                @else
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><line x1="7" y1="9" x2="14" y2="9"/><line x1="7" y1="13" x2="11" y2="13"/></svg>
                @endif
            </div>

            {{-- Main info --}}
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:6px;">
                    <span style="font-size:1rem;font-weight:700;color:#1a202c;line-height:1.4;">{{ $noticia->titulo }}</span>
                    @if($noticia->publicada)
                        <span style="background:#dcfce7;color:#0f1f3d;font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:99px;letter-spacing:0.04em;">PUBLICADA</span>
                    @else
                        <span style="background:#f1f5f9;color:#64748b;font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:99px;letter-spacing:0.04em;">RASCUNHO</span>
                    @endif
                    @if($noticia->institucional)
                        <span style="background:#eaeff5;color:#0f1f3d;font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:99px;letter-spacing:0.04em;">INSTITUCIONAL</span>
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                    <span style="font-size:0.85rem;color:#64748b;display:flex;align-items:center;gap:5px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}
                    </span>
                    @if($noticia->pdf)
                    <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank"
                       style="font-size:0.85rem;color:#dc2626;display:flex;align-items:center;gap:5px;text-decoration:none;font-weight:600;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        PDF
                    </a>
                    @endif
                    @if($noticia->imagem)
                    <a href="{{ asset('storage/' . $noticia->imagem) }}" target="_blank"
                       style="font-size:0.85rem;color:#1e3a5f;display:flex;align-items:center;gap:5px;text-decoration:none;font-weight:600;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Imagem
                    </a>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;flex-wrap:wrap;">
                {{-- Ver no site --}}
                <a href="{{ route('noticias') }}#noticia-{{ $noticia->id }}" target="_blank"
                   title="Ver no site"
                   style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;color:#475569;text-decoration:none;border:1px solid #e2e8f0;transition:background 0.15s;"
                   onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>

                {{-- Publicar/Despublicar --}}
                <form method="POST" action="{{ route('admin.noticias.toggle-publicar', $noticia->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" title="{{ $noticia->publicada ? 'Despublicar' : 'Publicar' }}"
                        style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;border:1px solid {{ $noticia->publicada ? '#fde68a' : '#bbf7d0' }};background:{{ $noticia->publicada ? '#fefce8' : '#f0fdf4' }};color:{{ $noticia->publicada ? '#92400e' : '#0f1f3d' }};cursor:pointer;transition:background 0.15s;"
                        onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        @if($noticia->publicada)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        @else
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        @endif
                    </button>
                </form>

                {{-- Editar --}}
                <a href="{{ route('admin.noticias.edit', $noticia->id) }}"
                   title="Editar"
                   style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#eaeff5;color:#0f1f3d;text-decoration:none;border:1px solid #c7d2e0;transition:background 0.15s;"
                   onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#eaeff5'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>

                {{-- Apagar --}}
                <form method="POST" action="{{ route('admin.noticias.destroy', $noticia->id) }}" style="display:inline;"
                      onsubmit="return confirm('Confirma que deseja apagar a notícia ' + @json($noticia->titulo) + '?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Apagar"
                        style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;transition:background 0.15s;"
                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
