<?php

Route::any('/bank-account', [
    'uses'=>'App\Http\Controllers\BankAccountController@index',
    'as'=>'bank-account',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-list', [
    'uses'=>'App\Http\Controllers\BankAccountController@bankAccountList',
    'as'=>'bank-account-list',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-save', [
    'uses'=>'App\Http\Controllers\BankAccountController@store',
    'as'=>'bank-account-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-update', [
    'uses'=>'App\Http\Controllers\BankAccountController@update',
    'as'=>'bank-account-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-status-update', [
    'uses'=>'App\Http\Controllers\BankAccountController@statusUpdate',
    'as'=>'bank-account-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-delete', [
    'uses'=>'App\Http\Controllers\BankAccountController@delete',
    'as'=>'bank-account-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-account-details', [
    'uses'=>'App\Http\Controllers\BankAccountController@bankAccountDetails',
    'as'=>'bank-account-details',
    'middleware'=>['auth:sanctum', 'verified']
]);
