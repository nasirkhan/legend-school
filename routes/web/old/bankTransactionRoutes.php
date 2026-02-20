<?php

Route::any('/bank-transaction', [
    'uses'=>'App\Http\Controllers\BankTransactionController@index',
    'as'=>'bank-transaction',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-transaction-save', [
    'uses'=>'App\Http\Controllers\BankTransactionController@store',
    'as'=>'bank-transaction-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-transaction-update', [
    'uses'=>'App\Http\Controllers\BankTransactionController@update',
    'as'=>'bank-transaction-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-transaction-status-update', [
    'uses'=>'App\Http\Controllers\BankTransactionController@statusUpdate',
    'as'=>'bank-transaction-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-transaction-delete', [
    'uses'=>'App\Http\Controllers\BankTransactionController@delete',
    'as'=>'bank-transaction-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

