@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:26px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Salas de Exame</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Gestão das salas e distribuição de candidatos</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            {{-- Distribuir --}}
            <form method="POST" action="{{ route('admin.salas.distribuir') }}"
                  onsubmit="return confirm('Isto vai redistribuir TODOS os candidatos pelas salas. Continuar?')">
                @csrf
                <button type="submit"
                        style="background:#1e3a5f;color:#fff;border:none;border-radius:10px;padding:10px 20px;font-weight:700;cursor:pointer;font-size:0.88rem;display:flex;align-items:center;gap:6px;"
                        onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Distribuir Candidatos
                </button>
            </form>
            {{-- Limpar --}}
            <form method="POST" action="{{ route('admin.salas.limpar') }}"
                  onsubmit="return confirm('Remover toda a distribuição existente?')">
                @csrf
                <button type="submit"
                        style="background:#f1f5f9;color:#475569;border:none;border-radius:10px;padding:10px 18px;font-weight:600;cursor:pointer;font-size:0.88rem;">
                    Limpar Distribuição
                </button>
            </form>
        </div>
    </div>

    {{-- Flash --}}
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

    {{-- Painel de Impressão em Lote por Horário --}}
    <div style="background:linear-gradient(135deg, #eaeff5 0%, #dbe3ee 100%);border:1.5pt solid #a8c4e0;border-radius:14px;padding:16px 20px;margin-bottom:22px;">
        <div style="margin-bottom:12px;">
            <strong style="color:#1e3a5f;">Imprimir Listas em Lote por Horário</strong>
            <p style="color:#0f1f3d;font-size:0.85rem;margin:2px 0 0;">Gera as listas de todas as salas de um horário de uma só vez, em vez de sala a sala.</p>
        </div>
        <form method="GET" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#0f1f3d;margin-bottom:5px;">Horário</label>
                <select name="horario" style="width:100%;border:1px solid #a8c4e0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    @foreach(\App\Models\Sala::$horarios as $h)
                    <option value="{{ $h }}">{{ $h }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" formaction="{{ route('admin.salas.pdf-lote') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF
            </button>
            <button type="submit" formaction="{{ route('admin.salas.pdf-exame-lote') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF Exame
            </button>
            <button type="submit" formaction="{{ route('admin.salas.excel-exame-lote') }}"
                    style="background:#15803d;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📊 Excel Exame
            </button>
        </form>
    </div>

    {{-- Painel de Impressão em Lote por Curso --}}
    <div style="background:linear-gradient(135deg, #eaeff5 0%, #dbe3ee 100%);border:1.5pt solid #a8c4e0;border-radius:14px;padding:16px 20px;margin-bottom:22px;">
        <div style="margin-bottom:12px;">
            <strong style="color:#1e3a5f;">Imprimir Listas em Lote por Curso</strong>
            <p style="color:#0f1f3d;font-size:0.85rem;margin:2px 0 0;">Gera as listas de todas as salas de um curso de uma só vez (independentemente do horário), para facilitar a impressão.</p>
        </div>
        <form method="GET" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#0f1f3d;margin-bottom:5px;">Curso</label>
                <select name="curso" style="width:100%;border:1px solid #a8c4e0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    @foreach($cursosDisponiveis as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" formaction="{{ route('admin.salas.pdf-lote-curso') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF
            </button>
            <button type="submit" formaction="{{ route('admin.salas.pdf-exame-lote-curso') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📄 PDF Exame
            </button>
            <button type="submit" formaction="{{ route('admin.salas.excel-exame-lote-curso') }}"
                    style="background:#15803d;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-weight:700;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                📊 Excel Exame
            </button>
        </form>
    </div>

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:26px;">
        @php
        $kpis = [
            ['label'=>'Candidatos','value'=>$totalCandidatos,'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Atribuídos','value'=>$atribuidos,'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Sem Sala','value'=>$semSala,'color'=>$semSala>0?'#F05A28':'#94a3b8','bg'=>$semSala>0?'#fde8e0':'#f1f5f9'],
            ['label'=>'Total Lugares','value'=>$totalLugares,'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Salas','value'=>$salas->count(),'color'=>'#0f1f3d','bg'=>'#eaeff5'],
        ];
        @endphp
        @foreach($kpis as $k)
        @if($k['label'] === 'Sem Sala' && $k['value'] > 0)
        <a href="{{ route('admin.salas.sem-sala') }}" style="background:#fff;border:1px solid #F05A28;border-radius:14px;padding:16px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }} →</div>
        </a>
        @else
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endif
        @endforeach
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- Criar sala --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
            <h2 style="font-size:0.95rem;font-weight:700;color:#1e3a5f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">
                Adicionar Sala
            </h2>
            <form method="POST" action="{{ route('admin.salas.store') }}">
                @csrf
                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Nome da Sala <span style="color:#ef4444">*</span></label>
                    <input type="text" name="nome" value="{{ old('nome') }}" required maxlength="100"
                           placeholder="Ex: Sala A, Anfiteatro 1..."
                           style="width:100%;border:1px solid {{ $errors->has('nome') ? '#f87171' : '#e2e8f0' }};border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                    @error('nome')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Capacidade <span style="color:#ef4444">*</span></label>
                    <input type="number" name="capacidade" value="{{ old('capacidade') }}" required min="1" max="1000"
                           style="width:140px;border:1px solid {{ $errors->has('capacidade') ? '#f87171' : '#e2e8f0' }};border-radius:8px;padding:9px 12px;font-size:0.9rem;">
                    @error('capacidade')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                    <div>
                        <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Data do Exame</label>
                        <input type="date" name="data_exame" value="{{ old('data_exame') }}"
                               style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Horário</label>
                        <select name="horario" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.9rem;">
                            <option value="">— Sem horário —</option>
                            @foreach(\App\Models\Sala::$horarios as $h)
                                <option value="{{ $h }}" {{ old('horario') === $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit"
                        style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;font-size:0.88rem;"
                        onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                    Criar Sala
                </button>
            </form>
        </div>

        {{-- Grupos de candidatos --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
            <h2 style="font-size:0.95rem;font-weight:700;color:#1e3a5f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">
                Candidatos por Curso / Período
            </h2>
            @if($grupos->isEmpty())
                <p style="color:#94a3b8;font-size:0.9rem;">Nenhuma candidatura registada.</p>
            @else
                <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.85rem;">
                    <thead>
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <th style="padding:7px 10px;text-align:left;color:#64748b;font-weight:700;">Curso</th>
                            <th style="padding:7px 10px;text-align:left;color:#64748b;font-weight:700;">Período</th>
                            <th style="padding:7px 10px;text-align:center;color:#64748b;font-weight:700;">Inscritos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $g)
                        <tr style="border-bottom:1px solid #f8fafc;">
                            <td style="padding:7px 10px;color:#334155;">{{ $g->curso }}</td>
                            <td style="padding:7px 10px;">
                                <span style="background:{{ $g->periodo === 'regular' ? '#eaeff5' : '#fde8e0' }};color:{{ $g->periodo === 'regular' ? '#1e3a5f' : '#F05A28' }};padding:2px 8px;border-radius:20px;font-size:0.75rem;font-weight:700;">
                                    {{ $g->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
                                </span>
                            </td>
                            <td style="padding:7px 10px;text-align:center;font-weight:700;color:#1e3a5f;">{{ $g->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    {{-- Lista de salas --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-top:22px;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:14px 22px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">
                Salas registadas ({{ $salas->count() }})
            </span>
            <form method="GET" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <label style="font-size:0.8rem;font-weight:600;color:#475569;">Curso</label>
                <select name="curso" onchange="this.form.submit()"
                        style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:0.85rem;background:#fff;">
                    <option value="">— Todos —</option>
                    @foreach($cursosDisponiveis as $c)
                        <option value="{{ $c }}" {{ $cursoFiltro === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                <label style="font-size:0.8rem;font-weight:600;color:#475569;">Período</label>
                <select name="periodo_filtro" onchange="this.form.submit()"
                        style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:0.85rem;background:#fff;">
                    <option value="">— Todos —</option>
                    <option value="regular" {{ $periodoFiltro === 'regular' ? 'selected' : '' }}>Regular</option>
                    <option value="pos-laboral" {{ $periodoFiltro === 'pos-laboral' ? 'selected' : '' }}>Pós-Laboral</option>
                </select>
                <label style="font-size:0.8rem;font-weight:600;color:#475569;">Data</label>
                <select name="data_filtro" onchange="this.form.submit()"
                        style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:0.85rem;background:#fff;">
                    <option value="">— Todas —</option>
                    @foreach($datasDisponiveis as $d)
                        <option value="{{ $d->format('Y-m-d') }}" {{ $dataFiltro === $d->format('Y-m-d') ? 'selected' : '' }}>{{ $d->format('d/m/Y') }}</option>
                    @endforeach
                </select>
                <label style="font-size:0.8rem;font-weight:600;color:#475569;">Horário</label>
                <select name="horario_filtro" onchange="this.form.submit()"
                        style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:0.85rem;background:#fff;">
                    <option value="">— Todos —</option>
                    @foreach(\App\Models\Sala::$horarios as $h)
                        <option value="{{ $h }}" {{ $horarioFiltro === $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @if($cursoFiltro || $dataFiltro || $horarioFiltro || $periodoFiltro)
                    <a href="{{ route('admin.salas.index') }}" style="font-size:0.8rem;color:#94a3b8;text-decoration:none;">Limpar ✕</a>
                @endif
            </form>
        </div>

        @if($cursoFiltro || $dataFiltro || $horarioFiltro || $periodoFiltro)
        <div style="padding:16px 22px;border-bottom:1px solid #e2e8f0;background:#fafbfc;">
            <div style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;">
                Candidatos por curso / período / data / horário (com estes filtros)
            </div>
            @if($resumo->isEmpty())
                <p style="color:#94a3b8;font-size:0.85rem;margin:0;">Nenhum candidato atribuído com estes filtros.</p>
            @else
                <table style="width:100%;border-collapse:collapse;font-size:0.85rem;">
                    <thead>
                        <tr style="border-bottom:1px solid #e2e8f0;">
                            <th style="padding:6px 10px;text-align:left;color:#64748b;">Curso</th>
                            <th style="padding:6px 10px;text-align:left;color:#64748b;">Período</th>
                            <th style="padding:6px 10px;text-align:left;color:#64748b;">Data</th>
                            <th style="padding:6px 10px;text-align:left;color:#64748b;">Horário</th>
                            <th style="padding:6px 10px;text-align:center;color:#64748b;">Candidatos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalResumo = 0; @endphp
                        @foreach($resumo as $r)
                        @php $totalResumo += $r->total; @endphp
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:6px 10px;color:#334155;">{{ $r->curso }}</td>
                            <td style="padding:6px 10px;color:#334155;">{{ $r->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</td>
                            <td style="padding:6px 10px;color:#334155;">{{ \Illuminate\Support\Carbon::parse($r->data_exame)->format('d/m/Y') }}</td>
                            <td style="padding:6px 10px;color:#334155;">{{ $r->horario }}</td>
                            <td style="padding:6px 10px;text-align:center;font-weight:700;color:#1e3a5f;">{{ $r->total }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="padding:8px 10px;font-weight:700;color:#1e3a5f;">Total</td>
                            <td style="padding:8px 10px;text-align:center;font-weight:700;color:#1e3a5f;">{{ $totalResumo }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
        @endif
        @if($salas->isEmpty())
            <div style="padding:48px;text-align:center;color:#94a3b8;">Nenhuma sala criada ainda.</div>
        @else
        <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;">
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Sala</th>
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Data / Horário</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Capacidade</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Atribuídos</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Livres</th>
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Curso(s) Atribuído(s)</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salas as $sala)
                @php
                    $ocupados = $sala->candidaturas_count;
                    $livres   = $sala->capacidade - $ocupados;
                    $pct      = $sala->capacidade > 0 ? round($ocupados / $sala->capacidade * 100) : 0;
                    $cursosNaSala = $sala->candidaturas()
                        ->where('pagamento_confirmado', true)
                        ->when($cursoFiltro, fn ($query) => $query->where('curso', $cursoFiltro))
                        ->when($periodoFiltro, fn ($query) => $query->where('periodo', $periodoFiltro))
                        ->whereNotIn('status', ['rejeitada'])
                        ->selectRaw('curso, periodo, COUNT(*) as n')
                        ->groupBy('curso','periodo')
                        ->get();
                @endphp
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;font-weight:700;color:#1a2332;">{{ $sala->nome }}</td>
                    <td style="padding:14px 20px;color:#475569;">
                        @if($sala->data_exame)
                            <div style="font-weight:600;">{{ $sala->data_exame->format('d/m/Y') }}</div>
                            <div style="font-size:0.78rem;color:#64748b;">{{ $sala->horario }}</div>
                        @else
                            <span style="color:#cbd5e1;font-size:0.8rem;">— modelo —</span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;text-align:center;color:#475569;">{{ $sala->capacidade }}</td>
                    <td style="padding:14px 20px;text-align:center;">
                        <span style="font-weight:700;color:{{ $ocupados > 0 ? '#15803d' : '#94a3b8' }};">{{ $ocupados }}</span>
                        <div style="background:#f1f5f9;border-radius:4px;height:6px;margin-top:4px;overflow:hidden;">
                            <div style="background:#1e3a5f;height:100%;width:{{ $pct }}%;border-radius:4px;"></div>
                        </div>
                    </td>
                    <td style="padding:14px 20px;text-align:center;color:{{ $livres > 0 ? '#64748b' : '#ef4444' }};font-weight:600;">{{ $livres }}</td>
                    <td style="padding:14px 20px;">
                        @forelse($cursosNaSala as $cg)
                            <div style="font-size:0.8rem;color:#334155;">
                                {{ $cg->curso }}
                                <span style="color:#94a3b8;">— {{ $cg->periodo === 'pos-laboral' ? 'Pós-Lab.' : 'Regular' }} ({{ $cg->n }})</span>
                            </div>
                        @empty
                            <span style="color:#cbd5e1;font-size:0.8rem;">Sem atribuição</span>
                        @endforelse
                    </td>
                    <td style="padding:14px 20px;text-align:center;" data-label="Ações">
                        <div style="display:flex;gap:6px;justify-content:center;align-items:center;flex-wrap:wrap;">
                            {{-- Ação principal --}}
                            <a href="{{ route('admin.salas.show', $sala) }}"
                               style="background:#1e3a5f;color:#fff;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;"
                               onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                                Ver
                            </a>
                            {{-- Ações secundárias: mesmo estilo neutro, agrupadas --}}
                            <a href="{{ route('admin.salas.pdf', $sala) }}"
                               style="background:#f1f5f9;color:#1e3a5f;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;border:1px solid #e2e8f0;"
                               onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#f1f5f9'">
                                PDF
                            </a>
                            <a href="{{ route('admin.salas.disciplines.edit', $sala) }}"
                               style="background:#f1f5f9;color:#1e3a5f;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;border:1px solid #e2e8f0;"
                               onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#f1f5f9'">
                                Disciplinas
                            </a>
                            <button onclick="document.getElementById('edit-{{ $sala->id }}').style.display='block'"
                                    style="background:#f1f5f9;color:#1e3a5f;border:1px solid #e2e8f0;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;cursor:pointer;"
                                    onmouseover="this.style.background='#eaeff5'" onmouseout="this.style.background='#f1f5f9'">
                                Editar
                            </button>
                            {{-- Ação destrutiva: mantida a vermelho por segurança, sem divisor rígido (evita desalinhar quando a linha quebra) --}}
                            <form method="POST" action="{{ route('admin.salas.destroy', $sala) }}"
                                  onsubmit="return confirm('Eliminar a sala {{ addslashes($sala->nome) }}?')" style="margin-left:6px;">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:#fff;color:#dc2626;border:1px solid #fca5a5;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;cursor:pointer;"
                                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff'">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        {{-- Form editar inline --}}
                        <div id="edit-{{ $sala->id }}" style="display:none;margin-top:8px;background:#eaeff5;border:1px solid #c7d2e0;border-radius:8px;padding:10px;">
                            <form method="POST" action="{{ route('admin.salas.update', $sala) }}" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                @csrf @method('PATCH')
                                <input type="text" name="nome" value="{{ $sala->nome }}" maxlength="100" required
                                       style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:120px;">
                                <input type="number" name="capacidade" value="{{ $sala->capacidade }}" min="1" required
                                       style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:80px;">
                                <input type="date" name="data_exame" value="{{ optional($sala->data_exame)->format('Y-m-d') }}"
                                       style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:150px;margin-left:6px;">
                                <select name="horario" style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:150px;margin-left:6px;">
                                    <option value="">— Sem horário —</option>
                                    @foreach(\App\Models\Sala::$horarios as $h)
                                        <option value="{{ $h }}" {{ $sala->horario === $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:6px;padding:6px 14px;font-size:0.82rem;font-weight:700;cursor:pointer;">Guardar</button>
                                <button type="button" onclick="document.getElementById('edit-{{ $sala->id }}').style.display='none'"
                                        style="background:#f1f5f9;color:#475569;border:none;border-radius:6px;padding:6px 10px;font-size:0.82rem;cursor:pointer;">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>
@endsection
