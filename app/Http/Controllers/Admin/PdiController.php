<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Midia;
use App\Models\SiteSetting;
use App\Support\PdiContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class PdiController extends Controller
{
    public function index()
    {
        $photoPath = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);
        $pdfPath = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        return view('admin.pdi', [
            'photoUrl' => PdiContent::photoUrl(),
            'hasPhotoOverride' => Midia::isManagedPdiPhotoPath($photoPath)
                && Storage::disk('public')->exists($photoPath),
            'pdfDisponivel' => Midia::isManagedPdiPdfPath($pdfPath)
                && Storage::disk('local')->exists($pdfPath),
            'pdfPublicado' => SiteSetting::pdiPdfPublicado(),
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'fotografia' => ['required', 'file', 'max:10240', 'image', 'mimetypes:image/jpeg,image/png,image/webp', 'extensions:jpg,jpeg,png,webp'],
        ]);

        $file = $request->file('fotografia');
        $extension = strtolower($file->getClientOriginalExtension());
        $expectedMime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        };

        if ($file->getMimeType() !== $expectedMime || @getimagesize($file->getRealPath()) === false) {
            throw ValidationException::withMessages([
                'fotografia' => 'Seleccione uma fotografia JPG, PNG ou WebP válida.',
            ]);
        }

        $disk = Storage::disk('public');
        try {
            $newPath = $file->store('pdi/fotografias', 'public');
            $stored = $newPath && $disk->exists($newPath);
        } catch (Throwable $e) {
            report($e);
            return back()->withErrors(['fotografia' => 'Não foi possível guardar a fotografia. A imagem anterior mantém-se.']);
        }

        if (! $stored) {
            return back()->withErrors(['fotografia' => 'Não foi possível guardar a fotografia. A imagem anterior mantém-se.']);
        }

        try {
            $oldPath = $this->saveAssetPath(Midia::PDI_FOTOGRAFIA_NOME, $newPath);
        } catch (Throwable $e) {
            $disk->delete($newPath);
            report($e);
            return back()->withErrors(['fotografia' => 'Não foi possível publicar a fotografia. A imagem anterior mantém-se.']);
        }

        if (Midia::isManagedPdiPhotoPath($oldPath) && $oldPath !== $newPath) {
            $disk->delete($oldPath);
        }

        return redirect()->route('admin.pdi')->with('success', 'Fotografia do PDI publicada.');
    }

    public function removePhoto(Request $request)
    {
        $request->validate(['confirmar_remocao' => ['required', 'accepted']]);

        try {
            $oldPath = $this->saveAssetPath(Midia::PDI_FOTOGRAFIA_NOME, '');
        } catch (Throwable $e) {
            report($e);
            return back()->withErrors(['fotografia' => 'Não foi possível remover a fotografia. A imagem anterior mantém-se.']);
        }

        if (Midia::isManagedPdiPhotoPath($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        return redirect()->route('admin.pdi')->with('success', 'Fotografia substituta removida.');
    }

    public function uploadPdf(Request $request)
    {
        $request->validate([
            'documento' => ['required', 'file', 'max:25600', 'mimetypes:application/pdf', 'extensions:pdf'],
            'aprovar_publicacao' => ['sometimes', 'accepted'],
        ]);

        $file = $request->file('documento');
        $handle = fopen($file->getRealPath(), 'rb');
        $header = $handle ? fread($handle, 5) : false;
        if ($handle) {
            fclose($handle);
        }
        if ($header !== '%PDF-') {
            throw ValidationException::withMessages([
                'documento' => 'Seleccione um PDF válido.',
            ]);
        }

        $disk = Storage::disk('local');
        try {
            $newPath = $file->store('pdi/documentos', 'local');
            $stored = $newPath && $disk->exists($newPath);
        } catch (Throwable $e) {
            report($e);
            return back()->withErrors(['documento' => 'Não foi possível guardar o PDF. O documento anterior mantém-se.']);
        }

        if (! $stored) {
            return back()->withErrors(['documento' => 'Não foi possível guardar o PDF. O documento anterior mantém-se.']);
        }

        try {
            $oldPath = DB::transaction(function () use ($newPath, $request) {
                $oldPath = $this->updateAssetRecord(Midia::PDI_DOCUMENTO_NOME, $newPath);
                SiteSetting::query()->updateOrCreate(
                    ['key' => SiteSetting::PDI_PDF_PUBLICADO],
                    ['value' => $request->boolean('aprovar_publicacao')]
                );
                return $oldPath;
            });
        } catch (Throwable $e) {
            $disk->delete($newPath);
            report($e);
            return back()->withErrors(['documento' => 'Não foi possível actualizar o PDF. O documento anterior mantém-se.']);
        }

        if (Midia::isManagedPdiPdfPath($oldPath) && $oldPath !== $newPath) {
            $disk->delete($oldPath);
        }

        return redirect()->route('admin.pdi')->with('success', $request->boolean('aprovar_publicacao')
            ? 'PDF do PDI carregado e publicado.'
            : 'PDF do PDI carregado como rascunho.');
    }

    public function setPdfPublication(Request $request)
    {
        $data = $request->validate(['publicar' => ['required', 'boolean']]);
        $publish = (bool) $data['publicar'];

        if ($publish) {
            $request->validate(['confirmar_aprovacao' => ['required', 'accepted']]);
            $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);
            if (! Midia::isManagedPdiPdfPath($path) || ! Storage::disk('local')->exists($path)) {
                return back()->withErrors(['documento' => 'Carregue primeiro o PDF oficial do PDI.']);
            }
        }

        try {
            SiteSetting::query()->updateOrCreate(
                ['key' => SiteSetting::PDI_PDF_PUBLICADO],
                ['value' => $publish]
            );
        } catch (Throwable $e) {
            report($e);
            return back()->withErrors(['documento' => 'Não foi possível alterar a publicação do PDF.']);
        }

        return redirect()->route('admin.pdi')->with('success', $publish
            ? 'PDF do PDI aprovado para publicação.'
            : 'PDF do PDI retirado da página pública.');
    }

    public function previewPdf()
    {
        $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);
        abort_unless(Midia::isManagedPdiPdfPath($path), 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($path), 404);

        return response()->file($disk->path($path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="PDI-2026-2031-ISP-Bie.pdf"',
            'Cache-Control' => 'no-store, private',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function removePdf(Request $request)
    {
        $request->validate(['confirmar_remocao' => ['required', 'accepted']]);

        try {
            $oldPath = DB::transaction(function () {
                $oldPath = $this->updateAssetRecord(Midia::PDI_DOCUMENTO_NOME, '');
                SiteSetting::query()->updateOrCreate(
                    ['key' => SiteSetting::PDI_PDF_PUBLICADO],
                    ['value' => false]
                );
                return $oldPath;
            });
        } catch (Throwable $e) {
            report($e);
            return back()->withErrors(['documento' => 'Não foi possível remover o PDF. O documento anterior mantém-se.']);
        }

        if (Midia::isManagedPdiPdfPath($oldPath)) {
            Storage::disk('local')->delete($oldPath);
        }

        return redirect()->route('admin.pdi')->with('success', 'PDF do PDI removido.');
    }

    private function saveAssetPath(string $name, string $path): ?string
    {
        return DB::transaction(fn () => $this->updateAssetRecord($name, $path));
    }

    private function updateAssetRecord(string $name, string $path): ?string
    {
        $record = Midia::query()->where('nome', $name)->orderBy('id')->lockForUpdate()->first();
        $oldPath = $record?->caminho;

        if ($record) {
            $record->update(['caminho' => $path]);
        } else {
            Midia::create(['nome' => $name, 'caminho' => $path]);
        }

        return $oldPath;
    }
}
