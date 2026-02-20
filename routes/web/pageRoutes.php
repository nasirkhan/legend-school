<?php

Route::any('/pages', [
    'uses'=>'App\Http\Controllers\PageController@index',
    'as'=>'pages',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/page-add-form', [
    'uses'=>'App\Http\Controllers\PageController@addForm',
    'as'=>'page-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/page-save', [
    'uses'=>'App\Http\Controllers\PageController@store',
    'as'=>'page-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/page-edit/{id}', [
    'uses'=>'App\Http\Controllers\PageController@edit',
    'as'=>'page-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/page-update', [
    'uses'=>'App\Http\Controllers\PageController@update',
    'as'=>'page-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-page-status/{id}', [
    'uses'=>'App\Http\Controllers\PageController@statusUpdate',
    'as'=>'update-page-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/page-delete/{id}', [
    'uses'=>'App\Http\Controllers\PageController@delete',
    'as'=>'page-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
