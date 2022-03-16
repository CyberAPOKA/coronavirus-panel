<?php

use App\Http\Controllers\CasosController;
use App\Http\Controllers\FormularioController;
use Illuminate\Support\Facades\Route;
use App\Formulario;


Route::get('/', 'CasosController@index')->name('casos.cadastro');

Route::get('/registrar', 'Auth\RegisterController@index')->name('user.register');
Route::post('/register/salvar', 'Auth\RegisterController@store')->name('user.salvar');

Route::get('/cadastro', 'CasosController@create')->name('casos.cadastro')->middleware('auth');
Route::post('/cadastro/salvar', 'CasosController@store')->name('casos.salvar')->middleware('auth');

Route::get('/lista','CasosController@lista')->name('casos.lista')->middleware('auth');

Route::get('/editar/{id}','CasosController@editCasos')->name('casos.editcasos')->middleware('auth');
Route::post('/update/{id}','CasosController@update')->name('casos.salvaredit')->middleware('auth');
Route::get('/auditoria','AuditController@index')->name('casos.audit')->middleware('auth');

Route::get('/gerenciador', 'CasosController@menu')->name('casos.menu')->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout')->name('login.logout')->middleware('auth');

Route::get('/arquivos', 'CasosController@uploadArquivoIndex')->name('casos.arquivos')->middleware('auth');
Route::post('/arquivos-upload', 'CasosController@uploadArquivos')->name('casos.uploadArquivos')->middleware('auth');

Route::get('/download', 'CasosController@downloadArquivos')->name('casos.download');
Route::get('/download2', 'CasosController@downloadArquivos2')->name('casos.download2');
Route::get('/arquivosdownload','CasosController@arquivosdownload')->name('casos.arquivos2');

Auth::routes();
