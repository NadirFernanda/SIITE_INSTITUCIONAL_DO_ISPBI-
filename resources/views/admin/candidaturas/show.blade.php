@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:860px;margin:0 auto;">

    {{-- Back --}}
    <a href="{{ route('admin.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#1565c0;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:24px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    {{-- Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Candidatura #{{ $candidatura->id }}</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;">Recebida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        @php $color = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8'; @endphp
        <span style="background:{{ $color }}20;color:{{ $color }};padding:6px 16px;border-radius:20px;font-size:0.9rem;font-weight:700;">
            {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
        </span>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Candidate info --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;margin-bottom:22px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1565c0;margin:0 0 20px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">Dados Pessoais</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;">
            @php
            $fields = [
                ['label' => 'Nome Completo',       'value' => $candidatura->nome],
                ['label' => 'Email',                'value' => $candidatura->email],
                ['label' => 'Telefone',             'value' => $candidatura->telefone],
                ['label' => 'BI',                   'value' => $candidatura->bi ?? '—'],
                ['label' => 'Data de Nascimento',   'value' => $candidatura->data_nascimento ? $candidatura->data_nascimento->format('d/m/Y') : '—'],
            ];
            @endphp
            @foreach($fields as $f)
            <div>
                <div style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">{{ $f['label'] }}</div>
                <div style="font-size:0.95rem;color:#1a2332;font-weight:500;">{{ $f['value'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Academic info --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;margin-bottom:22px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1565c0;margin:0 0 20px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">Dados Académicos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;">
            @php
            $academic = [
                ['label' => 'Curso Pretendido',  'value' => $candidatura->curso],
                ['label' => 'Escola de Origem',  'value' => $candidatura->escola_origem ?? '—'],
                ['label' => 'Ano de Conclusão',  'value' => $candidatura->ano_conclusao ?? '—'],
            ];
            @endphp
            @foreach($academic as $f)
            <div>
                <div style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">{{ $f['label'] }}</div>
                <div style="font-size:0.95rem;color:#1a2332;font-weight:500;">{{ $f['value'] }}</div>
            </div>
            @endforeach
        </div>
        @if($candidatura->observacoes)
        <div style="margin-top:18px;">
            <div style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Observações do Candidato</div>
            <div style="font-size:0.92rem;color:#334155;background:#f8fafc;border-radius:8px;padding:12px 16px;line-height:1.6;">{{ $candidatura->observacoes }}</div>
        </div>
        @endif
    </div>

    {{-- Update status --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;margin-bottom:22px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1565c0;margin:0 0 20px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">Atualizar Estado</h2>
        <form method="POST" action="{{ route('admin.candidaturas.status', $candidatura) }}">
            @csrf
            @method('PATCH')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:6px;">Estado</label>
                    <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;font-size:0.9rem;">
                        @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                            <option value="{{ $val }}" {{ $candidatura->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="margin-bottom:18px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:6px;">Notas Internas</label>
                <textarea name="notas_admin" rows="4"
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;font-size:0.9rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Notas visíveis apenas para administradores...">{{ $candidatura->notas_admin }}</textarea>
            </div>
            <button type="submit"
                    style="background:#1565c0;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                    onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                Guardar
            </button>
        </form>
    </div>

    {{-- Danger zone --}}
    <div style="background:#fff;border:1px solid #fecaca;border-radius:14px;padding:22px 28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <div style="font-weight:700;color:#b91c1c;margin-bottom:3px;">Eliminar candidatura</div>
            <div style="font-size:0.85rem;color:#64748b;">Esta ação é irreversível.</div>
        </div>
        <form method="POST" action="{{ route('admin.candidaturas.destroy', $candidatura) }}"
              onsubmit="return confirm('Tem a certeza que pretende eliminar esta candidatura?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    style="background:#ef4444;color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                    onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#ef4444'">
                Eliminar
            </button>
        </form>
    </div>

</div>
@endsection
