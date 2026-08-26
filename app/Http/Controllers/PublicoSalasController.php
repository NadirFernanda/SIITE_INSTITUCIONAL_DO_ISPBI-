<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Página pública de distribuição de salas do Exame de Acesso — permite aos
 * candidatos verem em que sala/data/horário vão fazer a prova e descarregar
 * a lista em PDF, organizada por curso e período. Só mostra salas já
 * distribuídas (com data_exame definida) e com pelo menos um candidato.
 */
class PublicoSalasController extends Controller
{
    public function index(Request $request)
    {
        // Nota: um eager-load com ->limit() por si só não limita "por sala"
        // no Eloquent (o limite aplica-se ao total combinado da query, não
        // por pai) — por isso o curso/período de cada sala é obtido com uma
        // query por sala, igual ao padrão já usado noutros pontos do sistema
        // (ex.: DistribuicaoSalasService::sincronizarDisciplinas).
        $salas = Sala::whereNotNull('data_exame')
            ->withCount('candidaturas')
            ->ordenadaPorHorario()
            ->get()
            ->filter(fn ($s) => $s->candidaturas_count > 0)
            ->map(function ($sala) {
                $primeiro = $sala->candidaturas()->whereNotNull('curso')->first();
                $sala->curso_grupo = $primeiro ? trim($primeiro->curso) : 'Outro';
                $sala->periodo_grupo = $primeiro->periodo ?? 'regular';

                // Só mostrar o botão de uma categoria se esta sala tiver mesmo
                // pelo menos um candidato (com pagamento confirmado, que é o
                // que entra de facto no PDF) nessa categoria — senão gerava
                // um PDF vazio, sem sentido para quem descarrega.
                $categoriasPermitidas = Candidatura::categoriasEspeciaisPermitidas($sala->curso_grupo);
                $categoriasPresentes = $sala->candidaturas()
                    ->where('pagamento_confirmado', true)
                    ->whereIn('necessidade_especial', $categoriasPermitidas)
                    ->distinct()
                    ->pluck('necessidade_especial');
                $sala->categorias_disponiveis = collect($categoriasPermitidas)
                    ->filter(fn ($cat) => $categoriasPresentes->contains($cat))
                    ->values();

                return $sala;
            });

        $grupos = $salas->groupBy('curso_grupo')->map(function ($doCurso) {
            return $doCurso->groupBy('periodo_grupo');
        });

        $resultado = null;
        $pesquisado = trim((string) $request->query('ficha'));
        if ($pesquisado !== '') {
            $resultado = $this->pesquisarPorFicha($pesquisado);
        }

        return view('pages.distribuicao-salas', compact('grupos', 'pesquisado', 'resultado'));
    }

    /**
     * Procura o candidato pelo número de ficha (o próprio ID, tal como
     * impresso nas listas — "00061" corresponde ao ID 61) e devolve os
     * dados da sua sala, se já tiver sido atribuída.
     *
     * @return array{status: string, candidatura?: Candidatura}
     */
    private function pesquisarPorFicha(string $ficha): array
    {
        $id = (int) ltrim($ficha, '0');
        if ($id <= 0) {
            return ['status' => 'invalido'];
        }

        $candidatura = Candidatura::with('sala')->find($id);
        if (! $candidatura || $candidatura->status === 'rejeitada') {
            return ['status' => 'nao_encontrado'];
        }

        // A sala só é atribuída de facto a candidatos com pagamento
        // confirmado (ver Admin\SalaController::show/pdf) — um candidato com
        // sala_id preenchido mas sem pagamento confirmado não aparece na
        // lista impressa da sala, por isso não faz sentido mostrá-lo como
        // "encontrado" aqui.
        if (! $candidatura->pagamento_confirmado) {
            return ['status' => 'pagamento_pendente', 'candidatura' => $candidatura];
        }

        if (! $candidatura->sala_id || ! $candidatura->sala) {
            return ['status' => 'sem_sala', 'candidatura' => $candidatura];
        }

        return ['status' => 'encontrado', 'candidatura' => $candidatura];
    }

    public function pdf(Request $request, Sala $sala)
    {
        abort_unless($sala->data_exame, 404);

        $necessidadeEspecial = $request->query('necessidade_especial');

        $query = $sala->candidaturas()->where('pagamento_confirmado', true);
        if ($necessidadeEspecial) {
            $query->where('necessidade_especial', $necessidadeEspecial);
        }
        $candidaturas = $query->orderBy('numero_lugar')->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        $sufixo = $necessidadeEspecial ? '-' . \Str::slug($necessidadeEspecial) : '';
        return $pdf->download('sala-' . \Str::slug($sala->nome) . $sufixo . '-' . $sala->data_exame->format('Y-m-d') . '.pdf');
    }
}
