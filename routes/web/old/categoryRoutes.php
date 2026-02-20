<?php

Route::any('/category', [
    'uses'=>'App\Http\Controllers\CategoryController@index',
    'as'=>'category',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/category-save', [
    'uses'=>'App\Http\Controllers\CategoryController@store',
    'as'=>'category-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/category-update', [
    'uses'=>'App\Http\Controllers\CategoryController@update',
    'as'=>'category-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/category-status-update', [
    'uses'=>'App\Http\Controllers\CategoryController@statusUpdate',
    'as'=>'category-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/category-delete', [
    'uses'=>'App\Http\Controllers\CategoryController@delete',
    'as'=>'category-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
