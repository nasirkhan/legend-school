<?php

Route::any('/brand', [
    'uses'=>'App\Http\Controllers\BrandController@index',
    'as'=>'brand',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/brand-save', [
    'uses'=>'App\Http\Controllers\BrandController@store',
    'as'=>'brand-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/brand-update', [
    'uses'=>'App\Http\Controllers\BrandController@update',
    'as'=>'brand-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/brand-status-update', [
    'uses'=>'App\Http\Controllers\BrandController@statusUpdate',
    'as'=>'brand-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/brand-delete', [
    'uses'=>'App\Http\Controllers\BrandController@delete',
    'as'=>'brand-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
