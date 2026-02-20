<?php

Route::any('/transaction', [
    'uses'=>'App\Http\Controllers\TransactionController@index',
    'as'=>'transaction',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-save', [
    'uses'=>'App\Http\Controllers\TransactionController@store',
    'as'=>'transaction-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-update', [
    'uses'=>'App\Http\Controllers\TransactionController@update',
    'as'=>'transaction-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-status-update', [
    'uses'=>'App\Http\Controllers\TransactionController@statusUpdate',
    'as'=>'transaction-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-delete', [
    'uses'=>'App\Http\Controllers\TransactionController@delete',
    'as'=>'transaction-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
