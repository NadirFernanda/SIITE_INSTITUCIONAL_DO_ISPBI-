<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnus;
use App\Models\User;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminAlumniController extends Controller
{
    public function index(Request $request)
    {
        $filters = $this->validatedFilters($request);
        $alumni = $this->filteredQuery($filters)->orderByDesc('created_at')->get();
        $allAlumni = Alumnus::query()->get();

        $pendingCount = User::where('role', 'alumni')
            ->where('aprovado', false)
            ->count();

        return view('admin.alumni', [
            'alumni' => $alumni,
            'pendingCount' => $pendingCount,
            'filters' => $filters,
            'filterOptions' => [
                'cursos' => $allAlumni->pluck('curso')->filter()->unique()->sort()->values(),
                'anos' => $allAlumni->pluck('ano')->filter()->unique()->sortDesc()->values(),
                'paises' => $allAlumni->pluck('pais')->filter()->unique()->sort()->values(),
            ],
        ]);
    }

    public function export(Request $request)
    {
        $filters = $this->validatedFilters($request);
        $alumni = $this->filteredQuery($filters)->orderByDesc('created_at')->get();

        return Excel::download(new AlumniExport($alumni), 'alumni-' . now()->format('Y-m-d_H-i') . '.xlsx');
    }

    private function validatedFilters(Request $request): array
    {
        return $request->validate([
            'estado' => 'nullable|in:todos,trabalha,nao_trabalha',
            'curso' => 'nullable|string|max:255',
            'ano' => 'nullable|integer|min:1950|max:2100',
            'pais' => 'nullable|string|max:100',
            'pesquisa' => 'nullable|string|max:100',
        ]);
    }

    private function filteredQuery(array $filters)
    {
        $query = Alumnus::with('user');

        if (($filters['estado'] ?? 'todos') === 'trabalha') {
            $query->where('trabalha', true);
        } elseif (($filters['estado'] ?? 'todos') === 'nao_trabalha') {
            $query->where('trabalha', false);
        }

        return $query
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
    }

    public function togglePublicar($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->publicado = ! $alumnus->publicado;
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Estado de publicação actualizado.');
    }

    public function toggleTestemunho($id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->testemunho = ! $alumnus->testemunho;
        if ($alumnus->testemunho) {
            $alumnus->publicado = true;
        }
        $alumnus->save();
        return redirect()->route('admin.alumni')->with('success', 'Estado de testemunho actualizado.');
    }

    public function aprovar($id)
    {
        $alumnus = Alumnus::with('user')->findOrFail($id);

        if ($alumnus->user) {
            $alumnus->user->forceFill(['aprovado' => true])->save();
        }

        return redirect()->route('admin.alumni')->with('success', 'Utilizador aprovado no portal alumni.');
    }

    public function revogar($id)
    {
        $alumnus = Alumnus::with('user')->findOrFail($id);

        if ($alumnus->user) {
            $alumnus->user->forceFill(['aprovado' => false])->save();
        }

        return redirect()->route('admin.alumni')->with('success', 'Acesso ao portal alumni revogado.');
    }
}
