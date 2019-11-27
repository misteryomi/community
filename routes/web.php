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

Route::get('/', 'PostController@index')->name('home');


//Auth Routes
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('post.login');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@postRegister')->name('post.register');

Route::name('posts.')->group(function() {
    Route::get('/{post}', 'PostController@show')->name('show');

    Route::middleware('auth')->group(function() {
        Route::post('/{post}/comment', 'CommentController@store')->name('comment');
    });

});

