<?php

Route::any('/popular-ecas', [
    'uses'=>'App\Http\Controllers\PopularClassController@index',
    'as'=>'popular-classes',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/popular-eca-add-form', [
    'uses'=>'App\Http\Controllers\PopularClassController@addForm',
    'as'=>'popular-class-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/popular-eca-save', [
    'uses'=>'App\Http\Controllers\PopularClassController@store',
    'as'=>'popular-class-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/popular-eca-edit/{id}', [
    'uses'=>'App\Http\Controllers\PopularClassController@edit',
    'as'=>'popular-class-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/popular-eca-update', [
    'uses'=>'App\Http\Controllers\PopularClassController@update',
    'as'=>'popular-class-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-popular-eca-status/{id}', [
    'uses'=>'App\Http\Controllers\PopularClassController@statusUpdate',
    'as'=>'update-popular-class-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/popular-eca-delete/{id}', [
    'uses'=>'App\Http\Controllers\PopularClassController@delete',
    'as'=>'popular-class-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
