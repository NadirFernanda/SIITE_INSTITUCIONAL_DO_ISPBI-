@extends('layouts.tecnico')

@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:26px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidaturas Online</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Gestão e acompanhamento das candidaturas recebidas</p>
        </div>
        <a href="{{ route('tecnico.candidaturas.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
           style="display:inline-flex;align-items:center;gap:7px;background:#22c55e;color:#fff;padding:9px 18px;border-radius:10px;font-weight:600;font-size:0.88rem;text-decoration:none;"
           onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            Exportar CSV
        </a>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:11px 16px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:9px;">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:10px;margin-bottom:22px;">
        @php
        $kpis = [
            ['label'=>'Total',       'value'=>$totais['total'],      'color'=>'#1565c0','bg'=>'#e3f2fd'],
            ['label'=>'Pendentes',   'value'=>$totais['pendente'],   'color'=>'#b45309','bg'=>'#fef3c7'],
            ['label'=>'Em Análise',  'value'=>$totais['em_analise'], 'color'=>'#1d4ed8','bg'=>'#dbeafe'],
            ['label'=>'Aprovadas',   'value'=>$totais['aprovada'],   'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Rejeitadas',  'value'=>$totais['rejeitada'],  'color'=>'#b91c1c','bg'=>'#fee2e2'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('tecnico.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        <div style="flex:1;min-width:160px;">
            <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:3px;">Pesquisar</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nome, email ou BI..."
                   style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;box-sizing:border-box;">
        </div>
        <div style="min-width:140px;">
            <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:3px;">Estado</label>
            <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;">
                <option value="">Todos</option>
                @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                    <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div style="min-width:190px;">
            <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:3px;">Curso</label>
            <select name="curso" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;">
                <option value="">Todos</option>
                @foreach(\App\Models\Candidatura::$cursos as $c)
                    <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div style="display:flex;gap:7px;">
            <button type="submit" style="background:#0e5c2f;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;font-size:0.88rem;">Filtrar</button>
            <a href="{{ route('tecnico.candidaturas.index') }}" style="background:#f1f5f9;color:#475569;border-radius:8px;padding:8px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;display:inline-flex;align-items:center;">Limpar</a>
        </div>
    </form>

    {{-- Tabela --}}
    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px 40px;text-align:center;">
            <svg width="48" height="48" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 14px;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p style="color:#94a3b8;font-size:0.95rem;margin:0;">Nenhuma candidatura encontrada.</p>
        </div>
    @else
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:0.87rem;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">#</th>
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Contacto</th>
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Estado</th>
                        <th style="padding:13px 16px;text-align:left;font-weight:700;color:#475569;">Data</th>
                        <th style="padding:13px 16px;text-align:center;font-weight:700;color:#475569;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidaturas as $c)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:13px 16px;color:#94a3b8;font-size:0.78rem;">{{ $c->id }}</td>
                        <td style="padding:13px 16px;">
                            <div style="font-weight:600;color:#1a2332;">{{ $c->nome }}</div>
                            <div style="font-size:0.78rem;color:#64748b;">{{ $c->email }}</div>
                        </td>
                        <td style="padding:13px 16px;color:#334155;">{{ $c->curso }}</td>
                        <td style="padding:13px 16px;color:#64748b;">{{ $c->telefone }}</td>
                        <td style="padding:13px 16px;">
                            @php $cor = \App\Models\Candidatura::$statusColors[$c->status] ?? '#94a3b8'; @endphp
                            <span style="background:{{ $cor }}20;color:{{ $cor }};padding:3px 9px;border-radius:20px;font-size:0.76rem;font-weight:700;white-space:nowrap;">
                                {{ \App\Models\Candidatura::$statusLabels[$c->status] ?? $c->status }}
                            </span>
                        </td>
                        <td style="padding:13px 16px;color:#64748b;white-space:nowrap;">{{ $c->created_at->format('d/m/Y') }}</td>
                        <td style="padding:13px 16px;text-align:center;">
                            <a href="{{ route('tecnico.candidaturas.show', $c) }}"
                               style="display:inline-flex;align-items:center;gap:4px;background:#0e5c2f;color:#fff;padding:5px 13px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;"
                               onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#0e5c2f'">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:18px;">
            {{ $candidaturas->links() }}
        </div>
    @endif

</div>
@endsection
