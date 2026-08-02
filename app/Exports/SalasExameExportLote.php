<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Combina a Lista de Exame de várias salas num único ficheiro Excel (uma folha
 * por sala) — usado para o DAAC imprimir todas as salas de um horário de uma
 * só vez, em vez de descarregar sala a sala.
 */
class SalasExameExportLote implements WithMultipleSheets
{
    protected Collection $salas;

    public function __construct(Collection $salas)
    {
        $this->salas = $salas;
    }

    public function sheets(): array
    {
        return $this->salas->map(fn(Sala $sala) => new SalaExameExport($sala))->all();
    }
}
