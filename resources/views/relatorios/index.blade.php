@extends($layout)
@section('content')
@php
    $efLabels = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
    $routePrefix = str_contains($layout, 'admin') ? 'admin' : (str_contains($layout, 'tecnico') ? 'tecnico' : 'daac');
@endphp
<div style="max-width:1200px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Relatórios de Candidaturas</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Filtre e exporte dados de candidaturas</p>
        </div>
        <a href="{{ route($routePrefix.'.relatorios.export') }}{{ request()->getQueryString() ? '?'.request()->getQueryString() : '' }}"
           style="display:inline-flex;align-items:center;gap:7px;background:#22c55e;color:#fff;padding:10px 20px;border-radius:10px;font-weight:700;font-size:0.88rem;text-decoration:none;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Exportar CSV
        </a>
    </div>

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:10px;margin-bottom:20px;">
        @foreach([
            ['Total',       $stats['total'],   '#1565c0','#e3f2fd'],
            ['Masculino',   $stats['masc'],    '#0369a1','#e0f2fe'],
            ['Feminino',    $stats['fem'],     '#7c3aed','#ede9fe'],
            ['Regular',     $stats['regular'], '#15803d','#dcfce7'],
            ['Pós-Laboral', $stats['posLab'],  '#b45309','#fef3c7'],
        ] as [$lbl,$val,$cor,$bg])
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $cor }};line-height:1;">{{ $val }}</div>
            <div style="font-size:0.75rem;color:#64748b;margin-top:4px;font-weight:600;">{{ $lbl }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route($routePrefix.'.relatorios') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px 24px;margin-bottom:20px;">

        {{-- Pesquisa principal --}}
        <div style="display:flex;gap:10px;margin-bottom:14px;">
            <div style="flex:1;position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Nome, n.º ficha, BI, email, escola, província, município..."
                       style="width:100%;border:1.5px solid {{ request('q') ? '#2563eb':'#e2e8f0' }};border-radius:10px;padding:10px 14px 10px 36px;font-size:0.9rem;box-sizing:border-box;">
            </div>
            <button type="submit"
                    style="background:#1565c0;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:700;cursor:pointer;font-size:0.9rem;white-space:nowrap;">
                Filtrar
            </button>
            @if(request()->hasAny(['q','status','periodo','sexo','curso','estado_financeiro','trabalhador','naturalidade_provincia','data_inicio','data_fim']))
            <a href="{{ route($routePrefix.'.relatorios') }}"
               style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-weight:600;font-size:0.88rem;text-decoration:none;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Limpar
            </a>
            @endif
        </div>

        {{-- Filtros secundários --}}
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
            {{-- Período --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Período</label>
                <select name="periodo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="regular"     {{ request('periodo')==='regular'     ? 'selected':'' }}>Regular</option>
                    <option value="pos-laboral" {{ request('periodo')==='pos-laboral' ? 'selected':'' }}>Pós-Laboral</option>
                </select>
            </div>
            {{-- Sexo --}}
            <div style="min-width:120px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Sexo</label>
                <select name="sexo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="masculino" {{ request('sexo')==='masculino' ? 'selected':'' }}>Masculino</option>
                    <option value="feminino"  {{ request('sexo')==='feminino'  ? 'selected':'' }}>Feminino</option>
                </select>
            </div>
            {{-- Curso --}}
            <div style="min-width:200px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Curso</label>
                <select name="curso" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                        <option value="{{ $c }}" {{ request('curso')===$c ? 'selected':'' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Status --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Estado</label>
                <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$statusLabels as $val => $lbl)
                        <option value="{{ $val }}" {{ request('status')===$val ? 'selected':'' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Província --}}
            <div style="min-width:160px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Província</label>
                <select name="naturalidade_provincia" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todas</option>
                    @foreach($provincias as $p)
                        <option value="{{ $p }}" {{ request('naturalidade_provincia')===$p ? 'selected':'' }}>{{ $p }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Est. Financeiro --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Est. Financeiro</label>
                <select name="estado_financeiro" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach($efLabels as $val => $lbl)
                        <option value="{{ $val }}" {{ request('estado_financeiro')===$val ? 'selected':'' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Trabalhador --}}
            <div style="min-width:120px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Trabalhador</label>
                <select name="trabalhador" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="sim" {{ request('trabalhador')==='sim' ? 'selected':'' }}>Sim</option>
                    <option value="nao" {{ request('trabalhador')==='nao' ? 'selected':'' }}>Não</option>
                </select>
            </div>
            {{-- Datas --}}
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Data Início</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                       style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;box-sizing:border-box;">
            </div>
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Data Fim</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                       style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;box-sizing:border-box;">
            </div>
            {{-- Contador --}}
            @if(request()->hasAny(['q','status','periodo','sexo','curso','estado_financeiro','trabalhador','naturalidade_provincia','data_inicio','data_fim']))
            <div style="display:flex;align-items:flex-end;padding-bottom:2px;">
                <span style="font-size:0.8rem;color:#64748b;background:#f1f5f9;padding:4px 12px;border-radius:20px;white-space:nowrap;">
                    {{ $candidaturas->total() }} resultado{{ $candidaturas->total() !== 1 ? 's':'' }}
                </span>
            </div>
            @endif
        </div>
    </form>

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
                        <div style="font-weight:600;color:#1a2332;">{{ $c->nome }}</div>
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

</div>
@endsection
