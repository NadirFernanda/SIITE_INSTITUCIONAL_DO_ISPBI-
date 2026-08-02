@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
    $periodoLabel = $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';
    $efMap = ['maximo' => 'Máximo', 'medio' => 'Médio', 'minimo' => 'Mínimo'];
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { size: A4 portrait; margin: 0; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: DejaVu Sans, Arial, sans-serif; font-size:9.5pt; color:#000; background:#fff }

/* ── CABEÇALHO (PRINT-FRIENDLY) ── */
.header {
    background: #fff;
    color: #000;
    padding: 8mm 12mm;
    display: table;
    width: 100%;
    border-bottom: 1px solid #e6e6e6;
}
.h-logo  { display:table-cell; width:22mm; vertical-align:middle; }
.h-logo img { width:18mm; height:auto; filter:grayscale(100%); opacity:0.95 }
.h-center { display:table-cell; vertical-align:middle; padding-left:5mm; }
.h-inst  { font-size:13pt; font-weight:bold; letter-spacing:0.4px; color:#000 }
.h-sub   { font-size:8.5pt; color:#555; margin-top:1.5mm; }
.h-right { display:table-cell; width:30mm; text-align:right; vertical-align:middle; }
.h-ficha-label { font-size:7.5pt; text-transform:uppercase; letter-spacing:0.08em; color:#666; }
.h-ficha-num   { font-size:22pt; font-weight:bold; line-height:1.1; color:#000 }

/* ── BANNER ── */
.banner {
    background: #fff;
    color: #000;
    text-align: center;
    padding: 4mm 0;
    font-size: 11pt;
    font-weight: bold;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    border-bottom: 1px solid #e6e6e6;
}

/* ── CONTEÚDO ── */
.content { padding: 7mm 12mm; }

/* Secção */
.sec-title {
    font-size: 7.5pt;
    font-weight: bold;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-bottom: 0.8pt solid #e6e6e6;
    padding-bottom: 1.5mm;
    margin-bottom: 4mm;
    margin-top: 5mm;
}

/* Grid de campos */
.fields { display: table; width: 100%; margin-bottom: 1mm; }
.frow   { display: table-row; }
.fcell  { display: table-cell; vertical-align: top; padding: 0 3mm 4mm 0; }
.flabel { font-size: 7pt; font-weight: bold; color: #444; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.5mm; }
.fval   { font-size: 10pt; font-weight: bold; color: #000; border-bottom: 0.5pt solid #ddd; padding-bottom: 1.5mm; min-height: 5mm; }

/* badge */
.badge { display:inline-block; background:transparent; color:#444; border:0.6pt solid #ddd; border-radius:2px; font-size:8pt; font-weight:bold; padding:1px 6px; }

/* ── ASSINATURAS ── */
.sigs { display:table; width:100%; margin-top:8mm; }
.sig  { display:table-cell; width:42%; text-align:center; vertical-align:top; }
.sig img { background:transparent; display:block; mix-blend-mode:multiply; }
.sig-gap { display:table-cell; width:16%; }
.sig-line  { border-bottom:0.8pt solid #333; height:9mm; margin-bottom:2mm; }
.sig-label { font-size:9.5pt; font-weight:bold; color:#000 }

/* rodapé */
.footer { text-align:center; font-size:7pt; color:#777; margin-top:5mm; border-top:0.5pt solid #e6e6e6; padding-top:2.5mm; }
</style>
</head>
<body>

{{-- CABEÇALHO AZUL --}}
<div class="header">
    <div class="h-logo">
        @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
    </div>
    <div class="h-center">
        <div class="h-inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="h-sub">Departamento dos Assuntos Académicos &nbsp;·&nbsp; Exame de Acesso 2026/2027</div>
    </div>
    <div class="h-right">
        <div class="h-ficha-label">Ficha N.º</div>
        <div class="h-ficha-num">{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>
    </div>
</div>

{{-- BANNER --}}
<div class="banner">Comprovativo de Candidatura</div>

<div class="content">

    {{-- DADOS PESSOAIS --}}
    <div class="sec-title">Dados Pessoais</div>
    <div class="fields">
        <div class="frow">
            <div class="fcell" style="width:55%">
                <div class="flabel">Nome Completo</div>
                <div class="fval">{{ mb_strtoupper($candidatura->nome, 'UTF-8') }}</div>
            </div>
            <div class="fcell" style="width:25%">
                <div class="flabel">Bilhete de Identidade</div>
                <div class="fval">{{ $candidatura->bi }}</div>
            </div>
            <div class="fcell" style="width:20%">
                <div class="flabel">Data de Nascimento</div>
                <div class="fval">{{ $candidatura->data_nascimento?->format('d/m/Y') ?? '—' }}</div>
            </div>
        </div>
        <div class="frow">
            <div class="fcell" style="width:20%">
                <div class="flabel">Sexo</div>
                <div class="fval">{{ $candidatura->sexo ? ucfirst($candidatura->sexo) : '—' }}</div>
            </div>
            <div class="fcell" style="width:25%">
                <div class="flabel">Estado Civil</div>
                <div class="fval">{{ $candidatura->estado_civil ?? '—' }}</div>
            </div>
            <div class="fcell" style="width:25%">
                <div class="flabel">Telefone</div>
                <div class="fval">{{ $candidatura->telefone }}</div>
            </div>
            <div class="fcell" style="width:30%">
                <div class="flabel">E-mail</div>
                <div class="fval">{{ $candidatura->email }}</div>
            </div>
        </div>
    </div>

    {{-- CURSO INSCRITO --}}
    <div class="sec-title">Inscrição</div>
    <div style="background:#fff;border-left:3px solid #e6e6e6;padding:4mm 6mm;border-radius:0;display:table;width:100%;margin-bottom:3mm;">
        <div style="display:table-cell;width:70%;vertical-align:middle;">
            <div class="flabel">Curso Inscrito</div>
            <div style="font-size:11pt;font-weight:bold;color:#000;margin-top:1mm;">{{ $candidatura->curso }}</div>
            @if($candidatura->perfil)
            <div style="margin-top:2mm;"><span class="flabel">Perfil de Acesso:</span> <span style="font-size:9pt;font-weight:bold;color:#000;">{{ $candidatura->perfil }}</span></div>
            @endif
        </div>
        <div style="display:table-cell;width:30%;vertical-align:middle;text-align:right;">
            <div class="flabel">Período</div>
            <div style="font-size:11pt;font-weight:bold;background:transparent;color:#000;padding:2px 8px;border:1px solid #ddd;border-radius:3px;display:inline-block;margin-top:1mm;">{{ $periodoLabel }}</div>
        </div>
    </div>
    <div style="margin-bottom:2mm;">
        <span class="badge">{{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}</span>
        &nbsp;
        <span style="font-size:8pt;color:#888;">Submetido em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</span>
    </div>

    {{-- DATA --}}
    <div style="font-size:10pt;margin-top:4mm;">
        Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
        de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
        de {{ $candidatura->created_at->format('Y') }}.
    </div>

    {{-- AVISO --}}
    <div style="background:#fff;border:1px solid #eee;padding:4mm 6mm;margin:4mm 0;border-radius:0;">
        <strong style="color:#000;">Importante:</strong> Apresente este comprovativo (impresso ou em formato digital) no dia do exame de acesso.
        Guarde o número da sua ficha: <strong style="color:#000;">{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</strong>.
        Candidatura registada em {{ $candidatura->created_at->format('d/m/Y') }} às {{ $candidatura->created_at->format('H:i') }}.
    </div>

    @php
        $assinante      = $candidatura->isAssinada() ? $candidatura->assinante : null;
        $sigImg         = $assinante?->signature_image ?? null;
        // Assinatura do candidato gerada na hora a partir do nome — não fica guardada
        // em lado nenhum, é recalculada sempre que o comprovativo é gerado.
        $candidatoSigImg = \App\Services\SignatureImageGenerator::generate($candidatura->nome);
    @endphp

    {{-- ASSINATURAS: Conferiu (esq) + Candidato(a) (dir) --}}
    <div class="sigs">
        <div class="sig">
            <div class="sig-line">
                @if($sigImg)
                    <img src="{{ $sigImg }}" style="display:block;margin:0 auto;max-height:9mm;max-width:55mm;object-fit:contain;" alt="Assinatura">
                @endif
            </div>
            <div class="sig-label">{{ $assinante ? $assinante->name : 'Conferiu' }}</div>
            @if($assinante)
            <div style="font-size:7.5pt;color:#555;">DAAC — ISP-Bié</div>
            @else
            <div style="height:12pt;"></div>
            @endif
        </div>
        <div class="sig-gap"></div>
        <div class="sig">
            <div class="sig-line">
                <img src="{{ $candidatoSigImg }}" style="display:block;margin:0 auto;max-height:9mm;max-width:55mm;object-fit:contain;" alt="Assinatura do candidato">
            </div>
            <div class="sig-label">Candidato (a)</div>
        </div>
    </div>

    @if($candidatura->pagamento_confirmado)
    <div style="background:#fff;border:1px solid #eee;border-radius:6px;padding:3mm 6mm;margin-top:4mm;">
        <div style="font-size:7.5pt;font-weight:bold;color:#000;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:1.5mm;">✓ Pagamento Confirmado</div>
        <div style="font-size:8pt;color:#555;">
            {{ $candidatura->confirmadoPor?->name ?? 'Secretaria' }}
            @if($candidatura->pagamento_confirmado_em) &mdash; {{ $candidatura->pagamento_confirmado_em->format('d/m/Y \à\s H:i') }} @endif
        </div>
    </div>
    @endif

    @if($candidatura->isAssinada())
    <div style="background:#fff;border:1px solid #eee;border-radius:6px;padding:3mm 6mm;margin-top:4mm;">
        <div style="display:table;width:100%;">
            <div style="display:table-cell;vertical-align:middle;width:{{ $sigImg ? '55%' : '100%' }};">
                <div style="font-size:7.5pt;font-weight:bold;color:#000;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:1.5mm;">✓ Assinado Digitalmente pelo DAAC</div>
                <div style="font-size:8pt;color:#555;">
                    {{ $assinante?->name ?? 'DAAC' }} &mdash; {{ $candidatura->assinado_em?->format('d/m/Y \à\s H:i') }}
                </div>
                <div style="font-family:monospace;font-size:8.5pt;font-weight:bold;color:#333;margin-top:1mm;letter-spacing:0.08em;">{{ $candidatura->assinatura_codigo }}</div>
            </div>
            @if($sigImg)
            <div style="display:table-cell;vertical-align:middle;text-align:right;width:45%;">
                <img src="{{ $sigImg }}" style="max-height:16mm;max-width:60mm;object-fit:contain;filter:grayscale(100%);" alt="Assinatura digital">
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }} &mdash; ISP-Bié &mdash; Válido para apresentação no dia do exame
    </div>

</div>
</body>
</html>
