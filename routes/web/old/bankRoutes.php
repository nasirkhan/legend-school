<?php

Route::any('/bank', [
    'uses'=>'App\Http\Controllers\BankController@index',
    'as'=>'bank',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-save', [
    'uses'=>'App\Http\Controllers\BankController@store',
    'as'=>'bank-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-update', [
    'uses'=>'App\Http\Controllers\BankController@update',
    'as'=>'bank-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-status-update', [
    'uses'=>'App\Http\Controllers\BankController@statusUpdate',
    'as'=>'bank-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-delete', [
    'uses'=>'App\Http\Controllers\BankController@delete',
    'as'=>'bank-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
