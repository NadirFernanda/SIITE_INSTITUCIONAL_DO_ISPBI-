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
                        style="background:#1565c0;color:#fff;border:none;border-radius:10px;padding:10px 20px;font-weight:700;cursor:pointer;font-size:0.88rem;display:flex;align-items:center;gap:6px;">
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

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:26px;">
        @php
        $kpis = [
            ['label'=>'Candidatos','value'=>$totalCandidatos,'color'=>'#1565c0','bg'=>'#e3f2fd'],
            ['label'=>'Atribuídos','value'=>$atribuidos,'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Sem Sala','value'=>$semSala,'color'=>$semSala>0?'#b45309':'#94a3b8','bg'=>$semSala>0?'#fef3c7':'#f1f5f9'],
            ['label'=>'Total Lugares','value'=>$totalLugares,'color'=>'#7c3aed','bg'=>'#ede9fe'],
            ['label'=>'Salas','value'=>$salas->count(),'color'=>'#0e7490','bg'=>'#cffafe'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- Criar sala --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
            <h2 style="font-size:0.95rem;font-weight:700;color:#1565c0;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">
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
                        style="background:#1565c0;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;font-size:0.88rem;">
                    Criar Sala
                </button>
            </form>
        </div>

        {{-- Grupos de candidatos --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
            <h2 style="font-size:0.95rem;font-weight:700;color:#1565c0;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">
                Candidatos por Curso / Período
            </h2>
            @if($grupos->isEmpty())
                <p style="color:#94a3b8;font-size:0.9rem;">Nenhuma candidatura registada.</p>
            @else
                <table style="width:100%;border-collapse:collapse;font-size:0.85rem;">
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
                                <span style="background:{{ $g->periodo === 'regular' ? '#dbeafe' : '#fef3c7' }};color:{{ $g->periodo === 'regular' ? '#1d4ed8' : '#92400e' }};padding:2px 8px;border-radius:20px;font-size:0.75rem;font-weight:700;">
                                    {{ $g->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
                                </span>
                            </td>
                            <td style="padding:7px 10px;text-align:center;font-weight:700;color:#1565c0;">{{ $g->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    {{-- Lista de salas --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-top:22px;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:14px 22px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">
                Salas registadas ({{ $salas->count() }})
            </span>
        </div>
        @if($salas->isEmpty())
            <div style="padding:48px;text-align:center;color:#94a3b8;">Nenhuma sala criada ainda.</div>
        @else
        <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;">
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Sala</th>
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
                        ->selectRaw('curso, periodo, COUNT(*) as n')
                        ->groupBy('curso','periodo')
                        ->get();
                @endphp
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;font-weight:700;color:#1a2332;">{{ $sala->nome }}</td>
                    <td style="padding:14px 20px;text-align:center;color:#475569;">{{ $sala->capacidade }}</td>
                    <td style="padding:14px 20px;text-align:center;">
                        <span style="font-weight:700;color:{{ $ocupados > 0 ? '#15803d' : '#94a3b8' }};">{{ $ocupados }}</span>
                        <div style="background:#f1f5f9;border-radius:4px;height:6px;margin-top:4px;overflow:hidden;">
                            <div style="background:#1565c0;height:100%;width:{{ $pct }}%;border-radius:4px;"></div>
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
                    <td style="padding:14px 20px;text-align:center;">
                        <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
                            <a href="{{ route('admin.salas.show', $sala) }}"
                               style="background:#1565c0;color:#fff;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;">
                                Ver
                            </a>
                            <a href="{{ route('admin.salas.pdf', $sala) }}"
                               style="background:#15803d;color:#fff;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;">
                                PDF
                            </a>
                            {{-- Editar capacidade inline --}}
                            <button onclick="document.getElementById('edit-{{ $sala->id }}').style.display='block'"
                                    style="background:#f59e0b;color:#fff;border:none;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;cursor:pointer;">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('admin.salas.destroy', $sala) }}"
                                  onsubmit="return confirm('Eliminar a sala {{ addslashes($sala->nome) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:#ef4444;color:#fff;border:none;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;cursor:pointer;">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        {{-- Form editar inline --}}
                        <div id="edit-{{ $sala->id }}" style="display:none;margin-top:8px;background:#fefce8;border:1px solid #fde68a;border-radius:8px;padding:10px;">
                            <form method="POST" action="{{ route('admin.salas.update', $sala) }}" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                @csrf @method('PATCH')
                                <input type="text" name="nome" value="{{ $sala->nome }}" maxlength="100" required
                                       style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:120px;">
                                <input type="number" name="capacidade" value="{{ $sala->capacidade }}" min="1" required
                                       style="border:1px solid #e2e8f0;border-radius:6px;padding:6px 10px;font-size:0.82rem;width:80px;">
                                <button type="submit" style="background:#f59e0b;color:#fff;border:none;border-radius:6px;padding:6px 14px;font-size:0.82rem;font-weight:700;cursor:pointer;">Guardar</button>
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
