<?php

Route::any('/measurement-category', [
    'uses'=>'App\Http\Controllers\MeasurementCategoryController@index',
    'as'=>'measurement-category',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/measurement-category-save', [
    'uses'=>'App\Http\Controllers\MeasurementCategoryController@store',
    'as'=>'measurement-category-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/measurement-category-update', [
    'uses'=>'App\Http\Controllers\MeasurementCategoryController@update',
    'as'=>'measurement-category-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/measurement-category-status-update', [
    'uses'=>'App\Http\Controllers\MeasurementCategoryController@statusUpdate',
    'as'=>'measurement-category-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/measurement-category-delete', [
    'uses'=>'App\Http\Controllers\MeasurementCategoryController@delete',
    'as'=>'measurement-category-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
