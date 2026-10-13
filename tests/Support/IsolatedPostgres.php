<?php

namespace Tests\Support;

use Illuminate\Foundation\Application;
use RuntimeException;

class IsolatedPostgres
{
    public static function configure(Application $app): void
    {
        if (! $app->environment('testing') || $app->configurationIsCached()) {
            throw new RuntimeException('Testes recusados: ambiente ou cache inseguro.');
        }

        $connection = $app['config']->get('database.connections.pgsql');
        foreach (['driver' => 'pgsql', 'host' => '127.0.0.1', 'port' => '55432', 'database' => 'isp_bie_test', 'username' => 'isp_bie_test'] as $key => $expected) {
            if ((string) ($connection[$key] ?? '') !== $expected) {
                throw new RuntimeException('Testes recusados: ligação PostgreSQL não isolada ('.$key.').');
            }
        }
        if (! empty($connection['url']) || isset($connection['read']) || isset($connection['write'])) {
            throw new RuntimeException('Testes recusados: ligação alternativa configurada.');
        }

        // Discard every other connection before providers or RefreshDatabase run.
        $app['config']->set('database.default', 'pgsql');
        $app['config']->set('database.connections', ['pgsql' => $connection]);
        $app['config']->set('view.compiled', base_path('.test-runtime/views'));
        foreach (['local', 'public', 'alumni_private'] as $disk) {
            $app['config']->set('filesystems.disks.'.$disk.'.root', base_path('.test-runtime/files/'.$disk));
        }
        $app['config']->set('logging.default', 'stderr');
        $app['config']->set('services.evolution.enabled', false);
    }

    public static function verify(Application $app): void
    {
        $row = $app['db']->connection('pgsql')->selectOne(
            'SELECT current_database() AS database, current_user AS username, rolsuper, rolcreatedb, rolcreaterole FROM pg_roles WHERE rolname = current_user'
        );
        if ($row->database !== 'isp_bie_test' || $row->username !== 'isp_bie_test'
            || $row->rolsuper || $row->rolcreatedb || $row->rolcreaterole) {
            throw new RuntimeException('Testes recusados: base ou permissões do utilizador inseguras.');
        }
    }
}
