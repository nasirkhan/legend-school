<?php

Route::any('/classes', [
    'uses'=>'App\Http\Controllers\ClassController@index',
    'as'=>'classes',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-classes', [
    'uses'=>'App\Http\Controllers\ClassController@getClasses',
    'as'=>'get-classes',
//    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-save', [
    'uses'=>'App\Http\Controllers\ClassController@store',
    'as'=>'class-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-update', [
    'uses'=>'App\Http\Controllers\ClassController@update',
    'as'=>'class-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-status-update', [
    'uses'=>'App\Http\Controllers\ClassController@statusUpdate',
    'as'=>'class-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-delete', [
    'uses'=>'App\Http\Controllers\ClassController@delete',
    'as'=>'class-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-class-subjects', [
    'uses'=>'App\Http\Controllers\ClassController@getClassSubjects',
    'as'=>'get-class-subjects',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-subject-update', [
    'uses'=>'App\Http\Controllers\ClassController@classSubjectUpdate',
    'as'=>'class-subject-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-subject-update-for-practical', [
    'uses'=>'App\Http\Controllers\ClassController@classSubjectUpdateForPractical',
    'as'=>'class-subject-update-for-practical',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-class-subjects-for-student', [
    'uses'=>'App\Http\Controllers\ClassController@getClassSubjectsForStudent',
    'as'=>'get-class-subjects-for-student',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-class-subject-update', [
    'uses'=>'App\Http\Controllers\ClassController@studentClassSubjectUpdate',
    'as'=>'student-class-subject-update',
    'middleware'=>['auth:sanctum', 'verified']
]);
