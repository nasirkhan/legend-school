<?php

Route::any('/subjects', [
    'uses'=>'App\Http\Controllers\SubjectController@index',
    'as'=>'subjects',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/subject-save', [
    'uses'=>'App\Http\Controllers\SubjectController@store',
    'as'=>'subject-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/subject-update', [
    'uses'=>'App\Http\Controllers\SubjectController@update',
    'as'=>'subject-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/subject-status-update', [
    'uses'=>'App\Http\Controllers\SubjectController@statusUpdate',
    'as'=>'subject-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/subject-delete', [
    'uses'=>'App\Http\Controllers\SubjectController@delete',
    'as'=>'subject-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-subject', [
    'uses'=>'App\Http\Controllers\SubjectController@getSubject',
    'as'=>'get-subject',
//    'middleware'=>['auth:sanctum', 'verified']
]);
