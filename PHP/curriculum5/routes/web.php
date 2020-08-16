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

Route::group(['middleware' => 'auth'], function(){
    Route::get('todo/create', 'Admin\TodoController@add');
    Route::post('todo/create', 'Admin\TodoController@create');
    Route::get('todo', 'Admin\TodoController@index');
    Route::get('todo/edit/{id}', 'Admin\TodoController@edit');
    Route::post('todo/update', 'Admin\TodoController@update');
    Route::get('todo/delete/{id}', 'Admin\TodoController@delete');
    Route::get('todo/complete', 'Admin\TodoController@complete');
    Route::get('todo/complete_list', 'Admin\TodoController@complete_list');
    Route::get('todo/incomplete', 'Admin\TodoController@incomplete');
    Route::get('todo/sort', 'Admin\TodoController@dead_list');
    Route::get('todo/dead_list', 'Admin\TodoController@sort');
    Route::post('todo/dead_list', 'Admin\TodoController@search_dead_list');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
