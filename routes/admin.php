<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
Route::get('/', ['uses'=>'HomeController@IndexAdmin','as'=>'admin.index']);

//Articulos
Route::get('/articulos',['uses'=>'ArticleController@Index','as'=>'admin.article.index']);
Route::get('/articulos/crear',['uses'=>'ArticleController@Create','as'=>'admin.article.create']);
Route::post('/articulos/crear',['uses'=>'ArticleController@Store','as'=>'admin.article.store']);
Route::get('/articulos/ver/{id}',['uses'=>'ArticleController@AdminShow','as'=>'admin.article.show']);
Route::get('/articulos/editar/{id}',['uses'=>'ArticleController@Edit','as'=>'admin.article.edit']);
Route::put('/articulos/actualizar/{id}',['uses'=>'ArticleController@Update','as'=>'admin.article.update']);
Route::get('/articulos/reordenar',['uses'=>'ArticleController@Reorder','as'=>'admin.article.reorder']);
Route::post('/articulos/reordenar',['uses'=>'ArticleController@SaveReorder','as'=>'admin.article.saveReorder']);

Route::post('articulos/activar/{id}',['uses'=>'ArticleController@Activate','as'=>'admin.article.activate']);
Route::post('articulos/eliminar/{id}',['uses'=>'ArticleController@Delete','as'=>'admin.article.delete']);

Route::get('/articulos/{id}/adjuntos',['uses'=>'AdjuntoController@Edit','as'=>'admin.adjuntos.edit']);

Route::post('/articulos/{id}/adjuntos/update',['uses'=>'AdjuntoController@Update','as'=>'admin.adjuntos.update']);
Route::post('/articulos/adjuntos/delete/{id}',['uses'=>'AdjuntoController@Update','as'=>'admin.adjuntos.delete']);


Route::get('medios/getData', ['uses' => 'MedioController@getData', 'as' => 'medio.data']);
Route::post('/upload/image', 'MedioController@UploadImage')->name('medio.uploadImage');
Route::post('/upload/video', 'MedioController@UploadVideo')->name('medio.uploadVideo');
Route::post('/upload/portada', 'MedioController@UploadHomeGif')->name('medio.portada');


//Categorias
Route::get('/categorias',['uses'=>'CategoriaController@Index','as'=>'admin.categories.index']);
Route::get('/categorias/crear',['uses'=>'CategoriaController@Create','as'=>'admin.categories.create']);
Route::post('/categorias/crear',['uses'=>'CategoriaController@Store','as'=>'admin.categories.store']);

Route::get('/categorias/editar/{id}',['uses'=>'CategoriaController@Edit','as'=>'admin.categories.edit']);
Route::put('/categorias/actualizar/{id}',['uses'=>'CategoriaController@Update','as'=>'admin.categories.update']);
Route::post('categorias/eliminar/{id}',['uses'=>'CategoriaController@Delete','as'=>'admin.categories.delete']);

//Clientes
Route::get('/clientes',['uses'=>'ClienteController@Index','as'=>'admin.clientes.index']);
Route::get('/clientes/crear',['uses'=>'ClienteController@Create','as'=>'admin.clientes.create']);
Route::post('/clientes/crear',['uses'=>'ClienteController@Store','as'=>'admin.clientes.store']);

Route::get('/clientes/editar/{id}',['uses'=>'ClienteController@Edit','as'=>'admin.clientes.edit']);
Route::put('/clientes/actualizar/{id}',['uses'=>'ClienteController@Update','as'=>'admin.clientes.update']);
Route::post('clientes/eliminar/{id}',['uses'=>'ClienteController@Delete','as'=>'admin.clientes.delete']);

//Cargos
Route::get('/cargos',['uses'=>'CargoController@Index','as'=>'admin.cargos.index']);
Route::get('/cargos/crear',['uses'=>'CargoController@Create','as'=>'admin.cargos.create']);
Route::post('/cargos/crear',['uses'=>'CargoController@Store','as'=>'admin.cargos.store']);

Route::get('/cargos/editar/{id}',['uses'=>'CargoController@Edit','as'=>'admin.cargos.edit']);
Route::put('/cargos/actualizar/{id}',['uses'=>'CargoController@Update','as'=>'admin.cargos.update']);
Route::post('cargos/eliminar/{id}',['uses'=>'CargoController@Delete','as'=>'admin.cargos.delete']);

//Miembros
Route::get('/miembros',['uses'=>'MiembroController@Index','as'=>'admin.miembros.index']);
Route::get('/miembros/crear',['uses'=>'MiembroController@Create','as'=>'admin.miembros.create']);
Route::post('/miembros/crear',['uses'=>'MiembroController@Store','as'=>'admin.miembros.store']);

Route::get('/miembros/editar/{id}',['uses'=>'MiembroController@Edit','as'=>'admin.miembros.edit']);
Route::put('/miembros/actualizar/{id}',['uses'=>'MiembroController@Update','as'=>'admin.miembros.update']);
Route::post('miembros/eliminar/{id}',['uses'=>'MiembroController@Delete','as'=>'admin.miembros.delete']);

});