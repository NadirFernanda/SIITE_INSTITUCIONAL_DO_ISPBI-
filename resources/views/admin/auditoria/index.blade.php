@extends('layouts.admin')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:28px 20px;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Registo de Auditoria</h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Histórico de acções realizadas no sistema</p>
        </div>
        <span style="background:#f1f5f9;color:#475569;padding:6px 14px;border-radius:20px;font-size:0.82rem;font-weight:600;">
            {{ number_format($logs->total()) }} registos
        </span>
    </div>

    {{-- Filtros --}}
    <form method="GET" style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:18px 20px;margin-bottom:24px;display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
        <div style="flex:1;min-width:160px;">
            <label style="display:block;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:5px;">Acção</label>
            <select name="accao" style="width:100%;padding:8px 10px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;color:#1a2332;">
                <option value="">Todas as acções</option>
                @foreach($accoes as $a)
                    <option value="{{ $a }}" {{ request('accao') === $a ? 'selected' : '' }}>
                        {{ \App\Models\AuditLog::$accaoLabels[$a] ?? $a }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="flex:1;min-width:160px;">
            <label style="display:block;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:5px;">Utilizador</label>
            <input type="text" name="user" value="{{ request('user') }}" placeholder="Nome do utilizador"
                   style="width:100%;padding:8px 10px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;color:#1a2332;box-sizing:border-box;">
        </div>
        <div style="flex:0 0 auto;min-width:120px;">
            <label style="display:block;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:5px;">N.º Ficha</label>
            <input type="number" name="modelo_id" value="{{ request('modelo_id') }}" placeholder="ID"
                   style="width:100%;padding:8px 10px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;color:#1a2332;box-sizing:border-box;">
        </div>
        <div style="display:flex;gap:8px;align-items:center;">
            <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;font-size:0.88rem;cursor:pointer;">
                Filtrar
            </button>
            @if(request()->hasAny(['accao','user','modelo_id']))
            <a href="{{ route('admin.auditoria') }}" style="color:#64748b;font-size:0.85rem;text-decoration:none;font-weight:600;">Limpar</a>
            @endif
        </div>
    </form>

    {{-- Tabela --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.86rem;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;white-space:nowrap;">Data / Hora</th>
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Utilizador</th>
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Papel</th>
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Acção</th>
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Descrição</th>
                        <th style="padding:12px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;white-space:nowrap;">IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    @php
                        $accaoColors = [
                            'criou_candidatura'     => ['bg'=>'#e8f5e9','color'=>'#2e7d32'],
                            'editou_candidatura'     => ['bg'=>'#e3f2fd','color'=>'#1565c0'],
                            'alterou_status'        => ['bg'=>'#fff8e1','color'=>'#f57f17'],
                            'eliminou_candidatura'  => ['bg'=>'#fce4ec','color'=>'#c62828'],
                            'assinou_candidatura'   => ['bg'=>'#e8eaf6','color'=>'#283593'],
                            'rejeitou_candidatura'  => ['bg'=>'#fce4ec','color'=>'#b71c1c'],
                            'imprimiu_comprovativo' => ['bg'=>'#e0f2f1','color'=>'#00695c'],
                            'distribuiu_salas'      => ['bg'=>'#fce4ec','color'=>'#880e4f'],
                            'limpou_salas'          => ['bg'=>'#fff3e0','color'=>'#bf360c'],
                            'criou_usuario'         => ['bg'=>'#e1f5fe','color'=>'#01579b'],
                            'eliminou_usuario'      => ['bg'=>'#fce4ec','color'=>'#c62828'],
                            'resetou_password'      => ['bg'=>'#f3e5f5','color'=>'#6a1b9a'],
                        ];
                        $ac = $accaoColors[$log->accao] ?? ['bg'=>'#f1f5f9','color'=>'#475569'];
                    @endphp
                    <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
                        <td style="padding:11px 16px;white-space:nowrap;color:#475569;font-size:0.82rem;">
                            {{ $log->created_at->format('d/m/Y') }}<br>
                            <span style="color:#94a3b8;font-size:0.78rem;">{{ $log->created_at->format('H:i:s') }}</span>
                        </td>
                        <td style="padding:11px 16px;font-weight:600;color:#1a2332;">{{ $log->user_nome ?? '—' }}</td>
                        <td style="padding:11px 16px;">
                            @if($log->user_role)
                            <span style="background:#f1f5f9;color:#475569;padding:2px 8px;border-radius:10px;font-size:0.78rem;font-weight:600;text-transform:uppercase;">{{ $log->user_role }}</span>
                            @else —
                            @endif
                        </td>
                        <td style="padding:11px 16px;">
                            <span style="background:{{ $ac['bg'] }};color:{{ $ac['color'] }};padding:3px 10px;border-radius:10px;font-size:0.78rem;font-weight:700;white-space:nowrap;">
                                {{ \App\Models\AuditLog::$accaoLabels[$log->accao] ?? $log->accao }}
                            </span>
                        </td>
                        <td style="padding:11px 16px;color:#475569;font-size:0.84rem;max-width:340px;">{{ $log->descricao ?? '—' }}</td>
                        <td style="padding:11px 16px;color:#94a3b8;font-size:0.78rem;font-family:monospace;white-space:nowrap;">{{ $log->ip ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:40px;text-align:center;color:#94a3b8;font-size:0.9rem;">
                            Nenhum registo encontrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginação --}}
    @if($logs->hasPages())
    <div style="margin-top:20px;">
        {{ $logs->links() }}
    </div>
    @endif

</div>
@endsection
