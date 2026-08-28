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
    {{-- Paginação manual — ver pdf/_sala-exame-conteudo.blade.php. --}}
    @page { size: A4 portrait; margin: 0; }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:"Times New Roman", Times, serif; font-size:11pt; color:#000; }

    {{-- Espaço reservado em baixo para o rodapé fixo (assinatura), que se
         repete em todas as páginas — não só na última. --}}
    .pagina { padding:15mm 18mm 40mm 18mm; }
    .pagina.seguinte { page-break-before: always; }

    .header { text-align:center; margin-bottom:8mm; }
    .header img { height:18mm; }
    .header .inst { font-family:"Helvetica Neue", Helvetica, Arial, sans-serif; font-size:15pt; font-weight:bold; color:#1565C0; margin-top:3mm; letter-spacing:0.3px; }
    .header .sub { font-family:"Helvetica Neue", Helvetica, Arial, sans-serif; font-size:10pt; font-weight:bold; color:#333; margin-top:3mm; }
    .linha-dupla { display:none; }

    .sala-titulo { font-size:16pt; font-weight:bold; text-align:center; margin:4mm 0 1mm; }
    .sala-info { text-align:center; font-size:10pt; color:#333; margin-bottom:6mm; }

    .grupo-header { background:#1a4e8a; color:#fff; font-weight:bold; font-size:10pt; padding:4px 10px; margin-top:5mm; }

    table { width:100%; border-collapse:collapse; margin-top:1mm; }
    thead tr { background:#f0f0f0; }
    th { padding:5px 10px; text-align:left; font-size:9pt; font-weight:bold; border:1px solid #ccc; text-transform:uppercase; letter-spacing:0.04em; }
    td { padding:8px 10px; font-size:9.5pt; border:1px solid #ddd; }
    td.nome-col { text-transform:uppercase; }
    tr:nth-child(even) { background:#f9f9f9; }

    .rodape-fixo { position:fixed; bottom:8mm; left:18mm; right:18mm; text-align:center; }
    .rodape-fixo .assinatura-img { display:block; margin:0 auto; max-height:12mm; max-width:60mm; filter:grayscale(100%); }
    .rodape-fixo .linha { border-bottom:1px solid #000; width:65mm; margin:1mm auto 1.5mm; }
    .rodape-fixo .label { font-size:9pt; font-weight:bold; }
    .rodape-fixo .sublabel { font-size:8.5pt; color:#333; margin-top:0.5mm; }
    .rodape-fixo .texto-gerado { font-size:7.5pt; color:#666; margin-top:2mm; border-top:1px solid #ddd; padding-top:2mm; }
</style>
</head>
<body>

<div class="rodape-fixo">
    <img class="assinatura-img" src="{{ \App\Services\SignatureImageGenerator::generate('Fernando Maia') }}" alt="Assinatura">
    <div class="linha"></div>
    <div class="label">Professor Doutor Fernando Maia</div>
    <div class="sublabel">Presidente da Comissão do Exame de Acesso</div>
    <div class="texto-gerado">Documento gerado em {{ now()->format('d/m/Y H:i') }} — ISP-Bié — Uso interno</div>
</div>

@include('pdf._sala-exame-conteudo', ['sala' => $sala, 'candidaturas' => $candidaturas, 'logoBase64' => $logoBase64, 'primeiroDoDocumento' => true, 'necessidadeEspecial' => $necessidadeEspecial ?? null])

</body>
</html>
