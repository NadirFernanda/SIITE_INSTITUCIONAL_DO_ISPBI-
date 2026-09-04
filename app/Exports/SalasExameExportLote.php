<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Combina a Lista de Exame de várias salas num único ficheiro Excel — usado
 * para descarregar todas as salas de um horário ou de um curso de uma só
 * vez, em vez de sala a sala.
 *
 * Por cada sala gera uma folha "Pauta Geral" com todos os candidatos
 * confirmados e mais uma folha por cada categoria especial presente nessa
 * sala. As folhas por categoria são complementares; a pauta geral permanece
 * completa para garantir que nenhum candidato fica fora do lote.
 */
class SalasExameExportLote implements WithMultipleSheets
{
    protected Collection $salas;
    protected ?string $cursoFiltro;

    public function __construct(Collection $salas, ?string $cursoFiltro = null)
    {
        $this->salas       = $salas;
        $this->cursoFiltro = $cursoFiltro;
    }

    public function sheets(): array
    {
        return $this->salas->flatMap(function (Sala $sala) {
            $candidaturasQuery = $sala->candidaturas()->where('pagamento_confirmado', true);
            if ($this->cursoFiltro !== null) {
                $candidaturasQuery->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($this->cursoFiltro)]);
            }
            $candidaturas = $candidaturasQuery->get();

            $categoriasSala = $candidaturas
                ->pluck('necessidade_especial')
                ->filter(fn ($cat) => $cat !== null && trim((string) $cat) !== '' && mb_strtolower(trim((string) $cat)) !== 'nenhuma')
                ->map(fn ($cat) => trim((string) $cat))
                ->unique(fn ($cat) => mb_strtolower($cat))
                ->values();

            // A pauta geral deve conter todos os candidatos confirmados.
            // As folhas por categoria são complementares e não podem fazer
            // com que um candidato desapareça da lista principal.
            $folhas = [new SalaExameExport($sala, null, false, $this->cursoFiltro)];
            foreach ($categoriasSala as $categoria) {
                $folhas[] = new SalaExameExport($sala, $categoria, false, $this->cursoFiltro);
            }

            return $folhas;
        })->all();
    }
}
