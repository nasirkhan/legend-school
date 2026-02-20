<?php

Route::any('/message-form/{from}', [
    'uses'=>'App\Http\Controllers\SMSController@index',
    'as'=>'message-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/send-password-to-mother', [
    'uses'=>'App\Http\Controllers\SMSController@sendPasswordToMother',
    'as'=>'send-password-to-mother',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-list-for-message', [
    'uses'=>'App\Http\Controllers\SMSController@form',
    'as'=>'student-list-for-message',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/send-message', [
    'uses'=>'App\Http\Controllers\SMSController@sendMessage',
    'as'=>'send-message',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unsent-sms', [
    'uses'=>'App\Http\Controllers\SMSController@unsentMessage',
    'as'=>'unsent-sms',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sms-resend', [
    'uses'=>'App\Http\Controllers\SMSController@smsResend',
    'as'=>'sms-resend',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/group-sms', [
    'uses'=>'App\Http\Controllers\SMSController@groupSMS',
    'as'=>'group-sms',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/group-sms-send', [
    'uses'=>'App\Http\Controllers\SMSController@groupSMSSend',
    'as'=>'group-sms-send',
    'middleware'=>['auth:sanctum', 'verified']
]);
