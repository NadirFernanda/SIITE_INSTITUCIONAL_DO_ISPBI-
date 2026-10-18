<?php

namespace Tests\Feature;

use App\Models\Candidatura;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;
use RuntimeException;

class CourseEntryProfilesManagementTest extends TestCase
{
    private const COURSE = 'Engenharia Informática';

    private const PROFILE = 'Perfil de Teste Académico';

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

        Storage::fake('local');

        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->boolean('value')->default(false);
        });
        DB::table('site_settings')->insert(['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => true]);

        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho')->nullable();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        $this->withHeader('User-Agent', 'CourseProfilesTestBot');
    }

    public function test_admin_addition_updates_course_page_public_form_and_server_validation_list(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => self::COURSE,
            'profile' => self::PROFILE,
        ])->assertRedirect(route('admin.configuracoes'));

        $this->assertContains(self::PROFILE, Candidatura::perfisParaCurso(self::COURSE));
        $this->assertContains(self::PROFILE, Candidatura::todosOsPerfis());
        $this->assertContains(self::PROFILE, Candidatura::mapaPerfisCurso()[self::COURSE]);
        $this->assertStringContainsString(self::PROFILE, Storage::disk('local')->get('course-entry-profiles.json'));

        $this->get(route('cursos.informatica'))->assertOk()->assertSee(self::PROFILE);
        $this->get(route('candidaturas'))->assertOk()->assertSee(self::PROFILE);
        $this->get(route('admin.configuracoes'))->assertOk()->assertSee(self::PROFILE);
    }

    public function test_duplicates_invalid_course_and_removal_of_base_profiles_are_rejected(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => self::COURSE,
            'profile' => 'Técnico de Informática',
        ])->assertSessionHasErrors('profile');
        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => 'Curso inexistente',
            'profile' => self::PROFILE,
        ])->assertSessionHasErrors('course');

        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => self::COURSE,
            'profile' => self::PROFILE,
        ])->assertRedirect(route('admin.configuracoes'));
        $before = Storage::disk('local')->get('course-entry-profiles.json');
        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => self::COURSE,
            'profile' => mb_strtolower(self::PROFILE),
        ])->assertSessionHasErrors('profile');
        $this->delete(route('admin.configuracoes.perfis.destroy'), [
            'course' => self::COURSE,
            'profile' => 'Técnico de Informática',
            'confirm_remove' => '1',
        ])->assertSessionHasErrors('profile');
        $this->assertSame($before, Storage::disk('local')->get('course-entry-profiles.json'));

        $this->delete(route('admin.configuracoes.perfis.destroy'), [
            'course' => self::COURSE,
            'profile' => self::PROFILE,
            'confirm_remove' => '1',
        ])->assertRedirect(route('admin.configuracoes'));
        $this->assertNotContains(self::PROFILE, Candidatura::perfisParaCurso(self::COURSE));
        $this->assertContains('Técnico de Informática', Candidatura::perfisParaCurso(self::COURSE));
    }

    public function test_public_submission_accepts_a_profile_added_by_admin(): void
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            foreach ([
                'nome', 'filiacao_pai', 'filiacao_mae', 'data_nascimento',
                'naturalidade_municipio', 'naturalidade_provincia', 'bi',
                'bi_emitido_em', 'bi_data_emissao', 'sexo', 'estado_civil',
                'necessidade_especial', 'residencia_municipio', 'residencia_bairro',
                'telefone', 'telefone2', 'email', 'habilitacoes', 'escola_origem',
                'perfil', 'ano_conclusao', 'estado_financeiro', 'trabalhador',
                'instituicao_laboral', 'curso', 'periodo', 'local_inscricao',
                'observacoes', 'autorizacao_assinatura', 'autorizacao_assinatura_em',
            ] as $column) {
                $table->string($column)->nullable();
            }
            $table->timestamps();
            $table->softDeletes();
        });

        $this->actingAs($this->user('admin'));
        $this->post(route('admin.configuracoes.perfis.store'), [
            'course' => self::COURSE,
            'profile' => self::PROFILE,
        ])->assertRedirect(route('admin.configuracoes'));
        auth()->logout();
        Queue::fake();

        $this->post(route('candidaturas.store'), [
            'nome' => 'Candidato Exemplo',
            'filiacao_pai' => 'Pai Exemplo',
            'filiacao_mae' => 'Mãe Exemplo',
            'data_nascimento' => '2000-05-01',
            'naturalidade_municipio' => 'Cuito',
            'naturalidade_provincia' => 'Bié',
            'bi' => '024187059BA057',
            'bi_emitido_em' => 'Cuito',
            'bi_data_emissao' => '2020-01-01',
            'sexo' => 'masculino',
            'estado_civil' => 'solteiro',
            'necessidade_especial' => 'Nenhuma',
            'residencia_municipio' => 'Cuito',
            'residencia_bairro' => 'Centro',
            'telefone' => '923000000',
            'autorizacao_assinatura' => '1',
            'habilitacoes' => 'Ensino médio',
            'escola_origem' => 'Escola Exemplo',
            'perfil' => self::PROFILE,
            'ano_conclusao' => '2020',
            'estado_financeiro' => 'medio',
            'trabalhador' => 'nao',
            'curso' => self::COURSE,
            'periodo' => 'regular',
            'local_inscricao' => 'dentro',
        ])->assertRedirectContains('/candidaturas/');

        $this->assertDatabaseHas('candidaturas', ['perfil' => self::PROFILE, 'curso' => self::COURSE]);
    }

    public function test_only_admin_may_change_profiles_and_invalid_storage_is_not_overwritten(): void
    {
        $data = ['course' => self::COURSE, 'profile' => self::PROFILE];
        $this->post(route('admin.configuracoes.perfis.store'), $data)->assertRedirect(route('login'));
        $this->actingAs($this->user('tecnico'));
        $this->post(route('admin.configuracoes.perfis.store'), $data)->assertRedirect(route('login'));
        $this->assertNotContains(self::PROFILE, Candidatura::perfisParaCurso(self::COURSE));

        $this->actingAs($this->user('admin'));
        Storage::disk('local')->put('course-entry-profiles.json', '{invalid');
        $this->post(route('admin.configuracoes.perfis.store'), $data)->assertSessionHasErrors('profile');
        $this->assertSame('{invalid', Storage::disk('local')->get('course-entry-profiles.json'));
        $this->assertContains('Técnico de Informática', Candidatura::perfisParaCurso(self::COURSE));
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
