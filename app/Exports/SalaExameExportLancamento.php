<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

/**
 * Exportação de lista de exame para o perfil LANÇAMENTO
 * Mostra APENAS códigos (sem dados dos candidatos)
 */
class SalaExameExportLancamento implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow;

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
    }

    public function title(): string
    {
        // Ver App\Exports\SalaExameExport::title() — nome único e dentro do
        // limite de 31 caracteres, necessário quando várias salas são
        // combinadas num só ficheiro (impressão em lote por horário).
        $nome = preg_replace('/[\\\\\/\?\*\[\]:]/', '', $this->sala->nome);
        $sufixo = ' #' . $this->sala->id;
        $prefixo = 'Exame - ';
        $maxNome = max(1, 31 - mb_strlen($prefixo) - mb_strlen($sufixo));
        return $prefixo . mb_substr($nome, 0, $maxNome) . $sufixo;
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço para logo
        $rows[] = ['', '', ''];

        // Linha 2 — nome da instituição
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];

        // Linha 3 — comissão + título da lista, combinados numa só linha
        $rows[] = ['COMISSÃO DO EXAME DE ACESSO   —   EXAME DE ACESSO 2026/2027 — LISTA DE EXAME', '', ''];

        // Linha 4 — sala, candidatos e data/horário combinados numa só linha.
        // O cabeçalho institucional inteiro fica "congelado" (freeze pane) ao
        // rolar a lista — quanto menos linhas ocupar, mais espaço sobra no
        // ecrã para ver códigos ao rolar.
        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = [
            'Sala: ' . $this->sala->nome
                . '     |     Candidatos atribuídos: ' . $this->candidaturas->count()
                . '     |     Data/Horário: ' . ($dataHorario ?: '___________  |  ___________'),
            '', '',
        ];

        // Tabela — APENAS CÓDIGO (sem dados)
        $this->tableRow = 5;
        $rows[] = ['Código Exame', '', ''];

        foreach ($this->candidaturas as $c) {
            $rows[] = [
                $c->codigo_exame ?? 'NÃO GERADO', '', '',
            ];
        }

        // Assinatura do Presidente
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['_________________________________', '', ''];
        $rows[] = ['Professor Doutor Fernando Maia', '', ''];
        $rows[] = ['Presidente da Comissão do Exame de Acesso', '', ''];

        return $rows;
    }

    public function columnWidths(): array
    {
        return ['A' => 20, 'B' => 65, 'C' => 23];
    }

    public function styles(Worksheet $sheet): array
    {
        $dataEnd = $this->tableRow + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;
        $sigNome  = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;

        // Mesclar cabeçalho
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells("A{$sigLinha}:C{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:C{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:C{$sigCargo}");

        // Alturas — cabeçalho institucional compactado ao mínimo (4 linhas em
        // vez de 9): como fica todo "congelado" (freeze pane) ao rolar a
        // lista, quanto mais alto for, menos linhas cabem no ecrã ao rolar.
        $sheet->getRowDimension(1)->setRowHeight(48);
        $sheet->getRowDimension(2)->setRowHeight(18);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(16);
        $sheet->getRowDimension($this->tableRow)->setRowHeight(22);

        // Estilos cabeçalho
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);

        // Cabeçalho da tabela
        $tr = $this->tableRow;
        $sheet->getStyle("A{$tr}:C{$tr}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // Linhas de dados
        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EBF3FD' : 'FFFFFF';
            $sheet->getStyle("A{$r}:C{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '1565C0']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("C{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // Assinatura
        $sheet->getStyle("A{$sigLinha}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigNome}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigCargo}")->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ── Imagem da assinatura digital do Presidente, por cima da linha ──
        $gdAssinatura = \App\Services\SignatureImageGenerator::generateGd('Fernando Maia');
        $imgW = imagesx($gdAssinatura);
        $imgH = imagesy($gdAssinatura);
        $assDisplayH = 28;
        $assDisplayW = (int) ($imgW * $assDisplayH / $imgH);

        $larguraTotal = array_sum($this->columnWidths());
        $assOffsetX = max(0, (int) ($larguraTotal * 8 / 2) - (int) ($assDisplayW / 2));

        $assinaturaDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
        $assinaturaDrawing->setName('Assinatura Presidente');
        $assinaturaDrawing->setImageResource($gdAssinatura);
        $assinaturaDrawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_PNG);
        $assinaturaDrawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
        $assinaturaDrawing->setHeight($assDisplayH);
        $assinaturaDrawing->setWidth($assDisplayW);
        $assinaturaDrawing->setCoordinates('A' . ($sigLinha - 2));
        $assinaturaDrawing->setOffsetX($assOffsetX);
        $assinaturaDrawing->setOffsetY(2);
        $assinaturaDrawing->setWorksheet($sheet);

        // ── Congela o cabeçalho da tabela ao rolar no ecrã ──
        $sheet->freezePane('A' . ($tr + 1));

        // Impressão A4
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(true);
        $ps->setFitToWidth(1);
        $ps->setFitToHeight(0);
        $ps->setHorizontalCentered(true);
        // Repete a linha do cabeçalho da tabela em todas as páginas impressas.
        $ps->setRowsToRepeatAtTopByStartAndEnd($tr, $tr);
        $ps->setPrintArea("A1:C{$sigCargo}");

        $sheet->getPageMargins()
            ->setHeader(0.2)
            ->setTop(0.6)
            ->setBottom(0.59)
            ->setLeft(0.39)->setRight(0.39)
            ->setFooter(0.2);

        // ── Rodapé com paginação ──
        $sheet->getHeaderFooter()->setOddFooter('&LISP-Bié — Lista de Exame&CPágina &P de &N&R' . now()->format('d/m/Y'));

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 44;
        $displayW = (int)($logoW * $displayH / $logoH);

        $centerFromB1 = (int)(((20 + 65 + 23) * 8 / 2) - (20 * 8));
        $offsetX = max(0, $centerFromB1 - (int)($displayW / 2));

        $drawing = new Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight($displayH);
        $drawing->setWidth($displayW);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX($offsetX);
        $drawing->setOffsetY(2);

        return [$drawing];
    }
}
