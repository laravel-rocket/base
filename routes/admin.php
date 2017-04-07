<?php

\Route::group(['prefix' => 'admin'], function () {
    \Route::get('/', 'Admin\IndexController@index');
});
