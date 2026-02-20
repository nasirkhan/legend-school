<?php

Route::any('/transaction-item', [
    'uses'=>'App\Http\Controllers\TransactionItemController@index',
    'as'=>'transaction-item',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-item-save', [
    'uses'=>'App\Http\Controllers\TransactionItemController@store',
    'as'=>'transaction-item-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-item-update', [
    'uses'=>'App\Http\Controllers\TransactionItemController@update',
    'as'=>'transaction-item-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-item-status-update', [
    'uses'=>'App\Http\Controllers\TransactionItemController@statusUpdate',
    'as'=>'transaction-item-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transaction-item-delete', [
    'uses'=>'App\Http\Controllers\TransactionItemController@delete',
    'as'=>'transaction-item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sector-wise-account-list', [
    'uses'=>'App\Http\Controllers\TransactionItemController@sectorWiseAccountList',
    'as'=>'sector-wise-account-list',
    'middleware'=>['auth:sanctum', 'verified']
]);
