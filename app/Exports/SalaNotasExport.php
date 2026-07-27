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
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalaNotasExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow = 10; // sempre linha 10 (estrutura fixa igual ao SalaExameExport)

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()->orderBy('id')->get();
    }

    public function title(): string
    {
        return 'Pauta';
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço mínimo (logo está no cabeçalho de impressão)
        $rows[] = ['', '', ''];

        // Cabeçalho (linhas 2-4) — mescladas A:C, centradas
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', '', ''];
        $rows[] = ['EXAME DE ACESSO 2026/2027 — PAUTA', '', ''];

        // Linha 5 — vazia
        $rows[] = ['', '', ''];

        // Linhas 6-7 — info da sala
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['Sala: ' . $this->sala->nome, '', ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, '', ''];

        // Linha 8 — data/horário (sempre presente para estrutura fixa)
        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = $dataHorario ? ['Data / Horário: ' . $dataHorario, '', ''] : ['', '', ''];

        // Linha 9 — vazia
        $rows[] = ['', '', ''];

        // Linha 10 — cabeçalho da tabela (SEMPRE linha 10)
        $rows[] = ['CÓDIGO EXAME', 'NOME COMPLETO', 'NOTA (0–20)'];

        // Dados — código de exame (único da pauta), nome em maiúsculas, nota em branco
        foreach ($this->candidaturas as $c) {
            $rows[] = [$c->codigo_exame ?? 'NÃO GERADO', strtoupper($c->nome), ''];
        }

        // Assinatura do Presidente — centrada
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['_________________________________', '', ''];
        $rows[] = ['Professor Doutor Fernando Maia', '', ''];
        $rows[] = ['Presidente da Instituição', '', ''];

        return $rows;
    }

    public function columnWidths(): array
    {
        // A4 portrait: N.º(7) + Nome(65) + Nota(23) ≈ 95 → fitToWidth ajusta
        return ['A' => 7, 'B' => 65, 'C' => 23];
    }

    public function styles(Worksheet $sheet): array
    {
        $tr      = $this->tableRow;
        $dataEnd = $tr + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;
        $sigNome  = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;

        // ── Mesclar cabeçalho A:C ──
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells('A6:C6');
        $sheet->mergeCells('A7:C7');
        $sheet->mergeCells('A8:C8');
        $sheet->mergeCells("A{$sigLinha}:C{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:C{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:C{$sigCargo}");

        // ── Alturas (igual ao SalaExameExport) ──
        $sheet->getRowDimension(1)->setRowHeight(55);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);
        $sheet->getRowDimension(5)->setRowHeight(8);
        $sheet->getRowDimension(9)->setRowHeight(8);
        $sheet->getRowDimension($tr)->setRowHeight(22);

        // ── Estilos do cabeçalho ──
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A6:A8')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

        // ── Cabeçalho da tabela (verde para distinguir das notas) ──
        $sheet->getStyle("A{$tr}:C{$tr}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // ── Linhas de dados ──
        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EDF7F1' : 'FFFFFF';
            $sheet->getStyle("A{$r}:C{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '0E5C2F']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("C{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // ── Assinatura do Presidente ──
        $sheet->getStyle("A{$sigLinha}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension($sigLinha)->setRowHeight(18);
        $sheet->getStyle("A{$sigNome}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigCargo}")->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ── Impressão A4 — sem header repetido nas páginas 2+ ──
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(true);
        $ps->setFitToWidth(1);
        $ps->setFitToHeight(0);
        $ps->setHorizontalCentered(true);

        $sheet->getPageMargins()
            ->setHeader(0.2)
            ->setTop(0.6)
            ->setBottom(0.59)
            ->setLeft(0.39)->setRight(0.39)
            ->setFooter(0.2);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 55;
        $displayW = (int)($logoW * $displayH / $logoH);

        // Centrar logo across colunas A(7)+B(65)+C(23)=95 chars.
        // Ancoramos em B1 porque offsets grandes a partir de A1 não são
        // respeitados pelo Excel quando ultrapassam a largura da coluna A.
        // Centro total (em px a 8px/char): (95*8)/2 = 380px desde a esquerda.
        // Offset desde A1_esquerda até B1_esquerda = 7*8 = 56px.
        // => Offset desde B1 até ao centro = 380 - 56 = 324px.
        $centerFromB1 = (int)(((7 + 65 + 23) * 8 / 2) - (7 * 8));
        $offsetX = max(0, $centerFromB1 - (int)($displayW / 2));

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight($displayH);
        $drawing->setWidth($displayW);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX($offsetX);
        $drawing->setOffsetY(3);

        return [$drawing];
    }
}
