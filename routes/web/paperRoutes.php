<?php

Route::any('/papers', [
    'uses'=>'App\Http\Controllers\PaperController@index',
    'as'=>'papers',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-papers', [
    'uses'=>'App\Http\Controllers\PaperController@getPapers',
    'as'=>'get-papers',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-raw-papers', [
    'uses'=>'App\Http\Controllers\PaperController@getRawPapers',
    'as'=>'get-raw-papers',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/paper-save', [
    'uses'=>'App\Http\Controllers\PaperController@store',
    'as'=>'paper-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/paper-update', [
    'uses'=>'App\Http\Controllers\PaperController@update',
    'as'=>'paper-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/paper-status-update', [
    'uses'=>'App\Http\Controllers\PaperController@statusUpdate',
    'as'=>'paper-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/paper-delete', [
    'uses'=>'App\Http\Controllers\PaperController@delete',
    'as'=>'paper-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/report-card', [
    'uses'=>'App\Http\Controllers\PaperController@reportCard',
    'as'=>'report-card',
    'middleware'=>['auth:sanctum', 'verified']
]);


