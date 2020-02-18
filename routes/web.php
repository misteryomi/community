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
Route::get('/search', 'PostController@all')->name('search');


//Auth Routes
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('post.login');

Route::get('login/google', 'AuthController@redirectToProvider');
Route::get('login/google/callback', 'AuthController@handleProviderCallback')->name('google.callback');

Route::get('/forgot-password/{token?}', 'AuthController@forgotPassword')->name('forgot-password');
Route::post('/forgot-password', 'AuthController@postForgotPassword')->name('post.forgot-password');
Route::post('/reset-password', 'AuthController@storePassword')->name('store-password');


Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@postRegister')->name('post.register');

Route::name('community.')->group(function() {
    Route::get('/communities', 'CommunityController@all')->name('all');

    Route::prefix('community')->group(function() {
        Route::get('/{community}', 'CommunityController@list')->name('list');
        Route::get('/{community}/follow', 'CommunityController@follow')->name('follow');
        Route::get('/{community}/unfollow', 'CommunityController@unfollow')->name('unfollow');    
    });
});

Route::name('posts.')->group(function() {

    Route::middleware('auth')->group(function() {
        Route::get('/new-topic', 'PostController@new')->name('new');
        Route::get('/{community}/new-topic', 'PostController@new')->name('posts.new');
        Route::post('/new-topic/store', 'PostController@store')->name('post.new');
        Route::post('/{post}/like/', 'PostController@like')->name('like');
        Route::post('/{post}/unlike/', 'PostController@unlike')->name('unlike');
        Route::post('/{post}/bookmark/', 'PostController@bookmark')->name('bookmark');
        Route::post('/{post}/remove-bookmark/', 'PostController@removeBookmark')->name('bookmark.remove');

        Route::post('/{post}/comment', 'CommentController@store')->name('comment');
        // Route::post('/{post}/comment/edit', 'CommentController@store')->name('comment');

        Route::get('/{post}/{comment}/edit', 'CommentController@edit')->name('comment.edit');
        Route::post('/{post}/{comment}/edit', 'CommentController@storeEdit')->name('comment.edit.post');


        Route::post('/comment/{comment}/like/', 'CommentController@like')->name('comment.like');
        Route::post('/comment/{comment}/unlike/', 'CommentController@unlike')->name('comment.unlike');

        Route::get('/{post}/edit', 'PostController@edit')->name('edit');
        Route::post('/{post}/edit', 'PostController@update')->name('post.edit');
    });


    Route::post('/media/upload', 'MediaManagerController');

});


Route::name('profile.')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/settings', 'UserController@settings')->name('settings');
        Route::post('/settings', 'UserController@update')->name('settings.post');
        Route::post('/settings/feed', 'UserController@feedSettings')->name('feed.settings.post');
        Route::get('/user/{user}', 'UserController@index')->name('show');
    });
    Route::get('users/list', 'UserController@apiList');
});

Route::name('topics.')->prefix('topics')->middleware('auth')->group(function() {
    Route::get('/saved', 'UserController@savedTopics')->name('saved');
    // Route::get('/likes', 'UserController@savedTopics')->name('likes');
    // Route::get('/liked', 'UserController@savedTopics')->name('liked');
});

Route::get('/{post}', 'PostController@show')->name('posts.show');



