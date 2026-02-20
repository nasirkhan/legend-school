<?php

Route::any('/students', [
    'uses'=>'App\Http\Controllers\StudentController@index',
    'as'=>'students',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-registration', [
    'uses'=>'App\Http\Controllers\StudentController@registrationForm',
    'as'=>'student-registration',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-save', [
    'uses'=>'App\Http\Controllers\StudentController@store',
    'as'=>'student-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-edit/{id}', [
    'uses'=>'App\Http\Controllers\StudentController@edit',
    'as'=>'student-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-fee-by-class-and-year', [
    'uses'=>'App\Http\Controllers\StudentController@getFeeByClassAndYear',
    'as'=>'get-fee-by-class-and-year',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-update', [
    'uses'=>'App\Http\Controllers\StudentController@update',
    'as'=>'student-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-status-update', [
    'uses'=>'App\Http\Controllers\StudentController@statusUpdate',
    'as'=>'student-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-delete', [
    'uses'=>'App\Http\Controllers\StudentController@delete',
    'as'=>'student-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

//*-----------------------------------------*//
Route::any('/student-list/{from}', [
    'uses'=>'App\Http\Controllers\StudentController@studentListForm',
    'as'=>'student-list',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-student', [
    'uses'=>'App\Http\Controllers\StudentController@activeStudent',
    'as'=>'active-student',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-student-for-class-activity', [
    'uses'=>'App\Http\Controllers\TeacherHWController@activeStudentForClassActivity',
    'as'=>'active-student-for-class-activity',
//    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-student-for-password', [
    'uses'=>'App\Http\Controllers\StudentController@activeStudentForPassword',
    'as'=>'active-student-for-password',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/active-student-title', [
    'uses'=>'App\Http\Controllers\StudentController@activeStudentTitle',
    'as'=>'active-student-title',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-detail/{id}', [
    'uses'=>'App\Http\Controllers\StudentController@studentDetail',
    'as'=>'student-detail',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-information/{id}', [
    'uses'=>'App\Http\Controllers\StudentController@studentInformation',
    'as'=>'student-information',
    'middleware'=>['auth:sanctum', 'verified']
]);

//-----------------Promotion----------------
Route::any('/promotion-form', [
    'uses'=>'App\Http\Controllers\StudentController@promotionForm',
    'as'=>'promotion-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-list-for-promotion', [
    'uses'=>'App\Http\Controllers\StudentController@studentListForPromotion',
    'as'=>'student-list-for-promotion',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/promotion-save', [
    'uses'=>'App\Http\Controllers\StudentController@promotionSave',
    'as'=>'promotion-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice-generation-for-promotion', [
    'uses'=>'App\Http\Controllers\StudentController@invoiceGenerationForPromotion',
    'as'=>'invoice-generation-for-promotion',
    'middleware'=>['auth:sanctum', 'verified']
]);
