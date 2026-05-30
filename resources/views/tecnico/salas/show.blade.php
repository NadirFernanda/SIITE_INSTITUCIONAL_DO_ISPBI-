@extends('layouts.tecnico')

@section('content')
<div style="padding:32px 24px;max-width:1000px;margin:0 auto;">

    <a href="{{ route('tecnico.salas.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#1565c0;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:22px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar às salas
    </a>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">{{ $sala->nome }}</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;">
                Capacidade: <strong>{{ $sala->capacidade }}</strong> &nbsp;|&nbsp;
                Atribuídos: <strong style="color:#15803d;">{{ $candidaturas->count() }}</strong> &nbsp;|&nbsp;
                Livres: <strong style="color:{{ $sala->capacidade - $candidaturas->count() > 0 ? '#64748b' : '#ef4444' }};">{{ $sala->capacidade - $candidaturas->count() }}</strong>
            </p>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('tecnico.salas.pdf', $sala) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#1565c0;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                PDF
            </a>
            <a href="{{ route('tecnico.salas.excel-exame', $sala) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#15803d;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Excel — Lista Exame
            </a>
            <a href="{{ route('tecnico.salas.excel-notas', $sala) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#0e5c2f;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Excel — Lançamento Notas
            </a>
        </div>
    </div>

    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhum candidato atribuído a esta sala.
        </div>
    @else
        {{-- Agrupado por curso + período --}}
        @foreach($candidaturas->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular')) as $grupo => $lista)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:18px;">
            <div style="background:#1565c0;padding:12px 20px;color:#fff;font-weight:700;font-size:0.9rem;">
                {{ $grupo }} <span style="font-weight:400;opacity:0.8;">({{ $lista->count() }} candidatos)</span>
            </div>
            <table style="width:100%;border-collapse:collapse;font-size:0.87rem;">
                <thead>
                    <tr style="border-bottom:1px solid #e2e8f0;background:#f8fafc;">
                        <th style="padding:11px 18px;text-align:center;font-weight:700;color:#475569;width:60px;">N.º Lugar</th>
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;">BI</th>
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;">Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista as $c)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;text-align:center;font-weight:700;color:#1565c0;">{{ $c->numero_lugar }}</td>
                        <td style="padding:11px 18px;font-weight:600;color:#1a2332;">{{ $c->nome }}</td>
                        <td style="padding:11px 18px;color:#475569;">{{ $c->bi }}</td>
                        <td style="padding:11px 18px;color:#64748b;">{{ $c->sexo ? ucfirst($c->sexo) : '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    @endif

</div>
@endsection
