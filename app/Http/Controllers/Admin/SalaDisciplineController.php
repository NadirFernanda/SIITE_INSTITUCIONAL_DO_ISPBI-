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
            // case-insensitive match for course_name
            $courseDisciplines = CourseDiscipline::whereRaw('LOWER(course_name) = ?', [strtolower($courseName)])->orderBy('id')->get();
        }

        return view('admin.salas.disciplines', compact('sala', 'disciplines', 'courseDisciplines'));
    }

    public function update(Request $request, Sala $sala)
    {
        $data = $request->validate([
            'disciplines' => 'required|array',
            'disciplines.*.discipline' => 'required|string|max:191',
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
