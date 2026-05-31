@extends('layouts.daac')
@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidaturas para Assinatura</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Assine digitalmente as candidaturas aprovadas</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:22px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;line-height:1;">{{ $totais['aprovada'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Por assinar</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#7c3aed;line-height:1;">{{ $totais['concluida'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Concluídas</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#1565c0;line-height:1;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Total</div>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('daac.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        <div style="flex:1;min-width:200px;position:relative;">
            <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nome, BI ou n.º ficha..."
                   style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px 8px 32px;font-size:0.88rem;box-sizing:border-box;">
        </div>
        <div>
            <select name="status" style="border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Aprovadas + Concluídas</option>
                <option value="aprovada"  {{ request('status') === 'aprovada'  ? 'selected' : '' }}>Por assinar</option>
                <option value="concluida" {{ request('status') === 'concluida' ? 'selected' : '' }}>Concluídas</option>
                <option value="pendente"  {{ request('status') === 'pendente'  ? 'selected' : '' }}>Pendentes</option>
            </select>
        </div>
        <button type="submit" style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;font-size:0.88rem;">Filtrar</button>
        @if(request()->hasAny(['q','status','curso']))
        <a href="{{ route('daac.candidaturas.index') }}" style="background:#f1f5f9;color:#475569;border-radius:8px;padding:8px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;">Limpar</a>
        @endif
    </form>

    {{-- Tabela --}}
    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhuma candidatura encontrada.
        </div>
    @else
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;font-size:0.87rem;">
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
                    <td style="padding:13px 16px;font-weight:700;color:#2563eb;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="padding:13px 16px;">
                        <div style="font-weight:600;color:#1a2332;">{{ $c->nome }}</div>
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
                        <a href="{{ route('daac.candidaturas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:4px;background:{{ $c->isAssinada() ? '#7c3aed' : '#2563eb' }};color:#fff;padding:5px 13px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;">
                            {{ $c->isAssinada() ? 'Ver' : 'Assinar' }}
                        </a>
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
