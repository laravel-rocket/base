<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function() {
        Route::get('information', 'IndexController@information');
        Route::resource('admin-users', 'AdminUserController')->only([
            'index','show','store','update','destroy'
        ]);
    });
});
