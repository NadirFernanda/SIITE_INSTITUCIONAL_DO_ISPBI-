<?php

// PHPUnit must never load the application's normal environment or cached config.
$autoload = dirname(__DIR__).'/.test-runtime/vendor/autoload.php';
require is_file($autoload) ? $autoload : dirname(__DIR__).'/vendor/autoload.php';

$root = dirname(__DIR__);
$runtime = $root.'/.test-runtime';
if (! is_dir($runtime.'/views') && ! mkdir($runtime.'/views', 0777, true) && ! is_dir($runtime.'/views')) {
    throw new RuntimeException('Não foi possível preparar o directório isolado de testes.');
}
// An empty dedicated file prevents dotenv from probing any real credentials.
file_put_contents($runtime.'/.env.testing', '');
foreach ([
    'APP_CONFIG_CACHE' => $root.'/.test-runtime/config.php',
    'APP_ROUTES_CACHE' => $root.'/.test-runtime/routes.php',
    'APP_EVENTS_CACHE' => $root.'/.test-runtime/events.php',
] as $key => $value) {
    if (is_file($value)) {
        throw new RuntimeException('Testes recusados: existe cache em '.$value);
    }
    putenv($key.'='.$value);
    $_ENV[$key] = $_SERVER[$key] = $value;
}

// Do not read .env: only explicitly reserved test settings are accepted.
foreach ([
    'APP_ENV' => 'testing',
    'APP_URL' => 'http://localhost',
    'APP_KEY' => 'base64:'.base64_encode(str_repeat('t', 32)),
    'DB_CONNECTION' => 'pgsql',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '55432',
    'DB_DATABASE' => 'isp_bie_test',
    'DB_USERNAME' => 'isp_bie_test',
    'DB_PASSWORD' => '',
    'DB_URL' => '',
    'CACHE_STORE' => 'array',
    'SESSION_DRIVER' => 'array',
    'SESSION_SECURE_COOKIE' => 'false',
    'MAIL_MAILER' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'EVOLUTION_ENABLED' => 'false',
] as $key => $value) {
    putenv($key.'='.$value);
    $_ENV[$key] = $_SERVER[$key] = $value;
}
