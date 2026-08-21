<?php

namespace App\Http\Controllers\Lancamento;

use App\Exports\SalaExameExportLancamento;
use App\Exports\SalasExameExportLoteLancamento;
use App\Http\Controllers\Concerns\DownloadsSalasEmLote;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Models\Sala;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaController extends Controller
{
    use DownloadsSalasEmLote;

    public function index()
    {
        $salas = Sala::withCount('candidaturas')->ordenadaPorHorario()->get();

        $totalCandidatos = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $atribuidos      = Candidatura::whereNotNull('sala_id')->count();
        $semSala         = $totalCandidatos - $atribuidos;
        $totalLugares    = $salas->sum('capacidade');

        $grupos = \DB::table('candidaturas')
            ->selectRaw("TRIM(curso) as curso,
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END as periodo,
                COUNT(*) as total")
            ->whereNotIn('status', ['rejeitada'])
            ->groupByRaw("TRIM(curso),
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END")
            ->orderByRaw("TRIM(curso),
                CASE WHEN LOWER(TRIM(periodo)) IN ('pos-laboral','pós-laboral','pos laboral','pós laboral','poslaboral')
                     THEN 'pos-laboral' ELSE 'regular' END")
            ->get();

        return view('lancamento.salas.index', compact(
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
        ));
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome,' . $sala->id,
            'capacidade' => 'required|integer|min:1|max:1000',
        ]);

        $sala->update($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('lancamento.salas.index')->with('success', 'Sala actualizada.');
    }

    public function destroy(Sala $sala)
    {
        Candidatura::where('sala_id', $sala->id)
                   ->update(['sala_id' => null, 'numero_lugar' => null]);
        $sala->delete();

        return redirect()->route('lancamento.salas.index')->with('success', 'Sala eliminada.');
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
        return view('lancamento.salas.show', compact('sala', 'candidaturas'));
    }

    /**
     * Distribui os candidatos pelas salas de acordo com o calendário oficial
     * dos Exames de Acesso (Sala::$agendaExames) — lógica partilhada com os
     * painéis Admin e Técnico via DistribuicaoSalasService.
     */
    public function distribuir(\App\Services\DistribuicaoSalasService $service)
    {
        $resultado = $service->distribuir();

        return redirect()->route('lancamento.salas.index')->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function limpar()
    {
        $count = Candidatura::whereNotNull('sala_id')->count();
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        AuditLog::registar('limpou_salas', null, null,
            "Distribuição removida — {$count} candidatos retirados das salas");

        return redirect()->route('lancamento.salas.index')
            ->with('success', 'Distribuição removida.');
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

    public function pdfExame(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
        $pdf = Pdf::loadView('pdf.sala-exame', compact('sala', 'candidaturas'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('lista-exame-' . \Str::slug($sala->nome) . '.pdf');
    }

    public function excelExame(Sala $sala)
    {
        return Excel::download(new SalaExameExportLancamento($sala),
            'lista-exame-' . \Str::slug($sala->nome) . '.xlsx');
    }

    // Substitui o excelExameLote() do trait DownloadsSalasEmLote — o Lançamento
    // usa a sua própria variante de exportação (SalaExameExportLancamento), não
    // a genérica usada pelos outros perfis.
    public function excelExameLote(Request $request)
    {
        $salas = $this->salasDoHorarioComCandidatos($request);

        if ($salas->isEmpty()) {
            return back()->with('error', 'Nenhuma sala com candidatos encontrada para esse horário.');
        }

        $filename = 'lista-exame-' . \Str::slug($request->input('horario')) . '.xlsx';
        return Excel::download(new SalasExameExportLoteLancamento($salas), $filename);
    }

    public function gerarCodigos(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->whereNotNull('numero_lugar')
            ->whereNull('codigo_exame')
            ->get();

        if ($candidaturas->isEmpty()) {
            return redirect()->route('lancamento.salas.show', $sala)
                ->with('error', 'Todos os candidatos desta sala já têm código de exame gerado.');
        }

        foreach ($candidaturas as $candidatura) {
            $candidatura->update(['codigo_exame' => Candidatura::gerarCodigoExame()]);
        }

        AuditLog::registar('gerou_codigos_exame', 'sala', $sala->id,
            "Códigos de exame gerados para {$candidaturas->count()} candidatos na sala {$sala->nome}");

        return redirect()->route('lancamento.salas.show', $sala)
            ->with('success', "{$candidaturas->count()} códigos de exame gerados para a sala {$sala->nome}.");
    }
}
