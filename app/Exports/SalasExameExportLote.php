<?php

namespace App\Exports;

use App\Models\Candidatura;
use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Combina a Lista de Exame de várias salas num único ficheiro Excel — usado
 * para descarregar todas as salas de um horário ou de um curso de uma só
 * vez, em vez de sala a sala.
 *
 * Por cada sala gera uma folha "Lista Geral" (sem os candidatos de categoria
 * especial) e mais uma folha por cada categoria especial presente nessa sala
 * — o mesmo padrão já usado nos botões Excel da página individual da sala.
 * Sem isto, os candidatos de categoria especial ficavam escondidos,
 * misturados na lista geral sem nenhuma separação.
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
                $candidaturasQuery->where('curso', $this->cursoFiltro);
            }
            $candidaturas = $candidaturasQuery->get();

            $cursoSala = $candidaturas->first()->curso ?? null;
            $categoriasSala = collect(Candidatura::categoriasEspeciaisPermitidas($cursoSala))
                ->filter(fn ($cat) => $candidaturas->contains('necessidade_especial', $cat))
                ->values();

            $folhas = [new SalaExameExport($sala, null, true, $this->cursoFiltro)];
            foreach ($categoriasSala as $categoria) {
                $folhas[] = new SalaExameExport($sala, $categoria, false, $this->cursoFiltro);
            }

            return $folhas;
        })->all();
    }
}
