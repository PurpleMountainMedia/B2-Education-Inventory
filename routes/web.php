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

Route::get('/', 'WebController@home')->name('home');

Route::middleware('needs_school')->group(function () {
    // Dash
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    // Buildings
    Route::get('buildings', 'BuildingsController@index')->name('buildings.index');
    Route::get('buildings/{building}', 'BuildingsController@index')->name('web.buildings.show');

    // Rooms
    Route::get('rooms', 'RoomsController@index')->name('rooms.index');

    // Items
    Route::get('items', 'ItemsController@index')->name('items.index');
    Route::get('items/create/table', 'ItemsController@createTable')->name('items.create.table');

    // Reports
    Route::get('reports', 'ReportsController@index')->name('reports.index');

    // School Session
    Route::post('session', 'SessionController@change')->name('session');
    Route::get('session', 'SessionController@choose')->name('choose-school');
});

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::get('login/b2/callback', 'Auth\LoginController@callback')->name('b2.callback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
