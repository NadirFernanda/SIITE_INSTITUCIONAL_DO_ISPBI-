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

    @if($salas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;color:#94a3b8;">
            Nenhuma sala registada.
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
                        <a href="{{ route('daac.salas.show', $sala) }}" style="color:#2563eb;text-decoration:none;">
                            {{ $sala->nome }}
                        </a>
                    </td>
                    <td style="padding:14px 20px;text-align:center;color:#475569;">{{ $sala->capacidade }}</td>
                    <td style="padding:14px 20px;text-align:center;font-weight:700;color:{{ $sala->candidaturas_count > 0 ? '#2563eb' : '#94a3b8' }};">
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
                        <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
                            <a href="{{ route('tecnico.salas.pdf', $sala) }}" title="Lista geral PDF"
                               style="background:#475569;color:#fff;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">PDF</a>
                            <a href="{{ route('tecnico.salas.excel-exame', $sala) }}" title="Lista de exame Excel"
                               style="background:#1565c0;color:#fff;padding:5px 12px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">Exame</a>
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
