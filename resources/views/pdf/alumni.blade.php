@php
    $logoPath = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
    $estadoLabel = match ($filters['estado'] ?? 'todos') {
        'trabalha' => 'Trabalha',
        'nao_trabalha' => 'Não trabalha',
        default => 'Todas as situações',
    };
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <style>
        @page { size: A4 landscape; margin: 12mm 12mm 14mm; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #1a2332; font-size: 8.5pt; }
        .header { text-align: center; border-bottom: 2px solid #1e3a5f; padding-bottom: 6mm; margin-bottom: 5mm; }
        .header img { height: 17mm; margin-bottom: 2mm; }
        .institution { color: #1565C0; font-size: 14pt; font-weight: bold; letter-spacing: .2px; }
        .department { color: #1e3a5f; font-size: 9pt; font-weight: bold; margin-top: 2mm; }
        .title { text-align: center; color: #1e3a5f; font-size: 15pt; font-weight: bold; margin: 3mm 0 1mm; }
        .subtitle { text-align: center; color: #64748b; font-size: 8.5pt; margin-bottom: 5mm; }
        .summary { width: 100%; border-collapse: separate; border-spacing: 3mm 0; margin-bottom: 5mm; }
        .summary td { width: 25%; background: #eaeff5; border-top: 3px solid #2563eb; padding: 3mm; text-align: center; }
        .summary strong { display: block; color: #1e3a5f; font-size: 13pt; }
        .summary span { color: #475569; font-size: 7.5pt; text-transform: uppercase; }
        .filters { color: #475569; border-left: 3px solid #F05A28; padding: 2mm 3mm; margin-bottom: 4mm; }
        .filters strong { color: #1e3a5f; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data thead { display: table-header-group; }
        table.data tr { page-break-inside: avoid; }
        table.data th { background: #1e3a5f; color: #fff; padding: 2.5mm 2mm; text-align: left; font-size: 7.5pt; text-transform: uppercase; }
        table.data td { border: 1px solid #d8e0ea; padding: 2.2mm 2mm; vertical-align: top; }
        table.data tr:nth-child(even) td { background: #f8fafc; }
        .name { font-weight: bold; color: #1e3a5f; }
        .status-yes { color: #2563eb; font-weight: bold; }
        .status-no { color: #F05A28; font-weight: bold; }
        .footer { position: fixed; bottom: -8mm; left: 0; right: 0; text-align: center; color: #64748b; font-size: 7pt; }
    </style>
</head>
<body>
    <div class="header">
        @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
        <div class="institution">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="department">ÁREA DE GESTÃO DE ALUMNI — PAINEL ALUMNI DO SITE INSTITUCIONAL</div>
    </div>

    <div class="title">LISTA DE ALUMNI</div>
    <div class="subtitle">Relatório institucional de alumni registados — gerado em {{ now()->format('d/m/Y H:i') }}</div>

    <table class="summary">
        <tr>
            <td><strong>{{ $alumni->count() }}</strong><span>Alumni encontrados</span></td>
            <td><strong>{{ $alumni->where('trabalha', true)->count() }}</strong><span>Trabalham</span></td>
            <td><strong>{{ $alumni->where('trabalha', false)->count() }}</strong><span>Não trabalham</span></td>
            <td><strong>{{ $alumni->where('publicado', true)->count() }}</strong><span>Publicados</span></td>
        </tr>
    </table>

    <div class="filters">
        <strong>Filtros aplicados:</strong>
        Situação: {{ $estadoLabel }} |
        Curso: {{ $filters['curso'] ?? 'Todos' }} |
        Ano: {{ $filters['ano'] ?? 'Todos' }} |
        País: {{ $filters['pais'] ?? 'Todos' }}
        @if(!empty($filters['pesquisa'])) | Pesquisa: {{ $filters['pesquisa'] }} @endif
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width:18%;">Nome</th>
                <th style="width:15%;">Email</th>
                <th style="width:14%;">Curso</th>
                <th style="width:7%;">Ano</th>
                <th style="width:10%;">Situação</th>
                <th style="width:12%;">Empresa / Cargo</th>
                <th style="width:8%;">País</th>
                <th style="width:9%;">Contacto</th>
                <th style="width:7%;">Estados</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumni as $alumnus)
                @php
                    $email = $alumnus->user?->email ?: $alumnus->email;
                    $empresa = trim((string) $alumnus->empresa);
                    $cargo = trim((string) $alumnus->cargo);
                    $pais = trim((string) $alumnus->pais);
                    $contacto = trim((string) $alumnus->contacto);
                @endphp
                <tr>
                    <td class="name">{{ $alumnus->nome }}</td>
                    <td>{{ $email ?: 'Não informado' }}</td>
                    <td>{{ $alumnus->curso }}</td>
                    <td>{{ $alumnus->ano }}</td>
                    <td class="{{ $alumnus->trabalha ? 'status-yes' : 'status-no' }}">{{ $alumnus->trabalha ? 'Trabalha' : 'Não trabalha' }}</td>
                    <td>{{ $empresa ?: 'Não informado' }}@if($cargo)<br><small>{{ $cargo }}</small>@endif</td>
                    <td>{{ $pais ?: 'Não informado' }}</td>
                    <td>{{ $contacto ?: 'Não informado' }}</td>
                    <td>
                        {{ $alumnus->publicado ? 'Publicado' : 'Rascunho' }}<br>
                        {{ $alumnus->user?->aprovado ? 'Portal aprovado' : ($alumnus->user ? 'Aguarda portal' : 'Sem portal') }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center;padding:8mm;color:#64748b;">Nenhum alumni encontrado com os filtros selecionados.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">ISP-Bié — Documento institucional de uso interno — Gerado pelo Painel Alumni do Site Institucional do ISP-Bié</div>
</body>
</html>
