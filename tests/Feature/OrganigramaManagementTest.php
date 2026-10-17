<?php

namespace Tests\Feature;

use App\Models\Midia;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class OrganigramaManagementTest extends TestCase
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
        $this->withHeader('User-Agent', 'OrganigramaTestBot');
    }

    public function test_original_image_is_the_default_without_a_setting(): void
    {
        $this->get(route('presidencia'))
            ->assertOk()
            ->assertSee('Órgãos de Gestão')
            ->assertSee('images/organigrama.jpeg')
            ->assertSee('Ampliar organigrama');
        $this->get(route('presidencia.organigrama'))->assertNotFound();
    }

    public function test_admin_can_upload_and_the_public_page_serves_the_image(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('novo.png', 1200, 800),
        ])->assertRedirect(route('admin.configuracoes'))->assertSessionHas('success');

        $path = Midia::organigramaPath();
        $this->assertTrue(Midia::isManagedOrganigramaPath($path));
        Storage::disk('public')->assertExists($path);
        $this->assertDatabaseCount('midias', 1);
        $this->assertDatabaseCount('site_settings', 0);
        $this->assertDatabaseHas('midias', ['nome' => Midia::ORGANIGRAMA_NOME, 'caminho' => $path]);

        $this->get(route('admin.configuracoes'))->assertOk()->assertSee('Organigrama Institucional');
        $this->get(route('presidencia'))->assertOk()->assertSee(route('presidencia.organigrama'));
        $this->withHeader('User-Agent', 'Mozilla/5.0')
            ->get(route('presidencia.organigrama'))->assertOk()->assertHeader('Content-Type', 'image/png');
    }

    public function test_replacement_keeps_only_the_new_managed_file(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('primeiro.jpg');
        $oldPath = Midia::organigramaPath();

        $this->upload('segundo.webp');
        $newPath = Midia::organigramaPath();

        $this->assertNotSame($oldPath, $newPath);
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($newPath);
        $this->get(route('presidencia.organigrama'))->assertOk()->assertHeader('Content-Type', 'image/webp');
    }

    public function test_invalid_content_and_extension_are_rejected_without_replacement(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('valido.png');
        $published = Midia::organigramaPath();

        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->createWithContent('falso.png', '<script>alert(1)</script>'),
        ])->assertSessionHasErrors('organigrama');
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('imagem.gif'),
        ])->assertSessionHasErrors('organigrama');
        $png = UploadedFile::fake()->image('imagem.png');
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => new UploadedFile($png->getPathname(), 'disfarce.jpg', 'image/jpeg', null, true),
        ])->assertSessionHasErrors('organigrama');
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('imagem.png')->size(5121),
        ])->assertSessionHasErrors('organigrama');

        $this->assertSame($published, Midia::organigramaPath());
        Storage::disk('public')->assertExists($published);
        $this->assertCount(1, Storage::disk('public')->files('organigramas'));
    }

    public function test_failed_database_write_keeps_published_image_and_removes_new_upload(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('original.png');
        $published = Midia::organigramaPath();

        DB::statement("CREATE TRIGGER block_organigrama_update BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('novo.png'),
        ])->assertSessionHasErrors('organigrama');

        $this->assertSame($published, Midia::organigramaPath());
        Storage::disk('public')->assertExists($published);
        $this->assertCount(1, Storage::disk('public')->files('organigramas'));
    }

    public function test_removal_requires_confirmation_and_does_not_restore_the_original(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('actual.png');
        $path = Midia::organigramaPath();

        $this->delete(route('admin.configuracoes.organigrama.remove'))
            ->assertSessionHasErrors('confirmar_remocao');
        $this->assertSame($path, Midia::organigramaPath());

        $this->delete(route('admin.configuracoes.organigrama.remove'), ['confirmar_remocao' => '1'])
            ->assertRedirect(route('admin.configuracoes'))->assertSessionHas('success');
        $this->assertSame('', Midia::organigramaPath());
        Storage::disk('public')->assertMissing($path);
        $this->get(route('presidencia'))->assertOk()
            ->assertSee('O organigrama institucional não está publicado neste momento.')
            ->assertDontSee('images/organigrama.jpeg');
        $this->get(route('presidencia.organigrama'))->assertNotFound();
    }

    public function test_failed_removal_keeps_the_current_image(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('actual.png');
        $path = Midia::organigramaPath();

        DB::statement("CREATE TRIGGER block_organigrama_removal BEFORE UPDATE ON midias BEGIN SELECT RAISE(ABORT, 'write blocked'); END");
        $this->delete(route('admin.configuracoes.organigrama.remove'), ['confirmar_remocao' => '1'])
            ->assertSessionHasErrors('organigrama');

        $this->assertSame($path, Midia::organigramaPath());
        Storage::disk('public')->assertExists($path);
        $this->get(route('presidencia.organigrama'))->assertOk();
    }

    public function test_generic_media_manager_cannot_change_the_reserved_organigram_record(): void
    {
        $this->actingAs($this->user('admin'));
        $this->upload('actual.png');
        $record = Midia::where('nome', Midia::ORGANIGRAMA_NOME)->firstOrFail();

        $this->get(route('admin.midia'))->assertOk()->assertDontSee(Midia::ORGANIGRAMA_NOME);
        $this->delete(route('admin.midia.destroy', $record->id))->assertForbidden();
        $this->post(route('admin.midia.store'), [
            'arquivo' => UploadedFile::fake()->image(Midia::ORGANIGRAMA_NOME.'.png'),
        ])->assertSessionHasErrors('arquivo');

        $this->assertDatabaseCount('midias', 1);
        Storage::disk('public')->assertExists($record->caminho);
    }

    public function test_guests_and_non_admins_cannot_change_the_image(): void
    {
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('novo.png'),
        ])->assertRedirect(route('login'));
        $this->delete(route('admin.configuracoes.organigrama.remove'), ['confirmar_remocao' => '1'])
            ->assertRedirect(route('login'));

        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image('novo.png'),
        ])->assertRedirect(route('login'));

        $this->assertNull(Midia::organigramaPath());
        $this->assertSame([], Storage::disk('public')->files('organigramas'));
    }

    private function upload(string $name): void
    {
        $this->post(route('admin.configuracoes.organigrama.upload'), [
            'organigrama' => UploadedFile::fake()->image($name, 800, 600),
        ])->assertRedirect(route('admin.configuracoes'))->assertSessionHas('success');
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
