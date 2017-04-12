<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => ['admin.guest']], function () {
        Route::get('signin', 'Admin\AuthController@getSignIn')->name('signIn.get');
        Route::post('signin', 'Admin\AuthController@postSignIn')->name('signIn.post');
        Route::get('forgot-password', 'Admin\PasswordController@getForgotPassword')->name('forgetPassword.get');
        Route::post('forgot-password', 'Admin\PasswordController@postForgotPassword')->name('forgetPassword.post');
        Route::get('reset-password/{token}', 'Admin\PasswordController@getResetPassword')->name('resetPassword.get');
        Route::post('reset-password', 'Admin\PasswordController@postResetPassword')->name('resetPassword.post');
    });

    Route::group(['middleware' => ['admin.auth']], function () {
        Route::get('/', 'Admin\IndexController@index')->name('index');
        Route::post('signout', 'Admin\AuthController@postSignOut')->name('signOut');
        Route::get('/me', 'Admin\MeController@index');
        Route::put('/me', 'Admin\MeController@update');
        Route::resource('users', 'Admin\UserController');
        Route::resource('admin-users', 'Admin\AdminUserController');
        /* NEW ADMIN RESOURCE ROUTE */
    });
});
