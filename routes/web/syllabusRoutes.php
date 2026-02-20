<?php

Route::any('/syllabus-add-form', [
    'uses'=>'App\Http\Controllers\SyllabusController@addForm',
    'as'=>'syllabus-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus', [
    'uses'=>'App\Http\Controllers\SyllabusController@index',
    'as'=>'syllabus',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-syllabus', [
    'uses'=>'App\Http\Controllers\SyllabusController@getSyllabus',
    'as'=>'get-syllabus',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-raw-syllabus', [
    'uses'=>'App\Http\Controllers\SyllabusController@getRawPapers',
    'as'=>'get-raw-syllabus',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus-save', [
    'uses'=>'App\Http\Controllers\SyllabusController@store',
    'as'=>'syllabus-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus-edit', [
    'uses'=>'App\Http\Controllers\SyllabusController@edit',
    'as'=>'syllabus-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus-update', [
    'uses'=>'App\Http\Controllers\SyllabusController@update',
    'as'=>'syllabus-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus-status-update/{id}', [
    'uses'=>'App\Http\Controllers\SyllabusController@statusUpdate',
    'as'=>'syllabus-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/syllabus-delete', [
    'uses'=>'App\Http\Controllers\SyllabusController@delete',
    'as'=>'syllabus-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);



