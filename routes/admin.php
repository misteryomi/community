<?php

//Admin Routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {
    Route::get('/', 'AdminController')->name('admin');

    Route::namespace('Permission')->group(function() {
        Route::get('/manage-roles', 'RoleController@index')->name('roles');
        Route::post('/manage-roles', 'RoleController@store')->name('roles.store');
        Route::get('/manage-permissions', 'PermissionController@index')->name('permissions');
        Route::post('/manage-permissions', 'PermissionController@store')->name('permissions.store');
    });

});
