<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnus;
use App\Services\AlumniIdentityService;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'estado' => 'nullable|in:todos,trabalha,nao_trabalha',
            'curso' => 'nullable|string|max:255',
            'ano' => 'nullable|integer|min:1950|max:' . now()->year,
            'pais' => 'nullable|string|max:100',
            'pesquisa' => 'nullable|string|max:100',
        ]);

        $query = Alumnus::completed()->where('publicado', true);

        if (($filters['estado'] ?? 'todos') === 'trabalha') {
            $query->where('trabalha', true);
        } elseif (($filters['estado'] ?? 'todos') === 'nao_trabalha') {
            $query->where('trabalha', false);
        }

        $query
            ->when($filters['curso'] ?? null, fn ($q, $curso) => $q->where('curso', $curso))
            ->when($filters['ano'] ?? null, fn ($q, $ano) => $q->where('ano', $ano))
            ->when($filters['pais'] ?? null, fn ($q, $pais) => $q->where('pais', $pais))
            ->when($filters['pesquisa'] ?? null, function ($q, $pesquisa) {
                $term = '%' . addcslashes($pesquisa, '%_') . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('nome', 'like', $term)
                        ->orWhere('curso', 'like', $term)
                        ->orWhere('empresa', 'like', $term)
                        ->orWhere('cargo', 'like', $term);
                });
            });

        $alumni = $query->orderByDesc('created_at')->get();
        $published = Alumnus::completed()->where('publicado', true)->get();
        $working = $alumni->where('trabalha', true)->count();

        return view('pages.alumni', [
            'alumni' => $alumni,
            'filters' => $filters,
            'filterOptions' => [
                'cursos' => $published->pluck('curso')->filter()->unique()->sort()->values(),
                'anos' => $published->pluck('ano')->filter()->unique()->sortDesc()->values(),
                'paises' => $published->pluck('pais')->filter()->unique()->sort()->values(),
            ],
            'stats' => [
                'total' => $alumni->count(),
                'working' => $working,
                'notWorking' => $alumni->where('trabalha', false)->count(),
                'employability' => $alumni->count() > 0 ? (int) round($working / $alumni->count() * 100) : 0,
                'countries' => $alumni->where('trabalha', true)->pluck('pais')->filter()->unique()->count(),
                'companies' => $alumni->where('trabalha', true)->pluck('empresa')->filter()->unique()->count(),
                'byCourse' => $alumni->groupBy('curso')->map->count()->sortDesc(),
                'byCountry' => $alumni->where('trabalha', true)->pluck('pais')->filter()->countBy()->sortDesc(),
            ],
        ]);
    }

    public function show($id)
    {
        $alumnus = Alumnus::completed()->where('id', $id)
            ->where('publicado', true)
            ->where('testemunho', true)
            ->firstOrFail();

        return view('pages.alumni-show', compact('alumnus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'      => 'required|string|max:255',
            'curso'     => 'required|string|max:255',
            'ano'       => 'required|integer|min:1950|max:' . now()->year,
            'contacto'  => 'required|string|max:255',
            'email'     => 'required|email:rfc,dns|max:255',
            'trabalha'  => 'required|in:sim,nao',
            'empresa'   => 'nullable|string|max:255',
            'pais'      => 'nullable|string|max:100',
            'cargo'     => 'nullable|string|max:255',
            'satisfacao'=> 'nullable|string|max:5000',
        ]);

        $trabalha = $validated['trabalha'] === 'sim';

        if (AlumniIdentityService::matches($validated['nome'], $validated['curso'], (int) $validated['ano'])->isNotEmpty()) {
            return back()->withInput()->withErrors([
                'nome' => 'Este alumni já está registado. Se já possui conta, utilize o Portal Alumni.',
            ]);
        }

        $alumnus = new Alumnus();
        $alumnus->nome      = $validated['nome'];
        $alumnus->curso     = $validated['curso'];
        $alumnus->ano       = $validated['ano'];
        $alumnus->contacto  = $validated['contacto'];
        $alumnus->email     = $validated['email'];
        $alumnus->trabalha  = $trabalha;
        $alumnus->empresa   = $trabalha ? ($validated['empresa'] ?? null) : null;
        $alumnus->pais      = $trabalha ? ($validated['pais'] ?? null) : null;
        $alumnus->cargo     = $trabalha ? ($validated['cargo'] ?? null) : null;
        $alumnus->satisfacao= $trabalha ? ($validated['satisfacao'] ?? null) : null;
        $alumnus->save();

        return redirect()->route('alumni')->with('success', 'Cadastro enviado com sucesso!');
    }
}
