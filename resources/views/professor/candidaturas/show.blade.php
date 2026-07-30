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

    {{-- Nota do Exame / Resumo de Lançamento --}}
    <div style="background:#fff;border:1px solid #ede9fe;border-radius:14px;padding:22px 24px;">
        <h2 style="font-size:0.85rem;font-weight:700;color:#7c3aed;text-transform:uppercase;letter-spacing:.05em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">
            Lançamento — Resumo
        </h2>

        @if(!empty($disciplines) && $disciplines->count())
            @php
                $sum = 0.0;
                $hasAny = false;
            @endphp
            <div style="margin-bottom:12px;">
                {{-- calcular soma ponderada conforme disciplinas definidas na sala --}}
                @foreach($disciplines as $d)
                    @php
                        $discName = $d->discipline;
                        $notaRow = $notas[$discName] ?? null;
                        if ($notaRow && $notaRow->nota !== null) {
                            $hasAny = true;
                            $sum += ((float)$notaRow->nota) * ((int)$d->weight_percent / 100.0);
                        }
                    @endphp
                @endforeach

                @if($hasAny)
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:8px;flex-wrap:wrap;">
                        <div id="computedWeightedBox" style="background:{{ $sum >= 10 ? '#f0fdf4' : '#fff5f5' }};border:1px solid {{ $sum >= 10 ? '#86efac' : '#fca5a5' }};border-radius:10px;padding:10px 22px;text-align:center;">
                            <div id="computedWeightedValue" style="font-size:2rem;font-weight:900;color:{{ $sum >= 10 ? '#15803d' : '#dc2626' }};">
                                {{ number_format($sum, 2) }}<span style="font-size:0.9rem;color:#94a3b8;">/20</span>
                            </div>
                            <div id="computedWeightedStatus" style="font-size:0.72rem;font-weight:700;color:{{ $sum >= 10 ? '#15803d' : '#dc2626' }};">
                                {{ $sum >= 10 ? 'APROVADO (pela soma ponderada)' : 'REPROVADO (pela soma ponderada)' }}
                            </div>
                        </div>
                        <div style="font-size:0.78rem;color:#64748b;">A soma ponderada acima é calculada automaticamente a partir das notas por disciplina. A Presidência usará este valor para a pauta final.</div>
                    </div>
                @else
                    <div style="background:#fff8f0;border:1px solid #fde3c7;border-radius:10px;padding:12px;margin-bottom:12px;">
                        <strong>Atenção:</strong> Esta sala utiliza lançamento por disciplinas. Ainda não existem notas por disciplina introduzidas para este candidato. Use o formulário "Lançamento de Notas por Disciplina" abaixo para inserir as notas.
                    </div>
                @endif

                {{-- mostrar resumo das disciplinas e notas atuais --}}
                <div style="border:1px solid #e6f6f6;border-radius:8px;padding:10px;">
                    <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:8px;font-weight:700;color:#0f172a;margin-bottom:8px;">
                        <div>Disciplina</div>
                        <div style="text-align:center;">Peso (%)</div>
                        <div style="text-align:center;">Nota</div>
                    </div>
                    @foreach($disciplines as $d)
                        @php $dn = $d->discipline; $nr = $notas[$dn] ?? null; @endphp
                        <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:8px;align-items:center;padding:6px 0;border-top:1px solid #f3f6f5;">
                            <div style="color:#111827;">{{ $dn }}</div>
                            <div style="text-align:center;color:#374151;">{{ $d->weight_percent }}</div>
                            <div style="text-align:center;color:#111827;font-weight:700;">{{ $nr?->nota !== null ? number_format($nr->nota,2) : '—' }}</div>
                        </div>
                    @endforeach
                    <div style="margin-top:8px;font-size:0.82rem;color:#475569;">
                        Peso total: <strong id="totalWeight">{{ $disciplines->sum('weight_percent') }}%</strong>
                        <span id="weightWarning" style="margin-left:8px;color:#d97706;display:{{ $disciplines->sum('weight_percent') != 100 ? 'inline' : 'none' }};">
                            (Aviso: soma de pesos ≠ 100%)
                        </span>
                    </div>
                </div>
            </div>
        @else
            {{-- fallback: sala sem disciplinas definidas — mostrar formulário de nota única --}}
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
        @endif
    </div>

    {{-- Notas por disciplina (se definidas para o curso) --}}
    @if(!empty($disciplines) && $disciplines->count())
    <div style="background:#fff;border:1px solid #e6fffa;border-radius:14px;padding:22px 24px;margin-top:18px;">
        <h2 style="font-size:0.85rem;font-weight:700;color:#0e7490;text-transform:uppercase;letter-spacing:.05em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #ecfeff;">
            Lançamento de Notas por Disciplina
        </h2>

        <form method="POST" action="{{ route('professor.candidaturas.notas-disciplinas', $candidatura) }}">
            @csrf @method('PATCH')

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;">
                @foreach($disciplines as $d)
                @php $discName = $d->discipline; $existing = $notas[$discName] ?? null; @endphp
                <div style="border:1px solid #e6f6f6;border-radius:8px;padding:12px;">
                    <div style="font-size:0.72rem;font-weight:700;color:#0f172a;margin-bottom:6px;">{{ $discName }}</div>
                    <input type="number" name="notas[{{ $discName }}]" data-weight="{{ (int)$d->weight_percent }}" min="0" max="20" step="0.01" value="{{ old('notas.'.$discName, $existing?->nota) }}" class="disc-nota-input" style="width:100%;padding:8px;border-radius:6px;border:1px solid #e2fdfa;font-weight:700;text-align:center;">
                </div>
                @endforeach
            </div>

            <div style="margin-top:14px;display:flex;gap:12px;align-items:center;">
                <button type="submit" style="background:#0ea5a4;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:700;cursor:pointer;">Guardar notas por disciplina</button>
                <div style="color:#64748b;font-size:0.85rem;">As notas por disciplina serão usadas na exportação da Presidência para calcular a soma ponderada.</div>
            </div>
        </form>
    </div>
    @endif

</div>
<script src="{{ asset('js/professor-candidaturas.js') }}"></script>
@endsection
