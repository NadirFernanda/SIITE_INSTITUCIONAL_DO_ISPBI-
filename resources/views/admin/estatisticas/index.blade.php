@extends('layouts.admin')

@section('content')
<div style="max-width:1000px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:1.75rem;font-weight:800;color:#1a202c;margin:0 0 4px;">Estatísticas</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">{{ $estatisticas->count() }} indicador{{ $estatisticas->count() !== 1 ? 'es' : '' }} no painel público</p>
        </div>
        <a href="{{ route('admin.estatisticas.create') }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#1e3a5f;color:#fff;font-weight:700;font-size:0.95rem;padding:11px 22px;border-radius:10px;text-decoration:none;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
           onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nova Estatística
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#0f1f3d;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($estatisticas->isEmpty())
    <div style="background:#fff;border-radius:16px;box-shadow:0 1px 8px rgba(0,0,0,0.07);padding:64px 32px;text-align:center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><rect x="3" y="13" width="4" height="8" rx="1"/><rect x="9" y="9" width="4" height="12" rx="1"/><rect x="15" y="5" width="4" height="16" rx="1"/></svg>
        <p style="color:#94a3b8;font-size:1.05rem;margin:0;">Nenhuma estatística cadastrada ainda.</p>
        <a href="{{ route('admin.estatisticas.create') }}" style="display:inline-block;margin-top:18px;background:#1e3a5f;color:#fff;font-weight:600;padding:10px 24px;border-radius:8px;text-decoration:none;font-size:0.95rem;">Criar primeira estatística</a>
    </div>
    @else
    <div style="display:grid;gap:12px;">
        @foreach($estatisticas as $estatistica)
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:18px 22px;display:flex;align-items:center;gap:18px;"
             onmouseover="this.style.boxShadow='0 4px 18px rgba(21,101,192,0.10)'" onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)'">

            {{-- Ordem badge --}}
            <div style="flex-shrink:0;width:40px;height:40px;border-radius:10px;background:#eaeff5;border:1px solid #c7d2e0;display:flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:800;color:#0f1f3d;">
                {{ $estatistica->ordem ?? '—' }}
            </div>

            {{-- Info --}}
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:baseline;gap:10px;flex-wrap:wrap;margin-bottom:3px;">
                    <span style="font-size:1rem;font-weight:700;color:#1a202c;">{{ $estatistica->titulo }}</span>
                    <span style="font-size:1.1rem;font-weight:800;color:#1e3a5f;">{{ $estatistica->valor }}</span>
                </div>
                @if($estatistica->descricao)
                <p style="font-size:0.85rem;color:#64748b;margin:0;">{{ $estatistica->descricao }}</p>
                @endif
            </div>

            {{-- Actions --}}
            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                <a href="{{ route('admin.estatisticas.edit', $estatistica) }}"
                   title="Editar"
                   style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#eaeff5;color:#0f1f3d;text-decoration:none;border:1px solid #c7d2e0;"
                   onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#eaeff5'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <form action="{{ route('admin.estatisticas.destroy', $estatistica) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Confirma que deseja excluir ' + @json($estatistica->titulo) + '?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Excluir"
                        style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;"
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
