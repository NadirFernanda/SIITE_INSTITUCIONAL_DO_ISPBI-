@extends('layouts.secretaria')
@section('content')
<div style="max-width:820px;margin:0 auto;">

    <a href="{{ route('secretaria.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#1e3a5f;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:24px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">
                Ficha #{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Candidatura submetida em {{ $candidatura->created_at?->format('d/m/Y \à\s H:i') ?? '—' }}</p>
        </div>
        {{-- Estado do pagamento --}}
        @if($candidatura->pagamento_confirmado)
            <div style="background:#dcfce7;border:1px solid #86efac;border-radius:12px;padding:14px 20px;text-align:center;">
                <div style="font-size:1.1rem;font-weight:800;color:#16a34a;">✓ Pagamento Confirmado</div>
                @if($candidatura->pagamento_confirmado_em)
                <div style="font-size:0.8rem;color:#4ade80;margin-top:3px;">{{ $candidatura->pagamento_confirmado_em->format('d/m/Y H:i') }}</div>
                @endif
                @if($candidatura->confirmadoPor)
                <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">por {{ $candidatura->confirmadoPor->name }}</div>
                @endif
            </div>
        @else
            <div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:12px;padding:14px 20px;text-align:center;">
                <div style="font-size:1rem;font-weight:700;color:#F05A28;">Aguardando Pagamento</div>
                <div style="font-size:0.8rem;color:#92400e;margin-top:3px;">Pagamento ainda não confirmado</div>
            </div>
        @endif
    </div>

    {{-- Dados do candidato --}}
    @php
    $sec = fn($label, $value) => $value
        ? '<div style="background:#f8fafc;border-radius:8px;padding:10px 14px;"><div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">'.e($label).'</div><div style="font-size:0.9rem;font-weight:600;color:#1a2332;">'.e($value).'</div></div>'
        : '';
    @endphp

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:20px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#1e3a5f;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;">Identificação</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:10px;">
            {!! $sec('Nome Completo', $candidatura->nome) !!}
            {!! $sec('Bilhete de Identidade', $candidatura->bi) !!}
            {!! $sec('Data de Nascimento', $candidatura->data_nascimento?->format('d/m/Y')) !!}
            {!! $sec('Telefone', $candidatura->telefone . ($candidatura->telefone2 ? ' / '.$candidatura->telefone2 : '')) !!}
            {!! $sec('Email', $candidatura->email) !!}
            {!! $sec('Sexo', ucfirst($candidatura->sexo ?? '')) !!}
        </div>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:20px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#1e3a5f;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;">Inscrição</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:10px;">
            {!! $sec('Curso', $candidatura->curso) !!}
            {!! $sec('Período', $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular') !!}
            {!! $sec('Escola de Origem', $candidatura->escola_origem) !!}
            {!! $sec('Perfil', $candidatura->perfil) !!}
            {!! $sec('Local de Inscrição', $candidatura->local_inscricao ? (\App\Models\Candidatura::$locaisInscricao[$candidatura->local_inscricao] ?? $candidatura->local_inscricao) : null) !!}
        </div>
    </div>

    {{-- Acções --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#1e3a5f;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;">Acção de Pagamento</h2>

        @if(! $candidatura->pagamento_confirmado)
        <p style="color:#475569;font-size:0.9rem;margin:0 0 16px;">
            Após verificar o comprovativo de pagamento da RUP apresentado pelo candidato, clique em <strong>"Confirmar Pagamento"</strong> para libertar a candidatura para assinatura pelo DAAC.
        </p>
        <form method="POST" action="{{ route('secretaria.candidaturas.confirmar-pagamento', $candidatura) }}">
            @csrf
            <button type="submit"
                    onclick="return confirm('Confirmar que o candidato {{ $candidatura->nome }} (Ficha #{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}) efectuou o pagamento?')"
                    style="background:#16a34a;color:#fff;border:none;border-radius:10px;padding:12px 28px;font-weight:700;cursor:pointer;font-size:0.95rem;display:inline-flex;align-items:center;gap:8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Confirmar Pagamento
            </button>
        </form>
        @else
        <p style="color:#475569;font-size:0.9rem;margin:0 0 16px;">
            O pagamento foi confirmado em <strong>{{ $candidatura->pagamento_confirmado_em?->format('d/m/Y \à\s H:i') }}</strong>.
            Se necessário, pode cancelar a confirmação (por exemplo, em caso de erro).
        </p>
        <form method="POST" action="{{ route('secretaria.candidaturas.cancelar-pagamento', $candidatura) }}">
            @csrf
            <button type="submit"
                    onclick="return confirm('Cancelar a confirmação de pagamento desta candidatura?')"
                    style="background:#dc2626;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:600;cursor:pointer;font-size:0.88rem;">
                Cancelar Confirmação de Pagamento
            </button>
        </form>
        @endif
    </div>

</div>
@endsection
