<?php

Route::any('/transaction-sector', [
    'uses'=>'App\Http\Controllers\TransactionSectorController@index',
    'as'=>'transaction-sector',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-sector-save', [
    'uses'=>'App\Http\Controllers\TransactionSectorController@store',
    'as'=>'transaction-sector-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-sector-update', [
    'uses'=>'App\Http\Controllers\TransactionSectorController@update',
    'as'=>'transaction-sector-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-sector-status-update', [
    'uses'=>'App\Http\Controllers\TransactionSectorController@statusUpdate',
    'as'=>'transaction-sector-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-sector-delete', [
    'uses'=>'App\Http\Controllers\TransactionSectorController@delete',
    'as'=>'transaction-sector-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
