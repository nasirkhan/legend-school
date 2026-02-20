<?php

Route::any('/exam-components', [
    'uses'=>'App\Http\Controllers\ExamComponentController@index',
    'as'=>'exam-components',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-exam-components', [
    'uses'=>'App\Http\Controllers\ExamComponentController@getExamComponents',
    'as'=>'get-exam-components',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-raw-exam-components', [
    'uses'=>'App\Http\Controllers\ExamComponentController@getRawPapers',
    'as'=>'get-raw-exam-components',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-component-save', [
    'uses'=>'App\Http\Controllers\ExamComponentController@store',
    'as'=>'exam-component-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-component-update', [
    'uses'=>'App\Http\Controllers\ExamComponentController@update',
    'as'=>'exam-component-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-component-status-update', [
    'uses'=>'App\Http\Controllers\ExamComponentController@statusUpdate',
    'as'=>'exam-component-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-component-delete', [
    'uses'=>'App\Http\Controllers\ExamComponentController@delete',
    'as'=>'exam-component-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);


