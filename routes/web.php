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

Route::feeds();

Route::get('/', 'PostController@index')->name('home');
Route::get('/topics', 'PostController@all')->name('topics');
Route::get('/latest', 'PostController@latest')->name('latest');
Route::get('/trending', 'PostController@trending')->name('trending');
Route::get('/jobs', 'JobController@all')->name('jobs');
Route::get('/rants', 'RantController@all')->name('rants');
Route::get('/questions', 'QuestionController@all')->name('questions');
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
        Route::get('{user:slug}/communities', 'CommunityController@userCommunities')->name('user');
        Route::get('/communities/joined', 'CommunityController@joined')->name('joined');    
    });

    Route::prefix('community')->group(function() {
        Route::middleware('auth')->group(function() {
            Route::get('/new', 'CommunityController@new')->name('new');
            Route::post('/new', 'CommunityController@new')->name('post.new');
        });

        Route::get('/{community:slug}', 'CommunityController@list')->name('list');
        Route::middleware('auth')->group(function() {
            Route::get('/{community:slug}/follow', 'CommunityController@follow')->name('follow');
            Route::get('/{community:slug}/unfollow', 'CommunityController@unfollow')->name('unfollow'); 

            Route::post('/{community:slug}/api-follow', 'CommunityController@apiFollow')->name('api-follow');
            Route::post('/{community:slug}/api-unfollow', 'CommunityController@apiUnfollow')->name('api-unfollow');        
        });
    });
});

Route::get('/new-topic', 'PostController@newTopic')->middleware('auth')->name('topics.new-topic');
Route::get('/new', 'PostController@newPost')->middleware('auth')->name('topics.new');
Route::name('posts.')->prefix('topic')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/{community:slug}/new-topic', 'PostController@new')->name('community.new');
        Route::post('/store', 'PostController@store')->name('post.new');
        Route::post('/{post:slug}/like/', 'PostController@like')->name('like');
        Route::post('/{post:slug}/unlike/', 'PostController@unlike')->name('unlike');
        Route::post('/{post:slug}/bookmark/', 'PostController@bookmark')->name('bookmark');
        Route::post('/{post:slug}/remove-bookmark/', 'PostController@removeBookmark')->name('bookmark.remove');

        Route::post('/{post:slug}/comment', 'CommentController@store')->name('comment');
        // Route::post('/{post:slug}/comment/edit', 'CommentController@store')->name('comment');

        Route::get('/{post:slug}/{comment}/edit', 'CommentController@edit')->name('comment.edit');
        Route::post('/{post:slug}/{comment}/edit', 'CommentController@storeEdit')->name('comment.edit.post');


        Route::post('/comment/{comment}/like/', 'CommentController@like')->name('comment.like');
        Route::post('/comment/{comment}/unlike/', 'CommentController@unlike')->name('comment.unlike');

        Route::get('/{post:slug}/edit', 'PostController@edit')->name('edit');
        Route::post('/{post:slug}/edit', 'PostController@update')->name('post.edit');
        Route::get('/{post:slug}/delete', 'PostController@delete')->name('delete');
        Route::get('/{post:slug}/set-featured', 'PostController@setFeatured')->name('set-featured');
        Route::get('/{post:slug}/remove-featured', 'PostController@removeFeatured')->name('remove-featured');
    });

    Route::get('/{post:slug}', 'PostController@showPost')->name('show');

    // Route::post('/comments/media/upload', 'MediaManagerController')->name('comments.media.upload');
});

Route::name('rants.')->prefix('rant')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/', 'RantController@new')->name('new');
        Route::post('/store', 'RantController@store')->name('store');
    
        Route::get('/{post:slug}/edit', 'RantController@edit')->name('edit');
        Route::post('/{post:slug}/edit', 'RantController@update')->name('edit.store');
        Route::get('/{post:slug}/delete', 'RantController@delete')->name('delete');
    });
    Route::get('/{post:slug}', 'RantController@show')->name('show');
});

//Questions
Route::get('/ask-question', 'QuestionController@new')->middleware('auth')->name('question.new');
Route::name('questions.')->prefix('question')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/', 'QuestionController@new')->name('new');
        Route::post('/store', 'QuestionController@store')->name('new.store');
    
        Route::get('/{post:slug}/edit', 'QuestionController@edit')->name('edit');
        Route::post('/{post:slug}/edit', 'QuestionController@update')->name('edit.store');
        Route::get('/{post:slug}/delete', 'QuestionController@delete')->name('delete');
    });
    Route::get('/{post:slug}', 'QuestionController@show')->name('show');
});

//Questions
Route::name('jobs.')->prefix('job')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/new', 'JobController@new')->name('new');
        Route::post('/store', 'JobController@store')->name('new.store');
    
        Route::get('/{post:slug}/edit', 'JobController@edit')->name('edit');
        Route::post('/{post:slug}/edit', 'JobController@update')->name('edit.store');
        Route::get('/{post:slug}/delete', 'JobController@delete')->name('delete');
    });
    Route::get('/{post:slug}', 'JobController@show')->name('show');
});


Route::name('mood.')->group(function() {
    Route::get('/moods', 'MoodController@all')->name('all');
    Route::get('/moods/search-api', 'MoodController@APISearch')->name('api.search');

    Route::middleware('auth')->group(function() {
        Route::get('{user:slug}/moods', 'MoodController@userMoods')->name('user');
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





Route::name('topics.')->prefix('topics')->middleware('auth')->group(function() {
    Route::get('/bookmarks', 'PostController@saved')->name('bookmarks');
    Route::get('/liked', 'PostController@liked')->name('likes');
    // Route::get('/bookmarks', 'UserController@savedTopics')->name('bookmarks');
});

Route::middleware('auth')->group(function() {
    Route::get('/notifications', 'NotificationsController@index')->name('notifications');
    Route::get('/notification/show/{notification}', 'NotificationsController@show')->name('notification.show');

});
Route::post('/media/upload', 'MediaManagerController')->name('media.upload')->middleware('auth');


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
    });
    Route::get('users/list', 'UserController@apiList')->name('users.api');
    Route::get('/profile/{user:username}', 'UserController@index')->name('show');
});


