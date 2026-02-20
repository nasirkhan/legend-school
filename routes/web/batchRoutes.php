<?php

Route::any('/batches', [
    'uses'=>'App\Http\Controllers\BatchController@index',
    'as'=>'batches',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/batch-save', [
    'uses'=>'App\Http\Controllers\BatchController@store',
    'as'=>'batch-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/batch-update', [
    'uses'=>'App\Http\Controllers\BatchController@update',
    'as'=>'batch-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/batch-status-update', [
    'uses'=>'App\Http\Controllers\BatchController@statusUpdate',
    'as'=>'batch-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/batch-delete', [
    'uses'=>'App\Http\Controllers\BatchController@delete',
    'as'=>'batch-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-batch', [
    'uses'=>'App\Http\Controllers\BatchController@getBatch',
    'as'=>'get-batch',
//    'middleware'=>['auth:sanctum', 'verified']
]);
