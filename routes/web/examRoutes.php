<?php

Route::any('/exams', [
    'uses'=>'App\Http\Controllers\ExamController@index',
    'as'=>'exams',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-exams', [
    'uses'=>'App\Http\Controllers\ExamController@getExams',
    'as'=>'get-exams',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-raw-exams', [
    'uses'=>'App\Http\Controllers\ExamController@getRawExams',
    'as'=>'get-raw-exams',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-save', [
    'uses'=>'App\Http\Controllers\ExamController@store',
    'as'=>'exam-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-edit/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@edit',
    'as'=>'exam-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-update', [
    'uses'=>'App\Http\Controllers\ExamController@update',
    'as'=>'exam-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-status-update/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@statusUpdate',
    'as'=>'exam-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-show-to-student/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@examShowToStudent',
    'as'=>'exam-show-to-student',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/mark-input-status-update/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@markInputStatusUpdate',
    'as'=>'mark-input-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/publication-status-update/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@publicationStatusUpdate',
    'as'=>'publication-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/need-promotional-status-update/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@needPromotionalStatusUpdate',
    'as'=>'need-promotional-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-schedule-status-update/{id}', [
    'uses'=>'App\Http\Controllers\ExamController@examScheduleStatusUpdate',
    'as'=>'exam-schedule-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/exam-delete', [
    'uses'=>'App\Http\Controllers\ExamController@delete',
    'as'=>'exam-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);


Route::any('/top', function () {
    $results = App\Models\Result::where([
        'exam_id'=>32,
        'subject_id'=>16,
    ])->get()->groupBy('student_id');

    $exam = App\Models\Exam::with([
        'papers'=>function ($query) {
            $query->where('subject_id',16);
        },
    ])->find(32);

    $class = App\Models\ClassName::find(5);

    $data = [];
    foreach ($results as $key => $result){
        $papers = App\Models\Paper::where([
            'exam_id'=>$result[0]->exam_id,
            'subject_id'=>$result[0]->subject_id,
            'status'=>1,
        ])->get(['id','mark']);
        $item = [
            'student_id'=>$key, 'mark'=>$result->sum('mark'), 'out_of'=>$papers->sum('mark'),
        ];

        $data[] = $item;
    }

    return max(array_column($data, 'out_of'));
});
