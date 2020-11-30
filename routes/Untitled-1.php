Route::name('rants.')->group(function() {

Route::middleware('auth')->group(function() {
    Route::get('/rant', 'RantController@new')->name('new');
    Route::rant('/rant/store', 'RantController@store')->name('rant.new');
    Route::get('/{mood}/rant', 'RantController@new')->name('mood.new');
    Route::rant('/{rant}/like/', 'RantController@like')->name('like');
    Route::rant('/{rant}/unlike/', 'RantController@unlike')->name('unlike');
    Route::rant('/{rant}/bookmark/', 'RantController@bookmark')->name('bookmark');
    Route::rant('/{rant}/remove-bookmark/', 'RantController@removeBookmark')->name('bookmark.remove');

    Route::rant('/{rant}/comment', 'CommentController@store')->name('comment');
    // Route::rant('/{rant}/comment/edit', 'CommentController@store')->name('comment');

    Route::get('/{rant}/{comment}/edit', 'CommentController@edit')->name('comment.edit');
    Route::rant('/{rant}/{comment}/edit', 'CommentController@storeEdit')->name('comment.edit.rant');


    Route::rant('/comment/{comment}/like/', 'CommentController@like')->name('comment.like');
    Route::rant('/comment/{comment}/unlike/', 'CommentController@unlike')->name('comment.unlike');

    Route::get('/{rant}/edit', 'RantController@edit')->name('edit');
    Route::rant('/{rant}/edit', 'RantController@update')->name('rant.edit');
    Route::get('/{rant}/delete', 'RantController@delete')->name('delete');
});


Route::rant('/media/upload', 'MediaManagerController')->name('media.upload');
Route::rant('/comments/media/upload', 'MediaManagerController')->name('comments.media.upload');
});