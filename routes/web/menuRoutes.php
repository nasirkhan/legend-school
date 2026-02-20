<?php

Route::any('/menus', [
    'uses'=>'App\Http\Controllers\MenuController@index',
    'as'=>'menus',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/menu-save', [
    'uses'=>'App\Http\Controllers\MenuController@store',
    'as'=>'menu-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/menu-update', [
    'uses'=>'App\Http\Controllers\MenuController@update',
    'as'=>'menu-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/menu-status-update', [
    'uses'=>'App\Http\Controllers\MenuController@statusUpdate',
    'as'=>'menu-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/menu-delete', [
    'uses'=>'App\Http\Controllers\MenuController@delete',
    'as'=>'menu-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
