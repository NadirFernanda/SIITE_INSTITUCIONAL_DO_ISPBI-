<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global rate limit: 200 requests/minute per IP for all web routes.
        // Individual sensitive endpoints (login, contact, alumni, revista) have stricter limits.
        $middleware->web(append: [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':200,1',
            \App\Http\Middleware\TrackVisit::class,
        ]);
        $middleware->append(\App\Http\Middleware\SecureHeaders::class);
        $middleware->alias([
            'admin'      => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'tecnico'    => \App\Http\Middleware\EnsureUserIsTecnico::class,
            'subcomissao_lancamento' => \App\Http\Middleware\EnsureUserIsSubcomissaoLancamento::class,
            'daac'       => \App\Http\Middleware\EnsureUserIsDAAC::class,
            'alumni'     => \App\Http\Middleware\EnsureUserIsAlumni::class,
            'secretaria' => \App\Http\Middleware\EnsureUserIsSecretaria::class,
            'subcomissao_correcao'  => \App\Http\Middleware\EnsureUserIsSubcomissaoCorrecao::class,
            'presidencia' => \App\Http\Middleware\EnsureUserIsPresidencia::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
