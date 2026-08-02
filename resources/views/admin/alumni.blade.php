@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1200px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Alumni Cadastrados</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">Gestao de ex-alunos registados</p>
        </div>
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            @if(isset($pendingCount) && $pendingCount > 0)
                <span style="background:#fff8e1;color:#f57f17;padding:5px 14px;border-radius:20px;font-size:0.8rem;font-weight:700;border:1px solid #F05A28;">
                    {{ $pendingCount }} pendente{{ $pendingCount !== 1 ? 's' : '' }} de aprovacao
                </span>
            @endif
            <a href="{{ route('admin.alumni.stats') }}"
               style="display:inline-flex;align-items:center;gap:8px;background:#1e3a5f;color:#fff;padding:10px 20px;border-radius:10px;font-weight:600;font-size:0.9rem;text-decoration:none;"
               onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Editar Indicadores
            </a>
            <a href="{{ route('admin.alumni-documentos.index') }}"
               style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:#1e3a5f;border:1px solid #1e3a5f;padding:10px 20px;border-radius:10px;font-weight:600;font-size:0.9rem;text-decoration:none;"
               onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#fff'">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Documentos Alumni
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Empty state --}}
    @if($alumni->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
            <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p style="color:#94a3b8;font-size:1rem;margin:0;">Nenhum cadastro de alumni ainda.</p>
        </div>
    @else
        <div style="display:grid;gap:14px;">
            @foreach($alumni as $alumnus)
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:20px 24px;display:flex;align-items:flex-start;gap:18px;">

                {{-- Avatar --}}
                <div style="width:46px;height:46px;border-radius:50%;background:#eaeff5;color:#1e3a5f;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:700;font-size:1.1rem;">
                    {{ strtoupper(substr($alumnus->nome, 0, 1)) }}
                </div>

                {{-- Main info --}}
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                        <div>
                            <div style="font-weight:700;font-size:1rem;color:#1a2332;">{{ $alumnus->nome }}</div>
                            <div style="font-size:0.84rem;color:#64748b;margin-top:3px;">
                                {{ $alumnus->curso }}
                                @if($alumnus->ano)
                                    &nbsp;&middot;&nbsp;<span style="background:#eaeff5;color:#1e3a5f;padding:1px 8px;border-radius:20px;font-size:0.77rem;font-weight:600;">{{ $alumnus->ano }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- Status badges --}}
                        <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                            @if($alumnus->user_id)
                                <span style="background:#eaeff5;color:#1e3a5f;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Portal</span>
                            @endif
                            @if($alumnus->publicado)
                                <span style="background:#e8f5e9;color:#2e7d32;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Publicado</span>
                            @else
                                <span style="background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Rascunho</span>
                            @endif
                            @if($alumnus->trabalha)
                                <span style="background:#fff8e1;color:#f57f17;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Empregado</span>
                            @endif
                            @if($alumnus->testemunho)
                                <span style="background:#eaeff5;color:#0f1f3d;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Testemunho</span>
                            @endif
                            {{-- Portal approval status --}}
                            @if($alumnus->user)
                                @if($alumnus->user->aprovado)
                                    <span style="background:#e8f5e9;color:#2e7d32;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Portal Aprovado</span>
                                @else
                                    <span style="background:#fff3e0;color:#F05A28;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Aguarda Aprovacao</span>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- Secondary details --}}
                    <div style="margin-top:10px;display:flex;gap:20px;flex-wrap:wrap;font-size:0.84rem;color:#475569;">
                        @if($alumnus->contacto)
                            <span>
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $alumnus->contacto }}
                            </span>
                        @endif
                        @if($alumnus->trabalha && $alumnus->empresa)
                            <span>
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                {{ $alumnus->empresa }}@if($alumnus->cargo) &middot; {{ $alumnus->cargo }}@endif
                            </span>
                        @endif
                        @if($alumnus->user)
                            <span style="color:#1e3a5f;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
                                {{ $alumnus->user->email }}
                            </span>
                        @endif
                    </div>

                    {{-- Depoimento --}}
                    @php
                        $satisfacao = trim((string) $alumnus->satisfacao);
                        $hasDepoimento = $satisfacao && !preg_match('/^\d+$/', $satisfacao);
                    @endphp
                    @if($hasDepoimento)
                        <details style="margin-top:10px;">
                            <summary style="cursor:pointer;color:#1e3a5f;font-size:0.82rem;font-weight:600;user-select:none;list-style:none;display:inline-flex;align-items:center;gap:5px;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                Ver testemunho
                            </summary>
                            <p style="margin-top:8px;font-size:0.85rem;color:#475569;line-height:1.5;border-left:3px solid #1e3a5f;padding-left:10px;">"{{ $satisfacao }}"</p>
                        </details>
                    @endif
                </div>

                {{-- Actions --}}
                <div style="display:flex;flex-direction:column;gap:8px;flex-shrink:0;">
                    <form method="POST" action="{{ route('admin.alumni.toggle-publicar', $alumnus->id) }}">
                        @csrf
                        <button type="submit"
                            style="padding:7px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;border:none;cursor:pointer;white-space:nowrap;{{ $alumnus->publicado ? 'background:#fff8e1;color:#f57f17;' : 'background:#1e3a5f;color:#fff;' }}"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            {{ $alumnus->publicado ? 'Despublicar' : 'Publicar' }}
                        </button>
                    </form>

                    @if($alumnus->trabalha)
                        <form method="POST" action="{{ route('admin.alumni.toggle-testemunho', $alumnus->id) }}">
                            @csrf
                            <button type="submit"
                                style="padding:7px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;border:none;cursor:pointer;white-space:nowrap;{{ $alumnus->testemunho ? 'background:#eaeff5;color:#0f1f3d;' : 'background:#eaeff5;color:#1e3a5f;' }}"
                                onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                {{ $alumnus->testemunho ? 'Rem. Testemunho' : 'Add Testemunho' }}
                            </button>
                        </form>
                    @endif

                    {{-- Portal approval actions --}}
                    @if($alumnus->user)
                        @if(!$alumnus->user->aprovado)
                            <form method="POST" action="{{ route('admin.alumni.aprovar', $alumnus->id) }}">
                                @csrf
                                <button type="submit"
                                    style="padding:7px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;border:none;cursor:pointer;white-space:nowrap;background:#e8f5e9;color:#2e7d32;"
                                    onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    Aprovar Portal
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.alumni.revogar', $alumnus->id) }}">
                                @csrf
                                <button type="submit"
                                    style="padding:7px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;border:none;cursor:pointer;white-space:nowrap;background:#fff3e0;color:#F05A28;"
                                    onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    Revogar Acesso
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
