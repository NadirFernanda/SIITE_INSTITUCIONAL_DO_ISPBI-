@extends('layouts.portal')

@section('page-title', 'Directorio de Alumni')

@section('content')

<div style="margin-bottom:24px;">
    <h1 style="font-size:1.4rem;font-weight:700;color:#1e3a5f;margin:0 0 4px;">Directorio de Alumni</h1>
    <p style="color:#64748b;font-size:0.9rem;margin:0;">Encontre colegas alumni do ISP-Bie publicados na rede.</p>
</div>

{{-- Search / filter bar --}}
<form method="GET" action="{{ route('portal.diretorio') }}" style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:18px 20px;display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px;align-items:flex-end;">
    <div style="flex:1;min-width:200px;">
        <label for="busca" style="display:block;font-size:0.8rem;font-weight:600;color:#374151;margin-bottom:4px;">Pesquisar por nome</label>
        <input type="text" id="busca" name="busca" value="{{ request('busca') }}" placeholder="Nome do alumni..."
            style="width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:0.88rem;outline:none;"
            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
    </div>
    <div style="min-width:180px;">
        <label for="curso" style="display:block;font-size:0.8rem;font-weight:600;color:#374151;margin-bottom:4px;">Filtrar por curso</label>
        <select id="curso" name="curso"
            style="width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:0.88rem;outline:none;background:#fff;"
            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
            <option value="">Todos os cursos</option>
            @foreach($cursos as $c)
                <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
    </div>
    <div style="display:flex;gap:8px;">
        <button type="submit"
            style="background:#1e3a5f;color:#fff;padding:9px 20px;border:none;border-radius:8px;font-size:0.86rem;font-weight:600;cursor:pointer;"
            onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
            Pesquisar
        </button>
        @if(request('busca') || request('curso'))
            <a href="{{ route('portal.diretorio') }}"
                style="background:#f1f5f9;color:#1e3a5f;padding:9px 16px;border-radius:8px;font-size:0.86rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;"
                onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                Limpar
            </a>
        @endif
    </div>
</form>

{{-- Results --}}
@if($alumni->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
        <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p style="color:#94a3b8;font-size:1rem;margin:0;">Nenhum alumni encontrado.</p>
    </div>
@else
    <div style="margin-bottom:12px;font-size:0.84rem;color:#64748b;">
        {{ $alumni->count() }} alumni encontrado(s)
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px;">
        @foreach($alumni as $a)
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 20px;display:flex;flex-direction:column;gap:12px;">

                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:48px;height:48px;border-radius:50%;background:#1e3a5f;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.2rem;flex-shrink:0;">
                        {{ strtoupper(substr($a->nome, 0, 1)) }}
                    </div>
                    <div style="min-width:0;">
                        <div style="font-weight:700;color:#1a2332;font-size:0.95rem;text-transform:uppercase;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $a->nome }}</div>
                        <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">{{ $a->curso }}</div>
                    </div>
                </div>

                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                    @if($a->ano)
                        <span style="background:#e8f0fe;color:#1e3a5f;padding:2px 10px;border-radius:20px;font-size:0.74rem;font-weight:600;">{{ $a->ano }}</span>
                    @endif
                    @if($a->trabalha)
                        <span style="background:#dcfce7;color:#16a34a;padding:2px 10px;border-radius:20px;font-size:0.74rem;font-weight:600;">Empregado</span>
                    @endif
                </div>

                <div style="font-size:0.82rem;color:#64748b;display:flex;flex-direction:column;gap:4px;">
                    @if($a->pais)
                        <div style="display:flex;align-items:center;gap:5px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $a->pais }}
                        </div>
                    @endif
                    @if($a->empresa)
                        <div style="display:flex;align-items:center;gap:5px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $a->empresa }}
                        </div>
                    @endif
                </div>

            </div>
        @endforeach
    </div>
@endif

@endsection
