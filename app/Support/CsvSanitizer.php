<?php

namespace App\Support;

class CsvSanitizer
{
    /**
     * Neutraliza injecção de fórmulas em CSV/Excel (OWASP "CSV Injection").
     *
     * Campos de candidaturas são texto livre submetido pelo público e depois
     * exportados para CSV/XLSX que a equipa abre no Excel. Um candidato podia
     * escrever algo como "=cmd|'/c calc'!A1" no nome e, ao abrir o ficheiro,
     * o Excel interpretava-o como fórmula/comando em vez de texto. Prefixar
     * com uma plica quando o valor começa por =, +, -, @, tab ou CR obriga o
     * Excel a tratá-lo sempre como texto.
     */
    public static function safe(?string $value): string
    {
        $value = (string) $value;

        if ($value !== '' && in_array($value[0], ['=', '+', '-', '@', "\t", "\r"], true)) {
            return "'" . $value;
        }

        return $value;
    }
}
