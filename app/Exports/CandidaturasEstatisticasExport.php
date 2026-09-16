<?php

namespace App\Exports;

use App\Services\RelatorioCandidaturasService;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CandidaturasEstatisticasExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    private array $estatisticas;
    private int $ultimaLinha = 1;

    public function __construct(RelatorioCandidaturasService $service)
    {
        $this->estatisticas = $service->estatisticas();
    }

    public function title(): string
    {
        return 'Relatório Estatístico';
    }

    public function array(): array
    {
        $rows = [
            ['', '', '', ''],
            ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', '', ''],
            ['RELATÓRIO ESTATÍSTICO DE CANDIDATURAS', '', '', ''],
            ['Estatísticas das candidaturas concluídas — emitido em ' . now()->format('d/m/Y H:i'), '', '', ''],
        ];

        foreach ($this->estatisticas['blocos'] as $titulo => $linhas) {
            $rows[] = [$titulo, '', '', ''];
            $rows[] = ['Categoria', 'Regular', 'Pós-Laboral', 'Total'];
            foreach ($linhas as $linha) {
                $rows[] = [$linha['label'], $linha['regular'], $linha['pos-laboral'], $linha['total']];
            }
            $rows[] = ['Total', ...$this->totais($linhas)];
            $rows[] = ['', '', '', ''];
        }

        $rows[] = ['TOTAL GERAL — CANDIDATURAS CONCLUÍDAS', '', '', $this->estatisticas['total']];
        $this->ultimaLinha = count($rows);

        return $rows;
    }

    public function columnWidths(): array
    {
        return ['A' => 42, 'B' => 16, 'C' => 18, 'D' => 16];
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('A3:D3');
        $sheet->mergeCells('A4:D4');

        $sheet->getRowDimension(1)->setRowHeight(48);
        foreach ([2 => 20, 3 => 24, 4 => 18] as $row => $height) {
            $sheet->getRowDimension($row)->setRowHeight($height);
        }

        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font' => ['italic' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        for ($row = 5; $row <= $this->ultimaLinha; $row++) {
            $value = (string) $sheet->getCell("A{$row}")->getValue();
            if ($value === '') {
                continue;
            }
            if ($sheet->getCell("B{$row}")->getValue() === 'Regular') {
                $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                continue;
            }
            if ($sheet->getCell("B{$row}")->getValue() === '' && ! str_starts_with($value, 'TOTAL GERAL')) {
                $sheet->mergeCells("A{$row}:D{$row}");
                $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1565C0']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E3F2FD']],
                ]);
                continue;
            }
            $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D9E2EC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("B{$row}:D{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            if ($value === 'Total' || str_starts_with($value, 'TOTAL GERAL')) {
                $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EDF7F1']],
                ]);
            }
        }

        $sheet->freezePane('A5');
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT)
            ->setPaperSize(PageSetup::PAPERSIZE_A4)
            ->setFitToPage(true)->setFitToWidth(1)->setFitToHeight(0);
        $sheet->getPageMargins()->setTop(0.6)->setBottom(0.85)->setLeft(0.39)->setRight(0.39)->setFooter(0.35);
        $footer = '&LISP-Bié — Relatório Estatístico&C&9Documento gerado em ' . now()->format('d/m/Y H:i') . '&RPágina &P de &N';
        $sheet->getHeaderFooter()->setOddFooter($footer);
        $sheet->getHeaderFooter()->setEvenFooter($footer);
        $sheet->getPageSetup()->setPrintArea("A1:D{$this->ultimaLinha}");

        return [];
    }

    private function totais(array $linhas): array
    {
        return [
            array_sum(array_column($linhas, 'regular')),
            array_sum(array_column($linhas, 'pos-laboral')),
            array_sum(array_column($linhas, 'total')),
        ];
    }

    public function drawings(): array
    {
        $logoPath = public_path('images/logo.png');
        if (! file_exists($logoPath) || filesize($logoPath) === 0) {
            return [];
        }
        $drawing = new Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight(44);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(130);
        $drawing->setOffsetY(2);
        return [$drawing];
    }
}
