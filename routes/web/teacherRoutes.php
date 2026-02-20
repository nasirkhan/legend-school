<?php

Route::any('/teachers', [
    'uses'=>'App\Http\Controllers\TeacherController@index',
    'as'=>'teachers',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-registration', [
    'uses'=>'App\Http\Controllers\TeacherController@registrationForm',
    'as'=>'teacher-registration',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-save', [
    'uses'=>'App\Http\Controllers\TeacherController@store',
    'as'=>'teacher-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-edit/{id}', [
    'uses'=>'App\Http\Controllers\TeacherController@edit',
    'as'=>'teacher-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-update', [
    'uses'=>'App\Http\Controllers\TeacherController@update',
    'as'=>'teacher-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-status-update', [
    'uses'=>'App\Http\Controllers\TeacherController@statusUpdate',
    'as'=>'teacher-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-delete', [
    'uses'=>'App\Http\Controllers\TeacherController@delete',
    'as'=>'teacher-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-wise-teacher', [
    'uses'=>'App\Http\Controllers\TeacherController@sectionWiseTeacher',
    'as'=>'section-wise-teacher',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-class-subject-save', [
    'uses'=>'App\Http\Controllers\TeacherController@teacherClassSubjectSave',
    'as'=>'teacher-class-subject-save',
    'middleware'=>['auth:sanctum', 'verified']
]);
//*-----------------------------------------*//
Route::any('/teacher-list/{from}', [
    'uses'=>'App\Http\Controllers\TeacherController@teacherListForm',
    'as'=>'teacher-list',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/create-teacher-login-info', [
    'uses'=>'App\Http\Controllers\TeacherController@createTeacherLoginInfo',
    'as'=>'create-teacher-login-info',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-teacher', [
    'uses'=>'App\Http\Controllers\TeacherController@activeStudent',
    'as'=>'active-teacher',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-teacher-title', [
    'uses'=>'App\Http\Controllers\TeacherController@activeStudentTitle',
    'as'=>'active-teacher-title',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-detail/{id}', [
    'uses'=>'App\Http\Controllers\TeacherController@teacherDetail',
    'as'=>'teacher-detail',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-subject-list/{id}/{sectionId}', [
    'uses'=>'App\Http\Controllers\TeacherController@teacherSubjectList',
    'as'=>'teacher-subject-list',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/teacher-class-schedule-save', [
    'uses'=>'App\Http\Controllers\TeacherController@teacherClassScheduleSave',
    'as'=>'teacher-class-schedule-save',
    'middleware'=>['auth:sanctum', 'verified']
]);





