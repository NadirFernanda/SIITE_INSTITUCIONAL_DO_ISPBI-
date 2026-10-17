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

    public function test_public_page_does_not_repeat_unverified_old_calendar(): void
    {
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado')
            ->assertDontSee('2026/2027')
            ->assertDontSee('03 - 14 Fev 2025')
            ->assertDontSee('25% de faltas')
            ->assertDontSee(route('calendario-academico.documento'));
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_admin_can_prepare_preview_and_edit_semester_activities_without_publishing(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->addActivity('1', 'Início de actividades confirmado', '2026-10-05', '2026-10-06');
        $this->addActivity('2', 'Conclusão confirmada', '2027-06-15', '2027-06-15');

        $draft = AcademicCalendar::draft();
        $this->assertSame('2026/2027', $draft['ano']);
        $this->assertCount(2, $draft['atividades']);
        $this->assertNull(AcademicCalendar::published());
        $this->get(route('admin.calendario-academico.preview'))->assertOk()
            ->assertSee('Pré-visualização do rascunho')
            ->assertSee('Início de actividades confirmado')
            ->assertSee('Conclusão confirmada');
        $this->get(route('calendario-academico'))->assertOk()
            ->assertDontSee('Início de actividades confirmado');

        $firstId = $draft['atividades'][0]['id'];
        $this->patch(route('admin.calendario-academico.actividades.update', $firstId), [
            'semestre' => '2', 'titulo' => 'Actividade revista',
            'inicio' => '2027-02-01', 'fim' => '2027-02-03', 'descricao' => 'Texto confirmado.',
        ])->assertRedirect(route('admin.calendario-academico'));
        $this->assertSame(2, AcademicCalendar::draft()['atividades'][0]['semestre']);
        $this->delete(route('admin.calendario-academico.actividades.destroy', $firstId))
            ->assertSessionHasErrors('confirmar_remocao');
        $this->delete(route('admin.calendario-academico.actividades.destroy', $firstId), [
            'confirmar_remocao' => '1',
        ])->assertRedirect(route('admin.calendario-academico'));
        $this->assertCount(1, AcademicCalendar::draft()['atividades']);
    }

    public function test_year_and_activity_dates_must_belong_to_same_academic_calendar(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2026/2028'])
            ->assertSessionHasErrors('ano');
        $this->startDraft('2026/2027');
        $this->post(route('admin.calendario-academico.actividades.store'), [
            'semestre' => '1', 'titulo' => 'Data de outro ano',
            'inicio' => '2025-03-01', 'fim' => '2025-03-02',
        ])->assertSessionHasErrors('inicio');
        $this->post(route('admin.calendario-academico.actividades.store'), [
            'semestre' => '1', 'titulo' => 'Datas inversas',
            'inicio' => '2026-03-02', 'fim' => '2026-03-01',
        ])->assertSessionHasErrors('fim');
        $this->assertSame([], AcademicCalendar::draft()['atividades']);
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertSessionHasErrors('publicacao');
        $this->assertNull(AcademicCalendar::published());
    }

    public function test_published_calendar_and_pdf_remain_unchanged_until_new_draft_is_approved(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->addActivity('1', 'Actividade publicada original', '2026-11-01', '2026-11-02');
        $this->uploadPdf();
        $oldPdf = AcademicCalendar::draft()['pdf'];
        $this->get(route('calendario-academico.documento'))->assertNotFound();
        $this->get(route('admin.calendario-academico.documento.preview'))
            ->assertOk()->assertHeader('Content-Type', 'application/pdf');
        $this->post(route('admin.calendario-academico.publicar'))
            ->assertSessionHasErrors('confirmar_publicacao');
        $this->publish();

        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário Académico 2026/2027')
            ->assertSee('Actividade publicada original')
            ->assertSee(route('calendario-academico.documento'));
        $this->get(route('calendario-academico.documento'))
            ->assertOk()->assertHeader('Content-Type', 'application/pdf');

        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => '2027/2028'])
            ->assertSessionHasErrors('confirmar_substituicao');
        $this->post(route('admin.calendario-academico.rascunho'), [
            'ano' => '2027/2028', 'confirmar_substituicao' => '1',
        ])->assertRedirect(route('admin.calendario-academico'));
        $this->addActivity('2', 'Actividade da nova versão', '2028-02-03', '2028-02-04');
        $this->assertSame('2026/2027', AcademicCalendar::published()['ano']);
        $this->assertSame($oldPdf, AcademicCalendar::published()['pdf']);
        Storage::disk('local')->assertExists($oldPdf);
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Actividade publicada original')
            ->assertDontSee('Actividade da nova versão')
            ->assertDontSee('2027/2028');

        $this->publish();
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário Académico 2027/2028')
            ->assertSee('Actividade da nova versão')
            ->assertDontSee('Actividade publicada original')
            ->assertDontSee(route('calendario-academico.documento'));
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_invalid_pdf_and_failed_draft_save_preserve_published_version(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->addActivity('1', 'Versão segura', '2026-09-01', '2026-09-01');
        $this->publish();
        $old = AcademicCalendar::published();
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => UploadedFile::fake()->createWithContent('falso.pdf', '<html>ficheiro falso</html>'),
        ])->assertSessionHasErrors('documento');

        DB::statement("CREATE TRIGGER block_calendar_draft BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => $this->fakePdf(),
        ])->assertSessionHasErrors('documento');
        $this->assertSame($old, AcademicCalendar::published());
        $this->assertNull(AcademicCalendar::draft()['pdf']);
        $this->assertSame([], Storage::disk('local')->files('calendarios-academicos/documentos'));
        $this->get(route('calendario-academico'))->assertOk()->assertSee('Versão segura');
    }

    public function test_replacing_draft_pdf_keeps_the_published_pdf_until_approval(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->uploadPdf();
        $oldPdf = AcademicCalendar::draft()['pdf'];
        $this->publish();

        $this->uploadPdf();
        $newPdf = AcademicCalendar::draft()['pdf'];
        $this->assertNotSame($oldPdf, $newPdf);
        $this->assertSame($oldPdf, AcademicCalendar::published()['pdf']);
        Storage::disk('local')->assertExists($oldPdf);
        Storage::disk('local')->assertExists($newPdf);
        $this->get(route('calendario-academico.documento'))->assertOk();

        $this->delete(route('admin.calendario-academico.documento.remove'), [
            'confirmar_remocao' => '1',
        ])->assertRedirect(route('admin.calendario-academico'));
        $this->assertNull(AcademicCalendar::draft()['pdf']);
        $this->assertSame($oldPdf, AcademicCalendar::published()['pdf']);
        $this->get(route('calendario-academico.documento'))->assertOk();
    }

    public function test_stale_review_and_failed_publication_cannot_replace_published_version(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->addActivity('1', 'Versão aprovada', '2026-09-01', '2026-09-01');
        $this->publish();
        $approved = AcademicCalendar::published();
        $reviewedRevision = AcademicCalendar::draftRevision();

        $this->addActivity('2', 'Alteração posterior à revisão', '2027-02-01', '2027-02-01');
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => $reviewedRevision,
        ])->assertSessionHasErrors('publicacao');
        $this->assertSame($approved, AcademicCalendar::published());

        DB::statement("CREATE TRIGGER block_calendar_publication BEFORE UPDATE ON midias WHEN NEW.nome = '__ispbie_system_calendario_publicado_v1__' BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertSessionHasErrors('publicacao');
        $this->assertSame($approved, AcademicCalendar::published());
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Versão aprovada')->assertDontSee('Alteração posterior à revisão');
    }

    public function test_unpublish_hides_calendar_and_pdf_but_keeps_draft(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $this->uploadPdf();
        $this->publish();
        $this->post(route('admin.calendario-academico.despublicar'))
            ->assertSessionHasErrors('confirmar_retirada');
        $this->post(route('admin.calendario-academico.despublicar'), [
            'confirmar_retirada' => '1',
        ])->assertRedirect(route('admin.calendario-academico'));
        $this->assertNull(AcademicCalendar::published());
        $this->assertNotNull(AcademicCalendar::draft());
        $this->get(route('calendario-academico'))->assertOk()
            ->assertSee('Calendário académico ainda não publicado');
        $this->get(route('calendario-academico.documento'))->assertNotFound();
    }

    public function test_guests_and_other_roles_cannot_manage_or_preview_drafts(): void
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

    public function test_calendar_references_are_reserved_in_generic_media_manager(): void
    {
        $this->actingAs($this->user('admin'));
        $this->startDraft('2026/2027');
        $record = Midia::where('nome', Midia::CALENDARIO_RASCUNHO_NOME)->firstOrFail();
        $this->get(route('admin.midia'))->assertOk()->assertDontSee(Midia::CALENDARIO_RASCUNHO_NOME);
        $this->delete(route('admin.midia.destroy', $record->id))->assertForbidden();
        $this->assertDatabaseHas('midias', ['id' => $record->id, 'caminho' => $record->caminho]);
    }

    private function startDraft(string $year): void
    {
        $this->post(route('admin.calendario-academico.rascunho'), ['ano' => $year])
            ->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function addActivity(string $semester, string $title, string $start, string $end): void
    {
        $this->post(route('admin.calendario-academico.actividades.store'), [
            'semestre' => $semester, 'titulo' => $title,
            'inicio' => $start, 'fim' => $end, 'descricao' => 'Descrição validada.',
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function uploadPdf(): void
    {
        $this->post(route('admin.calendario-academico.documento.upload'), [
            'documento' => $this->fakePdf(),
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function publish(): void
    {
        $this->post(route('admin.calendario-academico.publicar'), [
            'confirmar_publicacao' => '1', 'revisao' => AcademicCalendar::draftRevision(),
        ])->assertRedirect(route('admin.calendario-academico'))->assertSessionHas('success');
    }

    private function fakePdf(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('calendario.pdf', "%PDF-1.4\n1 0 obj<</Type/Catalog>>endobj\n%%EOF\n");
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
