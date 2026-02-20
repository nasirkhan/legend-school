<?php

Route::any('/hw-add-form', [
    'uses'=>'App\Http\Controllers\HWController@addForm',
    'as'=>'hw-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-save', [
    'uses'=>'App\Http\Controllers\HWController@store',
    'as'=>'hw-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-hw-list', [
    'uses'=>'App\Http\Controllers\HWController@classWiseHwList',
    'as'=>'class-wise-hw-list',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-review/{id}', [
    'uses'=>'App\Http\Controllers\HWController@hwReview',
    'as'=>'hw-review',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-edit/{id}', [
    'uses'=>'App\Http\Controllers\HWController@edit',
    'as'=>'hw-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-update', [
    'uses'=>'App\Http\Controllers\HWController@update',
    'as'=>'hw-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-status-update/{id}', [
    'uses'=>'App\Http\Controllers\HWController@statusUpdate',
    'as'=>'hw-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-delete-attachment/{id}', [
    'uses'=>'App\Http\Controllers\HWController@deleteAttachment',
    'as'=>'hw-delete-attachment',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/hw-delete/{id}', [
    'uses'=>'App\Http\Controllers\HWController@delete',
    'as'=>'hw-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-hw', [
    'uses'=>'App\Http\Controllers\HWController@getHW',
    'as'=>'get-hw',
//    'middleware'=>['auth:sanctum', 'verified']
]);
