<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Página pública de distribuição de salas do Exame de Acesso — permite aos
 * candidatos verem em que sala/data/horário vão fazer a prova e descarregar
 * a lista em PDF, organizada por curso e período. Só mostra salas já
 * distribuídas (com data_exame definida) e com pelo menos um candidato.
 */
class PublicoSalasController extends Controller
{
    public function index()
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
                return $sala;
            });

        $grupos = $salas->groupBy('curso_grupo')->map(function ($doCurso) {
            return $doCurso->groupBy('periodo_grupo');
        });

        return view('pages.distribuicao-salas', compact('grupos'));
    }

    public function pdf(Sala $sala)
    {
        abort_unless($sala->data_exame, 404);

        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '-' . $sala->data_exame->format('Y-m-d') . '.pdf');
    }
}
