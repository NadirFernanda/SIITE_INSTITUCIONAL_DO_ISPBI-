<?php

namespace App\Services;

use App\Models\Candidatura;
use App\Models\CursoVaga;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Calcula quem fica admitido a um curso/período com base na nota de exame e
 * no número de vagas configurado (App\Models\CursoVaga).
 *
 * Regras de negócio (definidas pela instituição):
 * - Só entram na selecção candidatos com nota positiva (>= 10); nota abaixo
 *   disso fica sempre não admitido, mesmo havendo vagas por preencher.
 * - Cada categoria especial (Filhos de antigos combatentes, Áreas Steam,
 *   Portadores de deficiência) tem reservados 3% do total de vagas do curso,
 *   e os candidatos dessa categoria concorrem só entre si por essas vagas —
 *   nunca com o concurso geral.
 * - Vagas de uma quota especial que a categoria não consiga preencher (por
 *   não ter candidatos suficientes com nota positiva) revertem para o
 *   concurso geral do curso.
 * - Vários candidatos empatados com a nota de corte (o último lugar
 *   disponível) são todos admitidos, mesmo que isso ultrapasse ligeiramente
 *   o número de vagas — ninguém fica de fora por estar empatado com quem
 *   entrou.
 */
class AdmissaoService
{
    public const NOTA_MINIMA_POSITIVA = 10.0;

    public const QUOTA_CATEGORIA_ESPECIAL = 0.03;

    /**
     * Recalcula do zero o resultado (admitido/não admitido) de todos os
     * candidatos de um curso+período. Nunca é incremental — uma nota nova
     * ou corrigida pode alterar toda a ordenação, por isso o cálculo
     * anterior é sempre descartado e refeito.
     */
    public function calcular(string $curso, string $periodo): array
    {
        return DB::transaction(function () use ($curso, $periodo) {
            $vagasTotal = (int) (CursoVaga::where('curso', $curso)->where('periodo', $periodo)->value('vagas') ?? 0);
            $agora = now();
            $utilizadorId = Auth::id();

            $base = Candidatura::where('curso', $curso)
                ->where('periodo', $periodo)
                ->where('pagamento_confirmado', true);

            (clone $base)->update([
                'resultado_admissao' => null,
                'resultado_calculado_em' => null,
                'resultado_calculado_por' => null,
            ]);

            // Nota lançada mas não positiva: reprovado de imediato, nunca compete.
            (clone $base)->whereNotNull('nota_exame')
                ->where('nota_exame', '<', self::NOTA_MINIMA_POSITIVA)
                ->update([
                    'resultado_admissao' => 'nao_admitido',
                    'resultado_calculado_em' => $agora,
                    'resultado_calculado_por' => $utilizadorId,
                ]);

            $vagasRestantesGerais = $vagasTotal;
            $resumo = ['vagas_total' => $vagasTotal, 'categorias' => []];

            foreach (Candidatura::categoriasEspeciaisPermitidas($curso) as $categoria) {
                $quota = (int) round($vagasTotal * self::QUOTA_CATEGORIA_ESPECIAL);

                $elegiveis = (clone $base)
                    ->where('necessidade_especial', $categoria)
                    ->where('nota_exame', '>=', self::NOTA_MINIMA_POSITIVA)
                    ->orderByDesc('nota_exame')
                    ->orderBy('id')
                    ->get();

                [$admitidos, $notaCorte] = $this->seleccionarComEmpate($elegiveis, $quota);

                $this->gravarResultados($elegiveis, $admitidos, $agora, $utilizadorId);

                $vagasRestantesGerais += max(0, $quota - $admitidos->count());

                $resumo['categorias'][$categoria] = [
                    'quota' => $quota,
                    'admitidos' => $admitidos->count(),
                    'nota_corte' => $notaCorte,
                ];
            }

            $elegiveisGeral = (clone $base)
                ->where(fn ($q) => $q->whereNull('necessidade_especial')->orWhere('necessidade_especial', 'Nenhuma'))
                ->where('nota_exame', '>=', self::NOTA_MINIMA_POSITIVA)
                ->orderByDesc('nota_exame')
                ->orderBy('id')
                ->get();

            [$admitidosGeral, $notaCorteGeral] = $this->seleccionarComEmpate($elegiveisGeral, $vagasRestantesGerais);

            $this->gravarResultados($elegiveisGeral, $admitidosGeral, $agora, $utilizadorId);

            $resumo['geral'] = [
                'vagas' => $vagasRestantesGerais,
                'admitidos' => $admitidosGeral->count(),
                'nota_corte' => $notaCorteGeral,
            ];

            return $resumo;
        });
    }

    /**
     * Marca como admitidos os candidatos seleccionados e como não admitidos
     * os restantes elegíveis (que tinham nota positiva mas não couberam nas
     * vagas). Quem não tem nota lançada fica de fora de $elegiveis à
     * partida, por isso mantém-se a null (pendente) — não é tocado aqui.
     */
    private function gravarResultados(Collection $elegiveis, Collection $admitidos, $agora, ?int $utilizadorId): void
    {
        $admitidosIds = $admitidos->pluck('id');
        $naoAdmitidosIds = $elegiveis->pluck('id')->diff($admitidosIds);

        if ($admitidosIds->isNotEmpty()) {
            Candidatura::whereIn('id', $admitidosIds)->update([
                'resultado_admissao' => 'admitido',
                'resultado_calculado_em' => $agora,
                'resultado_calculado_por' => $utilizadorId,
            ]);
        }

        if ($naoAdmitidosIds->isNotEmpty()) {
            Candidatura::whereIn('id', $naoAdmitidosIds)->update([
                'resultado_admissao' => 'nao_admitido',
                'resultado_calculado_em' => $agora,
                'resultado_calculado_por' => $utilizadorId,
            ]);
        }
    }

    /**
     * Selecciona os melhores classificados de $elegiveis (já ordenado por
     * nota_exame desc) até preencher $vagas, incluindo todos os candidatos
     * empatados com a nota do último lugar disponível.
     *
     * @return array{0: Collection, 1: float|null} [admitidos, nota_corte]
     */
    private function seleccionarComEmpate(Collection $elegiveis, int $vagas): array
    {
        if ($vagas <= 0 || $elegiveis->isEmpty()) {
            return [$elegiveis->take(0), null];
        }

        if ($elegiveis->count() <= $vagas) {
            return [$elegiveis, (float) $elegiveis->last()->nota_exame];
        }

        $notaCorte = (float) $elegiveis->slice(0, $vagas)->last()->nota_exame;
        $admitidos = $elegiveis->filter(fn ($c) => $c->nota_exame >= $notaCorte)->values();

        return [$admitidos, $notaCorte];
    }
}
