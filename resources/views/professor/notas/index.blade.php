@extends('layouts.professor')
@section('content')
<div style="max-width:1000px;margin:0 auto;">

    <div style="margin-bottom:22px;">
        <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Lançamento de Notas</h1>
        <p style="color:#64748b;font-size:0.88rem;margin:0;">
            Avaliação cega — apenas o código de exame é apresentado. Nenhum dado pessoal do candidato é visível.
        </p>
    </div>

    @if(session('success'))
        <div style="background:#e0f2fe;border:1px solid #7dd3fc;color:#0369a1;padding:11px 16px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:9px;">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:11px 16px;border-radius:10px;margin-bottom:18px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:22px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#0e7490;line-height:1;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Total candidatos</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#15803d;line-height:1;">{{ $totais['lancadas'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Notas lançadas</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;line-height:1;">{{ $totais['por_lancar'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Por lançar</div>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('professor.notas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 18px;margin-bottom:18px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        <div>
            <label style="display:block;font-size:0.75rem;font-weight:600;color:#64748b;margin-bottom:4px;">Código de Exame</label>
            <input type="text" name="codigo" value="{{ request('codigo') }}" placeholder="EX..."
                   style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;width:160px;text-transform:uppercase;"
                   oninput="this.value=this.value.toUpperCase()">
        </div>
        <div>
            <label style="display:block;font-size:0.75rem;font-weight:600;color:#64748b;margin-bottom:4px;">Curso</label>
            <select name="curso" style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os cursos</option>
                @foreach($cursos as $c)
                    <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display:block;font-size:0.75rem;font-weight:600;color:#64748b;margin-bottom:4px;">Estado</label>
            <select name="estado" style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 11px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos</option>
                <option value="por_lancar" {{ request('estado') === 'por_lancar' ? 'selected' : '' }}>Por lançar</option>
                <option value="lancada"    {{ request('estado') === 'lancada'    ? 'selected' : '' }}>Nota lançada</option>
            </select>
        </div>
        <button type="submit" style="background:#0e7490;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;font-size:0.88rem;">Filtrar</button>
        @if(request()->hasAny(['codigo','curso','estado']))
        <a href="{{ route('professor.notas.index') }}" style="background:#f1f5f9;color:#475569;border-radius:8px;padding:8px 14px;font-size:0.88rem;text-decoration:none;font-weight:500;">Limpar</a>
        @endif
    </form>

    {{-- Aviso de privacidade --}}
    <div style="background:#fef9c3;border:1px solid #fde047;border-left:4px solid #ca8a04;border-radius:8px;padding:10px 14px;margin-bottom:18px;font-size:0.82rem;color:#713f12;">
        <strong>Avaliação cega:</strong> Os dados pessoais dos candidatos estão ocultos. Apenas o código de exame, curso e período são apresentados, garantindo imparcialidade no lançamento de notas.
    </div>

    {{-- Tabela --}}
    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhum candidato encontrado com os filtros seleccionados.
        </div>
    @else
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;font-size:0.87rem;">
            <thead>
                <tr style="background:#f0f9ff;border-bottom:2px solid #bae6fd;">
                    <th style="padding:12px 16px;text-align:left;font-weight:700;color:#0e7490;">Código de Exame</th>
                    <th style="padding:12px 16px;text-align:left;font-weight:700;color:#0e7490;">Curso</th>
                    <th style="padding:12px 16px;text-align:center;font-weight:700;color:#0e7490;">Período</th>
                    <th style="padding:12px 16px;text-align:center;font-weight:700;color:#0e7490;">Nota</th>
                    <th style="padding:12px 16px;text-align:center;font-weight:700;color:#0e7490;">Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidaturas as $c)
                @php $nota = $c->nota; @endphp
                <tr style="border-bottom:1px solid #f1f5f9;{{ $nota ? '' : 'background:#fffbeb;' }}">
                    <td style="padding:13px 16px;">
                        <span style="font-family:monospace;font-size:1rem;font-weight:800;color:#0e7490;letter-spacing:0.05em;">{{ $c->codigo_exame }}</span>
                    </td>
                    <td style="padding:13px 16px;color:#334155;font-weight:500;">{{ $c->curso }}</td>
                    <td style="padding:13px 16px;text-align:center;">
                        <span style="background:#e0f2fe;color:#0369a1;padding:2px 10px;border-radius:20px;font-size:0.76rem;font-weight:700;">
                            {{ $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
                        </span>
                    </td>
                    <td style="padding:13px 16px;text-align:center;">
                        @if($nota)
                            <span style="font-size:1.05rem;font-weight:800;color:{{ $nota->nota >= 10 ? '#15803d' : '#dc2626' }};">
                                {{ number_format($nota->nota, 1) }}
                            </span>
                            <span style="font-size:0.75rem;color:#94a3b8;">/20</span>
                        @else
                            <span style="color:#94a3b8;font-size:0.8rem;">—</span>
                        @endif
                    </td>
                    <td style="padding:13px 16px;text-align:center;">
                        @if(! $nota || $nota->professor_id === auth()->id())
                        <a href="{{ route('professor.notas.show', $c) }}"
                           style="display:inline-flex;align-items:center;gap:5px;background:#0e7490;color:#fff;padding:5px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;"
                           onmouseover="this.style.background='#0891b2'" onmouseout="this.style.background='#0e7490'">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H9v-1.414a2 2 0 01.586-1.414z"/></svg>
                            {{ $nota ? 'Corrigir' : 'Lançar nota' }}
                        </a>
                        @else
                            <span style="color:#94a3b8;font-size:0.78rem;">Lançada</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:14px;">{{ $candidaturas->links() }}</div>
    @endif

</div>
@endsection
