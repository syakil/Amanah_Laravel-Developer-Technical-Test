<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('inventory/index','InventoryController@index');
Route::get('inventory/show/{id}','InventoryController@show');
Route::post('inventory/store','InventoryController@store');
Route::post('inventory/update','InventoryController@update');
Route::delete('inventory/delete/{id}', 'InventoryController@delete');
Route::post('inventory/tambahStok','InventoryController@tambahStok');
Route::post('inventory/kurangStok','InventoryController@kurangStok');
Route::post('challange/store','ChallangeController@store');
Route::post('challange/update','ChallangeController@update');
Route::get('challange/show','ChallangeController@show');
Route::post('challange/test','ChallangeController@test');
