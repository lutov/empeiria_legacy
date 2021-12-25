<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(array('prefix' => 'factions'), function () {
        Route::get('/{id}/squads', 'FactionController@squads')->name('faction_squads');
        Route::post('/{id}/squads/attach', 'FactionController@attachSquads')->name('faction_attach_squads');
        Route::post('/{id}/squads/detach', 'FactionController@detachSquads')->name('faction_detach_squads');

        Route::get('/{id}/characters', 'FactionController@characters')->name('faction_characters');
        Route::post('/{id}/characters/attach', 'FactionController@attachCharacters')->name('faction_attach_characters');
        Route::post('/{id}/characters/detach', 'FactionController@detachCharacters')->name('faction_detach_characters');
    });

    Route::group(array('prefix' => 'squads'), function () {
        Route::get('/{id}/characters', 'SquadController@characters')->name('squad_characters');
        Route::post('/{id}/characters/attach', 'SquadController@attachCharacters')->name('squad_attach_characters');
        Route::post('/{id}/characters/detach', 'SquadController@detachCharacters')->name('squad_detach_characters');
    });

    Route::group(array('prefix' => 'characters'), function () {
        Route::post('/{id}/move', 'CharacterController@move')->name('move_character');
    });

    Route::group(array('prefix' => 'containers'), function () {
        Route::get('/{id}/items', 'ContainerController@items')->name('container_items');
        Route::post('/{id}/items/attach', 'ContainerController@attachItems')->name('container_attach_items');
        Route::post('/{id}/items/detach', 'ContainerController@detachItems')->name('container_detach_items');
    });

    Route::group(array('prefix' => 'inventories'), function () {
        Route::get('/{id}/items', 'InventoryController@items')->name('inventory_items');
        Route::post('/{id}/items/attach', 'InventoryController@attachItems')->name('inventory_attach_items');
        Route::post('/{id}/items/detach', 'InventoryController@detachItems')->name('inventory_detach_items');
    });
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

        'genders' => 'GenderController',

        'conversations' => 'ConversationController',
        'messages' => 'MessageController',
    )
);
