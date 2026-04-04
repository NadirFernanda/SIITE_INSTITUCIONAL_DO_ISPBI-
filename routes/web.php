<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;


// Rotas do painel administrativo protegidas por autenticação E papel de administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/estatisticas', App\Http\Controllers\Admin\EstatisticaController::class)->names('admin.estatisticas');
            Route::get('/admin/noticias/{id}/edit', [App\Http\Controllers\AdminNoticiaController::class, 'edit'])->name('admin.noticias.edit');
            Route::put('/admin/noticias/{id}', [App\Http\Controllers\AdminNoticiaController::class, 'update'])->name('admin.noticias.update');
            Route::delete('/admin/noticias/{id}', [App\Http\Controllers\AdminNoticiaController::class, 'destroy'])->name('admin.noticias.destroy');
        Route::post('/admin/noticias/{id}/toggle-publicar', [App\Http\Controllers\AdminNoticiaController::class, 'togglePublicar'])->name('admin.noticias.toggle-publicar');
        Route::get('/admin/noticias', [App\Http\Controllers\AdminNoticiaController::class, 'index'])->name('admin.noticias');
        Route::get('/admin/noticias/create', [App\Http\Controllers\AdminNoticiaController::class, 'create'])->name('admin.noticias.create');
        Route::post('/admin/noticias', [App\Http\Controllers\AdminNoticiaController::class, 'store'])->name('admin.noticias.store');
    Route::get('/admin', function () {
        $pending = 0;
        try {
            $pending = \App\Models\RevistaSubmission::where('status', 'pending')->count();
        } catch (\Throwable $e) {
            // ignore if table doesn't exist yet
        }
        return view('admin.dashboard', compact('pending'));
    })->name('admin');
    Route::get('/admin/paginas', [App\Http\Controllers\Admin\PaginaController::class, 'index'])->name('admin.paginas');
    Route::get('/admin/paginas/create', [App\Http\Controllers\Admin\PaginaController::class, 'create'])->name('admin.paginas.create');
    Route::post('/admin/paginas', [App\Http\Controllers\Admin\PaginaController::class, 'store'])->name('admin.paginas.store');
    Route::get('/admin/midia', [App\Http\Controllers\Admin\MidiaController::class, 'index'])->name('admin.midia');
    Route::post('/admin/midia', [App\Http\Controllers\Admin\MidiaController::class, 'store'])->name('admin.midia.store');
    Route::delete('/admin/midia/{id}', [App\Http\Controllers\Admin\MidiaController::class, 'destroy'])->name('admin.midia.destroy');
    Route::resource('/admin/carrossel', App\Http\Controllers\Admin\CarrosselController::class)->names('admin.carrossel');
    Route::post('/admin/carrossel/{id}/toggle-publicar', [App\Http\Controllers\Admin\CarrosselController::class, 'togglePublicar'])->name('admin.carrossel.toggle-publicar');
    Route::get('/admin/alumni', [App\Http\Controllers\AdminAlumniController::class, 'index'])->name('admin.alumni');
    Route::get('/admin/alumni/stats', [App\Http\Controllers\Admin\AlumniStatsController::class, 'edit'])->name('admin.alumni.stats');
    Route::post('/admin/alumni/stats', [App\Http\Controllers\Admin\AlumniStatsController::class, 'update'])->name('admin.alumni.stats.update');
    Route::post('/admin/alumni/{id}/toggle-publicar', [App\Http\Controllers\AdminAlumniController::class, 'togglePublicar'])->name('admin.alumni.toggle-publicar');
    Route::post('/admin/alumni/{id}/toggle-testemunho', [App\Http\Controllers\AdminAlumniController::class, 'toggleTestemunho'])->name('admin.alumni.toggle-testemunho');
    Route::get('/admin/usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'index'])->name('admin.usuarios');
    Route::get('/admin/configuracoes', function () {
        $configuracoes = [];
        return view('admin.configuracoes', compact('configuracoes'));
    })->name('admin.configuracoes');
});


// Rotas individuais para páginas de cursos (otimizado)

$cursos = ['informatica', 'hidricos', 'psicologia', 'comunicacao', 'contabilidade'];
foreach ($cursos as $curso) {
    Route::view("/cursos/{$curso}", "pages.cursos.{$curso}")->name("cursos.{$curso}");
}

// Rota de enfermagem com closure para evitar erro 500
Route::get('/cursos/enfermagem', function () {
    // Passe variáveis necessárias para o layout aqui, se houver
    return view('pages.cursos.enfermagem');
})->name('cursos.enfermagem');


use App\Models\Alumnus;


Route::get('/busca', function () {
    return view('pages.busca');
})->name('busca');

Route::get('/', function () {
    $testemunhos = Alumnus::where('publicado', true)
        ->where('testemunho', true)
        ->orderByDesc('created_at')
        ->take(6)
        ->get();
    $carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->take(5)->get();
    $totalSlides = $carrosseis->count();
    $hero = $carrosseis->first();
    return view('welcome', compact('testemunhos', 'carrosseis', 'totalSlides', 'hero'));
})->name('welcome');

// Investigação (public) - use closure to guarantee controller is executed and view data provided
Route::get('/investigacao', function () {
    return app(App\Http\Controllers\ProjectController::class)->index();
})->name('investigacao');

// Admin CRUD for projects
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('projects', AdminProjectController::class)->parameters(['projects' => 'project']);

    // Explicit admin routes for concursos that must be registered BEFORE the
    // resource route to avoid collisions with the implicit `{concurso}` binding
    // (e.g. '/admin/concursos/alerts' would otherwise be interpreted as an id).
    // Global subscribers list + export
    Route::get('concursos/alerts', [App\Http\Controllers\Admin\ConcursoController::class, 'alerts'])->name('concursos.alerts');
    Route::get('concursos/alerts/export', [App\Http\Controllers\Admin\ConcursoController::class, 'alertsExport'])->name('concursos.alerts.export');

    // Per-concurso subscribers (filtered by concurso.area) and export
    Route::get('concursos/{concurso}/subscribers', [App\Http\Controllers\Admin\ConcursoController::class, 'subscribers'])->name('concursos.subscribers');
    Route::get('concursos/{concurso}/subscribers/export', [App\Http\Controllers\Admin\ConcursoController::class, 'subscribersExport'])->name('concursos.subscribers.export');

    // Manual resend action for a specific concurso
    Route::post('concursos/{concurso}/resend-alerts', [App\Http\Controllers\Admin\ConcursoController::class, 'resendAlerts'])->name('concursos.resend-alerts');
    // Manual resend to ALL subscribers (ignore consent/area)
    Route::post('concursos/{concurso}/resend-alerts-all', [App\Http\Controllers\Admin\ConcursoController::class, 'resendAlertsAll'])->name('concursos.resend-alerts-all');

    // Delete attachment route for concursos (named under admin. prefix)
    Route::delete('concursos/attachments/{id}', [App\Http\Controllers\Admin\ConcursoController::class, 'destroyAttachment'])->name('concursos.attachments.destroy');

    // Now register the resource routes for concursos (will not intercept the
    // explicit routes defined above)
    Route::resource('concursos', App\Http\Controllers\Admin\ConcursoController::class);

    // Revista submissions moderation
    Route::get('revistas/submissions', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'index'])->name('revistas');
    Route::post('revistas/{id}/publish', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'publish'])->name('revistas.publish');
    Route::get('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'show'])->name('revistas.show');
    Route::get('revistas/{id}/edit', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'edit'])->name('revistas.edit');
    Route::put('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'update'])->name('revistas.update');
    Route::delete('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'destroy'])->name('revistas.destroy');
});

// Placeholder routes for later scaffolding
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/cursos', 'pages.cursos')->name('cursos');
Route::view('/pos-graduacao', 'pages.pos-graduacao')->name('pos-graduacao');
Route::view('/vida-academica', 'pages.vida')->name('vida');
Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');

// Rota para envio do formulário de contactos
use App\Http\Controllers\ContactController;
Route::post('/contactos/send', [ContactController::class, 'send'])->name('contact.send')->middleware('throttle:5,1');

// Alerts for concursos (subscribe)
use App\Http\Controllers\ConcursoAlertController;
Route::post('/alerts/subscribe', [ConcursoAlertController::class, 'store'])->name('alerts.subscribe')->middleware('throttle:5,1');
Route::view('/valores', 'pages.valores')->name('valores');
Route::view('/visao', 'pages.visao')->name('visao');
Route::get('/trabalhe-conosco', function () {
    $concursos = \App\Models\Concurso::where('status', 'published')
        ->orderByDesc('publish_at')
        ->get()
        ->map(function ($c) {
            if ($c->publish_at && ! $c->publish_at instanceof \Carbon\Carbon) {
                try { $c->publish_at = \Carbon\Carbon::parse($c->publish_at); }
                catch (\Throwable $e) { $c->publish_at = null; }
            }
            return $c;
        });
    $allCount = \App\Models\Concurso::count();
    $publishedCount = \App\Models\Concurso::where('status', 'published')->count();
    return view('pages.trabalhe-conosco', compact('concursos', 'allCount', 'publishedCount'));
})->name('trabalhe-conosco');
Route::view('/sistemas', 'pages.sistemas')->name('sistemas');
Route::view('/resultados', 'pages.resultados')->name('resultados');
Route::view('/presidencia', 'pages.presidencia')->name('presidencia');
Route::view('/pilares', 'pages.pilares')->name('pilares');
Route::view('/pesquisa', 'pages.pesquisa')->name('pesquisa');
Route::view('/missao', 'pages.missao')->name('missao');
Route::view('/mestrado', 'pages.mestrado')->name('mestrado');
Route::view('/linguas', 'pages.linguas')->name('linguas');
Route::view('/jornadas', 'pages.jornadas')->name('jornadas');
Route::get('/sobre-ispbie', [App\Http\Controllers\InstitucionalController::class, 'index'])->name('institucional');
Route::view('/inclusao', 'pages.inclusao')->name('inclusao');
Route::view('/guia-estudante', 'pages.guia-estudante')->name('guia-estudante');
Route::view('/gestao', 'pages.gestao')->name('gestao');
Route::view('/eventos', 'pages.eventos')->name('eventos');
Route::view('/estagios', 'pages.estagios')->name('estagios');
Route::view('/cursos-online', 'pages.cursos-online')->name('cursos-online');
Route::view('/cultura', 'pages.cultura')->name('cultura');
Route::view('/calendario-academico', 'pages.calendario-academico')->name('calendario-academico');

Route::view('/candidaturas', 'pages.candidaturas')->name('candidaturas');
Route::get('/alumni', function () {
    $alumni = App\Models\Alumnus::where('publicado', true)->orderByDesc('created_at')->get();
    return view('pages.alumni', compact('alumni'));
})->name('alumni');
Route::get('/alumni/{id}', [App\Http\Controllers\AlumniController::class, 'show'])->name('alumni.show');
Route::post('/alumni', [App\Http\Controllers\AlumniController::class, 'store'])->name('alumni.store')->middleware('throttle:3,1');

// Rotas para Acesso Rápido
// Rota '/portal' removida (página externa usada em vez da view interna)
// Public listing of published revista articles
Route::get('/revista', [App\Http\Controllers\RevistaController::class, 'index'])->name('revista');
Route::get('/revista/{id}', [App\Http\Controllers\RevistaController::class, 'show'])->whereNumber('id')->name('revista.show');

// Revista: página de submissão (GET form + POST handler)
Route::get('/revista/submeter', function () {
    return view('pages.revista-submeter');
})->name('revista.submeter');

Route::post('/revista/submeter', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'link' => 'required|url',
        'email' => 'required|email|max:255',
        'affiliation' => 'nullable|string|max:255',
        'category' => ['required','string','in:Engenharias e Tecnologia,Ciências da Saúde,Ciências Sociais e Humanas'],
        'notes' => 'nullable|string',
    ]);

    // Save submission for moderation
    $submission = App\Models\RevistaSubmission::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'description' => $request->input('description'),
        'link' => $request->input('link'),
        'email' => $request->input('email'),
        'affiliation' => $request->input('affiliation'),
        'category' => $request->input('category'),
        'notes' => $request->input('notes'),
        'status' => 'pending',
    ]);

    try {
        \Illuminate\Support\Facades\Mail::to('geral@isp-bie.ao')
            ->send(new App\Mail\RevistaSubmissionReceived($submission));
    } catch (\Throwable $e) {
        \Log::error('Falha ao enviar email de submissão da revista: '.$e->getMessage());
    }

    // Redirect to the submission page so user sees immediate feedback
    // (do NOT include old input on success so the form fields are cleared)
    return redirect()->route('revista.submeter')->with('status', 'Submissão recebida e pendente para  avaliação.');
})->name('revista.submeter.post')->middleware('throttle:3,1');
Route::view('/biblioteca', 'pages.biblioteca')->name('biblioteca');
Route::view('/repositorio', 'pages.repositorio')->name('repositorio');

Route::view('/busca-pessoas', 'pages.pesquisa-pessoas')->name('busca-pessoas');
Route::view('/busca-biblioteca', 'pages.busca-biblioteca')->name('busca-biblioteca');
// Rota para exibir notícia individual
Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticias.show');
Route::view('/servicos', 'pages.servicos')->name('servicos');
Route::view('/parcerias', 'pages.parcerias')->name('parcerias');

require __DIR__.'/auth.php';
