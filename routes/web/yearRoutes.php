<?php

Route::any('/years', [
    'uses'=>'App\Http\Controllers\YearController@index',
    'as'=>'years',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/year-save', [
    'uses'=>'App\Http\Controllers\YearController@store',
    'as'=>'year-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/year-update', [
    'uses'=>'App\Http\Controllers\YearController@update',
    'as'=>'year-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/year-status-update', [
    'uses'=>'App\Http\Controllers\YearController@statusUpdate',
    'as'=>'year-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/year-delete', [
    'uses'=>'App\Http\Controllers\YearController@delete',
    'as'=>'year-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
