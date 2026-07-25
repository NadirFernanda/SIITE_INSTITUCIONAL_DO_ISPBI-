@extends('layouts.secretaria')
@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Confirmação de Pagamentos</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Pesquise o candidato e confirme o pagamento da RUP</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:22px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#1a2332;line-height:1;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Total</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#16a34a;line-height:1;">{{ $totais['confirmados'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Pagamentos confirmados</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;line-height:1;">{{ $totais['pendentes'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Aguardando pagamento</div>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('secretaria.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        <div style="flex:1;min-width:240px;position:relative;">
            <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="N.º ficha, nome, BI, email, telefone..."
                   style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px 9px 34px;font-size:0.9rem;box-sizing:border-box;">
        </div>
        <div>
            <select name="pagamento" style="border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os pagamentos</option>
                <option value="nao" {{ request('pagamento') === 'nao' ? 'selected' : '' }}>Sem pagamento confirmado</option>
                <option value="sim" {{ request('pagamento') === 'sim' ? 'selected' : '' }}>Pagamento confirmado</option>
            </select>
        </div>
        <div>
            <select name="curso" style="border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os cursos</option>
                @foreach(\App\Models\Candidatura::$cursos as $c)
                    <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="background:#7c3aed;color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;cursor:pointer;font-size:0.9rem;">Pesquisar</button>
        @if(request()->hasAny(['q','pagamento','curso']))
        <a href="{{ route('secretaria.candidaturas.index') }}" style="background:#f1f5f9;color:#64748b;border-radius:8px;padding:9px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;">Limpar</a>
        @endif
    </form>

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
                    <td style="padding:13px 16px;font-weight:700;color:#7c3aed;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="padding:13px 16px;">
                        <div style="font-weight:600;color:#1a2332;">{{ $c->nome }}</div>
                        <div style="font-size:0.78rem;color:#64748b;">BI: {{ $c->bi }} · {{ $c->telefone }}</div>
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
                            <span style="background:#fef3c7;color:#d97706;padding:4px 12px;border-radius:20px;font-size:0.76rem;font-weight:700;">
                                Pendente
                            </span>
                        @endif
                    </td>
                    <td style="padding:13px 16px;text-align:center;">
                        <div style="display:flex;gap:6px;justify-content:center;align-items:center;">
                            <a href="{{ route('secretaria.candidaturas.show', $c) }}"
                               style="display:inline-flex;align-items:center;gap:4px;background:#7c3aed;color:#fff;padding:6px 13px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;">
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
    <div style="margin-top:16px;">{{ $candidaturas->links() }}</div>
    @endif

</div>
@endsection
