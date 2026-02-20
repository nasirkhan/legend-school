<?php

Route::any('/academic-sessions', [
    'uses'=>'App\Http\Controllers\AcademicSessionController@index',
    'as'=>'academic-sessions',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/academic-session-save', [
    'uses'=>'App\Http\Controllers\AcademicSessionController@store',
    'as'=>'academic-session-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/academic-session-update', [
    'uses'=>'App\Http\Controllers\AcademicSessionController@update',
    'as'=>'academic-session-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/academic-session-status-update', [
    'uses'=>'App\Http\Controllers\AcademicSessionController@statusUpdate',
    'as'=>'academic-session-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/academic-session-delete', [
    'uses'=>'App\Http\Controllers\AcademicSessionController@delete',
    'as'=>'academic-session-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
