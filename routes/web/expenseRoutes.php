<?php

Route::any('/make-transaction', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@create',
    'as'=>'create-expense',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/expenses', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@index',
    'as'=>'expenses',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-expenses', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@getExpenses',
    'as'=>'get-expenses',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/expense-save', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@store',
    'as'=>'expense-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/expense-update', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@update',
    'as'=>'expense-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/expense-status-update', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@statusUpdate',
    'as'=>'expense-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/expense-delete', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@delete',
    'as'=>'expense-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

/*============Reporting================*/
Route::any('/date-wise-expense-report', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@dateWiseExpenseReport',
    'as'=>'date-wise-expense-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/month-wise-expense-report', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@monthWiseExpenseReport',
    'as'=>'month-wise-expense-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-wise-expense-report', [
    'uses'=>'App\Http\Controllers\IncomeExpenseController@itemWiseExpenseReport',
    'as'=>'item-wise-expense-report',
    'middleware'=>['auth:sanctum', 'verified']
]);
