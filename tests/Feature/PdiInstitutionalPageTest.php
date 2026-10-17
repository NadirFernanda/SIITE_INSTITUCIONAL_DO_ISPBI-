<?php

namespace Tests\Feature;

use App\Models\Midia;
use App\Models\SiteSetting;
use App\Models\User;
use App\Support\PdiContent;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class PdiInstitutionalPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if ($this->app->configurationIsCached()
            || config('app.env') !== 'testing'
            || config('database.default') !== 'sqlite'
            || config('database.connections.sqlite.database') !== ':memory:'
            || DB::connection()->getDatabaseName() !== ':memory:') {
            throw new RuntimeException('Testes recusados: a base de dados não é SQLite em memória.');
        }

        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->boolean('value')->default(false);
        });
        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        Storage::fake('public');
        Storage::fake('local');
        $this->withHeader('User-Agent', 'PdiTestBot');
    }

    public function test_public_page_has_exactly_seven_pillars_and_no_unapproved_pdf(): void
    {
        $response = $this->get(route('pdi'))->assertOk()
            ->assertSee('Plano de Desenvolvimento Institucional')
            ->assertSee('PDI 2026–2031')
            ->assertDontSee(route('pdi.documento'));

        $titles = [
            'Qualidade Académica e Acreditação',
            'Inovação STEAM e Modernização Digital',
            'Infraestruturas e Laboratórios',
            'Desenvolvimento do Capital Humano',
            'Investigação, Extensão e Impacto Comunitário',
            'Empreendedorismo e Relação Universidade–Sociedade',
            'Governação, Transparência e Sustentabilidade',
        ];
        foreach ($titles as $title) {
            $response->assertSee($title);
            $this->assertSame(1, substr_count($response->getContent(), $title));
        }
        $response->assertSee(route('pdi')); // desktop and mobile institutional menu
        $this->get(route('pdi.documento'))->assertNotFound();

        $this->assertFileExists(public_path(PdiContent::ORIGINAL_PHOTO));
        $this->assertSame(
            '4267F9335D566B72D81F96C65D953ED3B1647B35A00EE685EAFBD6DF861206C1',
            strtoupper(hash_file('sha256', public_path(PdiContent::ORIGINAL_PHOTO)))
        );
        $response->assertSee(asset(PdiContent::ORIGINAL_PHOTO));
    }

    public function test_admin_photo_upload_and_replacement_are_public_and_remove_old_file(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.jpg', 1200, 800),
        ])->assertRedirect(route('admin.pdi'))->assertSessionHas('success');

        $oldPath = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);
        $this->assertTrue(Midia::isManagedPdiPhotoPath($oldPath));
        Storage::disk('public')->assertExists($oldPath);
        $this->get(route('pdi'))->assertOk()->assertSee(route('pdi.fotografia'));
        $this->get(route('pdi.fotografia'))->assertOk()->assertHeader('Content-Type', 'image/jpeg');

        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.webp', 1200, 800),
        ])->assertRedirect(route('admin.pdi'));
        $newPath = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);
        $this->assertNotSame($oldPath, $newPath);
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($newPath);
        $this->get(route('pdi.fotografia'))->assertOk()->assertHeader('Content-Type', 'image/webp');
    }

    public function test_invalid_photo_and_failed_database_update_keep_current_photo(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.png'),
        ])->assertRedirect(route('admin.pdi'));
        $oldPath = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);

        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->createWithContent('falso.png', '<script>bad</script>'),
        ])->assertSessionHasErrors('fotografia');
        $png = UploadedFile::fake()->image('painel.png');
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => new UploadedFile($png->getPathname(), 'falso.jpg', 'image/jpeg', null, true),
        ])->assertSessionHasErrors('fotografia');

        DB::statement("CREATE TRIGGER block_pdi_photo BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('novo.png'),
        ])->assertSessionHasErrors('fotografia');

        $this->assertSame($oldPath, Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME));
        Storage::disk('public')->assertExists($oldPath);
        $this->assertCount(1, Storage::disk('public')->files('pdi/fotografias'));
    }

    public function test_removing_photo_requires_confirmation_and_restores_original(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.png'),
        ])->assertRedirect(route('admin.pdi'));
        $path = Midia::pdiPath(Midia::PDI_FOTOGRAFIA_NOME);

        $this->delete(route('admin.pdi.fotografia.remove'))
            ->assertSessionHasErrors('confirmar_remocao');
        Storage::disk('public')->assertExists($path);

        $this->delete(route('admin.pdi.fotografia.remove'), ['confirmar_remocao' => '1'])
            ->assertRedirect(route('admin.pdi'));
        Storage::disk('public')->assertMissing($path);
        $this->get(route('pdi'))->assertOk()
            ->assertSee(asset(PdiContent::ORIGINAL_PHOTO))
            ->assertDontSee(route('pdi.fotografia'));
    }

    public function test_pdf_remains_private_until_an_admin_approves_it(): void
    {
        $this->actingAs($this->user('admin'));
        $this->uploadPdf();
        $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        $this->assertTrue(Midia::isManagedPdiPdfPath($path));
        Storage::disk('local')->assertExists($path);
        $this->assertFalse(SiteSetting::pdiPdfPublicado());
        $this->get(route('pdi'))->assertOk()->assertDontSee(route('pdi.documento'));
        $this->get(route('pdi.documento'))->assertNotFound();
        $this->get(route('admin.pdi.documento.preview'))->assertOk()->assertHeader('Content-Type', 'application/pdf');

        $this->patch(route('admin.pdi.documento.publicacao'), ['publicar' => '1'])
            ->assertSessionHasErrors('confirmar_aprovacao');
        $this->patch(route('admin.pdi.documento.publicacao'), [
            'publicar' => '1', 'confirmar_aprovacao' => '1',
        ])->assertRedirect(route('admin.pdi'));

        $this->assertTrue(SiteSetting::pdiPdfPublicado());
        $this->get(route('pdi'))->assertOk()->assertSee(route('pdi.documento'));
        $this->get(route('pdi.documento'))->assertOk()->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_replacing_pdf_without_approval_unpublishes_old_document(): void
    {
        $this->actingAs($this->user('admin'));
        $this->uploadPdf(['aprovar_publicacao' => '1']);
        $oldPath = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);
        $this->assertTrue(SiteSetting::pdiPdfPublicado());

        $this->uploadPdf();
        $newPath = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        $this->assertNotSame($oldPath, $newPath);
        Storage::disk('local')->assertMissing($oldPath);
        Storage::disk('local')->assertExists($newPath);
        $this->assertFalse(SiteSetting::pdiPdfPublicado());
        $this->get(route('pdi.documento'))->assertNotFound();
    }

    public function test_invalid_pdf_and_failed_replacement_keep_published_document(): void
    {
        $this->actingAs($this->user('admin'));
        $this->uploadPdf(['aprovar_publicacao' => '1']);
        $oldPath = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        $this->post(route('admin.pdi.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent('falso.pdf', '<html>not a pdf</html>'),
        ])->assertSessionHasErrors('documento');

        DB::statement("CREATE TRIGGER block_pdi_pdf BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.pdi.documento.upload'), [
            'documento' => $this->fakePdf(),
        ])->assertSessionHasErrors('documento');

        $this->assertSame($oldPath, Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME));
        Storage::disk('local')->assertExists($oldPath);
        $this->assertCount(1, Storage::disk('local')->files('pdi/documentos'));
        $this->assertTrue(SiteSetting::pdiPdfPublicado());
        $this->get(route('pdi.documento'))->assertOk();
    }

    public function test_removing_pdf_requires_confirmation_and_hides_public_document(): void
    {
        $this->actingAs($this->user('admin'));
        $this->uploadPdf(['aprovar_publicacao' => '1']);
        $path = Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME);

        $this->delete(route('admin.pdi.documento.remove'))->assertSessionHasErrors('confirmar_remocao');
        $this->assertTrue(SiteSetting::pdiPdfPublicado());

        $this->delete(route('admin.pdi.documento.remove'), ['confirmar_remocao' => '1'])
            ->assertRedirect(route('admin.pdi'));
        $this->assertSame('', Midia::pdiPath(Midia::PDI_DOCUMENTO_NOME));
        $this->assertFalse(SiteSetting::pdiPdfPublicado());
        Storage::disk('local')->assertMissing($path);
        $this->get(route('pdi.documento'))->assertNotFound();
    }

    public function test_guests_and_other_roles_cannot_manage_or_preview_pdi_files(): void
    {
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.png'),
        ])->assertRedirect(route('login'));
        $this->get(route('admin.pdi.documento.preview'))->assertRedirect(route('login'));

        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.pdi.documento.upload'), ['documento' => $this->fakePdf()])
            ->assertRedirect(route('login'));
        $this->patch(route('admin.pdi.documento.publicacao'), ['publicar' => '1'])
            ->assertRedirect(route('login'));
        $this->assertDatabaseCount('midias', 0);
        $this->assertDatabaseCount('site_settings', 0);
    }

    public function test_generic_media_manager_cannot_remove_pdi_assets(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.pdi.fotografia.upload'), [
            'fotografia' => UploadedFile::fake()->image('painel.png'),
        ])->assertRedirect(route('admin.pdi'));
        $record = Midia::where('nome', Midia::PDI_FOTOGRAFIA_NOME)->firstOrFail();

        $this->get(route('admin.midia'))->assertOk()->assertDontSee(Midia::PDI_FOTOGRAFIA_NOME);
        $this->delete(route('admin.midia.destroy', $record->id))->assertForbidden();
        $this->assertDatabaseHas('midias', ['id' => $record->id, 'caminho' => $record->caminho]);
    }

    private function uploadPdf(array $extra = []): void
    {
        $this->post(route('admin.pdi.documento.upload'), array_merge([
            'documento' => $this->fakePdf(),
        ], $extra))->assertRedirect(route('admin.pdi'))->assertSessionHas('success');
    }

    private function fakePdf(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('pdi.pdf', "%PDF-1.4\n1 0 obj<</Type/Catalog>>endobj\n%%EOF\n");
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
