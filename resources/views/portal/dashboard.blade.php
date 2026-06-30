@extends('layouts.portal')

@section('page-title', 'Dashboard')

@section('content')

<div style="margin-bottom:28px;">
    <h1 style="font-size:1.6rem;font-weight:700;color:#1e3a5f;margin:0 0 4px;">Bem-vindo, {{ Auth::user()->name }}!</h1>
    <p style="color:#64748b;font-size:0.95rem;margin:0;">Este e o seu portal exclusivo de alumni do ISP-Bie.</p>
</div>

{{-- Stat cards --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:36px;">

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 24px;display:flex;align-items:center;gap:16px;">
        <div style="width:46px;height:46px;background:#e8f0fe;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <div style="font-size:1.65rem;font-weight:700;color:#1e3a5f;">{{ $totalAlumni }}</div>
            <div style="font-size:0.8rem;color:#64748b;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;">Alumni Publicados</div>
        </div>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 24px;display:flex;align-items:center;gap:16px;">
        <div style="width:46px;height:46px;background:#fef3c7;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" fill="none" stroke="#b45309" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <div style="font-size:1.65rem;font-weight:700;color:#1e3a5f;">{{ $totalDocumentos }}</div>
            <div style="font-size:0.8rem;color:#64748b;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;">Documentos</div>
        </div>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 24px;display:flex;align-items:center;gap:16px;">
        <div style="width:46px;height:46px;background:#dcfce7;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="5" width="18" height="14" rx="2"/>
                <path stroke-linecap="round" d="M7 9h10M7 13h6"/>
            </svg>
        </div>
        <div>
            <div style="font-size:1.65rem;font-weight:700;color:#1e3a5f;">{{ $totalNoticias }}</div>
            <div style="font-size:0.8rem;color:#64748b;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;">Noticias Alumni</div>
        </div>
    </div>

</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;flex-wrap:wrap;">

    {{-- Latest news --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
            <h2 style="font-size:1rem;font-weight:700;color:#1e3a5f;margin:0;">Ultimas Noticias</h2>
            <a href="{{ route('portal.noticias') }}" style="font-size:0.8rem;color:#1e3a5f;text-decoration:none;font-weight:600;">Ver todas</a>
        </div>

        @if($noticias->isEmpty())
            <p style="color:#94a3b8;font-size:0.88rem;text-align:center;padding:20px 0;">Sem noticias disponiveis.</p>
        @else
            <div style="display:flex;flex-direction:column;gap:12px;">
                @foreach($noticias as $noticia)
                    <a href="{{ route('portal.noticias.show', $noticia->id) }}"
                        style="display:block;padding:12px;border:1px solid #f1f5f9;border-radius:10px;text-decoration:none;transition:border-color 0.15s,background 0.15s;"
                        onmouseover="this.style.background='#f8fafc';this.style.borderColor='#1e3a5f'"
                        onmouseout="this.style.background='';this.style.borderColor='#f1f5f9'">
                        <div style="font-weight:600;color:#1a2332;font-size:0.88rem;margin-bottom:3px;">{{ Str::limit($noticia->titulo, 65) }}</div>
                        <div style="font-size:0.76rem;color:#94a3b8;">
                            {{ $noticia->data ? $noticia->data->format('d/m/Y') : '' }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Latest documents --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
            <h2 style="font-size:1rem;font-weight:700;color:#1e3a5f;margin:0;">Documentos Recentes</h2>
            <a href="{{ route('portal.documentos') }}" style="font-size:0.8rem;color:#1e3a5f;text-decoration:none;font-weight:600;">Ver todos</a>
        </div>

        @if($documentos->isEmpty())
            <p style="color:#94a3b8;font-size:0.88rem;text-align:center;padding:20px 0;">Sem documentos disponiveis.</p>
        @else
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($documentos as $doc)
                    <div style="display:flex;align-items:center;gap:12px;padding:10px 12px;border:1px solid #f1f5f9;border-radius:10px;">
                        <div style="width:34px;height:34px;background:#e8f0fe;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="17" height="17" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:600;color:#1a2332;font-size:0.85rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $doc->titulo }}</div>
                            @if($doc->tamanho)
                                <div style="font-size:0.74rem;color:#94a3b8;">{{ $doc->tamanho }}</div>
                            @endif
                        </div>
                        <a href="{{ route('portal.documentos.download', $doc->id) }}"
                            style="flex-shrink:0;background:#1e3a5f;color:#fff;padding:5px 12px;border-radius:6px;font-size:0.76rem;font-weight:600;text-decoration:none;"
                            onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                            Baixar
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@if($alumnus)
    <div style="margin-top:24px;background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <div style="display:flex;align-items:center;gap:14px;">
            <div style="width:46px;height:46px;background:#1e3a5f;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1.15rem;flex-shrink:0;">
                {{ strtoupper(substr($alumnus->nome, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:700;color:#1a2332;">{{ $alumnus->nome }}</div>
                <div style="font-size:0.82rem;color:#64748b;">{{ $alumnus->curso }} &middot; {{ $alumnus->ano }}</div>
                @if($alumnus->empresa)
                    <div style="font-size:0.8rem;color:#64748b;">{{ $alumnus->empresa }}{{ $alumnus->cargo ? ' — ' . $alumnus->cargo : '' }}</div>
                @endif
            </div>
        </div>
        <a href="{{ route('portal.perfil') }}"
            style="display:inline-flex;align-items:center;gap:6px;background:#f1f5f9;color:#1e3a5f;padding:9px 18px;border-radius:9px;font-weight:600;font-size:0.85rem;text-decoration:none;"
            onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            Editar Perfil
        </a>
    </div>
@endif

@endsection
