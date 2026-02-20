<?php

Route::any('/months', [
    'uses'=>'App\Http\Controllers\MonthController@index',
    'as'=>'months',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/month-save', [
    'uses'=>'App\Http\Controllers\MonthController@store',
    'as'=>'month-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/month-update', [
    'uses'=>'App\Http\Controllers\MonthController@update',
    'as'=>'month-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/month-status-update', [
    'uses'=>'App\Http\Controllers\MonthController@statusUpdate',
    'as'=>'month-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/month-delete', [
    'uses'=>'App\Http\Controllers\MonthController@delete',
    'as'=>'month-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
