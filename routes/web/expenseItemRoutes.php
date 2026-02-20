<?php

Route::any('/income-expense-items', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@index',
    'as'=>'expense-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-income-expense-items', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@getItems',
    'as'=>'get-expense-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/income-expense-item-save', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@store',
    'as'=>'expense-item-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/income-expense-item-update', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@update',
    'as'=>'expense-item-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/income-expense-item-status-update', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@statusUpdate',
    'as'=>'expense-item-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/income-expense-item-delete', [
    'uses'=>'App\Http\Controllers\ExpenseItemController@delete',
    'as'=>'expense-item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
