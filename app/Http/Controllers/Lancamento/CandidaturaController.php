<?php

namespace App\Http\Controllers\Lancamento;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    /**
     * Update the exam grade (nota_exame) for a candidatura.
     * This route is registered inside the lancamento group which already
     * applies the 'auth' and 'subcomissao_lancamento' middleware.
     */
    public function updateNota(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'nota_exame' => 'required|numeric|min:0|max:20',
        ]);

        $nota = round((float) $request->input('nota_exame'), 1);

        $candidatura->update([
            'nota_exame'       => $nota,
            'nota_lancada_por' => auth()->id(),
            'nota_lancada_em'  => now(),
        ]);

        AuditLog::registar('lancou_nota', 'candidatura', $candidatura->id,
            "Ficha #{$candidatura->id} — {$candidatura->nome} | Nota: {$nota}");

        return redirect()->route('lancamento.salas.show', $candidatura->sala_id)
            ->with('success', "Nota {$nota} actualizada com sucesso.");
    }
}
