<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalaExameExport;
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

        // Estatísticas para o painel
        $totalCandidatos   = Candidatura::whereNotIn('status', ['rejeitada'])->count();
        $atribuidos        = Candidatura::whereNotNull('sala_id')->count();
        $semSala           = $totalCandidatos - $atribuidos;
        $totalLugares      = $salas->sum('capacidade');

        // Grupos por curso+período (para mostrar na view)
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

        return view('admin.salas.index', compact(
            'salas', 'totalCandidatos', 'atribuidos', 'semSala', 'totalLugares', 'grupos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome',
            'capacidade' => 'required|integer|min:1|max:1000',
            'data_exame' => 'nullable|date',
            'horario'    => 'nullable|in:' . implode(',', Sala::$horarios),
        ], [
            'nome.unique' => 'Já existe uma sala com este nome.',
        ]);

        Sala::create($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('admin.salas.index')->with('success', 'Sala criada com sucesso.');
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nome'       => 'required|string|max:100|unique:salas,nome,' . $sala->id,
            'capacidade' => 'required|integer|min:1|max:1000',
            'data_exame' => 'nullable|date',
            'horario'    => 'nullable|in:' . implode(',', Sala::$horarios),
        ]);

        $sala->update($request->only('nome', 'capacidade', 'data_exame', 'horario'));

        return redirect()->route('admin.salas.index')->with('success', 'Sala actualizada.');
    }

    public function destroy(Sala $sala)
    {
        // Libertar candidatos desta sala antes de apagar
        Candidatura::where('sala_id', $sala->id)
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        $sala->delete();

        return redirect()->route('admin.salas.index')->with('success', 'Sala eliminada.');
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();

        return view('admin.salas.show', compact('sala', 'candidaturas'));
    }

    /**
     * Distribui os candidatos pelas salas de acordo com o calendário oficial
     * dos Exames de Acesso (Sala::$agendaExames) — lógica partilhada com os
     * painéis Técnico e Lançamento via DistribuicaoSalasService.
     */
    public function distribuir(Request $request, \App\Services\DistribuicaoSalasService $service)
    {
        $resultado = $service->distribuir();

        return redirect()->route('admin.salas.index')->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function limpar()
    {
        $count = Candidatura::whereNotNull('sala_id')->count();
        Candidatura::whereNotNull('sala_id')
                   ->update(['sala_id' => null, 'numero_lugar' => null]);

        AuditLog::registar('limpou_salas', null, null,
            "Distribuição removida — {$count} candidatos retirados das salas");

        return redirect()->route('admin.salas.index')
            ->with('success', 'Distribuição removida. Todos os candidatos foram retirados das salas.');
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
        $filename = 'lista-exame-' . \Str::slug($sala->nome) . '.xlsx';
        return Excel::download(new SalaExameExport($sala), $filename);
    }

}
