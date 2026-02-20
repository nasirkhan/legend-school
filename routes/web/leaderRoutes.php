<?php

Route::any('/leaders', [
    'uses'=>'App\Http\Controllers\LeaderController@index',
    'as'=>'leaders',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/leader-add-form', [
    'uses'=>'App\Http\Controllers\LeaderController@addForm',
    'as'=>'leader-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/leader-save', [
    'uses'=>'App\Http\Controllers\LeaderController@store',
    'as'=>'leader-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/leader-edit/{id}', [
    'uses'=>'App\Http\Controllers\LeaderController@edit',
    'as'=>'leader-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/leader-update', [
    'uses'=>'App\Http\Controllers\LeaderController@update',
    'as'=>'leader-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-leader-status/{id}', [
    'uses'=>'App\Http\Controllers\LeaderController@statusUpdate',
    'as'=>'update-leader-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/leader-delete/{id}', [
    'uses'=>'App\Http\Controllers\LeaderController@delete',
    'as'=>'leader-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
