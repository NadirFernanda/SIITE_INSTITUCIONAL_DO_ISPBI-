// Rotas individuais para páginas de cursos
Route::view('/cursos/informatica', 'pages.cursos.informatica')->name('cursos.informatica');
Route::view('/cursos/hidricos', 'pages.cursos.hidricos')->name('cursos.hidricos');
Route::view('/cursos/psicologia', 'pages.cursos.psicologia')->name('cursos.psicologia');
Route::view('/cursos/comunicacao', 'pages.cursos.comunicacao')->name('cursos.comunicacao');
Route::view('/cursos/contabilidade', 'pages.cursos.contabilidade')->name('cursos.contabilidade');
Route::view('/cursos/enfermagem', 'pages.cursos.enfermagem')->name('cursos.enfermagem');
<?php



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
    Route::view('/admin', 'admin.dashboard')->name('admin');
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
    return view('welcome', compact('testemunhos'));
})->name('welcome');

// Placeholder routes for later scaffolding
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/cursos', 'pages.cursos')->name('cursos');
Route::view('/pos-graduacao', 'pages.pos-graduacao')->name('pos-graduacao');
Route::view('/investigacao', 'pages.investigacao')->name('investigacao');
Route::view('/vida-academica', 'pages.vida')->name('vida');
Route::view('/noticias', 'pages.noticias')->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');

Route::view('/valores', 'pages.valores')->name('valores');
Route::view('/visao', 'pages.visao')->name('visao');
Route::view('/trabalhe-conosco', 'pages.trabalhe-conosco')->name('trabalhe-conosco');
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
Route::view('/portal', 'pages.portal')->name('portal');
Route::view('/ouvidoria', 'pages.ouvidoria')->name('ouvidoria');
Route::view('/revista', 'pages.revista')->name('revista');
Route::view('/biblioteca', 'pages.biblioteca')->name('biblioteca');
Route::view('/repositorio', 'pages.repositorio')->name('repositorio');

Route::view('/busca-pessoas', 'pages.pesquisa-pessoas')->name('busca-pessoas');
Route::view('/busca-biblioteca', 'pages.busca-biblioteca')->name('busca-biblioteca');
// Rota para exibir notícia individual
Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show']);
Route::view('/servicos', 'pages.servicos')->name('servicos');

require __DIR__.'/auth.php';
