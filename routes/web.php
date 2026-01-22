Route::view('/inovacao', 'pages.inovacao')->name('inovacao');

<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Placeholder routes for later scaffolding
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/cursos', 'pages.cursos')->name('cursos');
Route::view('/pos-graduacao', 'pages.pos-graduacao')->name('pos-graduacao');
Route::view('/investigacao', 'pages.pesquisa-pessoas')->name('investigacao');
Route::view('/vida-academica', 'pages.vida')->name('vida');
Route::view('/noticias', 'pages.noticias')->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');

Route::view('/valores', 'pages.valores')->name('valores');
Route::view('/transparencia', 'pages.transparencia')->name('transparencia');
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
Route::view('/institucional', 'pages.institucional')->name('institucional');
Route::view('/inclusao', 'pages.inclusao')->name('inclusao');
Route::view('/imprensa', 'pages.imprensa')->name('imprensa');
Route::view('/guia-estudante', 'pages.guia-estudante')->name('guia-estudante');
Route::view('/gestao', 'pages.gestao')->name('gestao');
Route::view('/eventos', 'pages.eventos')->name('eventos');
Route::view('/estagios', 'pages.estagios')->name('estagios');
Route::view('/cursos-online', 'pages.cursos-online')->name('cursos-online');
Route::view('/cultura', 'pages.cultura')->name('cultura');
Route::view('/calendario-academico', 'pages.calendario-academico')->name('calendario-academico');

Route::view('/candidaturas', 'pages.candidaturas')->name('candidaturas');
Route::view('/alumni', 'pages.alumni')->name('alumni');

// Webmail
Route::view('/webmail', 'pages.webmail')->name('webmail');

// Rotas para Acesso Rápido
Route::view('/portal', 'pages.portal')->name('portal');
Route::view('/ouvidoria', 'pages.ouvidoria')->name('ouvidoria');
Route::view('/revista', 'pages.revista')->name('revista');
Route::view('/biblioteca', 'pages.biblioteca')->name('biblioteca');
Route::view('/repositorio', 'pages.repositorio')->name('repositorio');
Route::view('/busca-pessoas', 'pages.pesquisa-pessoas')->name('busca-pessoas');
Route::view('/busca-biblioteca', 'pages.busca-biblioteca')->name('busca-biblioteca');
