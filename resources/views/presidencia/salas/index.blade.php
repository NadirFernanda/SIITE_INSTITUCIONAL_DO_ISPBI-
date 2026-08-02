@extends('layouts.presidencia')

@section('content')
<div style="padding:32px 24px;max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:26px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Pautas de Exame</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Impressão e exportação de pautas de candidatos para o exame.</p>
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

    {{-- Painel de Impressão em Lote por Horário --}}
    <div style="background:linear-gradient(135deg, #eaeff5 0%, #dbe3ee 100%);border:1.5pt solid #a8c4e0;border-radius:14px;padding:16px 20px;margin-bottom:22px;">
        <div style="margin-bottom:12px;">
            <strong style="color:#1e3a5f;">Imprimir Pautas em Lote por Horário</strong>
            <p style="color:#0f1f3d;font-size:0.85rem;margin:2px 0 0;">Gera as listas de todas as salas de um horário de uma só vez, em vez de sala a sala.</p>
        </div>
        <form method="GET" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#0f1f3d;margin-bottom:5px;">Horário</label>
                <select name="horario" style="width:100%;border:1px solid #a8c4e0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    @foreach(\App\Models\Sala::$horarios as $h)
                    <option value="{{ $h }}">{{ $h }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" formaction="{{ route('presidencia.salas.pdf-lote') }}"
                    style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF
            </button>
            <button type="submit" formaction="{{ route('presidencia.salas.pdf-exame-lote') }}"
                    style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF Exame
            </button>
            <button type="submit" formaction="{{ route('presidencia.salas.excel-exame-lote') }}"
                    style="background:#059669;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📊 Excel Exame
            </button>
            <button type="submit" formaction="{{ route('presidencia.salas.excel-notas-lote') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📋 Excel Notas
            </button>
        </form>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:26px;">
        @php
        $kpis = [
            ['label'=>'Candidatos','value'=>$totalCandidatos,'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Atribuídos','value'=>$atribuidos,'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Sem Sala','value'=>$semSala,'color'=>$semSala>0?'#b45309':'#94a3b8','bg'=>$semSala>0?'#fef3c7':'#f1f5f9'],
            ['label'=>'Total Lugares','value'=>$totalLugares,'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Salas','value'=>$salas->count(),'color'=>'#1e3a5f','bg'=>'#eaeff5'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-top:22px;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:14px 22px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">
                Salas registadas ({{ $salas->count() }})
            </span>
        </div>
        @if($salas->isEmpty())
            <div style="padding:48px;text-align:center;color:#94a3b8;">Nenhuma sala criada ainda.</div>
        @else
        <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;">
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Sala</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Capacidade</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Atribuídos</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Livres</th>
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Curso(s) Atribuído(s)</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salas as $sala)
                @php
                    $ocupados = $sala->candidaturas_count;
                    $livres   = $sala->capacidade - $ocupados;
                    $pct      = $sala->capacidade > 0 ? round($ocupados / $sala->capacidade * 100) : 0;
                    $cursosNaSala = $sala->candidaturas()
                        ->selectRaw('curso, periodo, COUNT(*) as n')
                        ->groupBy('curso','periodo')
                        ->get();
                @endphp
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;font-weight:700;color:#1a2332;">{{ $sala->nome }}</td>
                    <td style="padding:14px 20px;text-align:center;color:#475569;">{{ $sala->capacidade }}</td>
                    <td style="padding:14px 20px;text-align:center;">
                        <span style="font-weight:700;color:{{ $ocupados > 0 ? '#15803d' : '#94a3b8' }};">{{ $ocupados }}</span>
                        <div style="background:#f1f5f9;border-radius:4px;height:6px;margin-top:4px;overflow:hidden;">
                            <div style="background:#1e3a5f;height:100%;width:{{ $pct }}%;border-radius:4px;"></div>
                        </div>
                    </td>
                    <td style="padding:14px 20px;text-align:center;color:{{ $livres > 0 ? '#64748b' : '#ef4444' }};font-weight:600;">{{ $livres }}</td>
                    <td style="padding:14px 20px;">
                        @forelse($cursosNaSala as $cg)
                            <div style="font-size:0.8rem;color:#334155;">
                                {{ $cg->curso }}
                                <span style="color:#94a3b8;">— {{ $cg->periodo === 'pos-laboral' ? 'Pós-Lab.' : 'Regular' }} ({{ $cg->n }})</span>
                            </div>
                        @empty
                            <span style="color:#cbd5e1;font-size:0.8rem;">Sem atribuição</span>
                        @endforelse
                    </td>
                    <td style="padding:12px 16px;">
                        <div style="display:flex;gap:5px;flex-wrap:wrap;align-items:center;">
                            <a href="{{ route('presidencia.salas.show', $sala) }}" title="Ver detalhe"
                               style="display:inline-flex;align-items:center;gap:4px;background:#1e3a5f;color:#fff;padding:5px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                                Ver
                            </a>
                            <a href="{{ route('presidencia.salas.pdf', $sala) }}" title="Pauta geral PDF"
                               style="display:inline-flex;align-items:center;gap:4px;background:#dc2626;color:#fff;padding:5px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                                📄 PDF
                            </a>
                            <a href="{{ route('presidencia.salas.excel-exame', $sala) }}" title="Lista de exame Excel"
                               style="display:inline-flex;align-items:center;gap:4px;background:#059669;color:#fff;padding:5px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                                📊 Exame
                            </a>
                            <a href="{{ route('presidencia.salas.excel-notas', $sala) }}" title="Pauta de notas Excel"
                               style="display:inline-flex;align-items:center;gap:4px;background:#1e3a5f;color:#fff;padding:5px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                                📋 Notas
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
