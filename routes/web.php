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
Route::get('/latest', 'PostController@latest')->name('latest');
Route::get('/trending', 'PostController@trending')->name('trending');
Route::get('/jobs', 'PostController@trending')->name('jobs');
Route::get('/rants', 'RantController@all')->name('rants');
Route::get('/search', 'PostController@all')->name('search');

Route::get('/generate-sitemap', 'SitemapController');

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
    Route::get('/communities/search-api', 'CommunityController@APISearch')->name('api.search');

    Route::middleware('auth')->group(function() {
        Route::get('{user}/communities', 'CommunityController@userCommunities')->name('user');
        Route::get('/communities/joined', 'CommunityController@joined')->name('joined');    
    });

    Route::prefix('community')->group(function() {
        Route::middleware('auth')->group(function() {
            Route::get('/new', 'CommunityController@new')->name('new');
            Route::post('/new', 'CommunityController@new')->name('post.new');
        });

        Route::get('/{community}', 'CommunityController@list')->name('list');
        Route::middleware('auth')->group(function() {
            Route::get('/{community}/follow', 'CommunityController@follow')->name('follow');
            Route::get('/{community}/unfollow', 'CommunityController@unfollow')->name('unfollow');        
        });
    });
});

Route::get('/new-topic', 'PostController@new')->middleware('auth')->name('posts.new');
Route::name('posts.')->prefix('topic')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/{community}/new-topic', 'PostController@new')->name('community.new');
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
        Route::get('/{post}/delete', 'PostController@delete')->name('delete');
    });

    Route::get('/{post}', 'PostController@show')->name('show');

    // Route::post('/comments/media/upload', 'MediaManagerController')->name('comments.media.upload');
});

Route::name('rants.')->prefix('rant')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/', 'RantController@new')->name('new');
        Route::post('/store', 'RantController@store')->name('rant.new');
    
        Route::get('/{post}/edit', 'RantController@edit')->name('edit');
        Route::post('/{post}/edit', 'RantController@update')->name('edit.store');
        Route::get('/{post}/delete', 'RantController@delete')->name('delete');
    });
    Route::get('/{post}', 'RantController@show')->name('show');
});

//Questions
Route::get('/ask-question', 'QuestionController@new')->middleware('auth')->name('question.new');
Route::name('questions.')->prefix('question')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/', 'QuestionController@new')->name('new');
        Route::post('/store', 'QuestionController@store')->name('rant.new');
    
        Route::get('/{post}/edit', 'QuestionController@edit')->name('edit');
        Route::post('/{post}/edit', 'QuestionController@update')->name('edit.store');
        Route::get('/{post}/delete', 'QuestionController@delete')->name('delete');
    });
    Route::get('/{post}', 'QuestionController@show')->name('show');
});


Route::name('mood.')->group(function() {
    Route::get('/moods', 'MoodController@all')->name('all');
    Route::get('/moods/search-api', 'MoodController@APISearch')->name('api.search');

    Route::middleware('auth')->group(function() {
        Route::get('{user}/moods', 'MoodController@userMoods')->name('user');
        Route::get('/moods/joined', 'MoodController@joined')->name('joined');    
    });

    Route::prefix('mood')->group(function() {
        Route::middleware('auth')->group(function() {
            Route::get('/new', 'MoodController@new')->name('new');
            Route::post('/new', 'MoodController@new')->name('post.new');
        });

        Route::get('/{mood}', 'MoodController@list')->name('list');
    });
});




Route::name('profile.')->group(function() {
    Route::middleware('auth')->group(function() {
        // Route::get('/profile', 'UserController@index')->name('index');
        Route::get('/settings', 'UserController@settings')->name('settings');
        Route::post('/settings', 'UserController@update')->name('settings.post');
        Route::get('/settings/homepage', 'UserController@feedSettings')->name('feed.settings');
        Route::post('/settings/homepage', 'UserController@updateFeedSettings')->name('feed.settings.post');
        Route::get('/settings/profile-picture', 'UserController@profilePicture')->name('avatar.settings');
        Route::post('/settings/profile-picture', 'UserController@updateProfilePicture')->name('avatar.settings.post');
        Route::get('/settings/password', 'UserController@password')->name('password.settings');
        Route::post('/settings/password', 'UserController@updatePassword')->name('password.settings.post');
        Route::get('/settings/deactivate', 'UserController@deactivate')->name('deactivate.settings');
        Route::post('/settings/deactivate', 'UserController@deactivateAccount')->name('deactivate.settings.post');
        Route::get('/user/{user}', 'UserController@index')->name('show');
    });
    Route::get('users/list', 'UserController@apiList')->name('users.api');
});

Route::name('topics.')->prefix('topics')->middleware('auth')->group(function() {
    Route::get('/bookmarks', 'PostController@saved')->name('bookmarks');
    Route::get('/liked', 'PostController@liked')->name('likes');
    // Route::get('/bookmarks', 'UserController@savedTopics')->name('bookmarks');
});

Route::post('/media/upload', 'MediaManagerController')->name('media.upload')->middleware('auth');




