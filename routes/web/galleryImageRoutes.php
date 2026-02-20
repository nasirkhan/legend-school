<?php

Route::any('/gallery-images', [
    'uses'=>'App\Http\Controllers\GalleryImageController@index',
    'as'=>'gallery-images',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/gallery-image-add-form', [
    'uses'=>'App\Http\Controllers\GalleryImageController@addForm',
    'as'=>'gallery-image-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/gallery-image-save', [
    'uses'=>'App\Http\Controllers\GalleryImageController@store',
    'as'=>'gallery-image-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/gallery-image-edit/{id}', [
    'uses'=>'App\Http\Controllers\GalleryImageController@edit',
    'as'=>'gallery-image-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/gallery-image-update', [
    'uses'=>'App\Http\Controllers\GalleryImageController@update',
    'as'=>'gallery-image-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-gallery-image-status/{id}', [
    'uses'=>'App\Http\Controllers\GalleryImageController@statusUpdate',
    'as'=>'update-gallery-image-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/gallery-image-delete/{id}', [
    'uses'=>'App\Http\Controllers\GalleryImageController@delete',
    'as'=>'gallery-image-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
