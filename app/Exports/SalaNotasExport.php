<?php

namespace App\Exports;

use App\Models\Sala;
use App\Models\CandidaturaNota;
use App\Models\Candidatura;
use App\Support\CsvSanitizer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class SalaNotasExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow = 5; // sempre linha 5 (estrutura fixa igual ao SalaExameExport)
    protected array $disciplines = [];
    protected array $weights = [];
    protected ?string $necessidadeEspecial;

    public function __construct(
        Sala $sala,
        ?string $cursoFiltro = null,
        ?string $periodoFiltro = null,
        ?string $necessidadeEspecial = null,
        bool $listaGeralExcluiCategorias = false
    )
    {
        $this->sala         = $sala;
        $this->necessidadeEspecial = $necessidadeEspecial;
        // Ordem alfabética por nome — ver App\Exports\SalaExameExport para a
        // explicação de por que a ordenação é feita em PHP, não via ORDER BY.
        $query = $sala->candidaturas()
            ->where('pagamento_confirmado', true);

        if ($cursoFiltro !== null) {
            $query->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($cursoFiltro)]);
        }
        if ($periodoFiltro !== null) {
            $query->where('periodo', $periodoFiltro);
        }
        if ($necessidadeEspecial !== null) {
            $query->whereRaw('LOWER(TRIM(necessidade_especial)) = LOWER(?)', [trim($necessidadeEspecial)]);
            if (mb_strtolower(trim($necessidadeEspecial), 'UTF-8') === mb_strtolower('Áreas Steam', 'UTF-8')) {
                $query->whereIn(\DB::raw('LOWER(TRIM(curso))'), [
                    mb_strtolower('Engenharia Informática', 'UTF-8'),
                    mb_strtolower('Engenharia em Recursos Hídricos', 'UTF-8'),
                ]);
                $query->whereRaw('LOWER(TRIM(sexo)) = LOWER(?)', ['feminino']);
            }
        }

        $this->candidaturas = $query->get()
            ->when($listaGeralExcluiCategorias, function ($items) {
                return $items->filter(fn ($candidatura) => Candidatura::pertenceListaGeral($candidatura));
            })
            ->sortBy(fn ($c) => strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $c->nome)))
            ->values();

        // Buscar disciplinas definidas para ESTA SALA (não por curso)
        $this->disciplines = \App\Models\SalaDiscipline::where('sala_id', $sala->id)
            ->orderBy('id')
            ->get()
            ->map(fn($d) => ['discipline' => $d->discipline, 'weight_percent' => $d->weight_percent])
            ->toArray();
        $this->weights = $this->weightsForCourse($this->candidaturas->first()?->curso);
    }

    private function weightsForCourse(?string $course): array
    {
        $courseKey = $this->normalize($course);
        $disciplineWeights = match ($courseKey) {
            'enfermagem' => [
                'biologia' => 35, 'quimica' => 25, 'matematica' => 30, 'lingua portuguesa' => 10,
            ],
            'contabilidade e administracao' => [
                'matematica' => 60, 'lingua portuguesa' => 40,
            ],
            'psicologia' => [
                'psicologia geral' => 60, 'lingua portuguesa' => 40,
            ],
            'comunicacao social' => [
                'lingua portuguesa' => 60, 'cultura geral' => 40,
            ],
            'engenharia informatica' => [
                'matematica' => 40, 'fisica' => 30, 'lingua portuguesa' => 30,
            ],
            'engenharia em recursos hidricos' => [
                'matematica' => 30, 'fisica' => 30, 'quimica' => 20, 'lingua portuguesa' => 20,
            ],
            default => [],
        };

        return array_map(
            fn ($discipline) => $disciplineWeights[$this->normalize($discipline['discipline'])]
                ?? (float) $discipline['weight_percent'],
            $this->disciplines
        );
    }

    private function normalize(?string $value): string
    {
        return mb_strtolower(trim((string) iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value)), 'UTF-8');
    }

    public function title(): string
    {
        // Ver App\Exports\SalaExameExport::title() — mesma necessidade de nome
        // único e dentro do limite de 31 caracteres quando várias salas são
        // combinadas num só ficheiro (impressão em lote por horário).
        $nome = preg_replace('/[\\\\\/\?\*\[\]:]/', '', $this->sala->nome);
        $sufixo = ' #' . $this->sala->id;
        if ($this->necessidadeEspecial !== null) {
            $sufixo = ' - ' . match ($this->necessidadeEspecial) {
                'Filhos de antigos combatentes' => 'Combatentes',
                'Portadores de deficiência' => 'Deficiência',
                'Áreas Steam' => 'Steam',
                default => mb_substr($this->necessidadeEspecial, 0, 10),
            } . $sufixo;
        }
        $prefixo = 'Pauta - ';
        $maxNome = max(1, 31 - mb_strlen($prefixo) - mb_strlen($sufixo));
        return $prefixo . mb_substr($nome, 0, $maxNome) . $sufixo;
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço mínimo (logo está no cabeçalho de impressão)
        $rows[] = ['', ''];

        // Linha 2 — nome da instituição
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', ''];

        // Linha 3 — comissão + categoria da lista, combinados numa só linha
        $tituloLista = $this->necessidadeEspecial
            ? 'EXAME DE ACESSO 2026/2027 — LISTA DE NOTAS: ' . mb_strtoupper($this->necessidadeEspecial, 'UTF-8')
            : 'EXAME DE ACESSO 2026/2027 — LISTA DE NOTAS GERAL';
        $rows[] = ['COMISSÃO DO EXAME DE ACESSO   —   ' . $tituloLista, ''];

        // Linha 4 — sala, curso(s)/período e data/horário combinados numa só
        // linha. O cabeçalho institucional inteiro fica "congelado" (freeze
        // pane) ao rolar a pauta — quanto menos linhas ocupar, mais espaço
        // sobra no ecrã para ver candidatos ao rolar.
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= method_exists($this->sala->data_exame, 'format') ? $this->sala->data_exame->format('d/m/Y') : (string)$this->sala->data_exame;
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = [
            'Sala: ' . $this->sala->nome
                . '     |     Curso/Período: ' . $grupos
                . '     |     Data/Horário: ' . ($dataHorario ?: '___________  |  ___________'),
            '',
        ];

        // Construir cabeçalho da tabela dinamicamente
        $header = ['NÚMERO DA FICHA', 'NOME COMPLETO'];
        foreach ($this->disciplines as $d) {
            $header[] = mb_strtoupper($d['discipline'], 'UTF-8');
        }
        $header[] = 'MÉDIA FINAL';
        $header[] = 'RESULTADO';

        // Garantir que a tabela comece na linha fixa definida
        // Preencher linhas de cabeçalho até chegar à $this->tableRow
        $currentRow = count($rows) + 1;
        while ($currentRow < $this->tableRow) {
            $rows[] = array_fill(0, count($header), '');
            $currentRow++;
        }

        $rows[] = $header;

        // Dados
        $firstDisciplineColumn = 3; // C
        $lastDisciplineColumn = $firstDisciplineColumn + count($this->disciplines) - 1;
        $finalGradeColumn = $lastDisciplineColumn + 1;

        foreach ($this->candidaturas as $index => $c) {
            $line = [];
            $line[] = $c->id;
            $line[] = mb_strtoupper(CsvSanitizer::safe($c->nome), 'UTF-8');

            foreach ($this->disciplines as $d) {
                $notaRow = CandidaturaNota::where('candidatura_id', $c->id)->where('discipline', $d['discipline'])->first();
                $nota = $notaRow ? (float) $notaRow->nota : null;
                $line[] = $nota !== null ? $nota : '';
            }

            $excelRow = $this->tableRow + 1 + $index;
            if ($this->disciplines === []) {
                $line[] = '';
                $line[] = '';
            } else {
                $firstColumn = Coordinate::stringFromColumnIndex($firstDisciplineColumn);
                $lastColumn = Coordinate::stringFromColumnIndex($lastDisciplineColumn);
                $finalGradeColumnLetter = Coordinate::stringFromColumnIndex($finalGradeColumn);
                $normalizedTerms = [];
                for ($offset = 0; $offset < count($this->disciplines); $offset++) {
                    $column = Coordinate::stringFromColumnIndex($firstDisciplineColumn + $offset);
                    // Aceita notas introduzidas como número ou como texto com
                    // vírgula decimal (por exemplo, "7,6").
                    $normalizedTerms[] = "IF(ISNUMBER({$column}{$excelRow}),{$column}{$excelRow},IFERROR(NUMBERVALUE({$column}{$excelRow},\",\",\".\"),0))";
                }
                $line[] = sprintf(
                    '=IF(COUNTA(%1$s%2$d:%3$s%2$d)=%4$d,%5$s,"")',
                    $firstColumn,
                    $excelRow,
                    $lastColumn,
                    count($this->disciplines),
                    implode('+', array_map(
                        fn ($term, $offset) => $term . '*' . ((float) $this->weights[$offset] / 100),
                        $normalizedTerms,
                        array_keys($normalizedTerms)
                    ))
                );
                $line[] = sprintf(
                    '=IF(COUNTA(%2$s%3$d:%4$s%3$d)<>%5$d,"",IF(%1$s%3$d>=10,"APROVADO","REPROVADO"))',
                    $finalGradeColumnLetter,
                    $firstColumn,
                    $excelRow,
                    $lastColumn,
                    count($this->disciplines)
                );
            }

            $rows[] = $line;
        }

        return $rows;
    }

    public function columnWidths(): array
    {
        // A dynamic mapping: A = código, B = nome, next N = disciplinas, last two = Soma/Resultado
        $widths = [];
        $widths['A'] = 12;
        $widths['B'] = 50;

        $col = 'C';
        foreach ($this->disciplines as $d) {
            // Largura proporcional ao nome da disciplina (em vez de um valor fixo de 15),
            // para nomes compridos não ficarem cortados no cabeçalho da pauta. O texto
            // do cabeçalho também tem "wrapText" activo (ver styles()) como rede de
            // segurança para nomes muito longos.
            $widths[$col] = max(15, min(28, mb_strlen($d['discipline']) + 4));
            $col++;
        }
        // Soma
        $widths[$col] = 12;
        $col++;
        // Resultado
        $widths[$col] = 12;

        return $widths;
    }

    public function styles(Worksheet $sheet): array
    {
        $tr = $this->tableRow;
        $dataEnd = $tr + $this->candidaturas->count();
        $lastDisciplineColumnLetter = Coordinate::stringFromColumnIndex(2 + count($this->disciplines));

        // Mesclar cabeçalho principal nas colunas usadas
        $lastCol = chr( ord('A') + (1 + count($this->disciplines) + 2) );
        // safe fallback if lastCol beyond 'Z' — avoid complex logic; only small number of disciplines expected
        $sheet->mergeCells("A2:{$lastCol}2");
        $sheet->mergeCells("A3:{$lastCol}3");
        $sheet->mergeCells("A4:{$lastCol}4");

        // Alturas e estilos básicos — cabeçalho institucional compactado ao
        // mínimo (4 linhas em vez de 9): como fica todo "congelado" (freeze
        // pane) ao rolar a pauta, quanto mais alto for, menos candidatos
        // cabem no ecrã ao rolar para baixo.
        $sheet->getRowDimension(1)->setRowHeight(48);
        $sheet->getRowDimension(2)->setRowHeight(18);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(16);
        // Cabeçalho mais alto do que o resto da tabela — dá espaço para os nomes das
        // disciplinas quebrarem em 2 linhas (wrapText) quando são compridos, em vez
        // de ficarem cortados.
        $sheet->getRowDimension($tr)->setRowHeight(34);

        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);

        $lastHeaderRange = "A{$tr}:{$lastCol}{$tr}";
        $sheet->getStyle($lastHeaderRange)->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            // wrapText: nomes de disciplinas compridos quebram para uma segunda linha
            // dentro da própria célula, em vez de aparecerem cortados.
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EDF7F1' : 'FFFFFF';
            $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '0E5C2F']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("C{$r}:{$lastCol}{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        if ($this->disciplines !== [] && $dataEnd >= $tr + 1) {
            $validation = new DataValidation();
            $validation->setType(DataValidation::TYPE_DECIMAL);
            $validation->setErrorStyle(DataValidation::STYLE_STOP);
            $validation->setAllowBlank(true);
            $validation->setShowInputMessage(true);
            $validation->setShowErrorMessage(true);
            $validation->setErrorTitle('Nota inválida');
            $validation->setError('Introduza apenas um número entre 0 e 20.');
            $validation->setPromptTitle('Nota da disciplina');
            $validation->setPrompt('Introduza uma nota numérica entre 0 e 20.');
            $validation->setOperator(DataValidation::OPERATOR_BETWEEN);
            $validation->setFormula1('0');
            $validation->setFormula2('20');
            $sheet->setDataValidation(
                "C" . ($tr + 1) . ":{$lastDisciplineColumnLetter}{$dataEnd}",
                $validation
            );
        }

        $reprovado = new Conditional();
        $reprovado->setConditionType(Conditional::CONDITION_CELLIS)
            ->setOperatorType(Conditional::OPERATOR_EQUAL)
            ->addCondition('"REPROVADO"');
        $reprovado->getStyle()->getFont()->getColor()->setARGB('FFFF0000');
        $sheet->getStyle("{$lastCol}" . ($tr + 1) . ":{$lastCol}{$dataEnd}")
            ->setConditionalStyles([$reprovado]);

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
        // Repete a linha do cabeçalho da tabela (Código/Nome/Disciplinas/Soma/Resultado)
        // em todas as páginas impressas — sem isto, uma pauta com muitos candidatos
        // imprimia a página 2+ sem títulos, exigindo edição manual antes de imprimir.
        $ps->setRowsToRepeatAtTopByStartAndEnd($tr, $tr);
        $ps->setPrintArea("A1:{$lastCol}{$dataEnd}");

        $sheet->getPageMargins()
            ->setHeader(0.2)
            ->setTop(0.6)
            ->setBottom(0.85)
            ->setLeft(0.39)->setRight(0.39)
            ->setFooter(0.35);

        // ── Rodapé com paginação ──
        $rodape = '&LISP-Bié — Lista de Notas'
            . "&C&12_________________________________\n"
            . "Professor Doutor Fernando Maia\n"
            . "&9Presidente da Comissão do Exame de Acesso"
            . '&RPágina &P de &N  ' . now()->format('d/m/Y');
        $sheet->getHeaderFooter()->setOddFooter($rodape);
        $sheet->getHeaderFooter()->setEvenFooter($rodape);

        // O Excel só permite proteger células individuais através da proteção
        // da folha. Desbloqueamos explicitamente toda a pauta e bloqueamos
        // somente a coluna calculada da Média Final.
        $sheet->getStyle("A1:{$lastCol}{$dataEnd}")
            ->getProtection()
            ->setLocked(Protection::PROTECTION_UNPROTECTED);

        $finalGradeColumnLetter = Coordinate::stringFromColumnIndex(3 + count($this->disciplines));
        if ($dataEnd >= $tr + 1) {
            $sheet->getStyle("{$finalGradeColumnLetter}" . ($tr + 1) . ":{$finalGradeColumnLetter}{$dataEnd}")
                ->getProtection()
                ->setLocked(Protection::PROTECTION_PROTECTED);
        }

        $sheet->getProtection()
            ->setSheet(true)
            ->setPassword('notas')
            ->setSelectLockedCells(false)
            ->setSelectUnlockedCells(true);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 44;
        $displayW = (int)($logoW * $displayH / $logoH);

        $centerFromB1 = (int)(((7 + 65 + 23) * 8 / 2) - (7 * 8));
        $offsetX = max(0, $centerFromB1 - (int)($displayW / 2));

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
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
