<?php
Route::any('/product', [
    'uses'=>'App\Http\Controllers\ProductController@index',
    'as'=>'product',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-add', [
    'uses'=>'App\Http\Controllers\ProductController@add',
    'as'=>'product-add',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-save', [
    'uses'=>'App\Http\Controllers\ProductController@store',
    'as'=>'product-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-update', [
    'uses'=>'App\Http\Controllers\ProductController@update',
    'as'=>'product-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-status-update', [
    'uses'=>'App\Http\Controllers\ProductController@statusUpdate',
    'as'=>'product-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-delete', [
    'uses'=>'App\Http\Controllers\ProductController@delete',
    'as'=>'product-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
