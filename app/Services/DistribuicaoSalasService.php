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
 * As salas-modelo fornecem capacidades para criar novas instâncias. Uma nova
 * distribuição apenas atribui candidatos pagos ainda sem sala: não elimina
 * atribuições existentes nem instâncias que possam conter decisões manuais.
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
        $agenda      = Sala::$agendaExames;
        $prioridades = Candidatura::$cursosPrioritarios;
        $dados = DB::transaction(function () use ($agenda, $prioridades) {
            $modelos = Sala::whereNull('data_exame')->orderBy('id')->lockForUpdate()->get()->values();
            $salasExistentes = Sala::whereNotNull('data_exame')->orderBy('id')->lockForUpdate()->get();

            if ($modelos->isEmpty() && $salasExistentes->isEmpty()) {
                return ['sem_salas' => true];
            }

            $candidatos = Candidatura::where('pagamento_confirmado', true)
                ->whereNotIn('status', ['rejeitada'])
                ->whereNull('sala_id')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            $comAgenda = $candidatos->filter(fn ($c) => isset($agenda[trim((string) $c->curso)][$c->periodo]));
            $semAgendaCount = $candidatos->count() - $comAgenda->count();
            $grupos = collect();

            foreach ($prioridades as $curso) {
                $grupos = $grupos->merge(
                    $comAgenda->filter(fn ($c) => $c->curso === $curso)
                        ->groupBy(fn ($c) => $c->curso.'|||'.$c->periodo)
                        ->sortByDesc(fn ($grupo) => $grupo->count())
                );
            }
            $grupos = $grupos->merge(
                $comAgenda->reject(fn ($c) => in_array($c->curso, $prioridades, true))
                    ->groupBy(fn ($c) => $c->curso.'|||'.$c->periodo)
                    ->sortByDesc(fn ($grupo) => $grupo->count())
            );

            $ocupantes = Candidatura::whereIn('sala_id', $salasExistentes->modelKeys())
                ->get(['id', 'sala_id', 'numero_lugar', 'curso'])
                ->groupBy('sala_id');
            $instanciasPorBloco = [];
            $nomesUsadosPorBloco = [];

            foreach ($salasExistentes as $sala) {
                $bloco = $sala->data_exame->format('Y-m-d').'|'.$sala->horario;
                $daSala = $ocupantes->get($sala->id, collect());
                $cursosNaSala = $daSala->pluck('curso')->filter()->map(fn ($curso) => trim($curso))->unique()->values();
                $cursoAtual = $cursosNaSala->count() > 1 ? '__misturada__' : $cursosNaSala->first();

                $instanciasPorBloco[$bloco][] = [
                    'sala' => $sala,
                    'ocupado' => $daSala->count(),
                    'lugares' => $daSala->pluck('numero_lugar')->filter()->map(fn ($lugar) => (int) $lugar)->flip()->all(),
                    'curso_atual' => $cursoAtual,
                ];
                $nomesUsadosPorBloco[$bloco][] = $sala->nome;
            }

            $instanciasCriadas = [];
            $atribuidos = 0;
            $naoAtribuidos = [];

            foreach ($grupos as $chave => $candidatosDoGrupo) {
                [$curso, $periodo] = explode('|||', $chave, 2);
                $curso = trim($curso);
                $slot = $agenda[$curso][$periodo] ?? null;

                if (! $slot) {
                    $naoAtribuidos[] = $chave;
                    continue;
                }

                foreach ($candidatosDoGrupo as $candidato) {
                    $atribuido = false;

                    foreach ($slot['horarios'] as $horario) {
                        $bloco = $slot['data'].'|'.$horario;
                        $instanciasPorBloco[$bloco] ??= [];
                        $nomesUsadosPorBloco[$bloco] ??= [];
                        $indice = null;

                        foreach ($instanciasPorBloco[$bloco] as $i => $instancia) {
                            if ($instancia['ocupado'] < $instancia['sala']->capacidade
                                && ($instancia['curso_atual'] === null || $instancia['curso_atual'] === $curso)) {
                                $indice = $i;
                                break;
                            }
                        }

                        if ($indice === null) {
                            $modelo = $modelos->first(fn ($salaModelo) =>
                                $salaModelo->capacidade > 0
                                && ! in_array($salaModelo->nome, $nomesUsadosPorBloco[$bloco], true)
                            );
                            if (! $modelo) {
                                continue;
                            }

                            $sala = Sala::create([
                                'nome' => $modelo->nome,
                                'capacidade' => $modelo->capacidade,
                                'data_exame' => $slot['data'],
                                'horario' => $horario,
                            ]);
                            $indice = count($instanciasPorBloco[$bloco]);
                            $instanciasPorBloco[$bloco][$indice] = [
                                'sala' => $sala,
                                'ocupado' => 0,
                                'lugares' => [],
                                'curso_atual' => null,
                            ];
                            $nomesUsadosPorBloco[$bloco][] = $modelo->nome;
                            $instanciasCriadas[] = $sala;
                        }

                        $instancia = &$instanciasPorBloco[$bloco][$indice];
                        $numeroLugar = 1;
                        while (isset($instancia['lugares'][$numeroLugar])) {
                            $numeroLugar++;
                        }

                        $candidato->forceFill([
                            'sala_id' => $instancia['sala']->id,
                            'numero_lugar' => $numeroLugar,
                        ])->save();

                        $instancia['lugares'][$numeroLugar] = true;
                        $instancia['ocupado']++;
                        $instancia['curso_atual'] = $curso;
                        unset($instancia);
                        $atribuidos++;
                        $atribuido = true;
                        break;
                    }

                    if (! $atribuido) {
                        $naoAtribuidos[] = $chave;
                    }
                }
            }

            $this->sincronizarDisciplinas($instanciasCriadas);

            return [
                'sem_salas' => false,
                'atribuidos' => $atribuidos,
                'nao_atribuidos' => $naoAtribuidos,
                'sem_agenda' => $semAgendaCount,
                'instancias_criadas' => count($instanciasCriadas),
            ];
        });

        if ($dados['sem_salas']) {
            return $this->resultado(false, 0, 0, 0,
                'Não existem salas registadas. Crie salas antes de distribuir.', 'error');
        }

        $atribuidos = $dados['atribuidos'];
        $naoAtribuidos = $dados['nao_atribuidos'];
        $semAgendaCount = $dados['sem_agenda'];
        $totalSalasUsadas = $dados['instancias_criadas'];
        $semSalaCount = count($naoAtribuidos);

        AuditLog::registar('distribuiu_salas', null, null,
            "{$atribuidos} candidatos pagos sem sala atribuídos a {$totalSalasUsadas} nova(s) sala(s), sem alterar atribuições existentes");

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
            "{$atribuidos} candidatos pagos sem sala atribuídos a {$totalSalasUsadas} nova(s) sala(s), de acordo com o calendário de exames. As atribuições existentes foram preservadas.",
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
            DB::transaction(function () use ($candidatura) {
                Candidatura::whereKey($candidatura->id)->lockForUpdate()->firstOrFail()
                    ->forceFill(['sala_id' => null, 'numero_lugar' => null])
                    ->save();
            });
            return ['ok' => false, 'mensagem' => "O curso '{$curso}' não tem data de exame definida na agenda — candidato ficou sem sala."];
        }

        return DB::transaction(function () use ($candidatura, $curso, $slot) {
            $modelos = Sala::whereNull('data_exame')->orderBy('id')->lockForUpdate()->get();
            $instanciasPorHorario = [];
            foreach ($slot['horarios'] as $horario) {
                $instanciasPorHorario[$horario] = Sala::where('data_exame', $slot['data'])
                    ->where('horario', $horario)
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get();
            }

            $candidatura = Candidatura::whereKey($candidatura->id)->lockForUpdate()->firstOrFail();
            if (! $candidatura->pagamento_confirmado || $candidatura->status === 'rejeitada') {
                $candidatura->forceFill(['sala_id' => null, 'numero_lugar' => null])->save();
                return ['ok' => false, 'mensagem' => 'Atribuição removida: é necessário ter o pagamento confirmado e a candidatura não pode estar rejeitada.'];
            }

            // Um período pode ter vários turnos no mesmo dia — procurar vaga
            // em cada um deles, pela ordem do calendário.
            foreach ($slot['horarios'] as $horario) {
                $instancias = $instanciasPorHorario[$horario];

                foreach ($instancias as $inst) {
                    if ($inst->id === $candidatura->sala_id) {
                        continue; // não conta a própria sala actual do candidato
                    }
                    $ocupantes = $inst->candidaturas()->where('candidaturas.id', '!=', $candidatura->id)->get(['curso', 'numero_lugar']);
                    $cursosNaSala = $ocupantes->pluck('curso')->filter()->map(fn ($nome) => trim($nome))->unique();
                    $cursoDaSala = $cursosNaSala->count() > 1 ? '__misturada__' : $cursosNaSala->first();
                    $lugares = $ocupantes->pluck('numero_lugar')->filter()->map(fn ($lugar) => (int) $lugar)->flip();
                    $compativel = $cursoDaSala === null || $cursoDaSala === $curso;

                    if ($compativel && $ocupantes->count() < $inst->capacidade) {
                        $numeroLugar = 1;
                        while (isset($lugares[$numeroLugar]) && $numeroLugar <= $inst->capacidade) {
                            $numeroLugar++;
                        }
                        if ($numeroLugar > $inst->capacidade) {
                            continue;
                        }
                        $candidatura->forceFill(['sala_id' => $inst->id, 'numero_lugar' => $numeroLugar])->save();
                        $this->sincronizarDisciplinas([$inst]);
                        return ['ok' => true, 'mensagem' => "Candidato realojado para {$inst->nome} ({$inst->data_exame->format('d/m/Y')}, {$inst->horario})."];
                    }
                }

                // Nenhuma instância existente tem vaga neste turno — tentar
                // criar mais uma a partir de uma sala-modelo ainda não usada
                // neste turno específico.
                $nomesUsados = $instancias->pluck('nome')->all();
                $modelo = $modelos
                    ->reject(fn ($salaModelo) => in_array($salaModelo->nome, $nomesUsados, true))
                    ->sortByDesc('capacidade')
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

            if ($disciplinasCurso->sum('weight_percent') !== 100) {
                throw new \RuntimeException("Os pesos das disciplinas de {$cursoNome} não totalizam 100%; a distribuição foi cancelada.");
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
