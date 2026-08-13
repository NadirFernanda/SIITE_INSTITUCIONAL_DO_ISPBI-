<div style="margin-bottom:12px;">
    <span style="font-size:0.8rem;color:#64748b;background:#f1f5f9;padding:4px 10px;border-radius:20px;">
        {{ $candidaturas->total() }} resultado{{ $candidaturas->total() !== 1 ? 's' : '' }}
    </span>
</div>

{{-- Table --}}
@if($candidaturas->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
        <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p style="color:#94a3b8;font-size:1rem;margin:0;">Nenhuma candidatura encontrada.</p>
    </div>
@else
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">#</th>
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">Contacto</th>
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">Estado</th>
                    <th style="padding:14px 18px;text-align:left;font-weight:700;color:#475569;">Data</th>
                    <th style="padding:14px 18px;text-align:center;font-weight:700;color:#475569;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidaturas as $c)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 18px;color:#94a3b8;font-size:0.8rem;">{{ $c->id }}</td>
                    <td style="padding:14px 18px;">
                        <div style="font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</div>
                        <div style="font-size:0.8rem;color:#64748b;">{{ $c->email }}</div>
                    </td>
                    <td style="padding:14px 18px;color:#334155;">{{ $c->curso }}</td>
                    <td style="padding:14px 18px;color:#64748b;">{{ $c->telefone }}</td>
                    <td style="padding:14px 18px;">
                        @php $color = \App\Models\Candidatura::$statusColors[$c->status] ?? '#94a3b8'; @endphp
                        <span style="background:{{ $color }}20;color:{{ $color }};padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:700;white-space:nowrap;">
                            {{ \App\Models\Candidatura::$statusLabels[$c->status] ?? $c->status }}
                        </span>
                    </td>
                    <td style="padding:14px 18px;color:#64748b;white-space:nowrap;">{{ $c->created_at?->format('d/m/Y') ?? '—' }}</td>
                    <td style="padding:14px 18px;text-align:center;" data-label="Ações">
                        <a href="{{ route('admin.candidaturas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:4px;background:#1e3a5f;color:#fff;padding:6px 14px;border-radius:8px;font-size:0.82rem;font-weight:600;text-decoration:none;"
                           onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top:20px;">
        {{ $candidaturas->links('partials.pagination') }}
    </div>
@endif
