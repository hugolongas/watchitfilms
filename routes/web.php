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

Route::get('/', ['uses' => 'HomeController@Index', 'as' => 'index']);
Route::get('/contacto', ['uses' => 'HomeController@Contact', 'as' => 'contact']);
Route::post('/contacto', ['uses' => 'HomeController@SendContact', 'as' => 'contact.send']);

Route::get('/nosotros', ['uses' => 'HomeController@Weare', 'as' => 'weare']);

Route::get('/modal/{id}',['uses'=>'HomeController@LoadModal','as'=>'modal']);

Route::get('/politica-privacidad.html', ['uses' => 'HomeController@PoliticaPrivacidad', 'as' => 'politica-privacidad']);
Route::get('/politica-cookies.html', ['uses' => 'HomeController@PoliticaCookie', 'as' => 'politica-cookie']);
//
Route::get('/{categoria}', ['uses' => 'ArticleController@CategoryArticles', 'as' => 'category']);
Route::get('/{categoria}/{slug}', ['uses' => 'ArticleController@Show', 'as' => 'article']);

