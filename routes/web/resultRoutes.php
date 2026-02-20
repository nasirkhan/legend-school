<?php

Route::any('/result/{from}', [
    'uses'=>'App\Http\Controllers\ResultController@index',
    'as'=>'result',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/result-form', [
    'uses'=>'App\Http\Controllers\ResultController@form',
    'as'=>'result-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/result-save', [
    'uses'=>'App\Http\Controllers\ResultController@store',
    'as'=>'result-save',
    'middleware'=>['auth:sanctum', 'verified']
]);


Route::any('/report-card-form', [
    'uses'=>'App\Http\Controllers\ResultController@reportCardForm',
    'as'=>'report-card-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-report-card', [
    'uses'=>'App\Http\Controllers\ResultController@studentReportCard',
    'as'=>'student-report-card',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-report-card-print', [
    'uses'=>'App\Http\Controllers\ResultController@studentReportCardPrint',
    'as'=>'student-report-card-print',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-teacher-comment-save', [
    'uses'=>'App\Http\Controllers\ResultController@classTeacherCommentSave',
    'as'=>'class-teacher-comment-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

//Academic Transcript Settings and Print

Route::any('/academic-transcript-settings', [
    'uses'=>'App\Http\Controllers\ResultController@academicTranscriptSettingsForm',
    'as'=>'academic-transcript-settings',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-exam-list-for-transcript-settings', [
    'uses'=>'App\Http\Controllers\ResultController@getExamListForTranscriptSettings',
    'as'=>'get-exam-list-for-transcript-settings',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transcript-setting-save', [
    'uses'=>'App\Http\Controllers\ResultController@transcriptSettingSave',
    'as'=>'transcript-setting-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-academic-transcript-print', [
    'uses'=>'App\Http\Controllers\ResultController@studentAcademicTranscriptPrint',
    'as'=>'student-academic-transcript-print',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/delete-result', [
    'uses'=>'App\Http\Controllers\ResultController@deleteResult',
    'as'=>'delete-result',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/result-meta-add', [
    'uses'=>'App\Http\Controllers\ResultController@resultMetaAdd',
    'as'=>'result-meta-add',
    'middleware'=>['auth:sanctum', 'verified']
]);

