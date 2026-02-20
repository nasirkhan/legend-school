<?php

Route::any('/purchase', [
    'uses'=>'App\Http\Controllers\PurchaseController@index',
    'as'=>'purchase',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/purchase-save', [
    'uses'=>'App\Http\Controllers\PurchaseController@store',
    'as'=>'purchase-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/purchase-update', [
    'uses'=>'App\Http\Controllers\PurchaseController@update',
    'as'=>'purchase-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/purchase-status-update', [
    'uses'=>'App\Http\Controllers\PurchaseController@statusUpdate',
    'as'=>'purchase-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/purchase-delete', [
    'uses'=>'App\Http\Controllers\PurchaseController@delete',
    'as'=>'purchase-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
