<?php

namespace Tests\Unit;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class CandidaturaToggleTest extends TestCase
{
    private const CLOSED_MESSAGE = 'As candidaturas encontram-se encerradas. Aguarde pela abertura do próximo período de inscrições.';

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
        DB::table('site_settings')->insert(['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => false]);

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        $this->withHeader('User-Agent', 'CandidaturaTestBot');
    }

    public function test_closed_page_hides_form_and_direct_post_is_forbidden(): void
    {
        $this->get(route('candidaturas'))
            ->assertOk()
            ->assertSee(self::CLOSED_MESSAGE)
            ->assertDontSee('name="bi"', false);

        $this->post(route('candidaturas.store'), ['nome' => 'Pedido directo'])
            ->assertForbidden();

        $this->assertDatabaseHas('site_settings', ['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => false]);
    }

    public function test_postgres_false_representation_stays_closed(): void
    {
        DB::table('site_settings')->where('key', SiteSetting::CANDIDATURAS_ATIVAS)->update(['value' => 'f']);

        $this->assertFalse(SiteSetting::candidaturasAtivas());
        $this->post(route('candidaturas.store'), [])->assertForbidden();
    }

    public function test_missing_setting_defaults_to_closed_and_can_be_created_by_admin(): void
    {
        DB::table('site_settings')->where('key', SiteSetting::CANDIDATURAS_ATIVAS)->delete();

        $this->assertFalse(SiteSetting::candidaturasAtivas());
        $this->get(route('candidaturas'))
            ->assertOk()
            ->assertSee(self::CLOSED_MESSAGE)
            ->assertDontSee('name="bi"', false);
        $this->post(route('candidaturas.store'), [])->assertForbidden();

        $this->actingAs($this->user('admin'));
        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
            ->assertRedirect(route('admin.configuracoes'));
        $this->assertDatabaseHas('site_settings', ['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => true]);
    }

    public function test_admin_can_open_persist_and_close_the_form(): void
    {
        $this->actingAs($this->user('admin'));

        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
            ->assertRedirect(route('admin.configuracoes'));
        $this->assertDatabaseHas('site_settings', ['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => true]);
        $this->assertTrue(SiteSetting::candidaturasAtivas());

        $this->get(route('candidaturas'))
            ->assertOk()
            ->assertSee('name="bi"', false)
            ->assertDontSee(self::CLOSED_MESSAGE);
        $this->post(route('candidaturas.store'), [])
            ->assertRedirect()
            ->assertSessionHasErrors('nome');

        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '0'])
            ->assertRedirect(route('admin.configuracoes'));
        $this->assertDatabaseHas('site_settings', ['key' => SiteSetting::CANDIDATURAS_ATIVAS, 'value' => false]);
        $this->assertFalse(SiteSetting::candidaturasAtivas());
        $this->get(route('candidaturas'))
            ->assertOk()
            ->assertSee(self::CLOSED_MESSAGE)
            ->assertDontSee('name="bi"', false);
        $this->post(route('candidaturas.store'), [])->assertForbidden();
    }

    public function test_only_admin_can_change_setting(): void
    {
        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
            ->assertRedirect(route('login'));
        $this->assertFalse(SiteSetting::candidaturasAtivas());

        $this->actingAs($this->user('tecnico'));
        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
            ->assertRedirect(route('login'));
        $this->assertFalse(SiteSetting::candidaturasAtivas());
    }

    public function test_open_form_accepts_a_valid_public_submission(): void
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
        $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
            ->assertRedirect(route('admin.configuracoes'));
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
            'perfil' => 'Outro',
            'ano_conclusao' => '2020',
            'estado_financeiro' => 'medio',
            'trabalhador' => 'nao',
            'curso' => 'Comunicação Social',
            'periodo' => 'regular',
            'local_inscricao' => 'dentro',
        ])->assertRedirectContains('/candidaturas/');

        $this->assertDatabaseHas('candidaturas', ['bi' => '024187059BA057', 'nome' => 'Candidato Exemplo']);
    }

    private function user(string $role): User
    {
        $user = new User(['name' => 'Utilizador de teste', 'email' => $role.'@example.test', 'password' => 'unused']);
        $user->role = $role;
        $user->save();

        return $user;
    }
}
