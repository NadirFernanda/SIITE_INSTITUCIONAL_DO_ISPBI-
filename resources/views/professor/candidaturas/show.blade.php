@extends('layouts.professor')

@section('content')
<div style="max-width:700px;margin:0 auto;">

    <a href="{{ route('professor.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#7c3aed;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:22px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    <div style="margin-bottom:24px;">
        <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">
            Ficha #{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}
        </h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Identificação anónima — apenas sala e n.º da ficha são visíveis.</p>

    {{-- Dados da ficha --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px 24px;margin-bottom:18px;">
        <h2 style="font-size:0.85rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin:0 0 14px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">Identificação de Exame</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;">
            @php
            function _pf($label, $value) {
                $v = $value ?? '—';
                echo '<div><div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">'.$label.'</div><div style="font-size:0.92rem;color:#1a2332;font-weight:500;">'.$v.'</div></div>';
            }
            @endphp
            @php _pf('Ficha', '#'.str_pad($candidatura->id, 5, '0', STR_PAD_LEFT)); @endphp
            @php _pf('Sala', $candidatura->sala?->nome ?? null); @endphp
            @php _pf('Ficha', '#'.str_pad($candidatura->id, 5, '0', STR_PAD_LEFT)); @endphp
            @php _pf('Curso', $candidatura->curso); @endphp
            @php _pf('Período', $candidatura->periodo ? ucfirst(str_replace('-',' ',$candidatura->periodo)) : null); @endphp
        </div>
        <div style="font-size:0.8rem;color:#64748b;margin-top:14px;line-height:1.6;">
            Nenhum dado pessoal do candidato é exibido nesta interface. Use o código de exame junto da correspondência física para confirmar que a ficha corresponde ao exame correto.
        </div>
    </div>

    {{-- Nota do Exame --}}
    <div style="background:#fff;border:1px solid #ede9fe;border-radius:14px;padding:22px 24px;">
        <h2 style="font-size:0.85rem;font-weight:700;color:#7c3aed;text-transform:uppercase;letter-spacing:.05em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">
            Nota do Exame de Acesso
        </h2>

        @if($candidatura->nota_exame !== null)
        <div style="display:flex;align-items:center;gap:16px;margin-bottom:18px;flex-wrap:wrap;">
            <div style="background:{{ $candidatura->nota_exame >= 10 ? '#f0fdf4' : '#fff5f5' }};border:1px solid {{ $candidatura->nota_exame >= 10 ? '#86efac' : '#fca5a5' }};border-radius:10px;padding:10px 22px;text-align:center;">
                <div style="font-size:2rem;font-weight:900;color:{{ $candidatura->nota_exame >= 10 ? '#15803d' : '#dc2626' }};">
                    {{ number_format($candidatura->nota_exame, 1) }}<span style="font-size:0.9rem;color:#94a3b8;">/20</span>
                </div>
                <div style="font-size:0.72rem;font-weight:700;color:{{ $candidatura->nota_exame >= 10 ? '#15803d' : '#dc2626' }};">
                    {{ $candidatura->nota_exame >= 10 ? 'APROVADO' : 'REPROVADO' }}
                </div>
            </div>
            @if($candidatura->nota_lancada_em)
            <div style="font-size:0.78rem;color:#64748b;">
                Lançada por <strong>{{ $candidatura->notaLancadaPor?->name ?? '—' }}</strong><br>
                em {{ $candidatura->nota_lancada_em->format('d/m/Y \à\s H:i') }}
            </div>
            @endif
        </div>
        @endif

        <form method="POST" action="{{ route('professor.candidaturas.nota', $candidatura) }}">
            @csrf @method('PATCH')
            <div style="display:flex;align-items:flex-end;gap:12px;flex-wrap:wrap;">
                <div>
                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:5px;">
                        {{ $candidatura->nota_exame !== null ? 'Corrigir nota' : 'Lançar nota' }} (0 – 20)
                    </label>
                    <input type="number" name="nota_exame" min="0" max="20" step="0.1"
                           value="{{ old('nota_exame', $candidatura->nota_exame) }}"
                           style="border:1px solid #ddd6fe;border-radius:8px;padding:9px 12px;font-size:1.1rem;font-weight:700;width:110px;text-align:center;">
                    @error('nota_exame')<p style="font-size:0.78rem;color:#dc2626;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                        style="background:#7c3aed;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                        onmouseover="this.style.background='#6d28d9'" onmouseout="this.style.background='#7c3aed'">
                    Guardar nota
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
