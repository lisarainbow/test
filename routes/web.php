<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index');

Route::prefix('user')->group(function() {

    Route::post('eat', 'UsersController@eatUsers')->name('eatUsers');

    Route::post('sort-all', 'UsersController@sortAllUsers')->name('sortAllUsers');

    Route::prefix('profile')->group(function() {

        Route::get('/', 'UsersController@getProfile')->name('getProfile');

        Route::post('save', 'UsersController@saveProfile')->name('saveProfile');
    });

    Route::prefix('post')->group(function() {

        Route::get('/', 'PostsController@getUsersMessages')->name('getUsersMessages');

        Route::post('save', 'PostsController@saveNewUsersMessage')->name('saveNewUsersMessage');
    });
});
