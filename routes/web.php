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

Route::get('factions/{id}/squads', 'FactionController@squads')->name('faction_squads');
Route::post('factions/{id}/squads/attach', 'FactionController@attachSquads')->name('faction_attach_squads');
Route::post('factions/{id}/squads/detach', 'FactionController@detachSquads')->name('faction_detach_squads');

Route::get('factions/{id}/characters', 'FactionController@characters')->name('faction_characters');
Route::post('factions/{id}/characters/attach', 'FactionController@attachCharacters')->name('faction_attach_characters');
Route::post('factions/{id}/characters/detach', 'FactionController@detachCharacters')->name('faction_detach_characters');

Route::get('squads/{id}/characters', 'SquadController@characters')->name('squad_characters');
Route::post('squads/{id}/characters/attach', 'SquadController@attachCharacters')->name('squad_attach_characters');
Route::post('squads/{id}/characters/detach', 'SquadController@detachCharacters')->name('squad_detach_characters');

Route::get('inventories/{id}/items', 'InventoryController@items')->name('inventory_items');
Route::post('inventories/{id}/items/attach', 'InventoryController@attachItems')->name('inventory_attach_items');
Route::post('inventories/{id}/items/detach', 'InventoryController@detachItems')->name('inventory_detach_items');

Route::resources([

    'worlds' => 'WorldController',
    'factions' => 'FactionController',
    'squads_types' => 'SquadTypeController',
    'squads' => 'SquadController',
    'characters' => 'CharacterController',

    'items' => 'ItemController',
    'inventories' => 'InventoryController',

]);
