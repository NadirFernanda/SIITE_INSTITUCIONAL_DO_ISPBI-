{{--
    Wrapper único para a impressão em lote (todas as salas de um horário
    num só PDF) — concatenar vários documentos <html>/<body> completos
    (um por sala) é HTML inválido e fazia o dompdf inserir páginas em
    branco a mais entre salas. Aqui só há UM <html>/<body>; cada sala
    contribui apenas o seu conteúdo (pdf/_sala-conteudo.blade.php), já
    com a paginação manual própria.
--}}
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    @page { size: A4 portrait; margin: 0; }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:"Times New Roman", Times, serif; font-size:11pt; color:#000; }

    .pagina { padding:15mm 18mm; }
    .pagina.seguinte { page-break-before: always; }

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
    th { padding:5px 10px; text-align:left; font-size:9pt; font-weight:bold; border:1px solid #ccc; text-transform:uppercase; letter-spacing:0.04em; }
    td { padding:{{ $paddingCelula }}; font-size:9.5pt; border:1px solid #ddd; }
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
{!! $conteudo !!}
</body>
</html>
