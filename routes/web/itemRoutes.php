<?php

Route::any('/items', [
    'uses'=>'App\Http\Controllers\ItemController@index',
    'as'=>'items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-items', [
    'uses'=>'App\Http\Controllers\ItemController@getItems',
    'as'=>'get-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-save', [
    'uses'=>'App\Http\Controllers\ItemController@store',
    'as'=>'item-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-update', [
    'uses'=>'App\Http\Controllers\ItemController@update',
    'as'=>'item-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-status-update', [
    'uses'=>'App\Http\Controllers\ItemController@statusUpdate',
    'as'=>'item-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-delete', [
    'uses'=>'App\Http\Controllers\ItemController@delete',
    'as'=>'item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-items', [
    'uses'=>'App\Http\Controllers\ItemController@classWiseItems',
    'as'=>'class-wise-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-item-save', [
    'uses'=>'App\Http\Controllers\ItemController@classWiseItemSave',
    'as'=>'class-wise-item-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-class-wise-items', [
    'uses'=>'App\Http\Controllers\ItemController@getClassWiseItems',
    'as'=>'get-class-wise-items',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-item-update', [
    'uses'=>'App\Http\Controllers\ItemController@classWiseItemUpdate',
    'as'=>'class-wise-item-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-item-status-update', [
    'uses'=>'App\Http\Controllers\ItemController@classWiseItemStatusUpdate',
    'as'=>'class-wise-item-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-item-delete', [
    'uses'=>'App\Http\Controllers\ItemController@classWiseItemDelete',
    'as'=>'class-wise-item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
