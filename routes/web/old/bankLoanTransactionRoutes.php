<?php

Route::any('/bank-loan-transaction', [
    'uses'=>'App\Http\Controllers\BankLoanTransactionController@index',
    'as'=>'bank-loan-transaction',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-transaction-save', [
    'uses'=>'App\Http\Controllers\BankLoanTransactionController@store',
    'as'=>'bank-loan-transaction-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-transaction-update', [
    'uses'=>'App\Http\Controllers\BankLoanTransactionController@update',
    'as'=>'bank-loan-transaction-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-transaction-status-update', [
    'uses'=>'App\Http\Controllers\BankLoanTransactionController@statusUpdate',
    'as'=>'bank-loan-transaction-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-transaction-delete', [
    'uses'=>'App\Http\Controllers\BankLoanTransactionController@delete',
    'as'=>'bank-loan-transaction-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

