<?php

Route::any('/schools', [
    'uses'=>'App\Http\Controllers\SchoolController@index',
    'as'=>'schools',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/school-save', [
    'uses'=>'App\Http\Controllers\SchoolController@store',
    'as'=>'school-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/school-update', [
    'uses'=>'App\Http\Controllers\SchoolController@update',
    'as'=>'school-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/school-status-update', [
    'uses'=>'App\Http\Controllers\SchoolController@statusUpdate',
    'as'=>'school-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/school-delete', [
    'uses'=>'App\Http\Controllers\SchoolController@delete',
    'as'=>'school-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
