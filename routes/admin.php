<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => ['admin.guest']], function () {
        Route::get('sign-in', 'Admin\AuthController@getSignIn')->name('signIn.get');
        Route::post('sign-in', 'Admin\AuthController@postSignIn')->name('signIn.post');
        Route::get('forgot-password', 'Admin\PasswordController@getForgotPassword')->name('forgetPassword.get');
        Route::post('forgot-password', 'Admin\PasswordController@postForgotPassword')->name('forgetPassword.post');
        Route::get('reset-password/{token}', 'Admin\PasswordController@getResetPassword')->name('resetPassword.get');
        Route::post('reset-password', 'Admin\PasswordController@postResetPassword')->name('resetPassword.post');
    });

    Route::group(['middleware' => ['admin.auth']], function () {

        Route::post('sign-out', 'Admin\AuthController@postSignOut')->name('signOut');
        Route::get('/{any?}', 'Admin\IndexController@index')->name('index')->where('any', '.*');
    });
});
