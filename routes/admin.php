<?php

\Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    \Route::group(['middleware' => ['admin.guest']], function () {
        \Route::get('signin', 'Admin\AuthController@getSignIn');
        \Route::post('signin', 'Admin\AuthController@postSignIn');
        \Route::get('forgot-password', 'Admin\PasswordController@getForgotPassword');
        \Route::post('forgot-password', 'Admin\PasswordController@postForgotPassword');
        \Route::get('reset-password/{token}', 'Admin\PasswordController@getResetPassword');
        \Route::post('reset-password', 'Admin\PasswordController@postResetPassword');
    });

    \Route::group(['middleware' => ['admin.auth']], function () {
        \Route::get('/', 'Admin\IndexController@index');
        \Route::resource('users', 'Admin\UserController');
        \Route::resource('admin-users', 'Admin\AdminUserController');
        /* NEW ADMIN RESOURCE ROUTE */
    });
});
