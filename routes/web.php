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

Route::get('inventories/{id}/items', 'InventoryController@items')->name('inventory_items');
Route::post('inventories/{id}/items/attach', 'InventoryController@attachItems')->name('inventory_attach_items');
Route::post('inventories/{id}/items/detach', 'InventoryController@detachItems')->name('inventory_detach_items');

Route::resources([

    'worlds' => 'WorldController',
    'factions' => 'FactionController',
    'squads' => 'SquadController',
    'characters' => 'CharacterController',

    'items' => 'ItemController',
    'inventories' => 'InventoryController',

]);
