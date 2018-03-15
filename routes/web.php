<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dump/testedeputados', 'DeputadosDumpController@getDadosAbertosDeputados')->name('Deputados');
Route::get('/dump/deputadosdetalhes', 'DeputadosDumpController@dumpDeputadosDetalhes')->name('Deputados');
Route::get('/dump/deputados', 'DeputadosDumpController@buscaDadosAbertosDeputados')->name('Deputados');
