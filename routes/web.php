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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

$this->group(['middleware' => 'auth'], function() {

    Route::resource('/empresas', 'EmpresaController');
    Route::resource('/funcionarios', 'FuncionarioController');
    Route::resource('/eventos', 'EventoController');
    Route::resource('/participantes', 'ParticipanteController');
    Route::resource('/users', 'UserController');
    
    Route::get('/funcionarios-create/{id}', 'FuncionarioController@createFuncionario')->name('funcionarios.create');
    Route::post('/funcionarios-create/{id}', 'FuncionarioController@storeFuncionario');
    Route::get('/funcionarios-detalhe/{id}', 'FuncionarioController@detalheFuncionario')->name('funcionarios.detalhe');
    
    Route::get('/eventos-create/{id}', 'EventoController@createEvento')->name('eventos.create');
    Route::post('/eventos-create/{id}', 'EventoController@storeEvento');
    Route::get('/eventos-detalhe/{id}', 'EventoController@detalheEvento')->name('eventos.detalhe');
    
    Route::get('/users-create', 'UserController@create')->name('users.create');
    Route::post('/users-create', 'UserController@store');
    
    Route::get('/relatorios', 'RelatorioController@index')->name('relatorios.index');
    Route::get('/rel-empresas', 'RelatorioController@relEmpresa')->name('relatorios.empresa');
    Route::get('/exportar-empresas', 'RelatorioController@exportCsvEmpresas')->name('relatorios.exportarEmpresas');
    Route::get('/exportar-eventos', 'RelatorioController@exportCsvEventos')->name('relatorios.exportarEventos');
    Route::get('/exportar-eventos-det', 'RelatorioController@exportCsvEventosDet')->name('relatorios.exportarEventosDet');
    Route::get('/rel-eventos', 'RelatorioController@relEvento')->name('relatorios.evento');
    Route::get('/rel-eventos-det/{ev}', 'RelatorioController@relEventoDet')->name('relatorios.det');
    
    Route::get('/participantes-show/{id}', 'ParticipanteController@show')->name('participantes.show');
    Route::get('/participantes-show/{id}', 'ParticipanteController@buscaParticipante')->name('participantes.buscaParticipante');
    Route::post('/participantes-show/{id}', 'ParticipanteController@storeParticipante');
    Route::get('/participantes-create/{id}', 'ParticipanteController@createParticipante')->name('participantes.create');
    Route::post('/participantes-create/{id}', 'ParticipanteController@storeParticipanteIndividual');
    
    Route::get('/credenciamentos/{id}', 'CredenciamentoController@index')->name('credenciamentos.index');
    Route::post('/credenciamentos/{id}', 'CredenciamentoController@storeCredenciamento');
    
});




