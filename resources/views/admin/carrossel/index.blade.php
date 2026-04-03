@extends('layouts.admin')

@section('content')
<div style="max-width:1000px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:1.75rem;font-weight:800;color:#1a202c;margin:0 0 4px;">Carrossel</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">{{ count($carrosseis) }} slide{{ count($carrosseis) !== 1 ? 's' : '' }} configurado{{ count($carrosseis) !== 1 ? 's' : '' }}</p>
        </div>
        <a href="{{ route('admin.carrossel.create') }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#1565c0;color:#fff;font-weight:700;font-size:0.95rem;padding:11px 22px;border-radius:10px;text-decoration:none;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
           onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Novo Slide
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success') || session('status'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#166534;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') ?? session('status') }}
    </div>
    @endif

    @if(empty($carrosseis) || count($carrosseis) === 0)
    <div style="background:#fff;border-radius:16px;box-shadow:0 1px 8px rgba(0,0,0,0.07);padding:64px 32px;text-align:center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><rect x="2" y="7" width="20" height="13" rx="2"/><polyline points="2 10 12 17 22 10"/></svg>
        <p style="color:#94a3b8;font-size:1.05rem;margin:0;">Nenhum slide configurado ainda.</p>
        <a href="{{ route('admin.carrossel.create') }}" style="display:inline-block;margin-top:18px;background:#1565c0;color:#fff;font-weight:600;padding:10px 24px;border-radius:8px;text-decoration:none;font-size:0.95rem;">Criar primeiro slide</a>
    </div>
    @else
    <div style="display:grid;gap:14px;">
        @foreach($carrosseis as $carrossel)
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:16px 20px;display:flex;align-items:center;gap:18px;"
             onmouseover="this.style.boxShadow='0 4px 18px rgba(21,101,192,0.10)'" onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)'">

            {{-- Thumbnail --}}
            <div style="flex-shrink:0;width:96px;height:64px;border-radius:8px;overflow:hidden;background:#f1f5f9;border:1px solid #e2e8f0;">
                @if($carrossel->imagem)
                <img src="{{ asset('storage/' . $carrossel->imagem) }}" alt="Imagem" style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                @endif
            </div>

            {{-- Ordem badge --}}
            <div style="flex-shrink:0;width:36px;height:36px;border-radius:8px;background:#eff6ff;border:1px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:800;color:#1d4ed8;">
                {{ $carrossel->ordem ?? '–' }}
            </div>

            {{-- Info --}}
            <div style="flex:1;min-width:0;">
                <div style="font-size:1rem;font-weight:700;color:#1a202c;margin-bottom:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $carrossel->titulo }}</div>
                @if($carrossel->subtitulo)
                <p style="font-size:0.83rem;color:#64748b;margin:0 0 4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $carrossel->subtitulo }}</p>
                @endif
                @if($carrossel->texto_botao)
                <span style="font-size:0.75rem;background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;border-radius:5px;padding:2px 7px;">Botão: {{ $carrossel->texto_botao }}</span>
                @endif
            </div>

            {{-- Status toggle --}}
            <form action="{{ route('admin.carrossel.toggle-publicar', $carrossel->id) }}" method="POST" style="flex-shrink:0;">
                @csrf
                @if($carrossel->publicado)
                <button type="submit"
                    style="display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;color:#166534;border:1px solid #86efac;border-radius:20px;padding:4px 12px;font-size:0.78rem;font-weight:700;cursor:pointer;"
                    onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">
                    <span style="width:7px;height:7px;border-radius:50%;background:#22c55e;display:inline-block;"></span>Publicado
                </button>
                @else
                <button type="submit"
                    style="display:inline-flex;align-items:center;gap:5px;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:20px;padding:4px 12px;font-size:0.78rem;font-weight:700;cursor:pointer;"
                    onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                    <span style="width:7px;height:7px;border-radius:50%;background:#94a3b8;display:inline-block;"></span>Rascunho
                </button>
                @endif
            </form>

            {{-- Actions --}}
            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                <a href="{{ route('admin.carrossel.edit', $carrossel->id) }}" title="Editar"
                   style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#1d4ed8;text-decoration:none;border:1px solid #bfdbfe;"
                   onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <form action="{{ route('admin.carrossel.destroy', $carrossel->id) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Excluir «{{ addslashes($carrossel->titulo) }}»?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Excluir"
                        style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;"
                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

