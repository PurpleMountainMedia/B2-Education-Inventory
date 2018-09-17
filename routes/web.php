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
    Route::get('dashboard', 'DashboardController@index')->name('web.dashboard.index');

    // Buildings
    Route::get('buildings', 'BuildingsController@index')->name('web.buildings.index');
    Route::get('buildings/{building}', 'BuildingsController@show')->name('web.buildings.show');

    // Rooms
    Route::get('rooms', 'RoomsController@index')->name('web.rooms.index');
    Route::get('rooms/{room}', 'RoomsController@show')->name('web.rooms.show');

    // Users
    Route::get('users', 'UsersController@index')->name('web.users.index');
    Route::get('users/{user}', 'UsersController@show')->name('web.users.show');

    // Items
    Route::get('items', 'ItemsController@index')->name('web.items.index');
    Route::get('items/{item}', 'ItemsController@show')->name('web.items.show');
    Route::get('items/create/table', 'ItemsController@createTable')->name('web.items.create.table');
    Route::get('items/group/{itemCategory}/{room}/{itemName}', 'ItemsController@showGroup')->name('web.items.show_group');

    // Reports
    Route::get('reports', 'ReportsController@index')->name('web.reports.index');
    Route::get('reports/{report}', 'ReportsController@show')->name('web.reports.show');

    // School Session
    Route::post('session', 'SessionController@change')->name('web.session');
    Route::get('session', 'SessionController@choose')->name('web.choose-school');
});

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::get('login/b2/callback', 'Auth\LoginController@callback')->name('b2.callback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
