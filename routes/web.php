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

Route::group(array('prefix' => 'home'), function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/worlds/', 'HomeController@worlds')->name('home_worlds');
    Route::get('/worlds/{id}', 'HomeController@world')->name('home_world');
    Route::get('/factions/{id}', 'HomeController@faction')->name('home_faction');
    Route::get('/squads/', 'HomeController@squads')->name('home_squads');
    Route::get('/characters/{id}', 'HomeController@character')->name('home_character');
    Route::get('/conversations/', 'HomeController@conversations')->name('home_conversations');
});

Route::group(array('prefix' => 'factions'), function () {
    // faction squads
    Route::get('/{id}/squads', 'FactionController@squads')->name('faction_squads');
    Route::post('/{id}/squads/attach', 'FactionController@attachSquads')->name('faction_attach_squads');
    Route::post('/{id}/squads/detach', 'FactionController@detachSquads')->name('faction_detach_squads');
    // faction characters
    Route::get('/{id}/characters', 'FactionController@characters')->name('faction_characters');
    Route::post('/{id}/characters/attach', 'FactionController@attachCharacters')->name('faction_attach_characters');
    Route::post('/{id}/characters/detach', 'FactionController@detachCharacters')->name('faction_detach_characters');
});

Route::group(array('prefix' => 'squads'), function () {
    // squad characters
    Route::get('/{id}/characters', 'SquadController@characters')->name('squad_characters');
    Route::post('/{id}/characters/attach', 'SquadController@attachCharacters')->name('squad_attach_characters');
    Route::post('/{id}/characters/detach', 'SquadController@detachCharacters')->name('squad_detach_characters');
});

Route::group(array('prefix' => 'characters'), function () {
    Route::post('/{id}/move', 'CharacterController@move')->name('move_character');
});

Route::group(array('prefix' => 'containers'), function () {
    // container items
    Route::get('/{id}/items', 'ContainerController@items')->name('container_items');
    Route::post('/{id}/items/attach', 'ContainerController@attachItems')->name('container_attach_items');
    Route::post('/{id}/items/detach', 'ContainerController@detachItems')->name('container_detach_items');
});

Route::group(array('prefix' => 'inventories'), function () {
    // inventory items
    Route::get('/{id}/items', 'InventoryController@items')->name('inventory_items');
    Route::post('/{id}/items/attach', 'InventoryController@attachItems')->name('inventory_attach_items');
    Route::post('/{id}/items/detach', 'InventoryController@detachItems')->name('inventory_detach_items');
});

Route::resources(
    array(
        'worlds' => 'WorldController',
        'factions' => 'FactionController',
        'squads_types' => 'SquadTypeController',
        'squads' => 'SquadController',
        'characters' => 'CharacterController',

        'items' => 'ItemController',
        'containers' => 'ContainerController',
        'inventories' => 'InventoryController',

        'conversations' => 'ConversationController',
        'messages' => 'MessageController',
    )
);
