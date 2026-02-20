<?php

Route::any('/eca-items', [
    'uses'=>'App\Http\Controllers\ECAItemController@index',
    'as'=>'eca-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-item-save', [
    'uses'=>'App\Http\Controllers\ECAItemController@store',
    'as'=>'eca-item-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-item-update', [
    'uses'=>'App\Http\Controllers\ECAItemController@update',
    'as'=>'eca-item-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-item-status-update', [
    'uses'=>'App\Http\Controllers\ECAItemController@statusUpdate',
    'as'=>'eca-item-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-item-delete', [
    'uses'=>'App\Http\Controllers\ECAItemController@delete',
    'as'=>'eca-item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
