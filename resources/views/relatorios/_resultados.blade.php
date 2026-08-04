@php
    $efLabels = $efLabels ?? ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
@endphp
{{-- Tabela --}}
@if($candidaturas->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;">
        <svg width="48" height="48" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 14px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <p style="color:#94a3b8;margin:0;">Nenhum resultado encontrado.</p>
    </div>
@else
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
    <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.85rem;">
        <thead>
            <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Ficha</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Sexo</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Período</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Província</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Est. Financeiro</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Trabalhador</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Estado</th>
                <th style="padding:11px 14px;text-align:left;font-weight:700;color:#475569;">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidaturas as $c)
            @php
                $corStatus = \App\Models\Candidatura::$statusColors[$c->status] ?? '#94a3b8';
            @endphp
            <tr style="border-bottom:1px solid #f1f5f9;">
                <td style="padding:10px 14px;color:#94a3b8;font-size:0.78rem;font-weight:600;">{{ str_pad($c->id,5,'0',STR_PAD_LEFT) }}</td>
                <td style="padding:10px 14px;">
                    <div style="font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</div>
                    <div style="font-size:0.75rem;color:#64748b;">{{ $c->email }}</div>
                </td>
                <td style="padding:10px 14px;color:#475569;">{{ $c->sexo ? ucfirst($c->sexo) : '—' }}</td>
                <td style="padding:10px 14px;color:#334155;max-width:160px;">{{ $c->curso }}</td>
                <td style="padding:10px 14px;">
                    @php $pCor = $c->periodo==='regular' ? ['#dbeafe','#1d4ed8'] : ['#fef3c7','#92400e']; @endphp
                    <span style="background:{{ $pCor[0] }};color:{{ $pCor[1] }};padding:2px 8px;border-radius:20px;font-size:0.75rem;font-weight:700;">
                        {{ $c->periodo==='pos-laboral' ? 'Pós-Lab.' : 'Regular' }}
                    </span>
                </td>
                <td style="padding:10px 14px;color:#64748b;font-size:0.83rem;">{{ $c->naturalidade_provincia ?? '—' }}</td>
                <td style="padding:10px 14px;color:#64748b;font-size:0.83rem;">{{ $efLabels[$c->estado_financeiro ?? ''] ?? '—' }}</td>
                <td style="padding:10px 14px;text-align:center;">
                    <span style="font-size:0.8rem;">{{ $c->trabalhador ? '✓ Sim' : 'Não' }}</span>
                </td>
                <td style="padding:10px 14px;">
                    <span style="background:{{ $corStatus }}20;color:{{ $corStatus }};padding:2px 8px;border-radius:20px;font-size:0.75rem;font-weight:700;">
                        {{ \App\Models\Candidatura::$statusLabels[$c->status] ?? $c->status }}
                    </span>
                </td>
                <td style="padding:10px 14px;color:#64748b;font-size:0.8rem;white-space:nowrap;">{{ $c->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $candidaturas->links() }}</div>
@endif
