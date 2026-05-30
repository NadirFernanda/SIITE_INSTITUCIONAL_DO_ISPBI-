@php
    $logoPath = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:"Times New Roman", Times, serif; font-size:11pt; color:#000; }
    .page { padding:15mm 18mm; }

    .header { text-align:center; margin-bottom:8mm; }
    .header img { height:18mm; }
    .header .inst { font-size:14pt; font-weight:bold; color:#1a4e8a; margin-top:3mm; letter-spacing:0.5px; }
    .header .sub { font-size:10pt; font-weight:bold; margin-top:2mm; }
    .linha-dupla { border-top:3px double #000; border-bottom:1px solid #000; height:4px; margin:3mm 0; }

    .sala-titulo { font-size:16pt; font-weight:bold; text-align:center; margin:4mm 0 1mm; }
    .sala-info { text-align:center; font-size:10pt; color:#333; margin-bottom:6mm; }

    .grupo-header { background:#1a4e8a; color:#fff; font-weight:bold; font-size:10pt; padding:4px 10px; margin-top:5mm; }

    table { width:100%; border-collapse:collapse; margin-top:1mm; }
    thead tr { background:#f0f0f0; }
    th { padding:5px 10px; text-align:left; font-size:9pt; font-weight:bold; border:1px solid #ccc; }
    td { padding:8px 10px; font-size:9.5pt; border:1px solid #ddd; }
    td.nome-col { text-transform:uppercase; }
    tr:nth-child(even) { background:#f9f9f9; }

    .assinatura-unica { text-align:center; margin-top:14mm; }
    .assinatura-unica .linha { border-bottom:1px solid #000; width:70mm; margin:0 auto 2mm; height:8mm; }
    .assinatura-unica .label { font-size:9pt; font-weight:bold; }
    .assinatura-unica .sublabel { font-size:8.5pt; color:#333; margin-top:1mm; }

    .footer { text-align:center; font-size:8pt; color:#666; margin-top:8mm; border-top:1px solid #ddd; padding-top:4mm; }
</style>
</head>
<body>
<div class="page">

    <div class="header">
        @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
        <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="linha-dupla"></div>
        <div class="sub">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS — EXAME DE ACESSO 2025/2026</div>
    </div>

    <div class="sala-titulo">{{ strtoupper($sala->nome) }}</div>
    <div class="sala-info">
        Capacidade: {{ $sala->capacidade }} lugares &nbsp;|&nbsp;
        Candidatos atribuídos: {{ $candidaturas->count() }}
    </div>

    @if($candidaturas->isEmpty())
        <p style="text-align:center;color:#666;margin-top:10mm;">Nenhum candidato atribuído a esta sala.</p>
    @else
        @foreach($candidaturas->groupBy(fn($c) => $c->curso . '|||' . $c->periodo) as $chave => $lista)
        @php [$curso, $periodo] = explode('|||', $chave); @endphp
        <div class="grupo-header">
            {{ $curso }} — {{ $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:26pt;text-align:center;">N.º</th>
                    <th>Nome Completo</th>
                    <th style="width:38%;">Assinatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lista->sortBy('numero_lugar') as $c)
                <tr>
                    <td style="text-align:center;font-weight:bold;color:#1a4e8a;">{{ $c->numero_lugar }}</td>
                    <td class="nome-col">{{ $c->nome }}</td>
                    <td>&nbsp;</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    @endif

    <div class="assinatura-unica">
        <div class="linha"></div>
        <div class="label">Professor Doutor Fernando Maia</div>
        <div class="sublabel">Presidente da Instituição</div>
    </div>

    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} — ISP-Bié — Uso interno
    </div>

</div>
</body>
</html>
