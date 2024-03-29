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
    return view('main');
})->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/demo/', 'GameController@demo')->name('demo');
    Route::get('/game/', 'GameController@index')->name('game');
    Route::get('/worlds/', 'GameController@worlds')->name('game_worlds');
    Route::get('/worlds/{id}', 'GameController@world')->name('game_world');
    Route::get('/factions/', 'GameController@factions')->name('game_factions');
    Route::get('/factions/{id}', 'GameController@faction')->name('game_faction');
    Route::get('/squads/', 'GameController@squads')->name('game_squads');
    Route::get('/squads/{id}', 'GameController@squad')->name('game_squad');
    Route::get('/characters/', 'GameController@characters')->name('game_characters');
    Route::get('/characters/{id}', 'GameController@character')->name('game_character');
    Route::get('/conversations/', 'GameController@conversations')->name('game_conversations');
});

