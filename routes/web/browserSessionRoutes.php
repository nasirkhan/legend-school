<?php

Route::any('/set-year', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setYear',
    'as'=>'set-year'
]);

Route::any('/set-session', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setSession',
    'as'=>'set-session'
]);

Route::any('/set-section', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setSection',
    'as'=>'set-section'
]);

Route::any('/set-class-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setClassId',
    'as'=>'set-class-id'
]);

Route::any('/set-next-class-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setNextClassId',
    'as'=>'set-next-class-id'
]);

Route::any('/set-next-year', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setNextYear',
    'as'=>'set-next-year'
]);

Route::any('/set-subject-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setSubjectId',
    'as'=>'set-subject-id'
]);

Route::any('/set-exam-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setExamId',
    'as'=>'set-exam-id'
]);

Route::any('/set-used-for', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setUsedFor',
    'as'=>'set-used-for'
]);

Route::any('/set-item-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setItemId',
    'as'=>'set-item-id'
]);

Route::any('/set-month-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setMonthId',
    'as'=>'set-month-id'
]);

Route::any('/set-billing-cycle', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setBillingCycle',
    'as'=>'set-billing-cycle'
]);

Route::any('/set-from', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setFrom',
    'as'=>'set-from'
]);

Route::any('/set-to', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setTo',
    'as'=>'set-to'
]);

Route::any('/set-beneficiary-type-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setBeneficiaryTypeId',
    'as'=>'set-beneficiary-type-id'
]);

Route::any('/set-expense-item-id', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setExpenseItemId',
    'as'=>'set-expense-item-id'
]);

Route::any('/set-transaction-type', [
    'uses'=>'App\Http\Controllers\BrowserSessionController@setTransactionType',
    'as'=>'set-transaction-type'
]);

