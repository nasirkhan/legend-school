<?php

//Route::any('/', [
//    'uses'=>'App\Http\Controllers\AdminController@index',
//    'as'=>'/',
//    'middleware'=>['auth:sanctum', 'verified']
//]);
//

Route::any('/users', [
    'uses'=>'App\Http\Controllers\AdminController@users',
    'as'=>'users',
    'middleware'=>['auth:sanctum', 'verified']
]);
