@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1200px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Candidaturas Online</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">Gestão das candidaturas recebidas</p>
        </div>
        <a href="{{ route('admin.candidaturas.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#22c55e;color:#fff;padding:10px 20px;border-radius:10px;font-weight:600;font-size:0.9rem;text-decoration:none;"
           onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Exportar CSV
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPI cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:28px;">
        @php
        $kpis = [
            ['label'=>'Total','value'=>$totais['total'],'color'=>'#1565c0','bg'=>'#e3f2fd'],
            ['label'=>'Pendentes','value'=>$totais['pendente'],'color'=>'#b45309','bg'=>'#fef3c7'],
            ['label'=>'Em Análise','value'=>$totais['em_analise'],'color'=>'#1d4ed8','bg'=>'#dbeafe'],
            ['label'=>'Aprovadas','value'=>$totais['aprovada'],'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Rejeitadas','value'=>$totais['rejeitada'],'color'=>'#b91c1c','bg'=>'#fee2e2'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 22px;text-align:center;">
            <div style="font-size:2rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:6px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Pesquisa avançada --}}
    <form method="GET" action="{{ route('admin.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px 24px;margin-bottom:22px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">

        {{-- Barra principal de pesquisa --}}
        <div style="display:flex;gap:10px;align-items:center;margin-bottom:14px;">
            <div style="flex:1;position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Pesquisar por nome, nº ficha, BI, email, telefone, escola, município, bairro, pai, mãe..."
                       style="width:100%;border:1.5px solid {{ request('q') ? '#2563eb' : '#e2e8f0' }};border-radius:10px;padding:10px 14px 10px 38px;font-size:0.92rem;box-sizing:border-box;outline:none;transition:border 0.2s;"
                       onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor=this.value?'#2563eb':'#e2e8f0'">
            </div>
            <button type="submit"
                    style="background:#1565c0;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:700;cursor:pointer;font-size:0.9rem;white-space:nowrap;display:flex;align-items:center;gap:6px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
                Pesquisar
            </button>
            @if(request()->hasAny(['q','status','curso','periodo','local_inscricao']))
            <a href="{{ route('admin.candidaturas.index') }}"
               style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-weight:600;font-size:0.88rem;text-decoration:none;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Limpar
            </a>
            @endif
        </div>

        {{-- Filtros secundários --}}
        <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Estado</label>
                <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:200px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Curso</label>
                <select name="curso" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                        <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                    <option value="Outro" {{ request('curso') === 'Outro' ? 'selected' : '' }}>Outro — Curso não listado</option>
                </select>
            </div>

            <div style="min-width:200px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Perfil</label>
                <select name="perfil" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                        <option value="{{ $p }}" {{ request('perfil') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                    <option value="Outro" {{ request('perfil') === 'Outro' ? 'selected' : '' }}>Outro — Perfil não listado</option>
                </select>
            </div>

            <div style="align-self:flex-end;">
                <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('page'), ['curso' => 'Outro'])) }}"
                   style="display:inline-block;background:#f97316;color:#fff;padding:8px 12px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;margin-left:8px;">
                    Mostrar "Outro"
                </a>
                <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('page'), ['perfil' => 'Outro'])) }}"
                   style="display:inline-block;background:#6b21a8;color:#fff;padding:8px 12px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;margin-left:8px;">
                    Mostrar perfil "Outro"
                </a>
            </div>
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Período</label>
                <select name="periodo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="regular"    {{ request('periodo') === 'regular'    ? 'selected' : '' }}>Regular</option>
                    <option value="pos-laboral"{{ request('periodo') === 'pos-laboral'? 'selected' : '' }}>Pós-Laboral</option>
                </select>
            </div>
            <div style="min-width:160px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Local</label>
                <select name="local_inscricao" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$locaisInscricao as $val => $label)
                        <option value="{{ $val }}" {{ request('local_inscricao') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @if(request()->hasAny(['q','status','curso','periodo','local_inscricao']))
            <div style="padding-bottom:2px;">
                <span style="font-size:0.8rem;color:#64748b;background:#f1f5f9;padding:4px 10px;border-radius:20px;">
                    {{ $candidaturas->total() }} resultado{{ $candidaturas->total() !== 1 ? 's' : '' }}
                </span>
            </div>
            @endif
        </div>
    </form>

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
            <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
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
                            <div style="font-weight:600;color:#1a2332;">{{ $c->nome }}</div>
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
                        <td style="padding:14px 18px;color:#64748b;white-space:nowrap;">{{ $c->created_at->format('d/m/Y') }}</td>
                        <td style="padding:14px 18px;text-align:center;">
                            <a href="{{ route('admin.candidaturas.show', $c) }}"
                               style="display:inline-flex;align-items:center;gap:4px;background:#1565c0;color:#fff;padding:6px 14px;border-radius:8px;font-size:0.82rem;font-weight:600;text-decoration:none;"
                               onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top:20px;">
            {{ $candidaturas->links() }}
        </div>
    @endif

</div>
@endsection
