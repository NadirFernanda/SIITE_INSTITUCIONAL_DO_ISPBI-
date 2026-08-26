@extends('layouts.daac')
@section('content')
<div style="max-width:1000px;margin:0 auto;">

    <a href="{{ route('daac.salas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#1e3a5f;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:20px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar às salas
    </a>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:22px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">{{ $sala->nome }}</h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">
                Capacidade: <strong>{{ $sala->capacidade }}</strong> &nbsp;|&nbsp;
                Atribuídos: <strong style="color:#1e3a5f;">{{ $candidaturas->count() }}</strong>
                @if($sala->data_exame || $sala->horario)
                    &nbsp;|&nbsp; {{ $sala->data_exame?->format('d/m/Y') }} {{ $sala->horario }}
                @endif
            </p>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            @if(auth()->check() && auth()->user()->hasRole('presidencia'))
                <a href="{{ route('presidencia.salas.pdf', $sala) }}"
                   style="display:inline-flex;align-items:center;gap:6px;background:#475569;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    PDF — Lista Sala
                </a>
                <a href="{{ route('presidencia.salas.excel-exame', $sala) }}"
                   style="display:inline-flex;align-items:center;gap:6px;background:#1e3a5f;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Excel — Lista Exame
                </a>
                <a href="{{ route('presidencia.salas.excel-notas', $sala) }}"
                   style="display:inline-flex;align-items:center;gap:6px;background:#1e3a5f;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Excel — Lançamento Notas
                </a>
            @else
                <a href="{{ route('daac.salas.pdf', $sala) }}" class="px-3 py-2 bg-slate-700 text-white rounded-md text-sm font-semibold">PDF</a>
                <a href="{{ route('daac.salas.excel-exame', $sala) }}" class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold">Exame</a>
            @endif
        </div>
    </div>

    @php
        $totalCandidatos = $candidaturas->count();
        $impressas       = $candidaturas->whereNotNull('folha_impressa_em')->count();
    @endphp
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <strong style="color:#1a2332;">Folhas de Prova desta Sala</strong>
            <p style="color:#64748b;font-size:0.85rem;margin:2px 0 0;">
                {{ $impressas }} de {{ $totalCandidatos }} folhas já impressas — cada folha só pode ser impressa uma vez.
            </p>
        </div>
        @if($totalCandidatos > 0 && $impressas === $totalCandidatos)
            <span style="background:#f1f5f9;color:#64748b;padding:8px 16px;border-radius:8px;font-size:0.85rem;font-weight:600;">
                Todas as folhas já foram impressas
            </span>
        @elseif($totalCandidatos > 0)
            <a href="{{ route('daac.candidaturas.folhas-prova-lote', ['sala_id' => $sala->id]) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#dc2626;color:#fff;padding:9px 18px;border-radius:10px;font-weight:700;font-size:0.88rem;text-decoration:none;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Gerar Folhas desta Sala ({{ $totalCandidatos - $impressas }} por imprimir)
            </a>
        @endif
    </div>

    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhum candidato atribuído a esta sala.
        </div>
    @else
        @foreach($candidaturas->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular')) as $grupo => $lista)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:16px;">
            <div style="background:#1e3a5f;padding:11px 18px;color:#fff;font-weight:700;font-size:0.9rem;">
                {{ $grupo }} <span style="font-weight:400;opacity:0.8;">({{ $lista->count() }} candidatos)</span>
            </div>
            <table style="width:100%;border-collapse:collapse;font-size:0.87rem;">
                <thead>
                    <tr style="border-bottom:1px solid #e2e8f0;background:#f8fafc;">
                        <th style="padding:10px 18px;text-align:center;font-weight:700;color:#475569;width:60px;">N.º</th>
                        <th style="padding:10px 18px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                        <th style="padding:10px 18px;text-align:left;font-weight:700;color:#475569;">Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista as $c)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:10px 18px;text-align:center;font-weight:700;color:#1e3a5f;">{{ $c->numero_lugar }}</td>
                        <td style="padding:10px 18px;font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</td>
                        <td style="padding:10px 18px;color:#64748b;">{{ $c->sexo ? ucfirst($c->sexo) : '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    @endif

</div>
@endsection
