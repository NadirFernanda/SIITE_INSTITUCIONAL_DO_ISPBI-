@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1100px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Carrossel</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">{{ count($carrosseis) }} slide{{ count($carrosseis) !== 1 ? 's' : '' }} configurado{{ count($carrosseis) !== 1 ? 's' : '' }}</p>
        </div>
        <a href="{{ route('admin.carrossel.create') }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#1565c0;color:#fff;font-weight:600;font-size:0.9rem;padding:10px 20px;border-radius:10px;text-decoration:none;"
           onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Novo Slide
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Empty state --}}
    @if(count($carrosseis) === 0)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
            <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;"><rect x="2" y="7" width="20" height="13" rx="2"/><polyline points="2 10 12 17 22 10"/></svg>
            <p style="color:#94a3b8;font-size:1rem;margin:0 0 18px;">Nenhum slide configurado ainda.</p>
            <a href="{{ route('admin.carrossel.create') }}" style="background:#1565c0;color:#fff;font-weight:600;padding:10px 24px;border-radius:8px;text-decoration:none;font-size:0.95rem;">Criar primeiro slide</a>
        </div>
    @else
        <div style="display:grid;gap:14px;">
            @foreach($carrosseis as $item)
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:18px;"
                 onmouseover="this.style.boxShadow='0 4px 18px rgba(21,101,192,0.10)'" onmouseout="this.style.boxShadow='none'">

                {{-- Thumbnail --}}
                <div style="flex-shrink:0;width:96px;height:64px;border-radius:8px;overflow:hidden;background:#f1f5f9;border:1px solid #e2e8f0;">
                    @if($item->imagem)
                        <img src="{{ asset('storage/' . $item->imagem) }}" alt="Imagem" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <svg width="24" height="24" fill="none" stroke="#94a3b8" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                </div>

                {{-- Ordem badge --}}
                <div style="flex-shrink:0;width:36px;height:36px;border-radius:8px;background:#eff6ff;border:1px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:800;color:#1d4ed8;">
                    {{ $item->ordem ?? '–' }}
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <div style="font-size:1rem;font-weight:700;color:#1a2332;margin-bottom:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item->titulo }}</div>
                    @if($item->subtitulo)
                        <p style="font-size:0.83rem;color:#64748b;margin:0 0 4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item->subtitulo }}</p>
                    @endif
                    @if($item->texto_botao)
                        <span style="font-size:0.75rem;background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;border-radius:5px;padding:2px 7px;">Botão: {{ $item->texto_botao }}</span>
                    @endif
                </div>

                {{-- Status toggle --}}
                <form action="{{ route('admin.carrossel.toggle-publicar', $item->id) }}" method="POST" style="flex-shrink:0;">
                    @csrf
                    @if($item->publicado)
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
                    <a href="{{ route('admin.carrossel.edit', $item->id) }}" title="Editar"
                       style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#1d4ed8;text-decoration:none;border:1px solid #bfdbfe;"
                       onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </a>
                    <form action="/admin/carrossel/{{ $item->id }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Excluir «{{ addslashes($item->titulo) }}»?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Excluir"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;"
                            onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
