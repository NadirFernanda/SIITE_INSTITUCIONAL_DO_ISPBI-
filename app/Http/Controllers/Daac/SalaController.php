<?php

namespace App\Http\Controllers\Daac;

use App\Exports\SalaExameExport;
use App\Http\Controllers\Controller;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::query()
            ->withCount(['candidaturas' => function ($query) {
                $query->where('pagamento_confirmado', true);
            }])
            ->orderBy('nome')
            ->get()
            ->filter(fn($sala) => $sala->candidaturas_count > 0);
        
        return view('daac.salas.index', compact('salas'));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        // Se as folhas ainda não foram geradas, gerar e guardar um PDF da sala
        if (!$sala->folhas_geradas_em) {
            $html = '';
            foreach ($candidaturas as $candidatura) {
                $view = \View::make('pdf.folha-prova', compact('candidatura'))->render();
                $html .= $view . '<div style="page-break-after: always;"></div>';
            }

            try {
                $pdf = Pdf::loadHTML($html)
                          ->setPaper('a4', 'portrait')
                          ->setOption('margin-top', 0)
                          ->setOption('margin-bottom', 0)
                          ->setOption('margin-left', 0)
                          ->setOption('margin-right', 0);

                $bytes = $pdf->output();
                $path = "folhas/sala-{$sala->id}.pdf";
                Storage::put($path, $bytes);

                // Marcar sala como gerada
                $sala->update([
                    'folhas_geradas_por' => Auth::id(),
                    'folhas_geradas_em'  => now(),
                ]);

                // Registrar auditoria
                if (class_exists('\App\Models\AuditLog')) {
                    \App\Models\AuditLog::registar('gerou_folhas_sala', 'sala', $sala->id,
                        "Gerou folhas de prova para sala {$sala->nome} ({$sala->id}) — Candidatos: {$candidaturas->count()}");
                }

            } catch (\Throwable $e) {
                \Log::error('Falha ao gerar folhas de prova da sala: ' . $e->getMessage());
                // Não interromper a visualização — apenas logar
            }

            // Re-load sala to have fresh timestamps
            $sala->refresh();
        }

        return view('daac.salas.show', compact('sala', 'candidaturas'));
    }

    public function pdf(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        $pdf = Pdf::loadView('pdf.sala', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('sala-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . '.xlsx';
        return Excel::download(new SalaExameExport($sala), $filename);
    }

}
