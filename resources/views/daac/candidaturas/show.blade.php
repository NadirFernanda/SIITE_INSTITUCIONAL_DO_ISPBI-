@extends('layouts.daac')
@section('content')
<div style="max-width:820px;margin:0 auto;">

    <a href="{{ route('daac.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#2563eb;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:22px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar
    </a>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">
                Ficha n.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Submetida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        @php $cor = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8'; @endphp
        <span style="background:{{ $cor }}20;color:{{ $cor }};padding:5px 14px;border-radius:20px;font-size:0.88rem;font-weight:700;">
            {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
        </span>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;">{{ session('error') }}</div>
    @endif

    {{-- Dados do candidato --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#2563eb;margin:0 0 18px;text-transform:uppercase;letter-spacing:0.04em;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">Dados do Candidato</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
            @php
            $campos = [
                'Nome Completo' => $candidatura->nome,
                'BI'            => $candidatura->bi,
                'Email'         => $candidatura->email,
                'Telefone'      => $candidatura->telefone,
                'Curso'         => $candidatura->curso,
                'Período'       => $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular',
                'Sexo'          => $candidatura->sexo ? ucfirst($candidatura->sexo) : '—',
                'Data Nasc.'    => $candidatura->data_nascimento?->format('d/m/Y') ?? '—',
            ];
            @endphp
            @foreach($campos as $label => $val)
            <div>
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">{{ $label }}</div>
                <div style="font-size:0.93rem;color:#1a2332;font-weight:500;">{{ $val ?? '—' }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Comprovativo para rever --}}
    <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:14px;padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <div style="font-size:0.88rem;font-weight:700;color:#0369a1;margin-bottom:4px;">Comprovativo de Candidatura</div>
            <div style="font-size:0.82rem;color:#475569;">Reveja o comprovativo antes de assinar digitalmente.</div>
        </div>
        <a href="{{ route('candidaturas.pdf', $candidatura) }}"
           style="display:inline-flex;align-items:center;gap:7px;background:#0369a1;color:#fff;padding:10px 20px;border-radius:10px;font-weight:700;font-size:0.88rem;text-decoration:none;"
           onmouseover="this.style.background='#075985'" onmouseout="this.style.background='#0369a1'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Descarregar Comprovativo (PDF)
        </a>
    </div>

    {{-- Assinatura existente --}}
    @if($candidatura->isAssinada())
    <div style="background:#f5f3ff;border:1px solid #ddd6fe;border-radius:14px;padding:22px 24px;margin-bottom:18px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#7c3aed;margin:0 0 14px;text-transform:uppercase;letter-spacing:0.04em;">✓ Assinatura Digital</h2>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Assinado por</div>
                <div style="font-weight:600;color:#1a2332;">{{ $candidatura->assinante?->name ?? 'DAAC' }}</div>
            </div>
            <div>
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Data e Hora</div>
                <div style="font-weight:600;color:#1a2332;">{{ $candidatura->assinado_em->format('d/m/Y \à\s H:i') }}</div>
            </div>
            <div style="grid-column:1/-1;">
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Código de Assinatura</div>
                <div style="font-family:monospace;font-size:1.1rem;font-weight:700;color:#7c3aed;background:#ede9fe;padding:6px 12px;border-radius:6px;display:inline-block;">{{ $candidatura->assinatura_codigo }}</div>
            </div>
        </div>
    </div>
    @else
    {{-- Formulário de assinatura --}}
    <div style="background:#fff;border:2px solid #2563eb;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#2563eb;margin:0 0 12px;text-transform:uppercase;letter-spacing:0.04em;">Assinar Digitalmente</h2>
        <p style="font-size:0.88rem;color:#475569;margin-bottom:16px;">
            Ao assinar, confirma que verificou os dados do candidato e valida a inscrição. A candidatura mudará para <strong>Concluída</strong> e o candidato receberá um email com o comprovativo assinado.
        </p>
        <form method="POST" action="{{ route('daac.candidaturas.assinar', $candidatura) }}"
              onsubmit="return confirm('Confirma a assinatura digital desta candidatura?')">
            @csrf
            <label style="display:flex;align-items:flex-start;gap:10px;margin-bottom:16px;cursor:pointer;">
                <input type="checkbox" name="confirmar" value="1" style="margin-top:2px;accent-color:#2563eb;">
                <span style="font-size:0.88rem;color:#334155;">
                    Declaro que verifiquei os dados desta candidatura e assino digitalmente em nome do DAAC — Departamento dos Assuntos Académicos do ISP-Bié.
                </span>
            </label>
            @error('confirmar')<p style="font-size:0.78rem;color:#dc2626;margin:0 0 12px;font-weight:400;">{{ $message }}</p>@enderror
            <button type="submit"
                    style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:11px 28px;font-weight:700;cursor:pointer;font-size:0.9rem;display:inline-flex;align-items:center;gap:8px;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Assinar e Concluir
            </button>
        </form>
    </div>
    @endif

</div>
@endsection
