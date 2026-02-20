<?php

Route::any('/sub-pages', [
    'uses'=>'App\Http\Controllers\SubPageController@index',
    'as'=>'sub-pages',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-page-add-form', [
    'uses'=>'App\Http\Controllers\SubPageController@addForm',
    'as'=>'sub-page-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-page-save', [
    'uses'=>'App\Http\Controllers\SubPageController@store',
    'as'=>'sub-page-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-page-edit/{id}', [
    'uses'=>'App\Http\Controllers\SubPageController@edit',
    'as'=>'sub-page-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-page-update', [
    'uses'=>'App\Http\Controllers\SubPageController@update',
    'as'=>'sub-page-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-sub-page-status/{id}', [
    'uses'=>'App\Http\Controllers\SubPageController@statusUpdate',
    'as'=>'update-sub-page-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-page-delete/{id}', [
    'uses'=>'App\Http\Controllers\SubPageController@delete',
    'as'=>'sub-page-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
