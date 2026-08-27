@extends('layouts.presidencia')

@section('content')
<div style="padding:32px 24px;max-width:1000px;margin:0 auto;">
    <style>
        @media print {
            @page { size: auto; margin: 20mm; }
            html, body {
                background: #fff !important;
                color: #000 !important;
                font-size: 12px !important;
            }
            .print-hidden { display: none !important; }
            a, button {
                color: #000 !important;
                text-decoration: none !important;
            }
            * {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            body, table, th, td, div, p {
                background: transparent !important;
                box-shadow: none !important;
            }
            table {
                font-size: 0.85rem !important;
                border-collapse: collapse !important;
                width: 100% !important;
            }
            th, td {
                border: 1px solid #999 !important;
                padding: 6px !important;
            }
            th {
                background: #f8f8f8 !important;
            }
        }
    </style>

    <a href="{{ route('presidencia.salas.index') }}"
       class="print-hidden"
       style="display:inline-flex;align-items:center;gap:6px;color:#1e3a5f;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:22px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar às pautas
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
            <a href="{{ route('presidencia.salas.pdf', $sala) }}"
               class="print-hidden"
               style="display:inline-flex;align-items:center;gap:6px;background:#dc2626;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                📄 Baixar PDF
            </a>
            <a href="{{ route('presidencia.salas.excel-exame', $sala) }}"
               class="print-hidden"
               style="display:inline-flex;align-items:center;gap:6px;background:#059669;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                📊 Excel — Lista Geral
            </a>
            @foreach($categoriasSala as $categoria)
            <a href="{{ route('presidencia.salas.excel-exame', $sala) }}?necessidade_especial={{ urlencode($categoria) }}"
               class="print-hidden"
               title="Lista de presença só com candidatos desta categoria"
               style="display:inline-flex;align-items:center;gap:6px;background:#fff;color:#059669;border:1px solid #059669;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                📊 Excel — {{ $categoria }}
            </a>
            @endforeach
            <a href="{{ route('presidencia.salas.excel-notas', $sala) }}"
               class="print-hidden"
               style="display:inline-flex;align-items:center;gap:6px;background:#1e3a5f;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                📋 Excel — Notas
            </a>
            <button type="button" class="print-hidden" onclick="window.print()"
                    style="display:inline-flex;align-items:center;gap:6px;background:#f59e0b;color:#fff;padding:9px 16px;border-radius:10px;font-weight:700;font-size:0.85rem;border:none;cursor:pointer;">
                🖨️ Imprimir
            </button>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            {{ session('error') }}
        </div>
    @endif

    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhum candidato atribuído a esta sala.
        </div>
    @else
        @foreach($candidaturas->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular')) as $grupo => $lista)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:18px;">
            <div style="background:#1e3a5f;padding:12px 20px;color:#fff;font-weight:700;font-size:0.9rem;">
                {{ $grupo }} <span style="font-weight:400;opacity:0.8;">({{ $lista->count() }} candidatos)</span>
            </div>
            <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.87rem;">
                <thead>
                    <tr style="border-bottom:1px solid #e2e8f0;background:#f8fafc;">
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;width:220px;">Código Exame</th>
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                        <th style="padding:11px 18px;text-align:left;font-weight:700;color:#475569;">Sexo</th>
                        <th style="padding:11px 18px;text-align:center;font-weight:700;color:#475569;width:120px;">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista as $c)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:11px 18px;font-weight:700;color:#1e3a5f;">{{ $c->codigo_exame ?? 'Não gerado' }}</td>
                        <td style="padding:11px 18px;font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</td>
                        <td style="padding:11px 18px;color:#64748b;">{{ $c->sexo ? ucfirst($c->sexo) : '—' }}</td>
                        <td style="padding:11px 18px;text-align:center;color:#1a2332;font-weight:700;">
                            {{ $c->nota_exame !== null ? number_format($c->nota_exame, 1) . '/20' : 'Sem nota' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    @endif

</div>
@endsection
