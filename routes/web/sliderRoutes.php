<?php

Route::any('/slides', [
    'uses'=>'App\Http\Controllers\SliderController@index',
    'as'=>'slides',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/slide-add-form', [
    'uses'=>'App\Http\Controllers\SliderController@addForm',
    'as'=>'slide-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/slide-save', [
    'uses'=>'App\Http\Controllers\SliderController@store',
    'as'=>'slide-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/slide-edit/{id}', [
    'uses'=>'App\Http\Controllers\SliderController@edit',
    'as'=>'slide-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/slide-update', [
    'uses'=>'App\Http\Controllers\SliderController@update',
    'as'=>'slide-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-slide-status/{id}', [
    'uses'=>'App\Http\Controllers\SliderController@statusUpdate',
    'as'=>'update-slide-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/slide-delete/{id}', [
    'uses'=>'App\Http\Controllers\SliderController@delete',
    'as'=>'slide-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/serialize-slides', [
    'uses'=>'App\Http\Controllers\SliderController@serializeSlides',
    'as'=>'serialize-slides',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-slide-position', [
    'uses'=>'App\Http\Controllers\SliderController@updateSlidePosition',
    'as'=>'update-slide-position',
    'middleware'=>['auth:sanctum', 'verified']
]);
