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
        Storage::fake('public');
        $this->withHeader('User-Agent', 'AcademicCalendarTestBot');
    }

    public function test_public_page_without_published_pdf_has_no_year_viewer_or_inactive_buttons(): void
    {
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('2026/2027')
            ->assertDontSee('<iframe', false)
            ->assertDontSee('Consultar PDF')
            ->assertDontSee('Descarregar PDF')
            ->assertDontSee('Primeiro Semestre');
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_draft_preview_is_private_and_public_page_remains_unpublished(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->get(route('admin.calendario-academico'))->assertOk()
            ->assertSee('PDF oficial do rascunho')
            ->assertDontSee('Actividades por semestre')
            ->assertDontSee('name="semestre"', false);
        $preview = $this->get(route('admin.calendario-academico.preview'))->assertOk()
            ->assertSee('Pré-visualização privada')
            ->assertSee('PDF ainda não carregado no rascunho');
        $this->assertStringContainsString("frame-src 'self'", $preview->headers->get('Content-Security-Policy'));
        $this->post('/admin/calendario-academico/actividades', [])->assertNotFound();
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertSessionHasErrors('publicacao');

        $this->uploadPdf();
        $this->get(route('admin.calendario-academico.preview'))->assertOk()
            ->assertSee(route('admin.calendario-academico.documento.preview'))
            ->assertDontSee(route('calendario-academico.visualizar'));
        $privatePdf = $this->get(route('admin.calendario-academico.documento.preview'))->assertOk()
            ->assertHeader('Content-Type', 'application/pdf')
            ->assertHeader('Content-Disposition', 'inline; filename="Calendario-Academico-Previsualizacao.pdf"');
        $this->assertStringContainsString('no-store', $privatePdf->headers->get('Cache-Control'));
        $this->assertStringContainsString('private', $privatePdf->headers->get('Cache-Control'));
        $this->get(route('calendario-academico'))->assertOk()->assertDontSee('2026/2027');
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_published_pdf_can_be_viewed_inline_and_downloaded(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->uploadPdf();
        $this->publish();

        $response = $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário Académico 2026/2027')
            ->assertSee('<iframe', false)
            ->assertSee(route('calendario-academico.visualizar'))
            ->assertSee(route('calendario-academico.documento'))
            ->assertSee('Consultar PDF')
            ->assertSee('Descarregar PDF')
            ->assertDontSee('Primeiro Semestre')
            ->assertDontSee('name="semestre"', false);
        $this->assertStringContainsString("frame-src 'self'", $response->headers->get('Content-Security-Policy'));
        $this->get(route('calendario-academico.visualizar'))->assertOk()
            ->assertHeader('Content-Disposition', 'inline; filename="Calendario-Academico-ISP-Bie.pdf"')
            ->assertHeader('Cache-Control', 'no-store, private');
        $this->get(route('calendario-academico.documento'))->assertOk()
            ->assertHeader('Content-Disposition', 'attachment; filename="Calendario-Academico-ISP-Bie.pdf"');
    }

    public function test_new_draft_and_failed_upload_preserve_published_document(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->uploadPdf();
        $this->publish();
        $old = AcademicCalendar::published();

        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2027/2028'])
            ->assertSessionHasErrors('confirmar_substituicao');
        $this->post(route('admin.calendario-academico.rascunho'), [
            'ano' => '2027/2028', 'confirmar_substituicao' => '1',
        ])->assertSessionHas('success');
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent('falso.pdf', 'não é um PDF'),
        ])->assertSessionHasErrors('documento');
        $this->assertSame($old, AcademicCalendar::published());
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('2026/2027')->assertDontSee('2027/2028');
        $this->get(route('calendario-academico.visualizar'))->assertOk();
    }

    public function test_year_must_be_consecutive_and_pdf_extension_must_match_content(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2026/2028'])
            ->assertSessionHasErrors('ano');
        $this->assertNull(AcademicCalendar::draft());

        $this->startDraft();
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent('documento.txt', "%PDF-1.4\n%%EOF\n"),
        ])->assertSessionHasErrors('documento');
        $this->assertNull(AcademicCalendar::draft()['pdf']);
    }

    public function test_failed_draft_update_keeps_published_document_and_removes_new_upload(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->uploadPdf();
        $this->publish();
        $old = AcademicCalendar::published();
        $this->post(route('admin.calendario-academico.rascunho'), [
            'ano' => '2027/2028', 'confirmar_substituicao' => '1',
        ])->assertSessionHas('success');

        DB::statement("CREATE TRIGGER block_calendar_draft BEFORE UPDATE ON midias WHEN NEW.nome = '__ispbie_system_calendario_rascunho_v1__' BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent(
                'novo.pdf', "%PDF-1.4\n1 0 obj<</Type/Catalog>>endobj\n%%EOF\n"
            ),
        ])->assertSessionHasErrors('documento');

        $this->assertSame($old, AcademicCalendar::published());
        $this->assertNull(AcademicCalendar::draft()['pdf']);
        $this->assertCount(1, Storage::disk('local')->files('calendarios-academicos/documentos'));
    }

    public function test_replacement_requires_review_and_unpublication_hides_both_public_pdf_routes(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->uploadPdf();
        $this->publish();
        $oldPath = AcademicCalendar::published()['pdf'];

        $this->post(route('admin.calendario-academico.rascunho'), [
            'ano' => '2027/2028', 'confirmar_substituicao' => '1',
        ])->assertSessionHas('success');
        $this->uploadPdf();
        $newPath = AcademicCalendar::draft()['pdf'];
        $this->assertNotSame($oldPath, $newPath);
        $this->assertSame($oldPath, AcademicCalendar::published()['pdf']);
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => str_repeat('a', 64),
        ])->assertSessionHasErrors('publicacao');
        $this->assertSame($oldPath, AcademicCalendar::published()['pdf']);
        $this->publish();
        $this->assertSame($newPath, AcademicCalendar::published()['pdf']);
        Storage::disk('local')->assertExists($oldPath);

        $this->post(route('admin.calendario-academico.despublicar'))
            ->assertSessionHasErrors('confirmar_retirada');
        $this->post(route('admin.calendario-academico.despublicar'), [
            'confirmar_retirada' => '1',
        ])->assertSessionHas('success');
        $this->assertNull(AcademicCalendar::published());
        $this->assertNotNull(AcademicCalendar::draft());
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_legacy_calendar_without_pdf_does_not_publish_manual_activities(): void
    {
        AcademicCalendar::saveDraft([
            'ano' => '2026/2027',
            'pdf' => null,
            'atividades' => [[
                'id' => '11111111-1111-1111-1111-111111111111',
                'semestre' => 1,
                'titulo' => 'Actividade antiga sem PDF',
                'inicio' => '2026-10-05',
                'fim' => '2026-10-05',
                'descricao' => '',
            ]],
        ]);
        $path = Midia::where('nome', Midia::CALENDARIO_RASCUNHO_NOME)->value('caminho');
        Midia::create(['nome' => Midia::CALENDARIO_PUBLICADO_NOME, 'caminho' => $path]);

        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('Actividade antiga sem PDF')
            ->assertDontSee('2026/2027');
        $this->get(route('calendario-academico.visualizar'))->assertNotFound();
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertSessionHasErrors('publicacao');
    }

    public function test_failed_publication_keeps_previous_pdf(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $this->uploadPdf();
        $this->publish();
        $old = AcademicCalendar::published();
        $this->post(route('admin.calendario-academico.rascunho'), [
            'ano' => '2027/2028', 'confirmar_substituicao' => '1',
        ])->assertSessionHas('success');
        $this->uploadPdf();

        DB::statement("CREATE TRIGGER block_calendar_publication BEFORE UPDATE ON midias WHEN NEW.nome = '__ispbie_system_calendario_publicado_v1__' BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertSessionHasErrors('publicacao');
        $this->assertSame($old, AcademicCalendar::published());
        $this->get(route('calendario-academico'))->assertOk()->assertSee('2026/2027');
    }

    public function test_preview_and_management_require_administrator_permission(): void
    {
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2026/2027'])
            ->assertRedirect(route('login'));
        $this->get(route('admin.calendario-academico.preview'))->assertRedirect(route('login'));
        $this->get(route('admin.calendario-academico.documento.preview'))->assertRedirect(route('login'));
        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2026/2027'])
            ->assertRedirect(route('login'));
        $this->post(route('admin.calendario-academico.publicar'), ['confirmar_publicacao' => '1'])
            ->assertRedirect(route('login'));
        $this->assertDatabaseCount('midias', 0);
    }

    public function test_calendar_references_remain_reserved_in_generic_media_manager(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft();
        $record = Midia::where('nome', Midia::CALENDARIO_RASCUNHO_NOME)->firstOrFail();
        $this->get(route('admin.midia'))->assertOk()->assertDontSee(Midia::CALENDARIO_RASCUNHO_NOME);
        $this->delete(route('admin.midia.destroy', $record->id))->assertForbidden();
        $this->assertDatabaseHas('midias', ['id' => $record->id, 'caminho' => $record->caminho]);
    }

    private function startDraft(): void
    {
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2026/2027'])
            ->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function uploadPdf(): void
    {
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent(
                'calendario.pdf', "%PDF-1.4\n1 0 obj<</Type/Catalog>>endobj\n%%EOF\n"
            ),
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function publish(): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
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
