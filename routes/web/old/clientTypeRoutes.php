<?php

Route::any('/client-type', [
    'uses'=>'App\Http\Controllers\ClientTypeController@index',
    'as'=>'client-type',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-type-save', [
    'uses'=>'App\Http\Controllers\ClientTypeController@store',
    'as'=>'client-type-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-type-update', [
    'uses'=>'App\Http\Controllers\ClientTypeController@update',
    'as'=>'client-type-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-type-status-update', [
    'uses'=>'App\Http\Controllers\ClientTypeController@statusUpdate',
    'as'=>'client-type-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-type-delete', [
    'uses'=>'App\Http\Controllers\ClientTypeController@delete',
    'as'=>'client-type-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
