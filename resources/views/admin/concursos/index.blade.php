@extends('layouts.admin')

@section('content')
<div style="max-width:1080px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:1.75rem;font-weight:800;color:#1a202c;margin:0 0 4px;">Concursos</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">{{ $concursos->total() }} concurso{{ $concursos->total() !== 1 ? 's' : '' }} registados</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('admin.concursos.alerts') }}"
               style="display:inline-flex;align-items:center;gap:7px;padding:10px 18px;border-radius:10px;border:1px solid #e2e8f0;background:#fff;color:#374151;font-weight:600;font-size:0.9rem;text-decoration:none;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Assinantes
            </a>
            <a href="{{ route('admin.concursos.create') }}"
               style="display:inline-flex;align-items:center;gap:8px;background:#1565c0;color:#fff;font-weight:700;font-size:0.95rem;padding:11px 22px;border-radius:10px;text-decoration:none;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
               onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Novo Concurso
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('status'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#166534;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('status') }}
    </div>
    @endif

    @if($concursos->isEmpty())
    <div style="background:#fff;border-radius:16px;box-shadow:0 1px 8px rgba(0,0,0,0.07);padding:64px 32px;text-align:center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8l-2 4h12l-2-4z"/></svg>
        <p style="color:#94a3b8;font-size:1.05rem;margin:0;">Nenhum concurso publicado ainda.</p>
        <a href="{{ route('admin.concursos.create') }}" style="display:inline-block;margin-top:18px;background:#1565c0;color:#fff;font-weight:600;padding:10px 24px;border-radius:8px;text-decoration:none;font-size:0.95rem;">Criar primeiro concurso</a>
    </div>
    @else
    <div style="display:grid;gap:14px;">
        @foreach($concursos as $c)
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:18px 22px;"
             onmouseover="this.style.boxShadow='0 4px 18px rgba(21,101,192,0.10)'" onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)'">

            <div style="display:flex;align-items:flex-start;gap:14px;">
                {{-- Status Badge --}}
                <div style="flex-shrink:0;margin-top:3px;">
                    @if($c->status === 'published')
                    <span style="display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;color:#166534;border:1px solid #86efac;border-radius:20px;padding:3px 10px;font-size:0.78rem;font-weight:700;">
                        <span style="width:7px;height:7px;border-radius:50%;background:#22c55e;display:inline-block;"></span>Publicado
                    </span>
                    @else
                    <span style="display:inline-flex;align-items:center;gap:5px;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:20px;padding:3px 10px;font-size:0.78rem;font-weight:700;">
                        <span style="width:7px;height:7px;border-radius:50%;background:#94a3b8;display:inline-block;"></span>Rascunho
                    </span>
                    @endif
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <div style="font-size:1rem;font-weight:700;color:#1a202c;margin-bottom:4px;">{{ $c->title }}</div>
                    @if($c->summary)
                    <p style="font-size:0.85rem;color:#64748b;margin:0 0 6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $c->summary }}</p>
                    @endif
                    <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                        @if($c->area)
                        <span style="font-size:0.78rem;color:#7c3aed;background:#f5f3ff;border:1px solid #ddd6fe;padding:2px 8px;border-radius:6px;font-weight:600;">{{ $c->area }}</span>
                        @endif
                        <span style="font-size:0.8rem;color:#94a3b8;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:3px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>{{ $c->publish_at ? \Illuminate\Support\Carbon::parse($c->publish_at)->format('d/m/Y') : '—' }}
                        </span>
                        @if($c->attachments->count())
                        <span style="font-size:0.8rem;color:#0ea5e9;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:3px;"><path d="M21.44 11.05L12.17 20.32a5 5 0 01-7.07-7.07l8.83-8.83a3 3 0 014.24 4.24l-8.84 8.84a1 1 0 01-1.414-1.415l7.07-7.07"/></svg>{{ $c->attachments->count() }} anexo{{ $c->attachments->count() !== 1 ? 's' : '' }}
                        </span>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div style="display:flex;align-items:center;gap:6px;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end;">
                    <a href="{{ route('admin.concursos.edit', $c) }}" title="Editar"
                       style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#1d4ed8;text-decoration:none;border:1px solid #bfdbfe;"
                       onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </a>
                    <form action="{{ route('admin.concursos.resend-alerts', $c) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Reenviar alertas deste concurso para assinantes?')">
                        @csrf
                        <button type="submit" title="Reenviar alertas"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f0fdf4;color:#16a34a;border:1px solid #86efac;cursor:pointer;"
                            onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                    <form action="{{ route('admin.concursos.destroy', $c) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Remover ' + @json($c->title) + '?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Remover"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;"
                            onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top:24px;">{{ $concursos->links() }}</div>
    @endif
</div>
@endsection
