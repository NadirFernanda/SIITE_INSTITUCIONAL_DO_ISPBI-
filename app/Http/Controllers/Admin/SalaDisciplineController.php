<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\SalaDiscipline;
use App\Models\CourseDiscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaDisciplineController extends Controller
{
    public function edit(Sala $sala)
    {
        $sala->load(['candidaturas']);
        $disciplines = SalaDiscipline::where('sala_id', $sala->id)->orderBy('id')->get();

        // Try to determine the main course for this sala from assigned candidaturas
        $courseName = null;
        if ($sala->candidaturas->isNotEmpty()) {
            $courseName = $sala->candidaturas->first()->curso;
        }

        $courseDisciplines = collect();
        if ($courseName) {
            // Build a normalized map of course_name => collection to allow robust matching
            $all = CourseDiscipline::orderBy('id')->get();

            $normalize = function ($s) {
                // remove accents and non-alphanum, lowercase
                $s = (string) $s;
                $s = iconv('UTF-8', 'ASCII//TRANSLIT', $s);
                $s = strtolower($s);
                $s = preg_replace('/[^a-z0-9 ]+/', '', $s);
                $s = trim($s);
                return $s;
            };

            $map = [];
            foreach ($all as $row) {
                $key = $normalize($row->course_name);
                $map[$key][] = $row;
            }

            $candidates = $sala->candidaturas->pluck('curso')->unique()->values();
            foreach ($candidates as $cn) {
                $norm = $normalize($cn);
                // exact normalized match
                if (isset($map[$norm])) {
                    $courseDisciplines = collect($map[$norm]);
                    break;
                }
                // partial match: key contains norm or norm contains key
                foreach ($map as $k => $rows) {
                    if ($k !== '' && (str_contains($k, $norm) || str_contains($norm, $k))) {
                        $courseDisciplines = collect($rows);
                        break 2;
                    }
                }
            }
        }

        return view('admin.salas.disciplines', compact('sala', 'disciplines', 'courseDisciplines'));
    }

    public function update(Request $request, Sala $sala)
    {
        $data = $request->validate([
            'disciplines' => 'required|array',
            'disciplines.*.discipline' => 'required|string|max:191|distinct',
            'disciplines.*.weight' => 'required|integer|min:0|max:100',
        ], [
            'disciplines.required' => 'Adicione pelo menos uma disciplina.',
        ]);

        DB::transaction(function () use ($sala, $data) {
            // Remove existing entries not present in payload
            $incoming = collect($data['disciplines'])->map(fn($d) => trim($d['discipline']))->filter()->values();

            SalaDiscipline::where('sala_id', $sala->id)
                ->whereNotIn('discipline', $incoming)
                ->delete();

            foreach ($data['disciplines'] as $d) {
                $name = trim($d['discipline']);
                if ($name === '') continue;
                SalaDiscipline::updateOrCreate(
                    ['sala_id' => $sala->id, 'discipline' => $name],
                    ['weight_percent' => (int) $d['weight']]
                );
            }
        });

        return redirect()->route('admin.salas.disciplines.edit', $sala)
            ->with('success', 'Disciplinas da sala atualizadas com sucesso.');
    }
}
