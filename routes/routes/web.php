<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Placeholder routes for later scaffolding
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/cursos', 'pages.cursos')->name('cursos');
Route::view('/investigacao', 'pages.investigacao')->name('investigacao');
Route::view('/vida-academica', 'pages.vida')->name('vida');
Route::view('/noticias', 'pages.noticias')->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');
