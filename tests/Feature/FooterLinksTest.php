<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class FooterLinksTest extends TestCase
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
            $table->string('value')->nullable();
        });
        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho');
            $table->timestamps();
        });
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->integer('ano')->nullable();
            $table->boolean('publicado')->default(false);
            $table->boolean('testemunho')->default(false);
            $table->boolean('trabalha')->default(false);
            $table->timestamps();
        });
        Schema::create('carrosseis', function (Blueprint $table) {
            $table->id();
            $table->boolean('publicado')->default(false);
            $table->integer('ordem')->default(0);
            $table->softDeletes();
        });
        Schema::create('estatisticas', function (Blueprint $table) {
            $table->id();
            $table->integer('ordem')->default(0);
        });
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->boolean('publicada')->default(false);
            $table->boolean('institucional')->default(false);
            $table->date('data')->nullable();
            $table->softDeletes();
        });
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->string('status')->nullable();
        });
        Schema::create('concursos', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamp('publish_at')->nullable();
            $table->softDeletes();
        });
        Schema::create('revista_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        $this->withHeader('User-Agent', 'FooterLinksTestBot');
    }

    public function test_every_visible_internal_footer_link_returns_200_without_redirecting(): void
    {
        $markup = $this->get(route('contactos'))->assertOk()->getContent();
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML($markup);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $xpath = new DOMXPath($document);

        $checked = [];
        foreach ($xpath->query('//footer//a[@href]') as $link) {
            $href = $link->getAttribute('href');
            $scheme = parse_url($href, PHP_URL_SCHEME);
            $host = parse_url($href, PHP_URL_HOST);
            if (in_array($scheme, ['mailto', 'tel'], true) || ($host && $host !== 'localhost')) {
                continue;
            }

            $path = parse_url($href, PHP_URL_PATH) ?: '/';
            $this->assertStringStartsWith('/', $path, $href);
            if (! isset($checked[$path])) {
                $this->get($path)->assertStatus(200);
                $checked[$path] = true;
            }

            $fragment = parse_url($href, PHP_URL_FRAGMENT);
            if ($fragment) {
                $this->get($path)->assertSee('id="'.$fragment.'"', false);
            }
        }

        $this->assertGreaterThanOrEqual(14, count($checked));
    }

    public function test_footer_labels_match_destinations_and_unavailable_links_are_hidden(): void
    {
        $response = $this->get(route('contactos'))->assertOk();
        $html = $response->getContent();
        $start = strpos($html, '<footer');
        $end = strpos($html, '</footer>', $start);
        $this->assertNotFalse($start);
        $this->assertNotFalse($end);
        $footer = substr($html, $start, $end - $start);

        $this->assertStringContainsString('href="'.route('investigacao').'"', $footer);
        $this->assertStringContainsString('href="'.route('trabalhe-conosco').'"', $footer);
        $this->assertStringContainsString('href="'.route('inclusao').'#acessibilidade"', $footer);
        $this->assertStringContainsString('Resultados de Exames', $footer);
        $this->assertStringContainsString('Missão</a>', $footer);
        $this->assertStringContainsString('Notícias</a>', $footer);

        foreach (['/transparencia', '/acessibilidade', '/politica-privacidade', '/termos', '/bolsas', '/ouvidoria', '/projetos', '/concursos', '/repositorio', '/busca-biblioteca', '/pos-graduacao', '/cursos-online'] as $unavailable) {
            $this->assertStringNotContainsString('href="'.$unavailable.'"', $footer);
        }
        $this->assertStringNotContainsString('facebook.com/search/', $footer);
        $this->assertStringNotContainsString('youtube.com/@ispbie', $footer);
        $this->assertStringNotContainsString('Gabinete Prov.', $footer);
        $this->assertStringNotContainsString('>Unitel<', $footer);
        $this->assertStringNotContainsString('>Cefejor<', $footer);

        // The shared layout still renders its established main navigation.
        $this->assertStringContainsString('href="'.route('pdi').'"', $html);
        $this->assertStringContainsString('href="'.route('calendario-academico').'"', $html);
        $this->get(route('parcerias'))->assertOk();
        $this->get(route('pdi'))->assertOk();
        $this->get(route('calendario-academico'))->assertOk();
    }
}
