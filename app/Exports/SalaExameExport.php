<?php

namespace App\Exports;

use App\Models\Sala;
use App\Support\CsvSanitizer;
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

class SalaExameExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow; // linha onde começa a tabela (depende de existir data/horário)
    protected ?string $necessidadeEspecial;

    public function __construct(Sala $sala, ?string $necessidadeEspecial = null, bool $listaGeralExcluiCategorias = false, ?string $cursoFiltro = null)
    {
        $this->sala                = $sala;
        $this->necessidadeEspecial = $necessidadeEspecial;

        $query = $sala->candidaturas()
            ->where('pagamento_confirmado', true);

        if ($cursoFiltro !== null) {
            // Usado nos downloads em lote por curso — uma sala pode ter
            // candidatos de mais do que um curso, e o ficheiro dessa sala
            // dentro do lote só deve mostrar os do curso pedido.
            $query->where('curso', $cursoFiltro);
        }

        if ($necessidadeEspecial !== null) {
            $query->where('necessidade_especial', $necessidadeEspecial);
        } elseif ($listaGeralExcluiCategorias) {
            // Quando a Lista Geral é oferecida ao lado de listas por
            // categoria (Admin), um candidato de uma categoria especial não
            // deve também aparecer na Lista Geral — senão fica duplicado
            // entre as duas listas. Sem este parâmetro (ex.: DAAC, que só
            // tem esta única lista, sem categorias em separado), a Lista
            // Geral continua a incluir toda a gente.
            $query->where(function ($q) {
                $q->whereNull('necessidade_especial')->orWhere('necessidade_especial', 'Nenhuma');
            });
        }

        // Ordem alfabética por nome em vez de por lugar — mais fácil de
        // encontrar um candidato na lista de presença impressa. Ordenado em
        // PHP (não via ORDER BY) porque o Postgres compara bytes UTF-8 por
        // omissão, o que põe nomes acentuados (ex.: "Álvaro") depois de "Z".
        $this->candidaturas = $query->get()
            ->sortBy(fn ($c) => strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $c->nome)))
            ->values();
    }

    public function title(): string
    {
        // Nome da folha tem de ser único quando várias salas são combinadas num só
        // ficheiro (impressão em lote por horário) — Excel não permite duas folhas
        // com o mesmo nome, e limita a 31 caracteres sem \ / ? * [ ] : — por isso
        // o ID da sala vai sempre no fim, garantindo unicidade mesmo com nomes
        // repetidos ou muito parecidos.
        $nome = preg_replace('/[\\\\\/\?\*\[\]:]/', '', $this->sala->nome);
        $categoriaAbrev = match ($this->necessidadeEspecial) {
            'Filhos de antigos combatentes' => ' - Combatentes',
            'Portadores de deficiência'     => ' - Deficiência',
            'Áreas Steam'                   => ' - Steam',
            default                          => '',
        };
        $sufixo = $categoriaAbrev . ' #' . $this->sala->id;
        $prefixo = 'Exame - ';
        $maxNome = max(1, 31 - mb_strlen($prefixo) - mb_strlen($sufixo));
        return $prefixo . mb_substr($nome, 0, $maxNome) . $sufixo;
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço para logo (Drawing)
        $rows[] = ['', '', ''];

        // Linha 2 — nome da instituição
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];

        // Linha 3 — comissão + título da lista, combinados numa só linha
        $tituloLista = $this->necessidadeEspecial
            ? 'EXAME DE ACESSO 2026/2027 — LISTA: ' . mb_strtoupper($this->necessidadeEspecial, 'UTF-8')
            : 'EXAME DE ACESSO 2026/2027 — LISTA GERAL';
        $rows[] = ['COMISSÃO DO EXAME DE ACESSO   —   ' . $tituloLista, '', ''];

        // Linha 4 — sala, curso(s)/período e data/horário combinados numa só
        // linha. O cabeçalho institucional inteiro fica "congelado" (freeze
        // pane) ao rolar a lista de candidatos — quanto menos linhas ocupar,
        // mais espaço do ecrã sobra para ver candidatos ao rolar.
        $grupos = $this->candidaturas
            ->groupBy(fn ($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = [
            'Sala: ' . $this->sala->nome
                . '     |     Curso(s)/Período: ' . $grupos
                . '     |     Data/Horário: ' . ($dataHorario ?: '___________  |  ___________'),
            '', '',
        ];

        $this->tableRow = 5;
        $rows[] = ['N.º Ficha', 'NOME COMPLETO', 'ASSINATURA'];

        foreach ($this->candidaturas as $c) {
            $rows[] = [
                str_pad($c->id, 5, '0', STR_PAD_LEFT), mb_strtoupper(CsvSanitizer::safe($c->nome), 'UTF-8'), '',
            ];
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
        return ['A' => 20, 'B' => 65, 'C' => 23];
    }

    public function styles(Worksheet $sheet): array
    {
        $dataEnd = $this->tableRow + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;
        $sigNome  = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;

        // ── Mesclar cabeçalho ──
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells("A{$sigLinha}:C{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:C{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:C{$sigCargo}");

        // ── Alturas ──
        // Cabeçalho institucional compactado ao mínimo (4 linhas em vez de 9):
        // como fica todo "congelado" (freeze pane) ao rolar a lista, quanto
        // mais alto for, menos candidatos cabem no ecrã ao rolar para baixo.
        $sheet->getRowDimension(1)->setRowHeight(34); // espaço para o logo (Drawing)
        $sheet->getRowDimension(2)->setRowHeight(18);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(16);
        $sheet->getRowDimension($this->tableRow)->setRowHeight(22);

        // ── Estilos do cabeçalho ──
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

        // ── Cabeçalho da tabela ──
        $tr = $this->tableRow;
        $sheet->getStyle("A{$tr}:C{$tr}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // ── Linhas de dados ──
        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EBF3FD' : 'FFFFFF';
            $sheet->getStyle("A{$r}:C{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            // Col A: ficha (center, bold & coloured)
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '1565C0']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            // Col B: nome (esquerda)
            $sheet->getStyle("B{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
            ]);
            // Col C: (reserved, center)
            $sheet->getStyle("C{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // ── Assinatura do Presidente ──
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

        // ── Congela o cabeçalho da tabela ao rolar no ecrã ──
        $sheet->freezePane('A' . ($tr + 1));

        // ── Impressão A4 ──
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(true);
        $ps->setFitToWidth(1);
        $ps->setFitToHeight(0);
        $ps->setHorizontalCentered(true);
        // Repete a linha do cabeçalho da tabela (N.º Ficha / Nome / Assinatura) em
        // todas as páginas impressas — sem isto, uma sala com muitos candidatos
        // imprimia a página 2+ sem títulos, exigindo edição manual antes de imprimir.
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
        $displayH = 34;
        $displayW = (int)($logoW * $displayH / $logoH);

        // Anchor logo to B1 and compute offset to center across A(20)+B(65)+C(23)
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
