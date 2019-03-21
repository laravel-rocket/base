<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::group(['middleware' => ['admin.auth']], function () {
            Route::get('information', 'IndexController@information');
            Route::get('me', 'MeController@show');
            Route::put('me', 'MeController@update');
            Route::post('sign-out', 'AuthController@postSignOut');

            Route::resource('admin-users', 'AdminUserController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);
            Route::resource('users', 'UserController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);
        });
    });
});
