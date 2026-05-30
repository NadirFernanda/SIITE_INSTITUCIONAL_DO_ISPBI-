<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: "Times New Roman", Times, serif; font-size: 12pt; color: #000; background: #fff; }

    .page { width: 100%; padding: 18mm 18mm 10mm 18mm; }

    /* Linha pontilhada de corte */
    .corte { border-top: 2px dashed #000; margin-bottom: 10mm; padding-top: 4mm; }

    /* Cabeçalho */
    .header { text-align: center; margin-bottom: 6mm; }
    .header img { height: 22mm; }
    .header .inst { font-size: 15pt; font-weight: bold; color: #1a4e8a; letter-spacing: 1px; margin-top: 3mm; }
    .header .dept { font-size: 11pt; font-weight: bold; margin-top: 3mm; }
    .header .exam { font-size: 11pt; font-weight: bold; margin-top: 1mm; }
    .header .ficha-title { font-size: 11pt; font-weight: bold; margin-top: 1mm; }

    /* Número da ficha */
    .ficha-num { text-align: right; font-size: 13pt; font-weight: bold; margin-bottom: 4mm; }

    /* Linha dupla separadora */
    .linha-dupla { border-top: 3px double #000; border-bottom: 1px solid #000; height: 4px; margin: 3mm 0 5mm 0; }

    /* Campos */
    .campo { margin-bottom: 5mm; }
    .campo-label { font-weight: bold; font-size: 11pt; display: inline; }
    .campo-linha { display: inline-block; border-bottom: 1px solid #000; min-width: 160mm; vertical-align: bottom; margin-left: 2mm; }
    .campo-valor { font-size: 11pt; display: inline; }

    /* Sexo e Período — checkboxes */
    .check-row { display: flex; align-items: center; margin-bottom: 5mm; gap: 6mm; flex-wrap: wrap; }
    .check-item { display: flex; align-items: center; gap: 2mm; font-size: 11pt; }
    .check-box { width: 5mm; height: 5mm; border: 1px solid #000; display: inline-block; background: #fff; text-align: center; line-height: 5mm; font-size: 10pt; }
    .check-box.checked { background: #000; color: #fff; }

    /* Linha de curso + período */
    .curso-row { display: flex; align-items: flex-end; margin-bottom: 5mm; gap: 4mm; }
    .curso-row .curso-label { font-weight: bold; font-size: 11pt; white-space: nowrap; }
    .curso-row .curso-linha { flex: 1; border-bottom: 1px solid #000; min-height: 5mm; }
    .curso-row .periodo-label { font-weight: bold; font-size: 11pt; white-space: nowrap; }

    /* Data */
    .data-row { margin: 6mm 0 10mm 0; font-size: 11pt; }

    /* Assinaturas */
    .assinaturas { display: flex; justify-content: space-between; margin-top: 8mm; }
    .assinatura { text-align: center; width: 44%; }
    .assinatura .linha-ass { border-bottom: 1px solid #000; width: 100%; margin-bottom: 2mm; height: 8mm; }
    .assinatura .ass-label { font-size: 10pt; font-weight: bold; }

    /* Talão de canto */
    .talao-canto { text-align: right; font-size: 10pt; font-weight: bold; margin-bottom: 2mm; }
</style>
</head>
<body>
<div class="page">

    {{-- ═══ SECÇÃO SUPERIOR (cópia arquivo) ═══ --}}
    <div class="corte">
        <div class="header">
            <img src="{{ public_path('images/logo-ispbie.png') }}" alt="ISP-Bié">
            <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="linha-dupla"></div>
            <div class="dept">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
            <div class="exam">EXAME DE ACESSO 2025/2026</div>
            <div class="ficha-title">FICHA DE INSCRIÇÃO</div>
        </div>

        <div class="talao-canto">Ficha n.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>

        {{-- Nome --}}
        <div class="campo">
            <span class="campo-label">Nome:</span>
            <span class="campo-linha">&nbsp;{{ $candidatura->nome }}</span>
        </div>

        {{-- Filiação --}}
        <div class="campo">
            <span class="campo-label">Filiação:</span>
            <span class="campo-linha" style="min-width:60mm;">&nbsp;{{ $candidatura->filiacao_pai }}</span>
            <span class="campo-label" style="margin-left:4mm;">e de</span>
            <span class="campo-linha" style="min-width:60mm;">&nbsp;{{ $candidatura->filiacao_mae }}</span>
        </div>

        {{-- Data de Nascimento --}}
        <div class="campo">
            <span class="campo-label">Data de Nascimento:</span>
            <span class="campo-linha" style="min-width:60mm;">&nbsp;{{ $candidatura->data_nascimento?->format('d/m/Y') }}</span>
        </div>

        {{-- Naturalidade --}}
        <div class="campo">
            <span class="campo-label">Naturalidade: Município de</span>
            <span class="campo-linha" style="min-width:50mm;">&nbsp;{{ $candidatura->naturalidade_municipio }}</span>
            <span class="campo-label" style="margin-left:4mm;">Província de</span>
            <span class="campo-linha" style="min-width:40mm;">&nbsp;{{ $candidatura->naturalidade_provincia }}</span>
        </div>

        {{-- BI --}}
        <div class="campo">
            <span class="campo-label">Bilhete de Identidade/Passaporte N.º</span>
            <span class="campo-linha" style="min-width:35mm;">&nbsp;{{ $candidatura->bi }}</span>
            <span class="campo-label" style="margin-left:4mm;">Emitido em</span>
            <span class="campo-linha" style="min-width:30mm;">&nbsp;{{ $candidatura->bi_emitido_em }}</span>
            <span class="campo-label" style="margin-left:4mm;">aos</span>
            <span class="campo-linha" style="min-width:22mm;">&nbsp;{{ $candidatura->bi_data_emissao?->format('d/m/Y') }}</span>
        </div>

        {{-- Sexo + Estado Civil --}}
        <div class="check-row">
            <span class="campo-label">Sexo:</span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->sexo === 'masculino' ? 'checked' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino
            </span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->sexo === 'feminino' ? 'checked' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino
            </span>
            <span class="campo-label" style="margin-left:8mm;">Estado Civil:</span>
            <span class="campo-linha" style="min-width:50mm;">&nbsp;{{ $candidatura->estado_civil }}</span>
        </div>

        {{-- Necessidade Especial --}}
        <div class="campo">
            <span class="campo-label">Necessidade de Educação Especial:</span>
            <span class="campo-linha" style="min-width:80mm;">&nbsp;{{ $candidatura->necessidade_especial }}</span>
        </div>

        {{-- Residência --}}
        <div class="campo">
            <span class="campo-label">Residência (Município):</span>
            <span class="campo-linha" style="min-width:45mm;">&nbsp;{{ $candidatura->residencia_municipio }}</span>
            <span class="campo-label" style="margin-left:4mm;">Rua/Bairro:</span>
            <span class="campo-linha" style="min-width:50mm;">&nbsp;{{ $candidatura->residencia_bairro }}</span>
        </div>

        {{-- Telefone + Email --}}
        <div class="campo">
            <span class="campo-label">Telefone:</span>
            <span class="campo-linha" style="min-width:35mm;">&nbsp;{{ $candidatura->telefone }}</span>
            @if($candidatura->telefone2)
            <span class="campo-linha" style="min-width:30mm;">&nbsp;{{ $candidatura->telefone2 }}</span>
            @endif
            <span class="campo-label" style="margin-left:4mm;">e-mail</span>
            <span class="campo-linha" style="min-width:55mm;">&nbsp;{{ $candidatura->email }}</span>
        </div>

        {{-- Habilitações + Escola --}}
        <div class="campo">
            <span class="campo-label">Habilitações Literárias:</span>
            <span class="campo-linha" style="min-width:25mm;">&nbsp;{{ $candidatura->habilitacoes }}</span>
            <span class="campo-label" style="margin-left:4mm;">Escola e Curso de Proveniência:</span>
            <span class="campo-linha" style="min-width:55mm;">&nbsp;{{ $candidatura->escola_origem }}</span>
        </div>

        {{-- Estado Financeiro --}}
        @php $ef = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo']; @endphp
        <div class="check-row">
            <span class="campo-label">Estado Financeiro da Família:</span>
            @foreach($ef as $val => $label)
            <span class="check-item">
                <span class="check-box {{ $candidatura->estado_financeiro === $val ? 'checked' : '' }}">{{ $candidatura->estado_financeiro === $val ? '✓' : '' }}</span> {{ $label }}
            </span>
            @endforeach
        </div>

        {{-- Trabalhador --}}
        <div class="check-row">
            <span class="campo-label">Trabalhador:</span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->trabalhador ? 'checked' : '' }}">{{ $candidatura->trabalhador ? '✓' : '' }}</span> Sim
            </span>
            <span class="check-item">
                <span class="check-box {{ !$candidatura->trabalhador ? 'checked' : '' }}">{{ !$candidatura->trabalhador ? '✓' : '' }}</span> Não
            </span>
            <span class="campo-label" style="margin-left:6mm;">Nome da Instituição Laboral:</span>
            <span class="campo-linha" style="min-width:55mm;">&nbsp;{{ $candidatura->instituicao_laboral ?? '' }}</span>
        </div>

        {{-- Curso + Período --}}
        <div class="curso-row">
            <span class="curso-label">Curso a se inscrever</span>
            <span class="curso-linha">&nbsp;{{ $candidatura->curso }}</span>
            <span class="periodo-label">Período:</span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->periodo === 'regular' ? 'checked' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span> Regular
            </span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->periodo === 'pos-laboral' ? 'checked' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span> Pós-laboral
            </span>
        </div>

        <div class="data-row">
            Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
            de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
            de {{ $candidatura->created_at->format('Y') }}.
        </div>

        <div class="assinaturas">
            <div class="assinatura">
                <div class="linha-ass"></div>
                <div class="ass-label">Conferiu</div>
            </div>
            <div class="assinatura">
                <div class="linha-ass"></div>
                <div class="ass-label">Candidato (a)</div>
            </div>
        </div>
    </div>

    {{-- ═══ TALÃO INFERIOR (cópia candidato) ═══ --}}
    <div style="border-top: 2px dashed #000; padding-top: 6mm;">

        <div class="header" style="margin-bottom:4mm;">
            <img src="{{ public_path('images/logo-ispbie.png') }}" alt="ISP-Bié">
            <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="linha-dupla"></div>
            <div class="dept">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
            <div class="exam">EXAME DE ACESSO 2025/2026</div>
            <div class="ficha-title">FICHA DE INSCRIÇÃO</div>
        </div>

        <div class="talao-canto">Ficha n.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>

        <div class="campo">
            <span class="campo-label">Nome:</span>
            <span class="campo-linha">&nbsp;{{ $candidatura->nome }}</span>
        </div>

        <div class="check-row" style="margin-bottom:4mm;">
            <span class="campo-label">Sexo:</span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->sexo === 'masculino' ? 'checked' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino
            </span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->sexo === 'feminino' ? 'checked' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino
            </span>
        </div>

        <div class="curso-row">
            <span class="curso-label">Curso a se inscrever</span>
            <span class="curso-linha">&nbsp;{{ $candidatura->curso }}</span>
            <span class="periodo-label">Período:</span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->periodo === 'regular' ? 'checked' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span> Regular
            </span>
            <span class="check-item">
                <span class="check-box {{ $candidatura->periodo === 'pos-laboral' ? 'checked' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span> Pós-laboral
            </span>
        </div>

        <div class="data-row">
            Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
            de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
            de {{ $candidatura->created_at->format('Y') }}.
        </div>

        <div class="assinaturas">
            <div class="assinatura">
                <div class="linha-ass"></div>
                <div class="ass-label">Conferiu</div>
            </div>
            <div class="assinatura">
                <div class="linha-ass"></div>
                <div class="ass-label">Candidato (a)</div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
