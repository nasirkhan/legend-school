<?php

Route::any('/daily-academic-report', [
    'uses'=>'App\Http\Controllers\AcademicSupervisionController@dailyAcademicReport',
    'as'=>'daily-academic-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-daily-academic-report', [
    'uses'=>'App\Http\Controllers\AcademicSupervisionController@getDailyAcademicReport',
    'as'=>'get-daily-academic-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-wise-academic-report', [
    'uses'=>'App\Http\Controllers\AcademicSupervisionController@dateWiseAcademicReport',
    'as'=>'date-wise-academic-report',
    'middleware'=>['auth:sanctum', 'verified']
]);
