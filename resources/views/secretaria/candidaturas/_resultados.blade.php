{{-- Tabela --}}
@if($candidaturas->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;font-size:0.95rem;">
        Nenhuma candidatura encontrada.
    </div>
@else
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
    <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.87rem;">
        <thead>
            <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Ficha</th>
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Candidato</th>
                <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                <th style="padding:13px 16px;text-align:center;font-weight:700;color:#475569;">Pagamento</th>
                <th style="padding:13px 16px;text-align:center;font-weight:700;color:#475569;">Acção</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidaturas as $c)
            <tr style="border-bottom:1px solid #f1f5f9;{{ $c->pagamento_confirmado ? '' : 'background:#fffbeb;' }}">
                <td style="padding:13px 16px;font-weight:700;color:#1e3a5f;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="padding:13px 16px;">
                    <div style="font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</div>
                    <div style="font-size:0.78rem;color:#64748b;">{{ $c->telefone }}</div>
                    @if($c->email)
                    <div style="font-size:0.78rem;color:#64748b;">{{ $c->email }}</div>
                    @endif
                </td>
                <td style="padding:13px 16px;color:#334155;">
                    {{ $c->curso }}<br>
                    <span style="font-size:0.78rem;color:#64748b;">{{ $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</span>
                </td>
                <td style="padding:13px 16px;text-align:center;">
                    @if($c->pagamento_confirmado)
                        <span style="background:#dcfce7;color:#16a34a;padding:4px 12px;border-radius:20px;font-size:0.76rem;font-weight:700;white-space:nowrap;">
                            ✓ Confirmado
                        </span>
                        @if($c->pagamento_confirmado_em)
                        <div style="font-size:0.72rem;color:#94a3b8;margin-top:3px;">{{ $c->pagamento_confirmado_em->format('d/m/Y H:i') }}</div>
                        @endif
                    @else
                        <span style="background:#fef3c7;color:#F05A28;padding:4px 12px;border-radius:20px;font-size:0.76rem;font-weight:700;">
                            Pendente
                        </span>
                    @endif
                </td>
                <td style="padding:13px 16px;text-align:center;">
                    <div style="display:flex;gap:6px;justify-content:center;align-items:center;">
                        <a href="{{ route('secretaria.candidaturas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:4px;background:#1e3a5f;color:#fff;padding:6px 13px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;">
                            Ver
                        </a>
                        @if(! $c->pagamento_confirmado)
                        <form method="POST" action="{{ route('secretaria.candidaturas.confirmar-pagamento', $c) }}" style="margin:0;">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Confirmar pagamento da Ficha {{ str_pad($c->id, 5, "0", STR_PAD_LEFT) }} — {{ $c->nome }}?')"
                                    style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:6px 13px;font-size:0.8rem;font-weight:700;cursor:pointer;">
                                Confirmar
                            </button>
                        </form>
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
