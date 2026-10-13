<?php

use App\Models\AlumniDocumento;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function isolateAlumniStorage(): void
{
    foreach (['public', 'alumni_private'] as $disk) {
        config(['filesystems.disks.'.$disk.'.root' => base_path('.test-runtime/files/'.bin2hex(random_bytes(8)).'/'.$disk)]);
        Storage::forgetDisk($disk);
    }
}

function securityDocument(string $disk = 'alumni_private'): AlumniDocumento
{
    $path = 'alumni-documentos/test.pdf';
    Storage::disk($disk)->put($path, '%PDF-private-test');

    return AlumniDocumento::create(['titulo' => 'Documento Teste', 'ficheiro' => $path]);
}

beforeEach(fn () => isolateAlumniStorage());

test('new alumni documents are uploaded only to the private disk', function () {
    $file = UploadedFile::fake()->createWithContent('documento.pdf', "%PDF-1.4\n1 0 obj\n<<>>\nendobj\n%%EOF");
    $this->actingAs(securityUser('admin'))->post(route('admin.alumni-documentos.store'), [
        'titulo' => 'Documento Privado', 'ficheiro' => $file,
    ])->assertRedirect(route('admin.alumni-documentos.index'))->assertSessionHasNoErrors();
    $document = AlumniDocumento::firstOrFail();
    expect(Storage::disk('alumni_private')->exists($document->ficheiro))->toBeTrue();
    expect(Storage::disk('public')->exists($document->ficheiro))->toBeFalse();
    expect(config('filesystems.disks.alumni_private.serve'))->toBeFalse();
    $this->get('/storage/'.$document->ficheiro)->assertNotFound();
});

test('approved alumni can download private and legacy documents', function (string $disk) {
    $document = securityDocument($disk);
    $response = $this->actingAs(securityUser('alumni'))->get(route('portal.documentos.download', $document));
    $response->assertOk()->assertDownload('test.pdf');
    expect($response->streamedContent())->toBe('%PDF-private-test');
    expect($response->headers->get('Cache-Control'))->toContain('no-store');
})->with(['alumni_private', 'public']);

test('portal documents require login approval and alumni role', function () {
    $document = securityDocument();
    $url = route('portal.documentos.download', $document);
    $this->get($url)->assertRedirect(route('login'));
    $this->actingAs(securityUser('alumni', false))->get($url)->assertRedirect(route('portal.pendente'));
    $this->actingAs(securityUser('tecnico'))->get($url)->assertRedirect(route('portal.login'));
});

test('missing or invalid document paths are not served', function () {
    $document = AlumniDocumento::create(['titulo' => 'Ausente', 'ficheiro' => 'alumni-documentos/missing.pdf']);
    $this->actingAs(securityUser('alumni'))->get(route('portal.documentos.download', $document))->assertNotFound();
    $document->update(['ficheiro' => '../secret.pdf']);
    $this->get(route('portal.documentos.download', $document))->assertNotFound();
});

test('document preparation is non destructive repeatable and supports dry run', function () {
    $document = securityDocument('public');
    $this->artisan('alumni:preparar-documentos-privados', ['--dry-run' => true])->assertSuccessful();
    expect(Storage::disk('alumni_private')->exists($document->ficheiro))->toBeFalse();
    $this->artisan('alumni:preparar-documentos-privados')->assertSuccessful();
    $this->artisan('alumni:preparar-documentos-privados')->assertSuccessful();
    expect(Storage::disk('public')->get($document->ficheiro))->toBe('%PDF-private-test');
    expect(Storage::disk('alumni_private')->get($document->ficheiro))->toBe('%PDF-private-test');
    expect($document->fresh()->ficheiro)->toBe($document->ficheiro);
});

test('document preparation reports conflicts and missing files without overwriting', function () {
    $document = securityDocument('public');
    Storage::disk('alumni_private')->put($document->ficheiro, 'different content');
    AlumniDocumento::create(['titulo' => 'Ausente', 'ficheiro' => 'alumni-documentos/missing.pdf']);
    $this->artisan('alumni:preparar-documentos-privados')->assertFailed();
    expect(Storage::disk('alumni_private')->get($document->ficheiro))->toBe('different content');
    expect(Storage::disk('public')->get($document->ficheiro))->toBe('%PDF-private-test');
});

test('roles containing alumni do not grant access to private documents', function (string $role) {
    $document = securityDocument();
    $this->actingAs(securityUser($role))->get(route('portal.documentos.download', $document))
        ->assertRedirect(route('portal.login'));
})->with(['superalumni', 'alumni administrador']);

test('preparation can resume after an interrupted temporary copy without serving partial content', function () {
    $document = securityDocument('public');
    $partial = $document->ficheiro.'.interrupted.partial';
    Storage::disk('alumni_private')->put($partial, 'incomplete');
    $this->actingAs(securityUser('alumni'))->get(route('portal.documentos.download', $document))->assertOk();
    $this->artisan('alumni:preparar-documentos-privados')->assertSuccessful();
    expect(Storage::disk('alumni_private')->get($document->ficheiro))->toBe('%PDF-private-test');
    expect(Storage::disk('alumni_private')->get($partial))->toBe('incomplete');
    expect(Storage::disk('public')->get($document->ficheiro))->toBe('%PDF-private-test');
    $this->artisan('alumni:preparar-documentos-privados')->assertSuccessful();
});

test('preparation reports a read failure continues inventory and can be safely repeated', function () {
    $document = securityDocument('public');
    $otherPath = 'alumni-documentos/other.pdf';
    Storage::disk('public')->put($otherPath, 'other content');
    AlumniDocumento::create(['titulo' => 'Outro', 'ficheiro' => $otherPath]);
    $manager = Storage::getFacadeRoot();
    $public = Storage::disk('public');
    $private = Storage::disk('alumni_private');
    $failingPublic = Mockery::mock($public);
    $failingPublic->shouldReceive('readStream')
        ->andReturnUsing(fn (string $path) => $public->readStream($path))->byDefault();
    $failingPublic->shouldReceive('readStream')->with($document->ficheiro)
        ->once()->andThrow(new RuntimeException('Falha simulada de leitura'));
    Storage::shouldReceive('disk')->with('public')->andReturn($failingPublic);
    Storage::shouldReceive('disk')->with('alumni_private')->andReturn($private);
    try {
        $this->artisan('alumni:preparar-documentos-privados')->assertFailed();
        expect($private->exists($document->ficheiro))->toBeFalse();
        expect($private->get($otherPath))->toBe('other content');
        expect($public->get($document->ficheiro))->toBe('%PDF-private-test');
    } finally {
        Storage::swap($manager);
    }
    $this->artisan('alumni:preparar-documentos-privados')->assertSuccessful();
    expect($private->get($document->ficheiro))->toBe('%PDF-private-test');
    expect($private->allFiles('alumni-documentos'))->toHaveCount(2);
});

test('preparation rejects traversal paths without reading or copying files', function () {
    AlumniDocumento::create(['titulo' => 'Inválido', 'ficheiro' => 'alumni-documentos/../secret.pdf']);
    $this->artisan('alumni:preparar-documentos-privados', ['--dry-run' => true])->assertFailed();
    $this->artisan('alumni:preparar-documentos-privados')->assertFailed();
    expect(Storage::disk('alumni_private')->allFiles())->toBeEmpty();
});
