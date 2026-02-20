<?php

Route::any('/periods', [
    'uses'=>'App\Http\Controllers\PeriodController@index',
    'as'=>'periods',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-periods', [
    'uses'=>'App\Http\Controllers\PeriodController@getClasses',
    'as'=>'get-periods',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/period-save', [
    'uses'=>'App\Http\Controllers\PeriodController@store',
    'as'=>'period-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/period-update', [
    'uses'=>'App\Http\Controllers\PeriodController@update',
    'as'=>'period-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/period-status-update', [
    'uses'=>'App\Http\Controllers\PeriodController@statusUpdate',
    'as'=>'period-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/period-delete', [
    'uses'=>'App\Http\Controllers\PeriodController@delete',
    'as'=>'period-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
