<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Midia;
use App\Models\SiteSetting;
use App\Models\Candidatura;
use App\Support\CourseEntryProfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class ConfiguracaoController extends Controller
{
    public function index(CourseEntryProfiles $profiles)
    {
        $formularioAtivo = SiteSetting::candidaturasAtivas();
        $cursos = Candidatura::$cursos;
        $perfisAdicionados = $profiles->additions();

        $organigramaPath = Midia::organigramaPath();
        $organigramaUrl = $organigramaPath === null
            ? asset('images/organigrama.jpeg')
            : ($organigramaPath !== '' && Midia::isManagedOrganigramaPath($organigramaPath)
                ? route('presidencia.organigrama')
                : null);

        return view('admin.configuracoes', compact('formularioAtivo', 'organigramaUrl', 'cursos', 'perfisAdicionados'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'candidaturas_ativas' => ['required', 'boolean'],
        ]);

        SiteSetting::query()->updateOrCreate(
            ['key' => SiteSetting::CANDIDATURAS_ATIVAS],
            ['value' => (bool) $validated['candidaturas_ativas']]
        );

        return redirect()->route('admin.configuracoes')
            ->with('success', $validated['candidaturas_ativas']
                ? 'Formulário de candidaturas activado.'
                : 'Formulário de candidaturas desactivado.');
    }

    public function uploadOrganigrama(Request $request)
    {
        $request->validate([
            'organigrama' => ['required', 'file', 'max:5120', 'image', 'mimetypes:image/jpeg,image/png,image/webp', 'extensions:jpg,jpeg,png,webp'],
        ]);

        $file = $request->file('organigrama');
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();
        $expectedMime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        };

        if ($mime !== $expectedMime || @getimagesize($file->getRealPath()) === false) {
            throw ValidationException::withMessages([
                'organigrama' => 'O ficheiro deve ser uma imagem JPG, PNG ou WebP válida.',
            ]);
        }

        $disk = Storage::disk('public');
        try {
            $newPath = $file->store('organigramas', 'public');
            $stored = $newPath && $disk->exists($newPath);
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['organigrama' => 'Não foi possível guardar a imagem. O organigrama publicado mantém-se.']);
        }
        if (! $stored) {
            return back()->withErrors(['organigrama' => 'Não foi possível guardar a imagem. O organigrama publicado mantém-se.']);
        }

        try {
            $oldPath = DB::transaction(function () use ($newPath) {
                $record = Midia::query()->where('nome', Midia::ORGANIGRAMA_NOME)
                    ->orderBy('id')->lockForUpdate()->first();
                $oldPath = $record?->caminho;
                if ($record) {
                    $record->update(['caminho' => $newPath]);
                } else {
                    Midia::create(['nome' => Midia::ORGANIGRAMA_NOME, 'caminho' => $newPath]);
                }

                return $oldPath;
            });
        } catch (Throwable $e) {
            $disk->delete($newPath);
            report($e);

            return back()->withErrors(['organigrama' => 'Não foi possível publicar a imagem. O organigrama anterior mantém-se.']);
        }

        if (Midia::isManagedOrganigramaPath($oldPath) && $oldPath !== $newPath) {
            $disk->delete($oldPath);
        }

        return redirect()->route('admin.configuracoes')
            ->with('success', 'Organigrama institucional publicado com sucesso.');
    }

    public function removeOrganigrama(Request $request)
    {
        $request->validate(['confirmar_remocao' => ['required', 'accepted']]);

        try {
            $oldPath = DB::transaction(function () {
                $record = Midia::query()->where('nome', Midia::ORGANIGRAMA_NOME)
                    ->orderBy('id')->lockForUpdate()->first();
                $oldPath = $record?->caminho;
                if ($record) {
                    $record->update(['caminho' => '']);
                } else {
                    Midia::create(['nome' => Midia::ORGANIGRAMA_NOME, 'caminho' => '']);
                }

                return $oldPath;
            });
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['organigrama' => 'Não foi possível remover o organigrama. A imagem publicada mantém-se.']);
        }

        if (Midia::isManagedOrganigramaPath($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        return redirect()->route('admin.configuracoes')
            ->with('success', 'Organigrama institucional removido.');
    }
}
