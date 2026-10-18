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

    public function test_public_page_has_presidency_layout_and_no_unpublished_calendar(): void
    {
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário Académico')
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('2026/2027')
            ->assertDontSee('Actividades por semestre')
            ->assertDontSee(route('calendario-academico.imagem'))
            ->assertSee('institutional-cta');
        $this->get(route('calendario-academico.imagem'))->assertNotFound();
    }

    public function test_admin_publishes_real_image_and_public_can_view_and_amplify_it(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishImage('2026/2027');

        $calendar = AcademicCalendar::published();
        $this->assertSame('2026/2027', $calendar['ano']);
        $this->assertTrue(AcademicCalendar::isImagePath($calendar['imagem']));
        Storage::disk('local')->assertExists($calendar['imagem']);
        $this->assertDatabaseHas('midias', ['nome' => Midia::CALENDARIO_PUBLICADO_NOME]);

        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Ano académico 2026/2027')
            ->assertSee('alt="Calendário Académico 2026/2027', false)
            ->assertSee('Ampliar calendário')
            ->assertSee(route('calendario-academico.imagem'))
            ->assertDontSee('Actividades por semestre');
        $this->get(route('calendario-academico.imagem'))->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
        $this->get(route('admin.calendario-academico'))->assertOk()
            ->assertSee('Imagem publicada')
            ->assertSee('Ano académico 2026/2027')
            ->assertSee('cal-preview-image')
            ->assertDontSee('Rascunho');
    }

    public function test_replacement_and_invalid_upload_preserve_previous_image(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishImage('2026/2027');
        $old = AcademicCalendar::published();

        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2027/2028',
            'imagem' => UploadedFile::fake()->createWithContent('falso.jpg', '<html>ficheiro falso</html>'),
        ])->assertSessionHasErrors('imagem');
        $this->assertSame($old, AcademicCalendar::published());

        $this->publishImage('2027/2028', 'novo.png');
        $new = AcademicCalendar::published();
        $this->assertNotSame($old['imagem'], $new['imagem']);
        $this->assertSame('2027/2028', $new['ano']);
        Storage::disk('local')->assertExists($old['imagem']);
        Storage::disk('local')->assertExists($new['imagem']);
        $this->get(route('calendario-academico.imagem'))->assertOk()
            ->assertHeader('Content-Type', 'image/png');
    }

    public function test_failed_database_update_keeps_published_image_and_removes_new_upload(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishImage('2026/2027');
        $old = AcademicCalendar::published();
        $stored = Storage::disk('local')->files('calendarios-academicos/imagens');

        DB::statement("CREATE TRIGGER block_calendar_publication BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2027/2028', 'imagem' => UploadedFile::fake()->image('novo.jpg', 1200, 800),
        ])->assertSessionHasErrors('imagem');

        $this->assertSame($old, AcademicCalendar::published());
        $this->assertSame($stored, Storage::disk('local')->files('calendarios-academicos/imagens'));
        $this->get(route('calendario-academico'))->assertOk()->assertSee('2026/2027');
    }

    public function test_year_validation_and_permissions_are_enforced(): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2027', 'imagem' => UploadedFile::fake()->image('calendario.jpg'),
        ])->assertRedirect(route('login'));
        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2027', 'imagem' => UploadedFile::fake()->image('calendario.jpg'),
        ])->assertRedirect(route('login'));
        $this->assertDatabaseCount('midias', 0);

        $this->actingAs($this->user('admin'));
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => '2026/2028', 'imagem' => UploadedFile::fake()->image('calendario.jpg'),
        ])->assertSessionHasErrors('ano');
        $this->assertDatabaseCount('midias', 0);
    }

    public function test_unpublish_hides_image_without_deleting_file(): void
    {
        $this->actingAs($this->user('admin'));
        $this->publishImage('2026/2027');
        $oldImage = AcademicCalendar::published()['imagem'];

        $this->post(route('admin.calendario-academico.despublicar'))
            ->assertSessionHasErrors('confirmar_retirada');
        $this->assertNotNull(AcademicCalendar::published());
        $this->post(route('admin.calendario-academico.despublicar'), ['confirmar_retirada' => '1'])
            ->assertRedirect(route('admin.calendario-academico'));

        $this->assertNull(AcademicCalendar::published());
        Storage::disk('local')->assertExists($oldImage);
        $this->get(route('calendario-academico.imagem'))->assertNotFound();
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado');
    }

    public function test_legacy_pdf_snapshot_is_preserved_but_not_presented_as_an_image(): void
    {
        $path = 'calendarios-academicos/versoes/6e980afb-6926-4b48-97c0-218af3d70859.json';
        $oldPdf = 'calendarios-academicos/documentos/antigo.pdf';
        Storage::disk('local')->put($oldPdf, '%PDF-1.4');
        Storage::disk('local')->put($path, json_encode([
            'ano' => '2025/2026', 'atividades' => [], 'pdf' => $oldPdf,
        ]));
        Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);

        $this->assertNull(AcademicCalendar::published());
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('2025/2026');
        $this->get(route('calendario-academico.imagem'))->assertNotFound();
        $this->get('/calendario-academico/documento')->assertNotFound();
        Storage::disk('local')->assertExists($oldPdf);
        $this->assertDatabaseHas('midias', ['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);

        $this->actingAs($this->user('admin'));
        $this->publishImage('2026/2027');
        $this->assertSame('2026/2027', AcademicCalendar::published()['ano']);
        Storage::disk('local')->assertExists($oldPdf);
        Storage::disk('local')->assertExists($path);
    }

    private function publishImage(string $year, string $filename = 'calendario.jpg'): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'ano' => $year, 'imagem' => UploadedFile::fake()->image($filename, 1200, 800),
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
