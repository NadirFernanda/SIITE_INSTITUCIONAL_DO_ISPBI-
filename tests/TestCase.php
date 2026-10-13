<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = require dirname(__DIR__).'/bootstrap/app.php';
        $app->useEnvironmentPath(dirname(__DIR__).'/.test-runtime');
        $app->loadEnvironmentFrom('.env.testing');
        $app->afterBootstrapping(\Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
            fn ($app) => \Tests\Support\IsolatedPostgres::configure($app));
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        \Tests\Support\IsolatedPostgres::verify($app);

        return $app;
    }
}
