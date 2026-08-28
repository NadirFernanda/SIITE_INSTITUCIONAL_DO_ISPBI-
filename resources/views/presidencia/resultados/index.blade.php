@extends('layouts.presidencia')

@section('content')
<div style="max-width:1100px;margin:0 auto;">
    <h1 style="font-size:1.6rem;font-weight:700;color:#1e3a5f;margin-bottom:6px;">Resultados de Admissão</h1>
    <p style="color:#64748b;margin-bottom:24px;">
        Define o número de vagas por curso/período e calcula quem fica admitido com base na nota de exame,
        respeitando a reserva de 3% de vagas para cada categoria especial (que concorrem só entre si).
    </p>

    @if(session('success'))
    <div style="background:#dcfce7;color:#15803d;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-weight:600;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('presidencia.resultados.vagas') }}">
        @csrf
        <div style="overflow-x:auto;background:#fff;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th style="text-align:left;padding:10px 14px;">Curso</th>
                    <th style="text-align:left;padding:10px 14px;">Período</th>
                    <th style="text-align:center;padding:10px 14px;">Vagas</th>
                    <th style="text-align:center;padding:10px 14px;">Candidatos</th>
                    <th style="text-align:center;padding:10px 14px;">Estado</th>
                    <th style="text-align:center;padding:10px 14px;">Admitidos</th>
                    <th style="text-align:center;padding:10px 14px;">Acções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($linhas as $linha)
                <tr style="border-top:1px solid #e2e8f0;">
                    <td style="padding:10px 14px;">{{ $linha['curso'] }}</td>
                    <td style="padding:10px 14px;">{{ $linha['periodo'] === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</td>
                    <td style="padding:10px 14px;text-align:center;">
                        <input type="number" min="0" name="vagas[{{ $linha['curso'] }}|{{ $linha['periodo'] }}]" value="{{ $linha['vagas'] }}" style="width:80px;padding:6px 8px;border:1px solid #cbd5e1;border-radius:6px;text-align:center;">
                    </td>
                    <td style="padding:10px 14px;text-align:center;">{{ $linha['totalCandidatos'] }}</td>
                    <td style="padding:10px 14px;text-align:center;">
                        @if($linha['calculado'])
                            <span style="background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:999px;font-size:0.82rem;font-weight:600;white-space:nowrap;">Calculado</span>
                        @else
                            <span style="background:#fef3c7;color:#b45309;padding:3px 10px;border-radius:999px;font-size:0.82rem;font-weight:600;white-space:nowrap;">Por calcular</span>
                        @endif
                    </td>
                    <td style="padding:10px 14px;text-align:center;">{{ $linha['admitidos'] }}</td>
                    <td style="padding:10px 14px;text-align:center;white-space:nowrap;">
                        <a href="{{ route('presidencia.resultados.show', ['curso' => $linha['curso'], 'periodo' => $linha['periodo']]) }}" style="color:#1565c0;font-weight:600;text-decoration:none;">Ver / Calcular</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <button type="submit" style="margin-top:16px;background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:700;cursor:pointer;">Guardar vagas</button>
    </form>
</div>
@endsection
