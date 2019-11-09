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
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map', 'MapController@index');
Route::get('tumami/index', 'TumamiController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/show', 'Admin\ProfileController@show')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfileController@create')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/edit', 'Admin\ProfileController@update')->middleware('auth');
    Route::get('tasks/index', 'Admin\TaskController@index')->middleware('auth');
    Route::get('tumami/index', 'Admin\TumamiController@index')->middleware('auth');
    Route::post('tasks/create', 'Admin\TaskController@create')->middleware('auth');
    Route::get('tasks/delete', 'Admin\TaskController@delete')->middleware('auth');
    Route::post('tumami/create', 'Admin\TumamiController@create');
    Route::get('tumami/edit', 'Admin\TumamiController@edit')->middleware('auth');
    Route::post('tumami/edit', 'Admin\TumamiController@update')->middleware('auth');
    Route::get('tumami/create', 'Admin\TumamiController@add')->middleware('auth');
    Route::get('tumami/show', 'Admin\TumamiController@show')->middleware('auth');
    Route::get('tumami/delete', 'Admin\TumamiController@delete')->middleware('auth');
});

Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider');
Route::get('/home', 'Auth\TwitterController@handleProviderCallback');
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');
