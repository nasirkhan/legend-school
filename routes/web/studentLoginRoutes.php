<?php

Route::any('/student-login-form', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentLoginForm',
'as'=>'student-login-form'
]);

Route::any('/student-login', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentLogin',
'as'=>'student-login'
]);

Route::any('/student-profile', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentProfile',
'as'=>'student-profile'
]);

Route::any('/student-logout', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentLogout',
'as'=>'student-logout'
]);

Route::any('/student-password-update-form', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentPasswordUpdateForm',
'as'=>'student-password-update-form'
]);

Route::any('/student-password-update', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentPasswordUpdate',
'as'=>'student-password-update'
]);

Route::any('/student-subject-choice-form', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentSubjectChoiceForm',
'as'=>'student-subject-choice-form'
]);

Route::any('/student-subject-list', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentSubjectList',
'as'=>'student-subject-list'
]);

Route::any('/student-routine/{id}', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentRoutine',
'as'=>'student-routine'
]);

Route::any('/student-syllabus', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentSyllabus',
'as'=>'student-syllabus'
]);

Route::any('/student-revision-worksheet', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentRevisionWorksheet',
'as'=>'student-revision-worksheet'
]);

Route::any('/student-attendance-report', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentAttendanceReport',
'as'=>'student-attendance-report'
]);

Route::any('/student-exam-schedule', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentExamSchedule',
'as'=>'student-exam-schedule'
]);

Route::any('/academic-transcript', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@academicTranscript',
'as'=>'academic-transcript'
]);

Route::any('/student-report-card-by-own', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentReportCardByOwn',
'as'=>'student-report-card-by-own'
]);


Route::any('/student-home-work', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentHomeWork',
'as'=>'student-home-work'
]);


Route::any('/student-home-work-details', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentHomeWorkDetails',
'as'=>'student-home-work-details'
]);

Route::any('/student-home-work-upload', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentHomeWorkUpload',
'as'=>'student-home-work-upload'
]);

Route::any('/student-class-performance', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentClassPerformance',
'as'=>'student-class-performance'
]);

Route::any('/class-performance-history', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@classPerformanceHistory',
'as'=>'class-performance-history'
]);

Route::any('/student-detail-payment-report', [
'uses'=>'App\Http\Controllers\Front\StudentLoginController@studentDetailPaymentReport',
'as'=>'student-detail-payment-report'
]);
