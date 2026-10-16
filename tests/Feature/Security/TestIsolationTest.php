<?php

use Tests\Support\IsolatedPostgres;

test('test connection is exclusively the restricted local PostgreSQL database', function () {
    expect(config('database.default'))->toBe('pgsql');
    expect(array_keys(config('database.connections')))->toBe(['pgsql']);
    IsolatedPostgres::verify($this->app);
    expect(config('mail.default'))->toBe('array');
    expect(config('session.driver'))->toBe('array');
});

test('unsafe connection settings are rejected before migrations', function (string $key, string $value) {
    config(['database.connections.pgsql.'.$key => $value]);
    expect(fn () => IsolatedPostgres::configure($this->app))->toThrow(RuntimeException::class);
})->with([
    ['host', 'production.example.test'], ['port', '5432'], ['database', 'production'],
    ['username', 'postgres'], ['driver', 'sqlite'], ['url', 'pgsql://production.example.test/production'],
]);

test('non testing environments are rejected before migrations', function () {
    $this->app['env'] = 'production';
    expect(fn () => IsolatedPostgres::configure($this->app))->toThrow(RuntimeException::class);
});
