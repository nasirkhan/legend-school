<?php

Route::any('/unit', [
    'uses'=>'App\Http\Controllers\UnitController@index',
    'as'=>'unit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-save', [
    'uses'=>'App\Http\Controllers\UnitController@store',
    'as'=>'unit-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-update', [
    'uses'=>'App\Http\Controllers\UnitController@update',
    'as'=>'unit-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-status-update', [
    'uses'=>'App\Http\Controllers\UnitController@statusUpdate',
    'as'=>'unit-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-delete', [
    'uses'=>'App\Http\Controllers\UnitController@delete',
    'as'=>'unit-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/product-unit', [
    'uses'=>'App\Http\Controllers\UnitController@productUnit',
    'as'=>'product-unit',
    'middleware'=>['auth:sanctum', 'verified']
]);

