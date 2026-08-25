@extends('layouts.daac')
@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="margin-bottom:24px;">
        <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Salas de Exame</h1>
        <p style="color:#64748b;font-size:0.92rem;margin:0;">Exportar listas de exame e lançamento de notas</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Painel de Impressão em Lote por Horário --}}
    <div style="background:linear-gradient(135deg, #eaeff5 0%, #dbe3ee 100%);border:1.5pt solid #a8c4e0;border-radius:14px;padding:16px 20px;margin-bottom:22px;">
        <div style="margin-bottom:12px;">
            <strong style="color:#1e3a5f;">Imprimir Listas em Lote por Horário</strong>
            <p style="color:#0f1f3d;font-size:0.85rem;margin:2px 0 0;">Gera o PDF ou o Excel de Lista de Exame de todas as salas de um horário, de uma só vez.</p>
        </div>
        <form method="GET" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#0f1f3d;margin-bottom:5px;">Horário</label>
                <select name="horario" id="horarioLote" style="width:100%;border:1px solid #a8c4e0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    @foreach(\App\Models\Sala::$horarios as $h)
                    <option value="{{ $h }}">{{ $h }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" formaction="{{ route('daac.salas.pdf-lote') }}"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 18px;font-weight:700;cursor:pointer;font-size:0.88rem;white-space:nowrap;">
                📄 Gerar PDF
            </button>
            <button type="submit" formaction="{{ route('daac.salas.excel-exame-lote') }}"
                    style="background:#15803d;color:#fff;border:none;border-radius:8px;padding:9px 18px;font-weight:700;cursor:pointer;font-size:0.88rem;white-space:nowrap;">
                📊 Gerar Excel Exame
            </button>
        </form>
    </div>

    <div style="display:flex;justify-content:flex-end;margin-bottom:14px;">
        <form method="GET" style="display:flex;align-items:center;gap:8px;">
            <label style="font-size:0.85rem;font-weight:600;color:#475569;">Filtrar por curso</label>
            <select name="curso" onchange="this.form.submit()"
                    style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:0.85rem;background:#fff;">
                <option value="">— Todos os cursos —</option>
                @foreach($cursosDisponiveis as $c)
                    <option value="{{ $c }}" {{ $cursoFiltro === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
            @if($cursoFiltro)
                <a href="{{ route('daac.salas.index') }}" style="font-size:0.8rem;color:#94a3b8;text-decoration:none;">Limpar ✕</a>
            @endif
        </form>
    </div>

    @if($salas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhuma sala {{ $cursoFiltro ? 'encontrada para este curso' : 'registada' }}.
        </div>
    @else
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Sala</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Capacidade</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Candidatos</th>
                    <th style="padding:13px 20px;text-align:left;font-weight:700;color:#475569;">Data / Horário</th>
                    <th style="padding:13px 20px;text-align:center;font-weight:700;color:#475569;">Exportar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salas as $sala)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;font-weight:700;color:#1a2332;">
                        <a href="{{ route('daac.salas.show', $sala) }}" style="color:#1e3a5f;text-decoration:none;">
                            {{ $sala->nome }}
                        </a>
                    </td>
                    <td style="padding:14px 20px;text-align:center;color:#475569;">{{ $sala->capacidade }}</td>
                    <td style="padding:14px 20px;text-align:center;font-weight:700;color:{{ $sala->candidaturas_count > 0 ? '#1e3a5f' : '#94a3b8' }};">
                        {{ $sala->candidaturas_count }}
                    </td>
                    <td style="padding:14px 20px;color:#475569;font-size:0.85rem;">
                        @if($sala->data_exame || $sala->horario)
                            {{ $sala->data_exame?->format('d/m/Y') }}
                            @if($sala->horario) &nbsp;|&nbsp; {{ $sala->horario }} @endif
                        @else
                            <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;align-items:center;">
                            @if($sala->candidaturas_count > 0 && $sala->candidaturas_impressas_count === $sala->candidaturas_count)
                                <span style="background:#f1f5f9;color:#64748b;padding:7px 12px;border-radius:7px;font-size:0.85rem;font-weight:600;display:inline-flex;align-items:center;">
                                    Todas as {{ $sala->candidaturas_count }} folhas já impressas
                                </span>
                            @elseif($sala->candidaturas_count > 0)
                                <a href="{{ route('daac.candidaturas.folhas-prova-lote', ['sala_id' => $sala->id]) }}"
                                   title="Gerar folhas de prova por imprimir desta sala"
                                   style="background:#dc2626;color:#fff;padding:6px 14px;border-radius:7px;font-size:0.85rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;">
                                    Gerar Folhas ({{ $sala->candidaturas_count - $sala->candidaturas_impressas_count }} por imprimir)
                                </a>
                            @endif
                            <a href="{{ route('daac.salas.show', $sala) }}" title="Ver sala"
                               style="background:#1e3a5f;color:#fff;padding:6px 14px;border-radius:7px;font-size:0.9rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;">Ver</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection
