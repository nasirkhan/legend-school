<?php

Route::any('/payment-form', [
    'uses'=>'App\Http\Controllers\PaymentController@index',
    'as'=>'payment-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-form-fill-up', [
    'uses'=>'App\Http\Controllers\PaymentController@paymentFormFillUp',
    'as'=>'payment-form-fill-up',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-save', [
    'uses'=>'App\Http\Controllers\PaymentController@store',
    'as'=>'payment-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice/{id}', [
    'uses'=>'App\Http\Controllers\PaymentController@invoice',
    'as'=>'invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

