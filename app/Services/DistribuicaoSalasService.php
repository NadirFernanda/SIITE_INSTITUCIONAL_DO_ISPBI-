<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Models\CourseDiscipline;
use App\Models\Sala;
use App\Models\SalaDiscipline;
use Illuminate\Support\Facades\DB;

/**
 * Distribuição automática de candidatos pelas salas, respeitando o calendário
 * oficial dos Exames de Acesso (Sala::$agendaExames): cada curso+período tem
 * uma data e horário fixos, e cada sala nunca mistura candidatos de cursos
 * diferentes.
 *
 * As salas sem data/horário definidos ("modelos") são a lista de referência
 * de capacidades — normalmente as 24 salas físicas geridas pelo admin. A cada
 * distribuição, este serviço apaga as instâncias anteriores (salas já COM
 * data/horário, criadas por uma corrida anterior) e cria novas instâncias
 * clonando os modelos conforme necessário para cada bloco (data+horário) da
 * agenda — por isso a mesma sala física ("Sala 1") pode aparecer em vários
 * dias/horários diferentes, cada aparição com o seu próprio registo e
 * candidatos, sem entrar em conflito com o nome único dos modelos.
 *
 * Usada pelos painéis Admin, Técnico e Lançamento — antes cada um tinha a sua
 * própria cópia deste algoritmo (sem calendário), o que os deixava
 * inconsistentes entre si.
 */
class DistribuicaoSalasService
{
    /**
     * @return array{ok: bool, atribuidos: int, sem_sala: int, sem_agenda: int, mensagem: string, tipo: string}
     */
    public function distribuir(): array
    {
        $modelos = Sala::whereNull('data_exame')->orderByDesc('capacidade')->get()->values();

        if ($modelos->isEmpty()) {
            return $this->resultado(false, 0, 0, 0,
                'Não existem salas registadas. Crie salas antes de distribuir.', 'error');
        }

        $agenda      = Sala::$agendaExames;
        $prioridades = Candidatura::$cursosPrioritarios;

        $todos = Candidatura::whereNotIn('status', ['rejeitada'])->orderBy('nome')->get();

        $comAgenda = $todos->filter(fn ($c) => isset($agenda[trim((string) $c->curso)]));
        $semAgendaCount = $todos->count() - $comAgenda->count();

        $grupos = collect();
        foreach ($prioridades as $curso) {
            $grupos = $grupos->merge(
                $comAgenda->filter(fn ($c) => $c->curso === $curso)
                    ->groupBy(fn ($c) => $c->curso . '|||' . $c->periodo)
                    ->sortByDesc(fn ($g) => $g->count())
            );
        }
        $grupos = $grupos->merge(
            $comAgenda->reject(fn ($c) => in_array($c->curso, $prioridades, true))
                ->groupBy(fn ($c) => $c->curso . '|||' . $c->periodo)
                ->sortByDesc(fn ($g) => $g->count())
        );

        // Nota: não há verificação prévia de "capacidade total insuficiente" —
        // as salas são reutilizadas em cada bloco (data+horário) da agenda, por
        // isso a capacidade real ao longo dos vários dias é a soma de cada
        // bloco, não a capacidade das salas vezes 1. Um eventual défice de
        // capacidade é detectado por bloco durante a distribuição abaixo e
        // reportado em "sem_sala"/$naoAtribuidos.

        $atribuidos    = 0;
        $naoAtribuidos = [];
        $instanciasCriadas = [];

        DB::transaction(function () use (
            $modelos, $agenda, $grupos, &$atribuidos, &$naoAtribuidos, &$instanciasCriadas
        ) {
            // Limpar distribuição anterior — liberta os candidatos e apaga as
            // instâncias de sala da corrida anterior (a FK liberta os
            // candidatos automaticamente e apaga as disciplinas em cascata).
            Candidatura::whereNotIn('status', ['rejeitada'])
                ->update(['sala_id' => null, 'numero_lugar' => null]);
            Sala::whereNotNull('data_exame')->delete();

            $instanciasPorBloco = []; // 'data|horario' => [ ['sala'=>Sala,'ocupado'=>int,'curso_atual'=>?string], ... ]
            $proximoModeloIdx   = []; // 'data|horario' => índice do próximo modelo a clonar

            foreach ($grupos as $chave => $candidatos) {
                [$curso, $periodo] = explode('|||', $chave);
                $curso = trim($curso);

                $slot = $agenda[$curso][$periodo] ?? null;
                if (! $slot) {
                    $naoAtribuidos[] = $chave;
                    continue;
                }

                // Um período pode ter vários turnos no mesmo dia (ex.: manhã
                // cedo e depois manhã tarde), cada um com a sua própria
                // capacidade cheia das 24 salas — candidatos diferentes em
                // cada turno. Preenchemos o primeiro turno até à capacidade
                // máxima antes de passar candidatos para o seguinte.
                $horarios = $slot['horarios'];
                $horIdx   = 0;
                $instIdx  = 0;

                foreach ($candidatos as $candidato) {
                    while (true) {
                        if (! isset($horarios[$horIdx])) {
                            // Esgotaram-se TODOS os turnos deste curso/período.
                            break 2;
                        }

                        $blocoChave = $slot['data'] . '|' . $horarios[$horIdx];
                        $instanciasPorBloco[$blocoChave] ??= [];
                        $proximoModeloIdx[$blocoChave]   ??= 0;

                        if (! isset($instanciasPorBloco[$blocoChave][$instIdx])) {
                            $mIdx = $proximoModeloIdx[$blocoChave];
                            if (! isset($modelos[$mIdx])) {
                                // Esgotaram-se as salas deste turno — passar
                                // para o turno seguinte do mesmo dia, se houver.
                                $horIdx++;
                                $instIdx = 0;
                                continue;
                            }
                            $modelo = $modelos[$mIdx];
                            $proximoModeloIdx[$blocoChave]++;

                            $instancia = Sala::create([
                                'nome'       => $modelo->nome,
                                'capacidade' => $modelo->capacidade,
                                'data_exame' => $slot['data'],
                                'horario'    => $horarios[$horIdx],
                            ]);
                            $instanciasCriadas[] = $instancia;

                            $instanciasPorBloco[$blocoChave][$instIdx] = [
                                'sala' => $instancia, 'ocupado' => 0, 'curso_atual' => null,
                            ];
                        }

                        $inst = $instanciasPorBloco[$blocoChave][$instIdx];
                        if ($inst['ocupado'] < $inst['sala']->capacidade
                            && ($inst['curso_atual'] === null || $inst['curso_atual'] === $curso)) {
                            break;
                        }
                        $instIdx++;
                    }

                    $blocoChave  = $slot['data'] . '|' . $horarios[$horIdx];
                    $numeroLugar = $instanciasPorBloco[$blocoChave][$instIdx]['ocupado'] + 1;

                    Candidatura::where('id', $candidato->id)->update([
                        'sala_id'      => $instanciasPorBloco[$blocoChave][$instIdx]['sala']->id,
                        'numero_lugar' => $numeroLugar,
                    ]);

                    $instanciasPorBloco[$blocoChave][$instIdx]['ocupado']++;
                    $instanciasPorBloco[$blocoChave][$instIdx]['curso_atual'] = $curso;
                    $atribuidos++;
                }
            }

            $this->sincronizarDisciplinas($instanciasCriadas);
        });

        $totalSalasUsadas = collect($instanciasCriadas)->unique('id')->count();
        $semSalaCount = max(0, $comAgenda->count() - $atribuidos);

        AuditLog::registar('distribuiu_salas', null, null,
            "{$atribuidos} candidatos distribuídos por {$totalSalasUsadas} sala(s), conforme calendário de exames");

        if (! empty($naoAtribuidos) || $semSalaCount > 0 || $semAgendaCount > 0) {
            $partes = [];
            if (! empty($naoAtribuidos)) {
                $resumo = collect($naoAtribuidos)->countBy()
                    ->map(fn ($n, $g) => str_replace('|||', ' — ', $g) . " ({$n})")
                    ->implode('; ');
                $partes[] = "sem correspondência no calendário: {$resumo}";
            }
            if ($semSalaCount > 0) {
                $partes[] = "{$semSalaCount} candidato(s) sem sala por falta de capacidade";
            }
            if ($semAgendaCount > 0) {
                $partes[] = "{$semAgendaCount} candidato(s) com curso sem data de exame definida na agenda";
            }
            $mensagem = "{$atribuidos} candidatos distribuídos por {$totalSalasUsadas} sala(s). "
                . 'ATENÇÃO: ' . implode('; ', $partes) . '.';

            return $this->resultado(true, $atribuidos, $semSalaCount, $semAgendaCount, $mensagem, 'error');
        }

        return $this->resultado(true, $atribuidos, 0, 0,
            "{$atribuidos} candidatos distribuídos por {$totalSalasUsadas} sala(s), de acordo com o calendário de exames.",
            'success');
    }

    /**
     * Realoja um único candidato já distribuído cujo curso/período mudou —
     * usado quando se edita a candidatura depois de uma distribuição já ter
     * corrido, para não a deixar "presa" à sala do curso antigo.
     *
     * Procura uma sala já existente para o novo curso+bloco com vaga; se não
     * houver, cria mais uma instância a partir de uma sala-modelo ainda não
     * usada nesse bloco. Se mesmo assim não houver nenhuma sala disponível,
     * o candidato fica sem sala (nunca é colocado numa sala de outro curso).
     *
     * @return array{ok: bool, mensagem: string}
     */
    public function reatribuirCandidato(Candidatura $candidatura): array
    {
        $curso   = trim((string) $candidatura->curso);
        $periodo = $candidatura->periodo;
        $agenda  = Sala::$agendaExames;

        $slot = $agenda[$curso][$periodo] ?? null;
        if (! $slot) {
            $candidatura->forceFill(['sala_id' => null, 'numero_lugar' => null])->save();
            return ['ok' => false, 'mensagem' => "O curso '{$curso}' não tem data de exame definida na agenda — candidato ficou sem sala."];
        }

        return DB::transaction(function () use ($candidatura, $curso, $slot) {
            // Um período pode ter vários turnos no mesmo dia — procurar vaga
            // em cada um deles, pela ordem do calendário.
            foreach ($slot['horarios'] as $horario) {
                $instancias = Sala::where('data_exame', $slot['data'])
                    ->where('horario', $horario)
                    ->withCount('candidaturas')
                    ->orderBy('id')
                    ->get();

                foreach ($instancias as $inst) {
                    if ($inst->id === $candidatura->sala_id) {
                        continue; // não conta a própria sala actual do candidato
                    }
                    $primeiro = $inst->candidaturas()->whereNotNull('curso')->first();
                    $cursoDaSala = $primeiro ? trim($primeiro->curso) : null;
                    $compativel = $cursoDaSala === null || $cursoDaSala === $curso;

                    if ($compativel && $inst->candidaturas_count < $inst->capacidade) {
                        $numeroLugar = $inst->candidaturas_count + 1;
                        $candidatura->forceFill(['sala_id' => $inst->id, 'numero_lugar' => $numeroLugar])->save();
                        $this->sincronizarDisciplinas([$inst]);
                        return ['ok' => true, 'mensagem' => "Candidato realojado para {$inst->nome} ({$inst->data_exame->format('d/m/Y')}, {$inst->horario})."];
                    }
                }

                // Nenhuma instância existente tem vaga neste turno — tentar
                // criar mais uma a partir de uma sala-modelo ainda não usada
                // neste turno específico.
                $nomesUsados = $instancias->pluck('nome')->all();
                $modelo = Sala::whereNull('data_exame')
                    ->whereNotIn('nome', $nomesUsados)
                    ->orderByDesc('capacidade')
                    ->first();

                if ($modelo) {
                    $novaInstancia = Sala::create([
                        'nome'       => $modelo->nome,
                        'capacidade' => $modelo->capacidade,
                        'data_exame' => $slot['data'],
                        'horario'    => $horario,
                    ]);
                    $candidatura->forceFill(['sala_id' => $novaInstancia->id, 'numero_lugar' => 1])->save();
                    $this->sincronizarDisciplinas([$novaInstancia]);
                    return ['ok' => true, 'mensagem' => "Candidato realojado para {$novaInstancia->nome} ({$novaInstancia->data_exame->format('d/m/Y')}, {$novaInstancia->horario})."];
                }

                // Este turno está mesmo esgotado (sem vaga e sem modelo livre)
                // — tentar o turno seguinte do mesmo dia, se houver.
            }

            // Sem nenhuma sala disponível em nenhum turno para este
            // curso/período — nunca colocar numa sala de outro curso. Fica
            // sem sala, sinalizado ao admin.
            $candidatura->forceFill(['sala_id' => null, 'numero_lugar' => null])->save();
            return ['ok' => false, 'mensagem' => "Não há nenhuma sala com vaga disponível para '{$curso}' em nenhum turno — candidato ficou SEM sala. Adicione mais salas-modelo ou liberte espaço."];
        });
    }

    /**
     * Sincroniza as disciplinas de cada sala recém-criada com as disciplinas
     * do curso atribuído (inferido do primeiro candidato colocado nessa sala).
     */
    private function sincronizarDisciplinas(array $instanciasCriadas): void
    {
        $normalize = function ($s) {
            $s = iconv('UTF-8', 'ASCII//TRANSLIT', (string) $s);
            $s = strtolower($s);
            $s = preg_replace('/[^a-z0-9 ]+/', '', $s);
            return trim($s);
        };

        $todasDisciplinas = CourseDiscipline::orderBy('id')->get();
        $mapa = [];
        foreach ($todasDisciplinas as $row) {
            $mapa[$normalize($row->course_name)][] = $row;
        }

        foreach ($instanciasCriadas as $sala) {
            $primeiro = $sala->candidaturas()->whereNotNull('curso')->first();
            if (! $primeiro) {
                continue;
            }

            $cursoNome = trim($primeiro->curso);
            if ($cursoNome === '') {
                continue;
            }

            $norm = $normalize($cursoNome);
            $disciplinasCurso = collect($mapa[$norm] ?? []);

            if ($disciplinasCurso->isEmpty()) {
                foreach ($mapa as $k => $rows) {
                    if ($k !== '' && (str_contains($k, $norm) || str_contains($norm, $k))) {
                        $disciplinasCurso = collect($rows);
                        break;
                    }
                }
            }

            if ($disciplinasCurso->isEmpty()) {
                continue;
            }

            foreach ($disciplinasCurso as $cd) {
                SalaDiscipline::updateOrCreate(
                    ['sala_id' => $sala->id, 'discipline' => trim($cd->discipline)],
                    ['weight_percent' => (int) $cd->weight_percent]
                );
            }
        }
    }

    private function resultado(bool $ok, int $atribuidos, int $semSala, int $semAgenda, string $mensagem, string $tipo): array
    {
        return [
            'ok'         => $ok,
            'atribuidos' => $atribuidos,
            'sem_sala'   => $semSala,
            'sem_agenda' => $semAgenda,
            'mensagem'   => $mensagem,
            'tipo'       => $tipo,
        ];
    }
}
