<?php

Route::any('/client/{type}', [
    'uses'=>'App\Http\Controllers\ClientController@index',
    'as'=>'client',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-add', [
    'uses'=>'App\Http\Controllers\ClientController@add',
    'as'=>'client-add',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-save', [
    'uses'=>'App\Http\Controllers\ClientController@store',
    'as'=>'client-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-update', [
    'uses'=>'App\Http\Controllers\ClientController@update',
    'as'=>'client-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-status-update', [
    'uses'=>'App\Http\Controllers\ClientController@statusUpdate',
    'as'=>'client-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-delete', [
    'uses'=>'App\Http\Controllers\ClientController@delete',
    'as'=>'client-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-balance', [
    'uses'=>'App\Http\Controllers\ClientController@balance',
    'as'=>'client-balance',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-details/{clientId}', [
    'uses'=>'App\Http\Controllers\ClientController@clientDetails',
    'as'=>'client-details',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice/{paymentId}', [
    'uses'=>'App\Http\Controllers\ClientController@invoice',
    'as'=>'invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sale-invoices', [
    'uses'=>'App\Http\Controllers\ClientController@saleInvoices',
    'as'=>'sale-invoices',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-sale-invoices', [
    'uses'=>'App\Http\Controllers\ClientController@dateToDateSaleInvoices',
    'as'=>'date-to-date-sale-invoices',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-transaction-form', [
    'uses'=>'App\Http\Controllers\ClientController@dueTransactionForm',
    'as'=>'due-transaction-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-client-for-due', [
    'uses'=>'App\Http\Controllers\ClientController@clientForDue',
    'as'=>'get-client-for-due',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-transaction', [
    'uses'=>'App\Http\Controllers\ClientController@dueTransaction',
    'as'=>'due-transaction',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-transaction-update', [
    'uses'=>'App\Http\Controllers\ClientController@dueTransactionUpdate',
    'as'=>'due-transaction-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice-edit', [
    'uses'=>'App\Http\Controllers\ClientController@invoiceEdit',
    'as'=>'invoice-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/client-invoice-delete', [
    'uses'=>'App\Http\Controllers\ClientController@invoiceDelete',
    'as'=>'client-invoice-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);


