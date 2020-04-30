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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'demandas'], function () {
    
    Route::get('/', 'DemandasController@index')->name('listaDemandas');
    Route::get('/cadastrar', 'DemandasController@create')->name('formDemandas');
    Route::post('/cadastrar/store', 'DemandasController@store')->name('cadastroDemandas');
    Route::get('/editar', 'DemandasController@edit')->name('editaDemandas');
    Route::put('/editar/{demandas}', 'DemandasController@update')->name('updateDemandas');

});

Route::group(['prefix' => 'projetos'], function () {
    
    Route::get('/', 'ProjetosController@index')->name('listaProjetos');
    Route::get('/cadastrar', 'ProjetosController@create')->name('formProjetos');
    Route::post('/cadastrar/store', 'ProjetosController@store')->name('cadastroProjetos');
    Route::post('/editar', 'ProjetosController@edit')->name('editaProjetos');
    Route::put('/editar/{projetos}', 'ProjetosController@update')->name('updateProjetos');
    // Route::get('/users', 'ProjetosController@show')->name('showUsersProjetos');

});
