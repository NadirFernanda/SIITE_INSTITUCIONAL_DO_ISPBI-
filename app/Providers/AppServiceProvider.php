<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }

        // Authorization policies
        Gate::policy(\App\Models\Noticia::class, \App\Policies\NoticiaPolicy::class);
        Gate::policy(\App\Models\Concurso::class, \App\Policies\ConcursoPolicy::class);

        // View Composers: inject DB data into components/partials that previously
        // had @php query blocks, keeping views query-free.
        View::composer('welcome', function ($view) {
            $view->with('estatisticas', \App\Models\Estatistica::orderBy('ordem')->get());
        });

        View::composer('components.noticias-carousel', function ($view) {
            $view->with('noticiasRecentes',
                \App\Models\Noticia::where('publicada', 1)->orderByDesc('data')->take(6)->get()
            );
        });

        View::composer('components.testemunhos-carousel', function ($view) {
            $view->with('testemunhos',
                \App\Models\Alumnus::where('publicado', 1)->where('testemunho', true)->orderByDesc('id')->take(10)->get()
            );
        });

        View::composer('partials.noticias-institucionais', function ($view) {
            $view->with('noticias',
                \App\Models\Noticia::where('institucional', true)->orderByDesc('data')->take(6)->get()
            );
        });

        // Redirecionar utilizadores autenticados que tentam aceder a rotas "guest"
        // (ex: /login) para o painel correcto consoante o seu role.
        RedirectIfAuthenticated::redirectUsing(function (Request $request) {
            $user = Auth::user();
            $role = $user?->role ?? '';

            return match(true) {
                $role === 'admin'                          => route('admin'),
                $role === 'daac'                           => route('daac.candidaturas.index'),
                $role === 'tecnico'                        => route('tecnico.candidaturas.index'),
                $role === 'lancamento'                    => route('lancamento.salas.index'),
                $role === 'alumni' && $user->aprovado      => route('portal.dashboard'),
                $role === 'alumni' && ! $user->aprovado    => route('portal.pendente'),
                default                                    => '/',
            };
        });

        $this->configureRateLimiting();
    }

    /**
     * Configure named rate limiters used across routes.
     *
     * - login:   5 attempts per minute per IP (brute-force protection)
     * - api:     60 requests per minute per authenticated user or IP (general API)
     */
    protected function configureRateLimiting(): void
    {
        // Brute-force protection for the login endpoint
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->input('email') . '|' . $request->ip())
                ->response(function () {
                    return back()
                        ->withInput()
                        ->withErrors(['email' => 'Demasiadas tentativas. Tente novamente mais tarde.']);
                });
        });

        // Default API limiter
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
