{{-- Tabela --}}
@if($candidaturas->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
        Nenhuma candidatura encontrada.
    </div>
@else
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
    <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.87rem;">
        <thead>
            <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Ficha</th>
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Candidato</th>
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Curso / Período</th>
                <th style="padding:13px 16px;text-align:center;font-weight:700;color:#475569;">Estado</th>
                <th style="padding:13px 16px;text-align:center;font-weight:700;color:#475569;">Acção</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidaturas as $c)
            @php $cor = \App\Models\Candidatura::$statusColors[$c->status] ?? '#94a3b8'; @endphp
            <tr style="border-bottom:1px solid #f1f5f9;">
                <td style="padding:13px 16px;font-weight:700;color:#1e3a5f;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="padding:13px 16px;">
                    <div style="font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</div>
                    <div style="font-size:0.78rem;color:#64748b;">{{ $c->email }}</div>
                </td>
                <td style="padding:13px 16px;color:#334155;">
                    {{ $c->curso }}<br>
                    <span style="font-size:0.78rem;color:#64748b;">{{ $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</span>
                </td>
                <td style="padding:13px 16px;text-align:center;">
                    <span style="background:{{ $cor }}20;color:{{ $cor }};padding:3px 10px;border-radius:20px;font-size:0.76rem;font-weight:700;">
                        {{ \App\Models\Candidatura::$statusLabels[$c->status] ?? $c->status }}
                    </span>
                </td>
                <td style="padding:13px 16px;text-align:center;">
                    <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
                        @if($c->isAssinada())
                        <a href="{{ route('daac.candidaturas.comprovativo', $c) }}"
                           style="display:inline-flex;align-items:center;gap:4px;background:#64748b;color:#fff;padding:5px 11px;border-radius:8px;font-size:0.78rem;font-weight:600;text-decoration:none;"
                           title="Ver comprovativo PDF">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            PDF
                        </a>
                        @else
                        <span style="display:inline-flex;align-items:center;gap:4px;background:#cbd5e1;color:#64748b;padding:5px 11px;border-radius:8px;font-size:0.78rem;font-weight:600;cursor:not-allowed;"
                              title="Só disponível depois de assinada — um comprovativo sem assinatura é inválido">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            PDF
                        </span>
                        @endif
                        <a href="{{ route('daac.candidaturas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:4px;background:{{ $c->isAssinada() ? '#1e3a5f' : '#1e3a5f' }};color:#fff;padding:5px 13px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;">
                            {{ $c->isAssinada() ? 'Ver' : 'Assinar' }}
                        </a>
                        @if($c->isAssinada() && ! $c->whatsapp_comprovativo_enviado_at)
                        <form method="POST" action="{{ route('daac.candidaturas.reenviar-comprovativo', $c) }}" style="display:inline;">
                            @csrf
                            <button type="submit"
                                    style="display:inline-flex;align-items:center;gap:4px;background:#F05A28;color:#fff;border:none;padding:5px 11px;border-radius:8px;font-size:0.78rem;font-weight:600;cursor:pointer;"
                                    title="O candidato ainda não recebeu o comprovativo por WhatsApp — clique para enviar">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Enviar
                            </button>
                        </form>
                        @endif
                        @if($c->isAssinada() && ! $c->comprovativo_impresso_presencialmente_em)
                        <a href="{{ route('daac.candidaturas.imprimir-presencial', $c) }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:4px;background:#eaeff5;color:#0f1f3d;border:1px solid #c7d2e0;padding:5px 11px;border-radius:8px;font-size:0.78rem;font-weight:600;text-decoration:none;"
                           title="Abre o comprovativo para impressão e marca que foi entregue presencialmente ao candidato">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"/></svg>
                            Imprimir
                        </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $candidaturas->links('partials.pagination') }}</div>
@endif
