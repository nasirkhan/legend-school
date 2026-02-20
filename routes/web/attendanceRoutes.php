<?php

Route::any('/attendance', [
    'uses'=>'App\Http\Controllers\AttendanceController@index',
    'as'=>'attendance',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/attendance-form', [
    'uses'=>'App\Http\Controllers\AttendanceController@form',
    'as'=>'attendance-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/attendance-save', [
    'uses'=>'App\Http\Controllers\AttendanceController@store',
    'as'=>'attendance-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/attendance-detail', [
    'uses'=>'App\Http\Controllers\AttendanceController@detail',
    'as'=>'attendance-detail',
    'middleware'=>['auth:sanctum', 'verified']
]);

//Biometric Attendance Report
Route::any('/attendance-report', [
    'uses'=>'App\Http\Controllers\AttendanceController@attendanceReport',
    'as'=>'attendance-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/biometric-attendance-report', [
    'uses'=>'App\Http\Controllers\AttendanceController@biometricAttendanceReport',
    'as'=>'biometric-attendance-report',
    'middleware'=>['auth:sanctum', 'verified']
]);
