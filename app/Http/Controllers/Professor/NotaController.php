<?php
namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    /**
     * Lista anónima — professor vê APENAS código de exame, curso e período.
     * Nenhum dado pessoal do candidato é exposto.
     */
    public function index(Request $request)
    {
        $q = Candidatura::where('pagamento_confirmado', true)
            ->with('nota');

        if ($request->filled('curso')) {
            $q->where('curso', $request->input('curso'));
        }
        if ($request->input('estado') === 'por_lancar') {
            $q->doesntHave('nota');
        } elseif ($request->input('estado') === 'lancada') {
            $q->has('nota');
        }
        if ($request->filled('codigo')) {
            $q->where('codigo_exame', strtoupper(trim($request->input('codigo'))));
        }

        $candidaturas = $q->orderBy('codigo_exame')->paginate(30)->withQueryString();

        $totais = [
            'total'      => Candidatura::where('pagamento_confirmado', true)->count(),
            'lancadas'   => Nota::count(),
            'por_lancar' => Candidatura::where('pagamento_confirmado', true)->doesntHave('nota')->count(),
        ];

        $cursos = \App\Models\Candidatura::$cursos;

        return view('professor.notas.index', compact('candidaturas', 'totais', 'cursos'));
    }

    /**
     * Formulário de lançamento — apenas informação anónima visível.
     */
    public function show(Candidatura $candidatura)
    {
        if (! $candidatura->pagamento_confirmado) {
            return redirect()->route('professor.notas.index')
                ->with('error', 'Este candidato ainda não tem pagamento confirmado.');
        }

        // Carregar a nota existente (se já foi lançada)
        $nota = $candidatura->nota;

        return view('professor.notas.lancamento', compact('candidatura', 'nota'));
    }

    /**
     * Guardar nota — bloqueia se já existir nota lançada por outro professor.
     */
    public function store(Request $request, Candidatura $candidatura)
    {
        if (! $candidatura->pagamento_confirmado) {
            return back()->with('error', 'Pagamento não confirmado.');
        }

        // Se já existe nota lançada por OUTRO professor, bloquear
        if ($candidatura->nota && $candidatura->nota->professor_id !== Auth::id()) {
            return back()->with('error', 'Este código já tem nota lançada por outro professor.');
        }

        $request->validate([
            'nota'        => 'required|numeric|min:0|max:20',
            'observacoes' => 'nullable|string|max:500',
        ], [
            'nota.required' => 'A nota é obrigatória.',
            'nota.numeric'  => 'A nota deve ser um número.',
            'nota.min'      => 'A nota mínima é 0.',
            'nota.max'      => 'A nota máxima é 20.',
        ]);

        $notaValor = round((float) $request->input('nota'), 1);

        if ($candidatura->nota) {
            // Actualizar nota própria
            $candidatura->nota->update([
                'nota'        => $notaValor,
                'observacoes' => $request->input('observacoes'),
                'lancada_em'  => now(),
            ]);
            $acao = 'corrigiu_nota';
        } else {
            Nota::create([
                'candidatura_id' => $candidatura->id,
                'professor_id'   => Auth::id(),
                'nota'           => $notaValor,
                'observacoes'    => $request->input('observacoes'),
                'lancada_em'     => now(),
            ]);
            $acao = 'lancou_nota';
        }

        AuditLog::registar($acao, 'candidatura', $candidatura->id,
            "Código: {$candidatura->codigo_exame} | Nota: {$notaValor} | Prof.: " . Auth::user()->name);

        return redirect()->route('professor.notas.index')
            ->with('success', "Nota {$notaValor} lançada para o código {$candidatura->codigo_exame}.");
    }
}
