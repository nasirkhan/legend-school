<?php

Route::any('/school-transcript/{from}', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@schoolTranscript',
    'as'=>'school-transcript',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/private-student-save', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@privateStudentSave',
    'as'=>'private-student-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/private-student-update', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@privateStudentUpdate',
    'as'=>'private-student-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transcript-mark-save', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@transcriptMarkSave',
    'as'=>'transcript-mark-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/cambridge-mark-save', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@cambridgeMarkSave',
    'as'=>'cambridge-mark-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/private-student-transcript/{id}', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@privateStudentTranscript',
    'as'=>'private-student-transcript',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/private-student-transcript-print/{id}', [
    'uses'=>'App\Http\Controllers\AcademicTranscriptController@privateStudentTranscriptPrint',
    'as'=>'private-student-transcript-print',
    'middleware'=>['auth:sanctum', 'verified']
]);


