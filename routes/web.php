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


Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('items', 'ItemsController@index')->name('items.index');
Route::get('items/create/table', 'ItemsController@createTable')->name('items.create.table');

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::get('login/b2/callback', 'Auth\LoginController@callback')->name('b2.callback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
