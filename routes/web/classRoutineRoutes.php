<?php

Route::any('/class-routines', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@index',
    'as'=>'class-routines',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-routine-add-form', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@addForm',
    'as'=>'class-routine-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-routine-save', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@store',
    'as'=>'class-routine-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-routine-edit/{id}', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@edit',
    'as'=>'class-routine-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-routine-update', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@update',
    'as'=>'class-routine-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-class-routine-status/{id}', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@statusUpdate',
    'as'=>'update-class-routine-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-routine-delete/{id}', [
    'uses'=>'App\Http\Controllers\ClassRoutineController@delete',
    'as'=>'class-routine-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
