<?php

Route::any('/sections', [
    'uses'=>'App\Http\Controllers\SectionController@index',
    'as'=>'sections',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-save', [
    'uses'=>'App\Http\Controllers\SectionController@store',
    'as'=>'section-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-update', [
    'uses'=>'App\Http\Controllers\SectionController@update',
    'as'=>'section-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-status-update', [
    'uses'=>'App\Http\Controllers\SectionController@statusUpdate',
    'as'=>'section-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-delete', [
    'uses'=>'App\Http\Controllers\SectionController@delete',
    'as'=>'section-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-section', [
    'uses'=>'App\Http\Controllers\SectionController@getBatch',
    'as'=>'get-section',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-section-classes', [
    'uses'=>'App\Http\Controllers\SectionController@getSectionClasses',
    'as'=>'get-section-classes',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/section-class-update', [
    'uses'=>'App\Http\Controllers\SectionController@sectionClassUpdate',
    'as'=>'section-class-update',
    'middleware'=>['auth:sanctum', 'verified']
]);
