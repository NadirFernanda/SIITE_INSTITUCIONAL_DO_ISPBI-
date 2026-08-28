@extends('layouts.admin')

@section('content')
@php
    $admitidos = $candidatos->where('resultado_admissao', 'admitido')->count();
    $naoAdmitidos = $candidatos->where('resultado_admissao', 'nao_admitido')->count();
    $pendentes = $candidatos->whereNull('resultado_admissao')->count();
@endphp
<div style="max-width:1100px;margin:0 auto;">
    <a href="{{ route('admin.resultados.index') }}" style="color:#1565c0;text-decoration:none;font-weight:600;">&larr; Voltar</a>

    <h1 style="font-size:1.6rem;font-weight:700;color:#1e3a5f;margin:10px 0 4px;">{{ $curso }}</h1>
    <p style="color:#64748b;margin-bottom:20px;">{{ $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }} &middot; {{ $vagas }} vaga(s)</p>

    @if(session('success'))
    <div style="background:#dcfce7;color:#15803d;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-weight:600;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.resultados.calcular') }}" style="margin-bottom:24px;" onsubmit="return confirm('Recalcular os resultados deste curso/período? Isto substitui o resultado actual de todos os candidatos.');">
        @csrf
        <input type="hidden" name="curso" value="{{ $curso }}">
        <input type="hidden" name="periodo" value="{{ $periodo }}">
        <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:700;cursor:pointer;">Calcular / Recalcular resultados</button>
    </form>

    <div style="display:flex;gap:14px;margin-bottom:24px;flex-wrap:wrap;">
        <div style="background:#fff;border-radius:10px;padding:14px 18px;box-shadow:0 1px 4px rgba(0,0,0,0.06);min-width:140px;">
            <div style="font-size:1.6rem;font-weight:700;color:#15803d;">{{ $admitidos }}</div>
            <div style="color:#64748b;font-size:0.85rem;">Admitidos</div>
        </div>
        <div style="background:#fff;border-radius:10px;padding:14px 18px;box-shadow:0 1px 4px rgba(0,0,0,0.06);min-width:140px;">
            <div style="font-size:1.6rem;font-weight:700;color:#dc2626;">{{ $naoAdmitidos }}</div>
            <div style="color:#64748b;font-size:0.85rem;">Não admitidos</div>
        </div>
        <div style="background:#fff;border-radius:10px;padding:14px 18px;box-shadow:0 1px 4px rgba(0,0,0,0.06);min-width:140px;">
            <div style="font-size:1.6rem;font-weight:700;color:#b45309;">{{ $pendentes }}</div>
            <div style="color:#64748b;font-size:0.85rem;">Sem nota lançada</div>
        </div>
    </div>

    <div style="overflow-x:auto;margin-bottom:24px;">
    <table style="width:100%;border-collapse:collapse;background:#fff;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="text-align:left;padding:8px 14px;">Grupo</th>
                <th style="text-align:center;padding:8px 14px;">Candidatos</th>
                <th style="text-align:center;padding:8px 14px;">Admitidos</th>
                <th style="text-align:center;padding:8px 14px;">Nota de corte</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resumoGrupos as $grupo => $info)
            <tr style="border-top:1px solid #e2e8f0;">
                <td style="padding:8px 14px;">{{ $grupo }}</td>
                <td style="text-align:center;padding:8px 14px;">{{ $info['total'] }}</td>
                <td style="text-align:center;padding:8px 14px;">{{ $info['admitidos'] }}</td>
                <td style="text-align:center;padding:8px 14px;">{{ $info['nota_corte'] !== null ? number_format($info['nota_corte'], 1) : '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div style="overflow-x:auto;background:#fff;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="text-align:center;padding:10px 14px;">N.º Ficha</th>
                <th style="text-align:left;padding:10px 14px;">Nome</th>
                <th style="text-align:left;padding:10px 14px;">Categoria</th>
                <th style="text-align:center;padding:10px 14px;">Nota</th>
                <th style="text-align:center;padding:10px 14px;">Resultado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidatos as $c)
            <tr style="border-top:1px solid #e2e8f0;">
                <td style="text-align:center;padding:9px 14px;font-weight:700;color:#1a4e8a;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="padding:9px 14px;">{{ $c->nome }}</td>
                <td style="padding:9px 14px;">{{ ($c->necessidade_especial && $c->necessidade_especial !== 'Nenhuma') ? $c->necessidade_especial : 'Geral' }}</td>
                <td style="text-align:center;padding:9px 14px;">{{ $c->nota_exame !== null ? number_format($c->nota_exame, 1) : '—' }}</td>
                <td style="text-align:center;padding:9px 14px;">
                    @if($c->resultado_admissao === 'admitido')
                        <span style="background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:999px;font-size:0.82rem;font-weight:600;white-space:nowrap;">Admitido</span>
                    @elseif($c->resultado_admissao === 'nao_admitido')
                        <span style="background:#fee2e2;color:#dc2626;padding:3px 10px;border-radius:999px;font-size:0.82rem;font-weight:600;white-space:nowrap;">Não admitido</span>
                    @else
                        <span style="background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:999px;font-size:0.82rem;font-weight:600;white-space:nowrap;">Pendente</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
