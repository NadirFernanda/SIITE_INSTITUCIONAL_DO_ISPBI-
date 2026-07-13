@extends('layouts.professor')

@section('content')
<div style="max-width:1000px;margin:0 auto;">

    <div style="margin-bottom:24px;">
        <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Lançamento de Notas</h1>
        <p style="color:#64748b;font-size:0.92rem;margin:0;">Selecione uma ficha para lançar ou corrigir a nota do exame de acesso.</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Contadores --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:16px 20px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:900;color:#1a2332;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;font-weight:600;color:#94a3b8;text-transform:uppercase;">Total</div>
        </div>
        <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:16px 20px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:900;color:#dc2626;">{{ $totais['sem_nota'] }}</div>
            <div style="font-size:0.78rem;font-weight:600;color:#f87171;text-transform:uppercase;">Sem Nota</div>
        </div>
        <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:12px;padding:16px 20px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:900;color:#15803d;">{{ $totais['com_nota'] }}</div>
            <div style="font-size:0.78rem;font-weight:600;color:#22c55e;text-transform:uppercase;">Com Nota</div>
        </div>
    </div>

    {{-- Filtros --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:16px 20px;margin-bottom:18px;">
        <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
            <div>
                <label style="display:block;font-size:0.75rem;font-weight:600;color:#475569;margin-bottom:4px;">Pesquisa</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Nome, BI ou Nº ficha"
                       style="border:1px solid #e2e8f0;border-radius:7px;padding:7px 11px;font-size:0.88rem;width:200px;">
            </div>
            <div>
                <label style="display:block;font-size:0.75rem;font-weight:600;color:#475569;margin-bottom:4px;">Curso</label>
                <select name="curso" style="border:1px solid #e2e8f0;border-radius:7px;padding:7px 10px;font-size:0.88rem;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                        <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block;font-size:0.75rem;font-weight:600;color:#475569;margin-bottom:4px;">Período</label>
                <select name="periodo" style="border:1px solid #e2e8f0;border-radius:7px;padding:7px 10px;font-size:0.88rem;">
                    <option value="">Todos</option>
                    <option value="regular" {{ request('periodo') === 'regular' ? 'selected' : '' }}>Regular</option>
                    <option value="pos-laboral" {{ request('periodo') === 'pos-laboral' ? 'selected' : '' }}>Pós-Laboral</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-size:0.75rem;font-weight:600;color:#475569;margin-bottom:4px;">Nota</label>
                <select name="nota" style="border:1px solid #e2e8f0;border-radius:7px;padding:7px 10px;font-size:0.88rem;">
                    <option value="">Todas</option>
                    <option value="sem_nota" {{ request('nota') === 'sem_nota' ? 'selected' : '' }}>Sem nota</option>
                    <option value="com_nota" {{ request('nota') === 'com_nota' ? 'selected' : '' }}>Com nota</option>
                </select>
            </div>
            <button type="submit"
                    style="background:#7c3aed;color:#fff;border:none;border-radius:7px;padding:8px 18px;font-weight:700;cursor:pointer;font-size:0.88rem;">
                Filtrar
            </button>
            @if(request()->hasAny(['q','curso','periodo','nota']))
            <a href="{{ route('professor.candidaturas.index') }}"
               style="background:#f1f5f9;color:#475569;border-radius:7px;padding:8px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;">
                Limpar
            </a>
            @endif
        </form>
    </div>

    {{-- Tabela --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;background:#f8fafc;">
                    <th style="padding:12px 20px;text-align:left;font-weight:700;color:#475569;">#</th>
                    <th style="padding:12px 20px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                    <th style="padding:12px 20px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                    <th style="padding:12px 20px;text-align:left;font-weight:700;color:#475569;">Período</th>
                    <th style="padding:12px 20px;text-align:center;font-weight:700;color:#475569;">Nota</th>
                    <th style="padding:12px 20px;text-align:center;font-weight:700;color:#475569;">Acção</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidaturas as $c)
                <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
                    <td style="padding:13px 20px;color:#94a3b8;font-size:0.8rem;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="padding:13px 20px;font-weight:600;color:#1a2332;">{{ $c->nome }}</td>
                    <td style="padding:13px 20px;color:#475569;">{{ $c->curso }}</td>
                    <td style="padding:13px 20px;color:#475569;">{{ ucfirst(str_replace('-',' ',$c->periodo)) }}</td>
                    <td style="padding:13px 20px;text-align:center;">
                        @if($c->nota_exame !== null)
                            <span style="background:{{ $c->nota_exame >= 10 ? '#f0fdf4' : '#fff5f5' }};color:{{ $c->nota_exame >= 10 ? '#15803d' : '#dc2626' }};border:1px solid {{ $c->nota_exame >= 10 ? '#86efac' : '#fca5a5' }};padding:3px 10px;border-radius:20px;font-size:0.82rem;font-weight:700;">
                                {{ number_format($c->nota_exame, 1) }}/20
                            </span>
                        @else
                            <span style="background:#f1f5f9;color:#94a3b8;padding:3px 10px;border-radius:20px;font-size:0.82rem;font-weight:600;">—</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;text-align:center;">
                        <a href="{{ route('professor.candidaturas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:5px;background:#f5f3ff;color:#6d28d9;border:1px solid #ddd6fe;border-radius:7px;padding:5px 14px;font-size:0.82rem;font-weight:700;text-decoration:none;"
                           onmouseover="this.style.background='#ede9fe'" onmouseout="this.style.background='#f5f3ff'">
                            {{ $c->nota_exame !== null ? 'Corrigir' : 'Lançar nota' }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:48px;text-align:center;color:#94a3b8;">Nenhuma ficha encontrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    @if($candidaturas->hasPages())
    <div style="margin-top:18px;display:flex;justify-content:center;">
        {{ $candidaturas->links() }}
    </div>
    @endif

</div>
@endsection
