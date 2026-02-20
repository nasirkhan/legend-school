<?php

Route::any('/testimonials', [
    'uses'=>'App\Http\Controllers\TestimonialController@index',
    'as'=>'testimonials',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/testimonial-add-form', [
    'uses'=>'App\Http\Controllers\TestimonialController@addForm',
    'as'=>'testimonial-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/testimonial-save', [
    'uses'=>'App\Http\Controllers\TestimonialController@store',
    'as'=>'testimonial-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/testimonial-edit/{id}', [
    'uses'=>'App\Http\Controllers\TestimonialController@edit',
    'as'=>'testimonial-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/testimonial-update', [
    'uses'=>'App\Http\Controllers\TestimonialController@update',
    'as'=>'testimonial-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-testimonial-status/{id}', [
    'uses'=>'App\Http\Controllers\TestimonialController@statusUpdate',
    'as'=>'update-testimonial-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/testimonial-delete/{id}', [
    'uses'=>'App\Http\Controllers\TestimonialController@delete',
    'as'=>'testimonial-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
