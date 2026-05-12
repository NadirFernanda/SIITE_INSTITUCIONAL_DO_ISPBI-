@extends('layouts.tecnico')

@section('content')
<div style="max-width:820px;margin:0 auto;">

    <a href="{{ route('tecnico.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#0e5c2f;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:22px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidatura #{{ $candidatura->id }}</h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Recebida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        @php $cor = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8'; @endphp
        <span style="background:{{ $cor }}20;color:{{ $cor }};padding:5px 14px;border-radius:20px;font-size:0.88rem;font-weight:700;">
            {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
        </span>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:11px 16px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:9px;">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Dados Pessoais --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#0e5c2f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Dados Pessoais</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
            @php
            $fields = [
                ['label' => 'Nome Completo',     'value' => $candidatura->nome],
                ['label' => 'Email',              'value' => $candidatura->email],
                ['label' => 'Telefone',           'value' => $candidatura->telefone],
                ['label' => 'BI',                 'value' => $candidatura->bi ?? '—'],
                ['label' => 'Data de Nascimento', 'value' => $candidatura->data_nascimento ? $candidatura->data_nascimento->format('d/m/Y') : '—'],
            ];
            @endphp
            @foreach($fields as $f)
            <div>
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">{{ $f['label'] }}</div>
                <div style="font-size:0.93rem;color:#1a2332;font-weight:500;">{{ $f['value'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Dados Académicos --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#0e5c2f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Dados Académicos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
            @php
            $academic = [
                ['label' => 'Curso Pretendido', 'value' => $candidatura->curso],
                ['label' => 'Escola de Origem', 'value' => $candidatura->escola_origem ?? '—'],
                ['label' => 'Ano de Conclusão', 'value' => $candidatura->ano_conclusao ?? '—'],
            ];
            @endphp
            @foreach($academic as $f)
            <div>
                <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">{{ $f['label'] }}</div>
                <div style="font-size:0.93rem;color:#1a2332;font-weight:500;">{{ $f['value'] }}</div>
            </div>
            @endforeach
        </div>
        @if($candidatura->observacoes)
        <div style="margin-top:16px;">
            <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:5px;">Observações do Candidato</div>
            <div style="font-size:0.9rem;color:#334155;background:#f8fafc;border-radius:8px;padding:11px 14px;line-height:1.6;">{{ $candidatura->observacoes }}</div>
        </div>
        @endif
    </div>

    {{-- Atualizar Estado --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#0e5c2f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Atualizar Estado</h2>
        <form method="POST" action="{{ route('tecnico.candidaturas.status', $candidatura) }}">
            @csrf
            @method('PATCH')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:5px;">Estado</label>
                    <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 11px;font-size:0.88rem;">
                        @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                            <option value="{{ $val }}" {{ $candidatura->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:5px;">Notas Internas</label>
                <textarea name="notas_admin" rows="4"
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 11px;font-size:0.88rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Notas visíveis apenas para a equipa técnica...">{{ $candidatura->notas_admin }}</textarea>
            </div>
            <button type="submit"
                    style="background:#0e5c2f;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;font-size:0.88rem;"
                    onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#0e5c2f'">
                Guardar
            </button>
        </form>
    </div>

</div>
@endsection
