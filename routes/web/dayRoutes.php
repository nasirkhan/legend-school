<?php

Route::any('/days', [
    'uses'=>'App\Http\Controllers\DayController@index',
    'as'=>'days',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-days', [
    'uses'=>'App\Http\Controllers\DayController@getClasses',
    'as'=>'get-days',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/day-save', [
    'uses'=>'App\Http\Controllers\DayController@store',
    'as'=>'day-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/day-update', [
    'uses'=>'App\Http\Controllers\DayController@update',
    'as'=>'day-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/day-status-update', [
    'uses'=>'App\Http\Controllers\DayController@statusUpdate',
    'as'=>'day-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/day-delete', [
    'uses'=>'App\Http\Controllers\DayController@delete',
    'as'=>'day-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
