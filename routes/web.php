<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;


// Rotas do painel administrativo protegidas por autenticação
Route::middleware('auth')->group(function () {
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
    Route::get('/admin/paginas', function () {
        // Exemplo: buscar páginas do banco se existir o model Pagina
        // $paginas = App\Models\Pagina::all();
        $paginas = [];
        return view('admin.paginas', compact('paginas'));
    })->name('admin.paginas');
    Route::get('/admin/midia', function () {
        $midias = [];
        return view('admin.midia', compact('midias'));
    })->name('admin.midia');
    Route::resource('/admin/carrossel', App\Http\Controllers\Admin\CarrosselController::class)->names('admin.carrossel');
    Route::post('/admin/carrossel/{id}/toggle-publicar', [App\Http\Controllers\Admin\CarrosselController::class, 'togglePublicar'])->name('admin.carrossel.toggle-publicar');
    Route::get('/admin/alumni', [App\Http\Controllers\AdminAlumniController::class, 'index'])->name('admin.alumni');
    Route::post('/admin/alumni/{id}/toggle-publicar', [App\Http\Controllers\AdminAlumniController::class, 'togglePublicar'])->name('admin.alumni.toggle-publicar');
    Route::post('/admin/alumni/{id}/toggle-testemunho', [App\Http\Controllers\AdminAlumniController::class, 'toggleTestemunho'])->name('admin.alumni.toggle-testemunho');
    Route::get('/admin/usuarios', function () {
        $usuarios = [];
        return view('admin.usuarios', compact('usuarios'));
    })->name('admin.usuarios');
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

use App\Http\Controllers\ResultadosController;

Route::get('/busca', function () {
    return view('pages.busca');
})->name('busca');

Route::get('/', function () {
    $testemunhos = Alumnus::where('publicado', true)
        ->where('testemunho', true)
        ->orderByDesc('created_at')
        ->take(6)
        ->get();
    return view('welcome', compact('testemunhos'));
})->name('welcome');

// Investigação (public) - use closure to guarantee controller is executed and view data provided
Route::get('/investigacao', function () {
    return app(App\Http\Controllers\ProjectController::class)->index();
})->name('investigacao');

// Admin CRUD for projects
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('projects', AdminProjectController::class)->parameters(['projects' => 'project']);
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
Route::view('/noticias', 'pages.noticias')->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');

// Rota para envio do formulário de contactos
use App\Http\Controllers\ContactController;
Route::post('/contactos/send', [ContactController::class, 'send'])->name('contact.send');

Route::view('/valores', 'pages.valores')->name('valores');
Route::view('/visao', 'pages.visao')->name('visao');
Route::view('/trabalhe-conosco', 'pages.trabalhe-conosco')->name('trabalhe-conosco');
Route::view('/sistemas', 'pages.sistemas')->name('sistemas');
Route::view('/resultados', 'pages.resultados')->name('resultados');
Route::post('/resultados/validar', [ResultadosController::class, 'validar'])->name('resultados.validar')->middleware('throttle:10,1');
Route::view('/presidencia', 'pages.presidencia')->name('presidencia');
Route::view('/pilares', 'pages.pilares')->name('pilares');
Route::view('/pesquisa', 'pages.pesquisa')->name('pesquisa');
Route::view('/missao', 'pages.missao')->name('missao');
Route::view('/mestrado', 'pages.mestrado')->name('mestrado');
Route::view('/linguas', 'pages.linguas')->name('linguas');
Route::view('/jornadas', 'pages.jornadas')->name('jornadas');
Route::get('/sobre-ispbie', [App\Http\Controllers\InstitucionalController::class, 'index'])->name('institucional');
Route::view('/inclusao', 'pages.inclusao')->name('inclusao');
Route::view('/noticias', 'pages.noticias')->name('noticias');
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
Route::post('/alumni', [App\Http\Controllers\AlumniController::class, 'store'])->name('alumni.store');

// Rotas para Acesso Rápido
// Rota '/portal' removida (página externa usada em vez da view interna)
Route::view('/revista', 'pages.revista')->name('revista');

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
        'category' => 'nullable|string|max:255',
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

    // Redirect back to the submission form so user sees immediate feedback
    return redirect()->back()->withInput()->with('status', 'Submissão recebida e pendente para  avaliação.');
})->name('revista.submeter.post');
Route::view('/biblioteca', 'pages.biblioteca')->name('biblioteca');
Route::view('/repositorio', 'pages.repositorio')->name('repositorio');

Route::view('/busca-pessoas', 'pages.pesquisa-pessoas')->name('busca-pessoas');
Route::view('/busca-biblioteca', 'pages.busca-biblioteca')->name('busca-biblioteca');
// Rota para exibir notícia individual
Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show']);
Route::view('/servicos', 'pages.servicos')->name('servicos');

require __DIR__.'/auth.php';
