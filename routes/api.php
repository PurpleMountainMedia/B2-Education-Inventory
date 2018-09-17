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

Route::namespace('Api')->middleware('auth:api')->group(function () {
    Route::apiResource('buildings', 'ApiBuildingsController');
    Route::get('buildings/{building}/rooms', 'ApiBuildingsController@rooms');

    Route::apiResource('rooms', 'ApiRoomsController');

    Route::apiResource('users', 'ApiUsersController');

    Route::apiResource('reports', 'ApiReportsController');

    Route::get('items/grouped', 'ApiItemsController@indexGrouped');
    Route::get('items/group', 'ApiItemsController@group');
    Route::apiResource('items', 'ApiItemsController');
    Route::post('items/bulk', 'ApiItemsController@bulkAdd');

    Route::apiResource('item-categories', 'ApiItemCategoriesController');
    Route::apiResource('makes', 'ApiMakesController');
});
