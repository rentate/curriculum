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

Route::group(['prefix' => 'posts', 'middleware' => 'auth'], function(){
    Route::get('index', 'PostsController@index')->name('posts.index');
    Route::post('store', 'PostsController@store')->name('posts.store');
    Route::get('destroy/{id}', 'PostsController@destroy')->name('posts.destroy');
});

// Route::get('/', 'PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
