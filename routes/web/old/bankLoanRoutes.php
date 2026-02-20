<?php

Route::any('/bank-loan', [
    'uses'=>'App\Http\Controllers\BankLoanController@index',
    'as'=>'bank-loan',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-save', [
    'uses'=>'App\Http\Controllers\BankLoanController@store',
    'as'=>'bank-loan-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-update', [
    'uses'=>'App\Http\Controllers\BankLoanController@update',
    'as'=>'bank-loan-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-status-update', [
    'uses'=>'App\Http\Controllers\BankLoanController@statusUpdate',
    'as'=>'bank-loan-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-delete', [
    'uses'=>'App\Http\Controllers\BankLoanController@delete',
    'as'=>'bank-loan-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
