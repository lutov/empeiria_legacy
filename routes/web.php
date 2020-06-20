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

Route::get('/world', 'WorldController@index')->name('world');

Route::get('/characters', 'CharactersController@list')->name('characters');
Route::post('/characters', 'CharactersController@add')->name('character_add');
Route::get('/characters/{id}', 'CharactersController@get')->name('character');
Route::post('/characters/{id}', 'CharactersController@update')->name('character_update');
Route::delete('/characters/{id}', 'CharactersController@delete')->name('character_delete');

Route::get('/squads', 'SquadsController@list')->name('squads');
Route::post('/squads', 'SquadsController@add')->name('squad_add');
Route::get('/squads/{id}', 'SquadsController@get')->name('squad');
Route::post('/squads/{id}', 'SquadsController@update')->name('squad_update');
Route::delete('/squads/{id}', 'SquadsController@delete')->name('squad_delete');
