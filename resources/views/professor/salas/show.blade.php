@extends('layouts.professor')

@section('content')
<div style="max-width:1200px;margin:0 auto;">

    {{-- Header com navegação --}}
    <div style="margin-bottom:28px;">
        <a href="{{ route('professor.salas.index') }}"
           style="display:inline-flex;align-items:center;gap:5px;color:#7c3aed;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:16px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Voltar às salas
        </a>

        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 6px;">{{ $sala->nome }}</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">
                📅 {{ $sala->data_exame?->format('d/m/Y') }} • ⏰ {{ $sala->horario }} 
                • <strong>{{ $candidaturas->count() }}</strong> candidatos
            </p>
        </div>
    </div>

    {{-- Barra de estatísticas --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:24px;">
        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:14px;text-align:center;">
            <div style="font-size:1.6rem;font-weight:900;color:#1a2332;">{{ $candidaturas->count() }}</div>
            <div style="font-size:0.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;">Total</div>
        </div>
        <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:14px;text-align:center;">
            <div style="font-size:1.6rem;font-weight:900;color:#15803d;">{{ $candidaturas->whereNotNull('nota_exame')->count() }}</div>
            <div style="font-size:0.72rem;font-weight:600;color:#22c55e;text-transform:uppercase;">Com Nota</div>
        </div>
        <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:10px;padding:14px;text-align:center;">
            <div style="font-size:1.6rem;font-weight:900;color:#dc2626;">{{ $candidaturas->whereNull('nota_exame')->count() }}</div>
            <div style="font-size:0.72rem;font-weight:600;color:#f87171;text-transform:uppercase;">Sem Nota</div>
        </div>
        <div style="background:#fff8f0;border:1px solid #fdd5ba;border-radius:10px;padding:14px;text-align:center;">
            <div style="font-size:1.6rem;font-weight:900;color:#ea580c;">
                {{ $candidaturas->count() > 0 ? round(($candidaturas->whereNotNull('nota_exame')->count() / $candidaturas->count()) * 100) : 0 }}%
            </div>
            <div style="font-size:0.72rem;font-weight:600;color:#f97316;text-transform:uppercase;">Progresso</div>
        </div>
    </div>

    {{-- Informativo de anonimato --}}
    <div style="margin-bottom:20px;padding:14px 16px;background:#ede9fe;border:1px solid #ddd6fe;border-radius:12px;color:#5b21b6;font-size:0.88rem;line-height:1.6;">
        <strong style="display:block;margin-bottom:4px;">🔒 Garantia de Anonimato:</strong>
        Apenas o código de exame é exibido. Nenhum dado pessoal do candidato (nome, BI, etc.) aparece nesta interface. Valide os códigos contra a correspondência física oficial da DAAC/Secretaria.
    </div>

    {{-- Tabela com pauta --}}
    @if($candidaturas->isEmpty())
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:40px;text-align:center;color:#64748b;">
        <p style="font-size:1rem;margin:0;">Nenhum candidato atribuído a esta sala.</p>
    </div>
    @else

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;background:#f8fafc;">
                    <th style="padding:12px 18px;text-align:center;font-weight:700;color:#475569;width:60px;">Lugar</th>
                    <th style="padding:12px 18px;text-align:left;font-weight:700;color:#475569;">Código Exame</th>
                    <th style="padding:12px 18px;text-align:center;font-weight:700;color:#475569;width:120px;">Nota</th>
                    <th style="padding:12px 18px;text-align:left;font-weight:700;color:#475569;">Status</th>
                    <th style="padding:12px 18px;text-align:center;font-weight:700;color:#475569;width:100px;">Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidaturas as $i => $c)
                <tr class="hover-row" style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:13px 18px;color:#94a3b8;font-weight:600;text-align:center;">{{ $loop->iteration }}</td>
                    <td style="padding:13px 18px;color:#1a2332;font-weight:700;font-size:0.95rem;">
                        <code style="background:#f1f5f9;padding:4px 8px;border-radius:5px;font-family:monospace;">{{ $c->codigo_exame }}</code>
                    </td>
                    <td style="padding:13px 18px;text-align:center;color:#475569;">
                        @if(isset($salaDiscs) && $salaDiscs->count())
                            @php
                                $discNotas = $c->discipline_notas ?? collect();
                                $hasAnyDisc = false;
                                $soma = 0.0;
                            @endphp
                            @foreach($salaDiscs as $sd)
                                @php
                                    $nr = $discNotas[$sd->discipline] ?? null;
                                    if ($nr && $nr->nota !== null) {
                                        $hasAnyDisc = true;
                                        $soma += (float)$nr->nota;
                                    }
                                @endphp
                            @endforeach

                            @if($hasAnyDisc)
                                <div style="margin-bottom:6px;">
                                    <span style="background:{{ $soma >= 10 ? '#f0fdf4' : '#fff5f5' }};color:{{ $soma >= 10 ? '#15803d' : '#dc2626' }};border:1px solid {{ $soma >= 10 ? '#86efac' : '#fca5a5' }};padding:4px 12px;border-radius:20px;font-weight:700;font-size:0.85rem;">
                                        {{ number_format($soma, 2) }}/20
                                    </span>
                                </div>
                                <div style="font-size:0.78rem;color:#64748b;display:flex;gap:8px;flex-wrap:wrap;justify-content:center;">
                                    @foreach($salaDiscs as $sd)
                                        @php $nr = $discNotas[$sd->discipline] ?? null; @endphp
                                        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:6px 8px;font-weight:700;color:#0f172a;font-size:0.8rem;">
                                            <div style="font-size:0.72rem;font-weight:600;color:#64748b;">{{ $sd->discipline }}</div>
                                            <div style="text-align:center;">{{ $nr?->nota !== null ? number_format($nr->nota,2) : '—' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span style="color:#94a3b8;font-size:0.9rem;">—</span>
                            @endif
                        @else
                            @if($c->nota_exame !== null)
                                <span style="background:{{ $c->nota_exame >= 10 ? '#f0fdf4' : '#fff5f5' }};color:{{ $c->nota_exame >= 10 ? '#15803d' : '#dc2626' }};border:1px solid {{ $c->nota_exame >= 10 ? '#86efac' : '#fca5a5' }};padding:4px 12px;border-radius:20px;font-weight:700;font-size:0.85rem;">
                                    {{ number_format($c->nota_exame, 1) }}/20
                                </span>
                            @else
                                <span style="color:#94a3b8;font-size:0.9rem;">—</span>
                            @endif
                        @endif
                    </td>
                    <td style="padding:13px 18px;">
                        @if($c->nota_exame !== null)
                            <div style="font-size:0.75rem;color:#64748b;">
                                <strong>Lançada por:</strong> {{ $c->notaLancadaPor?->name ?? 'Sistema' }}<br>
                                <strong>Em:</strong> {{ $c->nota_lancada_em?->format('d/m/Y H:i') }}
                            </div>
                        @else
                            <span style="background:#fff5f5;color:#dc2626;padding:4px 10px;border-radius:6px;font-size:0.8rem;font-weight:600;">Pendente</span>
                        @endif
                    </td>
                    <td style="padding:13px 18px;text-align:center;">
                        <button type="button" class="openNotaBtn"
                                                        data-candidatura-id="{{ $c->id }}"
                                                        data-codigo-exame="{{ $c->codigo_exame }}"
                                                        data-nota="{{ $c->nota_exame ?? '' }}"
                                                        style="background:{{ $c->nota_exame !== null ? '#f5f3ff' : '#ede9fe' }};color:#6d28d9;border:1px solid #ddd6fe;border-radius:7px;padding:6px 14px;font-size:0.8rem;font-weight:700;cursor:pointer;transition:all 0.2s;">
                            {{ $c->nota_exame !== null ? '✏️ Editar' : '➕ Lançar' }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif

</div>

{{-- Modal para lançamento de nota --}}
<div id="notaModal" data-sala-id="{{ $sala->id }}" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:32px;max-width:700px;width:95%;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);">
        <h2 style="font-size:1.3rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Lançar Nota</h2>
        <p style="color:#64748b;font-size:0.9rem;margin:0 0 20px;">Código de Exame: <code id="codigoExame" style="background:#f1f5f9;padding:2px 6px;border-radius:4px;font-weight:700;"></code></p>

        {{-- Formulário dinâmico: se a sala tiver disciplinas definidas mostramos inputs por disciplina, senão input único --}}
        <form id="notaForm" method="POST" style="margin-bottom:20px;">
            @csrf @method('PATCH')
            <input type="hidden" name="redirect_to" id="redirectInput" value="">

            <div id="singleNotaContainer" style="margin-bottom:16px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:6px;">Nota (0 – 20)</label>
                <input type="number" name="nota_exame" id="notaInput" min="0" max="20" step="0.1"
                       style="width:100%;border:2px solid #ddd6fe;border-radius:8px;padding:12px;font-size:1.2rem;font-weight:700;text-align:center;box-sizing:border-box;"
                       placeholder="Ex: 15.5"
                       required autofocus>
                <p id="notaError" style="font-size:0.8rem;color:#dc2626;margin-top:6px;display:none;"></p>
            </div>

            <div id="disciplinasContainer" style="display:none;margin-bottom:12px;">
                <div style="font-size:0.9rem;color:#64748b;margin-bottom:8px;">Lançamento por disciplina — preencha as notas abaixo:</div>
                <div id="disciplinasList" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:10px;"></div>
            </div>

            {{-- Visual feedback de aprovação/reprovação --}}
            <div id="notaFeedback" style="padding:12px;border-radius:8px;font-size:0.85rem;font-weight:600;margin-bottom:20px;text-align:center;display:none;">
            </div>

            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <button type="submit" id="notaSubmit" style="flex:1;background:#7c3aed;color:#fff;border:none;border-radius:8px;padding:12px;font-weight:700;cursor:pointer;font-size:0.9rem;">
                    Guardar Nota
                </button>
                <button type="button" id="notaCancel" style="flex:1;background:#f1f5f9;color:#475569;border:none;border-radius:8px;padding:12px;font-weight:700;cursor:pointer;font-size:0.9rem;">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script id="sala-disciplines" type="application/json">{!! json_encode(isset($salaDiscs) ? $salaDiscs->map(function($d){ return ['discipline' => $d->discipline, 'weight' => (int)$d->weight_percent]; }) : []) !!}</script>
<script src="{{ asset('js/professor-salas.js') }}"></script>

@endsection
