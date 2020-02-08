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
Route::get('/topics', 'PostController@all')->name('topics');


//Auth Routes
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('post.login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@postRegister')->name('post.register');

Route::prefix('community')->name('community.')->group(function() {
    Route::get('/{community}', 'CommunityController@list')->name('list');
    Route::get('/{community}/follow', 'CommunityController@follow')->name('follow');
    Route::get('/{community}/unfollow', 'CommunityController@unfollow')->name('unfollow');
});

Route::name('posts.')->group(function() {

    Route::middleware('auth')->group(function() {
        Route::get('/new-topic', 'PostController@new')->name('new');
        Route::get('/{community}/new-topic', 'PostController@new')->name('posts.new');
        Route::post('/new-topic/store', 'PostController@store')->name('post.new');

        Route::post('/{post}/comment', 'CommentController@store')->name('comment');
        Route::post('/{post}/comment/edit', 'CommentController@store')->name('comment');

        Route::get('/{post}/edit', 'PostController@edit')->name('edit');
        Route::post('/{post}/edit', 'PostController@update')->name('post.edit');
    });

    Route::get('/{post}', 'PostController@show')->name('show');
});

Route::name('profile.')->group(function() {
    Route::get('/user/{user}', 'UserController@index')->name('show');
});
