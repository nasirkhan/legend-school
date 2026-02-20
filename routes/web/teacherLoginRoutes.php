<?php

Route::any('/teacher/login',function (){
    return redirect('/teacher-login-form');
});

Route::any('/teacher-login-form', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherLoginForm',
'as'=>'teacher-login-form'
]);

Route::any('/teacher-login', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherLogin',
'as'=>'teacher-login'
]);

Route::any('/teacher-profile', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherProfile',
'as'=>'teacher-profile'
]);

Route::any('/teacher-schedule', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherSchedule',
'as'=>'teacher-schedule'
]);

Route::any('/teacher-logout', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherLogout',
'as'=>'teacher-logout'
]);

Route::any('/teacher-profile-edit', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherProfileEdit',
'as'=>'teacher-profile-edit'
]);

Route::any('/teacher-profile-update', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherProfileUpdate',
'as'=>'teacher-profile-update'
]);

Route::any('/teacher-password-change-form', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherPasswordChangeForm',
'as'=>'teacher-password-change-form'
]);

Route::any('/teacher-password-update', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherPasswordUpdate',
'as'=>'teacher-password-update'
]);

Route::any('/teacher-subject-choice-form', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherSubjectChoiceForm',
'as'=>'teacher-subject-choice-form'
]);

Route::any('/teacher-subject-list', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherSubjectList',
'as'=>'teacher-subject-list'
]);

Route::any('/teacher-routine/{id}', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherRoutine',
'as'=>'teacher-routine'
]);

Route::any('/teacher-syllabus', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherSyllabus',
'as'=>'teacher-syllabus'
]);

Route::any('/teacher-attendance-report', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherAttendanceReport',
'as'=>'teacher-attendance-report'
]);

Route::any('/teacher-exam-schedule', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherExamSchedule',
'as'=>'teacher-exam-schedule'
]);

Route::any('/teacher-academic-transcript', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@academicTranscript',
'as'=>'teacher-academic-transcript'
]);

Route::any('/teacher-report-card-by-own', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherReportCardByOwn',
'as'=>'teacher-report-card-by-own'
]);


Route::any('/teacher-home-work', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherHomeWork',
'as'=>'teacher-home-work'
]);


Route::any('/teacher-home-work-details', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherHomeWorkDetails',
'as'=>'teacher-home-work-details'
]);

Route::any('/teacher-home-work-upload', [
'uses'=>'App\Http\Controllers\Front\TeacherLoginController@teacherHomeWorkUpload',
'as'=>'teacher-home-work-upload'
]);

/*Teacher Class Subject etc*/
Route::any('/get-teacher-classes', [
    'uses'=>'App\Http\Controllers\Front\TeacherLoginController@getTeacherClasses',
    'as'=>'get-teacher-classes'
]);

Route::any('/get-teacher-subject', [
    'uses'=>'App\Http\Controllers\Front\TeacherLoginController@getTeacherSubject',
    'as'=>'get-teacher-subject'
]);


/*Home Work Section*/
Route::any('/teacher-hw-add-form', [
    'uses'=>'App\Http\Controllers\TeacherHWController@addForm',
    'as'=>'teacher-hw-add-form'
]);

Route::any('/teacher-hw-save', [
    'uses'=>'App\Http\Controllers\TeacherHWController@store',
    'as'=>'teacher-hw-save'
]);

Route::any('/teacher-class-wise-hw-list', [
    'uses'=>'App\Http\Controllers\TeacherHWController@classWiseHwList',
    'as'=>'teacher-class-wise-hw-list'
]);

Route::any('/teacher-hw-review/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@hwReview',
    'as'=>'teacher-hw-review'
]);

Route::any('/teacher-hw-edit/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@edit',
    'as'=>'teacher-hw-edit'
]);

Route::any('/teacher-hw-update', [
    'uses'=>'App\Http\Controllers\TeacherHWController@update',
    'as'=>'teacher-hw-update'
]);

Route::any('/teacher-hw-status-update/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@statusUpdate',
    'as'=>'teacher-hw-status-update'
]);

Route::any('/teacher-hw-delete-attachment/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@deleteAttachment',
    'as'=>'teacher-hw-delete-attachment'
]);

Route::any('/teacher-hw-delete/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@delete',
    'as'=>'teacher-hw-delete'
]);

Route::any('/teacher-get-hw', [
    'uses'=>'App\Http\Controllers\TeacherHWController@getHW',
    'as'=>'teacher-get-hw'
]);

//HW Checking section
Route::any('/students-hw-check-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@studentsHWCheckByTeacher',
    'as'=>'students-hw-check-by-teacher'
]);

Route::any('/get-my-subject-hw', [
    'uses'=>'App\Http\Controllers\TeacherHWController@getMySubjectHW',
    'as'=>'get-my-subject-hw'
]);

Route::any('/get-my-students-hw', [
    'uses'=>'App\Http\Controllers\TeacherHWController@getMyStudentsHW',
    'as'=>'get-my-students-hw'
]);

Route::any('/returned-hw-form', [
    'uses'=>'App\Http\Controllers\TeacherHWController@returnedHWForm',
    'as'=>'returned-hw-form'
]);

Route::any('/students-returned-hw-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@studentsReturnedHWByTeacher',
    'as'=>'students-returned-hw-by-teacher'
]);

Route::any('/open-hw-for-checking/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@openHWForChecking',
    'as'=>'open-hw-for-checking'
]);

//HW Annotation
Route::any('/save-annotation-together', [
    'uses'=>'App\Http\Controllers\TeacherHWController@saveAnnotationTogether',
    'as'=>'save-annotation-together'
]);

Route::any('/all-page-annotations', [
    'uses'=>'App\Http\Controllers\TeacherHWController@allPageAnnotations',
    'as'=>'all-page-annotations'
]);

//Class Activity
Route::any('/class-activity', [
    'uses'=>'App\Http\Controllers\TeacherHWController@classActivity',
    'as'=>'class-activity'
]);

Route::any('/get-subject-for-class-activity', [
    'uses'=>'App\Http\Controllers\TeacherHWController@getSubjectForClassActivity',
    'as'=>'get-subject-for-class-activity'
]);

Route::any('/student-class-activity-update', [
    'uses'=>'App\Http\Controllers\TeacherHWController@studentClassActivityUpdate',
    'as'=>'student-class-activity-update'
]);

Route::any('/teacher-class-activity-add-form', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherClassActivityAddForm',
    'as'=>'teacher-class-activity-add-form'
]);

Route::any('/teacher-cw-save', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWSave',
    'as'=>'teacher-cw-save'
]);

Route::any('/teacher-class-wise-cw-list', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherClassWiseCWList',
    'as'=>'teacher-class-wise-cw-list'
]);

Route::any('/teacher-cw-review/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWReview',
    'as'=>'teacher-cw-review'
]);

Route::any('/teacher-cw-edit/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWEdit',
    'as'=>'teacher-cw-edit'
]);

Route::any('/teacher-cw-update', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWUpdate',
    'as'=>'teacher-cw-update'
]);

Route::any('/teacher-cw-status-update/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWStatusUpdate',
    'as'=>'teacher-cw-status-update'
]);

Route::any('/teacher-cw-delete-attachment/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWDeleteAttachment',
    'as'=>'teacher-cw-delete-attachment'
]);

Route::any('/teacher-cw-delete/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherCWDelete',
    'as'=>'teacher-cw-delete'
]);
//Syllabus Management
Route::any('/syllabus-add-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@syllabusAddByTeacher',
    'as'=>'syllabus-add-by-teacher'
]);

Route::any('/exam-list-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@examListByTeacher',
    'as'=>'exam-list-by-teacher'
]);

Route::any('/syllabus-save-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@syllabusSaveByTeacher',
    'as'=>'syllabus-save-by-teacher'
]);

Route::any('/syllabus-view-by-teacher', [
    'uses'=>'App\Http\Controllers\TeacherHWController@syllabusViewByTeacher',
    'as'=>'syllabus-view-by-teacher'
]);

Route::any('/teacher-syllabus-edit/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherSyllabusEdit',
    'as'=>'teacher-syllabus-edit'
]);

Route::any('/teacher-syllabus-update', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherSyllabusUpdate',
    'as'=>'teacher-syllabus-update'
]);

Route::any('/teacher-syllabus-status-update/{id}', [
    'uses'=>'App\Http\Controllers\TeacherHWController@teacherSyllabusStatusUpdate',
    'as'=>'teacher-syllabus-status-update'
]);
