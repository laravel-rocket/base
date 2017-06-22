<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function() {
    Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1'], function() {
        Route::get('status', 'IndexController@status');

        Route::post('signup', 'AuthController@postSignUp');
        Route::post('signin', 'AuthController@postSignIn');

        Route::post('signin/facebook', 'FacebookAuthController@facebookSignIn');
        Route::post('forgot-password', 'PasswordController@forgotPassword');

        Route::group(['middleware' => 'api.auth'], function() {
            Route::post('signout', 'AuthController@postSignOut');
        });
    });
});

/* %%ROUTES%% */
