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

Route::group(['prefix' => 'permissions', 'middleware' => 'auth'], function () {

    Route::post('/', 'PermissionsController@permissions')->name('permissions');
    Route::get('/edit', 'PermissionsController@edit')->name('editPermissions');
    Route::post('/update', 'PermissionsController@update')->name('updatePermissions');
    Route::post('/show/roles', 'PermissionsController@showRoles')->name('roles');

});

Route::post('/notifications', 'NotificationsController@read')->name('notifications');

Route::group(['prefix' => 'demandas', 'middleware' => 'auth'], function () {

    Route::get('/', 'DemandasController@index')->name('listaDemandas');
    Route::get('/cadastrar', 'DemandasController@create')->name('formDemandas');
    Route::post('/', 'DemandasController@store')->name('cadastroDemandas');
    Route::get('/{id}/{idProjeto}/editar', 'DemandasController@edit')->name('editaDemandas');
    Route::put('/{id}', 'DemandasController@update')->name('updateDemandas');
    Route::post('/delete/{id}', 'DemandasController@destroy')->name('destroyDemandas');
    Route::post('/ajax', 'DemandasController@show')->name('ajaxDemandas');

});

Route::group(['prefix' => 'projetos', 'middleware' => 'auth'], function () {

    Route::get('/', 'ProjetosController@index')->name('listaProjetos');
    Route::get('/cadastrar', 'ProjetosController@create')->name('formProjetos');
    Route::post('/', 'ProjetosController@store')->name('cadastroProjetos');
    Route::get('/{id}/editar', 'ProjetosController@edit')->name('editaProjetos');
    Route::put('/{id}', 'ProjetosController@update')->name('updateProjetos');
    Route::post('/delete/{id}', 'ProjetosController@destroy')->name('destroyProjetos');

});

Route::group(['prefix' => 'comentarios', 'middleware' => 'auth'], function () {

    Route::post('/', 'ComentariosController@index')->name('listaComentarios');
    Route::post('/adicionar', 'ComentariosController@store')->name('storeComentarios');

});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {

    Route::get('/', 'ProfileController@edit')->name('listProfile');
    Route::put('/edit/{id}', 'ProfileController@update')->name('editProfile');

});

//Route::get('/import', 'ProfileController@create')->name('importJob');

Route::get('import', function () {

    \App\Jobs\ImportJob::dispatch();
    return redirect()->route('home');

})->name('importJob');
