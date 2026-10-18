<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidatura;
use App\Support\CourseEntryProfiles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class CourseEntryProfileController extends Controller
{
    public function store(Request $request, CourseEntryProfiles $profiles)
    {
        $data = $request->validate([
            'course' => ['required', 'string', Rule::in(Candidatura::$cursos)],
            'profile' => ['required', 'string', 'min:2', 'max:150'],
        ]);
        $profile = preg_replace('/\s+/u', ' ', trim($data['profile']));
        if ($profile === null || preg_match('/[<>\x00-\x1F\x7F]/u', $profile)) {
            throw ValidationException::withMessages(['profile' => 'Indique uma designação válida para o perfil.']);
        }

        try {
            if (! $profiles->add($data['course'], $profile)) {
                throw ValidationException::withMessages(['profile' => 'Este perfil já consta da lista do curso.']);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['profile' => 'Não foi possível guardar o perfil. A lista anterior mantém-se.']);
        }

        return redirect()->route('admin.configuracoes')
            ->with('success', 'Perfil de precedência acrescentado ao curso.')
            ->with('updated_course', $data['course']);
    }

    public function destroy(Request $request, CourseEntryProfiles $profiles)
    {
        $data = $request->validate([
            'course' => ['required', 'string', Rule::in(Candidatura::$cursos)],
            'profile' => ['required', 'string', 'max:150'],
            'confirm_remove' => ['required', 'accepted'],
        ]);

        try {
            if (! $profiles->remove($data['course'], $data['profile'])) {
                throw ValidationException::withMessages(['profile' => 'Só é possível remover perfis acrescentados pelo painel.']);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['profile' => 'Não foi possível remover o perfil. A lista anterior mantém-se.']);
        }

        return redirect()->route('admin.configuracoes')
            ->with('success', 'Perfil de precedência removido do curso.')
            ->with('updated_course', $data['course']);
    }
}
