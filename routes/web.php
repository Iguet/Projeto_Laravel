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
    Route::post('/', 'DemandasController@store')->name('cadastroDemandas');
    Route::get('/{id}/{idProjeto}/editar', 'DemandasController@edit')->name('editaDemandas');
    Route::put('/{id}', 'DemandasController@update')->name('updateDemandas');
    Route::post('/delete/{id}', 'DemandasController@destroy')->name('destroyDemandas');
    Route::post('/ajax', 'DemandasController@show')->name('ajaxDemandas');

});

Route::group(['prefix' => 'projetos'], function () {
    
    Route::get('/', 'ProjetosController@index')->name('listaProjetos');
    Route::get('/cadastrar', 'ProjetosController@create')->name('formProjetos');
    Route::post('/', 'ProjetosController@store')->name('cadastroProjetos');
    Route::get('/{id}/editar', 'ProjetosController@edit')->name('editaProjetos');
    Route::put('/{id}', 'ProjetosController@update')->name('updateProjetos');
    Route::post('/{id}', 'ProjetosController@destroy')->name('destroyProjetos');

});
