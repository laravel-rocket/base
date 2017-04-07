<?php

\Route::group([], function () {
    \Route::get('/', 'User\IndexController@index');
});
