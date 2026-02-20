<?php

Route::any('/sub-category', [
    'uses'=>'App\Http\Controllers\SubCategoryController@index',
    'as'=>'sub-category',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-category-save', [
    'uses'=>'App\Http\Controllers\SubCategoryController@store',
    'as'=>'sub-category-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-category-update', [
    'uses'=>'App\Http\Controllers\SubCategoryController@update',
    'as'=>'sub-category-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-category-status-update', [
    'uses'=>'App\Http\Controllers\SubCategoryController@statusUpdate',
    'as'=>'sub-category-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sub-category-delete', [
    'uses'=>'App\Http\Controllers\SubCategoryController@delete',
    'as'=>'sub-category-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-sub-category', [
    'uses'=>'App\Http\Controllers\SubCategoryController@getSubCategory',
    'as'=>'get-sub-category',
    'middleware'=>['auth:sanctum', 'verified']
]);
