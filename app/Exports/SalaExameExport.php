<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class SalaExameExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $dataStartRow;

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
    }

    public function title(): string
    {
        return 'Lista de Exame';
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — logo (3 colunas: A, B, C)
        $rows[] = ['', '', ''];

        // Cabeçalho instituição
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', '', ''];
        $rows[] = ['EXAME DE ACESSO 2025/2026 — LISTA DE EXAME', '', ''];
        $rows[] = ['', '', ''];

        // Info da sala
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['Sala: ' . $this->sala->nome, '', ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, '', ''];
        $rows[] = ['', '', ''];

        // Linha 9: cabeçalho da tabela — N.º, Nome, Assinatura
        $rows[] = ['N.º', 'Nome Completo', 'Assinatura'];

        $this->dataStartRow = 10;

        // Dados
        foreach ($this->candidaturas as $c) {
            $rows[] = [
                $c->numero_lugar,
                $c->nome,
                '', // assinatura — em branco
            ];
        }

        // Linha vazia + assinaturas
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['_________________________________', '', '_________________________________'];
        $rows[] = ['Responsável de Sala', '', 'Chefe de Departamento'];

        return $rows;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 55,
            'C' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Mesclar cabeçalho A-C
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells('A6:C6');
        $sheet->mergeCells('A7:C7');

        $sheet->getRowDimension(1)->setRowHeight(60);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);

        // Títulos instituição
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '333333']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Info sala
        $sheet->getStyle('A6:A7')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

        // Cabeçalho tabela
        $sheet->getStyle('A9:C9')->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(9)->setRowHeight(22);

        // Linhas de dados
        $dataEnd = 9 + $this->candidaturas->count();
        for ($r = 10; $r <= $dataEnd; $r++) {
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
            // Assinatura — mais alta para assinar
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->getPageMargins()->setTop(0.5)->setBottom(0.5)->setLeft(0.5)->setRight(0.5);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        $drawing = new Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight(52);
        $drawing->setCoordinates('B1'); // centrado na tabela de 3 colunas
        $drawing->setOffsetX(0);
        $drawing->setOffsetY(4);

        return [$drawing];
    }
}
