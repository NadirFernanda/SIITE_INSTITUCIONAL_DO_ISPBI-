<?php

namespace Tests\Feature;

use App\Models\Midia;
use App\Models\User;
use App\Support\AcademicCalendar;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class AcademicCalendarManagementTest extends TestCase
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

        Storage::fake('local');
        $this->withHeader('User-Agent', 'AcademicCalendarTestBot');
    }

    public function test_public_page_without_pdf_has_no_year_or_inactive_buttons(): void
    {
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('2026/2027')
            ->assertDontSee('<iframe', false)
            ->assertDontSee('Consultar PDF')
            ->assertDontSee('Descarregar PDF');
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->get(route('calendario-academico.documento'))->assertNotFound();
        $this->get('/calendario-academico/imagem')->assertNotFound();
    }

    public function test_admin_uploads_pdf_and_public_can_view_and_download_it(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishPdf('2026/2027');

        $calendar = AcademicCalendar::published();
        $this->assertSame('2026/2027', $calendar['ano']);
        $this->assertTrue(AcademicCalendar::isPdfPath($calendar['pdf']));
        Storage::disk('local')->assertExists($calendar['pdf']);
        $this->assertDatabaseHas('midias', ['nome' => Midia::CALENDARIO_PUBLICADO_NOME]);

        $page = $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário Académico 2026/2027')
            ->assertSee('<iframe', false)
            ->assertSee(route('calendario-academico.visualizar'))
            ->assertSee(route('calendario-academico.documento'))
            ->assertSee('Consultar PDF')
            ->assertSee('Descarregar PDF')
            ->assertDontSee('Actividades por semestre');
        $this->assertStringContainsString("frame-src 'self'", $page->headers->get('Content-Security-Policy'));
        $this->get(route('calendario-academico.visualizar'))->assertOk()
            ->assertHeader('Content-Type', 'application/pdf')
            ->assertHeader('Content-Disposition', 'inline; filename="Calendario-Academico-ISP-Bie.pdf"')
            ->assertHeader('Cache-Control', 'no-store, private');
        $this->get(route('calendario-academico.documento'))->assertOk()
            ->assertHeader('Content-Disposition', 'attachment; filename="Calendario-Academico-ISP-Bie.pdf"');

        $admin = $this->get(route('admin.calendario-academico'))->assertOk()
            ->assertSee('PDF publicado')
            ->assertSee('name="documento"', false)
            ->assertSee('cal-preview-document')
            ->assertDontSee('Rascunho');
        $this->assertStringContainsString('blob:', $admin->headers->get('Content-Security-Policy'));
    }

    public function test_invalid_upload_and_replacement_preserve_old_file(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishPdf('2026/2027');
        $old = AcademicCalendar::published();

        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2027/2028',
            'documento' => UploadedFile::fake()->createWithContent('falso.pdf', '<html>ficheiro falso</html>'),
        ])->assertSessionHasErrors('documento');
        $this->assertSame($old, AcademicCalendar::published());

        $this->publishPdf('2027/2028');
        $new = AcademicCalendar::published();
        $this->assertSame('2027/2028', $new['ano']);
        $this->assertNotSame($old['pdf'], $new['pdf']);
        Storage::disk('local')->assertExists($old['pdf']);
        Storage::disk('local')->assertExists($new['pdf']);
    }

    public function test_failed_database_update_keeps_published_pdf_and_removes_new_upload(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishPdf('2026/2027');
        $old = AcademicCalendar::published();
        $stored = Storage::disk('local')->files('calendarios-academicos/documentos');

        DB::statement("CREATE TRIGGER block_calendar_publication BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2027/2028', 'documento' => $this->pdfFile(),
        ])->assertSessionHasErrors('documento');

        $this->assertSame($old, AcademicCalendar::published());
        $this->assertSame($stored, Storage::disk('local')->files('calendarios-academicos/documentos'));
        $this->get(route('calendario-academico'))->assertOk()->assertSee('2026/2027');
    }

    public function test_year_file_type_and_permissions_are_enforced(): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2027', 'documento' => $this->pdfFile(),
        ])->assertRedirect(route('login'));
        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2027', 'documento' => $this->pdfFile(),
        ])->assertRedirect(route('login'));
        $this->assertDatabaseCount('midias', 0);

        $this->actingAs($this->user('admin'));
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2028', 'documento' => $this->pdfFile(),
        ])->assertSessionHasErrors('ano');
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2027', 'documento' => UploadedFile::fake()->image('imagem.jpg'),
        ])->assertSessionHasErrors('documento');
        $this->assertDatabaseCount('midias', 0);
    }

    public function test_unpublish_hides_pdf_without_deleting_file(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishPdf('2026/2027');
        $oldPdf = AcademicCalendar::published()['pdf'];

        $this->post(route('admin.calendario-academico.despublicar'))
            ->assertSessionHasErrors('confirmar_retirada');
        $this->assertNotNull(AcademicCalendar::published());
        $this->post(route('admin.calendario-academico.despublicar'), ['confirmar_retirada' => '1'])
            ->assertRedirect(route('admin.calendario-academico'));

        $this->assertNull(AcademicCalendar::published());
        Storage::disk('local')->assertExists($oldPdf);
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_existing_pdf_snapshot_remains_available_without_data_migration(): void
    {
        $path = 'calendarios-academicos/versoes/6e980afb-6926-4b48-97c0-218af3d70859.json';
        $oldPdf = 'calendarios-academicos/documentos/antigo.pdf';
        Storage::disk('local')->put($oldPdf, "%PDF-1.4\n%%EOF\n");
        Storage::disk('local')->put($path, json_encode([
            'ano' => '2025/2026', 'atividades' => [], 'pdf' => $oldPdf,
        ]));
        Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);

        $this->assertSame('2025/2026', AcademicCalendar::published()['ano']);
        $this->get(route('calendario-academico'))->assertOk()->assertSee('2025/2026');
        $this->get(route('calendario-academico.visualizar'))->assertOk();
        Storage::disk('local')->assertExists($oldPdf);
    }

    public function test_prior_image_snapshot_is_kept_but_not_presented_as_pdf(): void
    {
        $path = 'calendarios-academicos/versoes/6e980afb-6926-4b48-97c0-218af3d70859.json';
        $oldImage = 'calendarios-academicos/imagens/antiga.jpg';
        Storage::disk('local')->put($oldImage, 'image data');
        Storage::disk('local')->put($path, json_encode(['ano' => '2025/2026', 'imagem' => $oldImage]));
        Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);

        $this->assertNull(AcademicCalendar::published());
        $this->get(route('calendario-academico'))->assertOk()->assertDontSee('2025/2026');
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->actingAs($this->user('admin'));
        $this->publishPdf('2026/2027');
        Storage::disk('local')->assertExists($oldImage);
        Storage::disk('local')->assertExists($path);
    }

    private function publishPdf(string $year): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => $year, 'documento' => $this->pdfFile(),
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function pdfFile(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent(
            'calendario.pdf', "%PDF-1.4\n1 0 obj<</Type/Catalog>>endobj\n%%EOF\n"
        );
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
