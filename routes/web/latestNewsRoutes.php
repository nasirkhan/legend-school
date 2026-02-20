<?php

Route::any('/latest-news', [
    'uses'=>'App\Http\Controllers\LatestNewsController@index',
    'as'=>'latest-news',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/latest-news-add-form', [
    'uses'=>'App\Http\Controllers\LatestNewsController@create',
    'as'=>'latest-news-add-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/latest-news-save', [
    'uses'=>'App\Http\Controllers\LatestNewsController@store',
    'as'=>'latest-news-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/latest-news-edit/{id}', [
    'uses'=>'App\Http\Controllers\LatestNewsController@edit',
    'as'=>'latest-news-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/latest-news-update', [
    'uses'=>'App\Http\Controllers\LatestNewsController@update',
    'as'=>'latest-news-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-latest-news-status/{id}', [
    'uses'=>'App\Http\Controllers\LatestNewsController@statusUpdate',
    'as'=>'update-latest-news-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/latest-news-delete/{id}', [
    'uses'=>'App\Http\Controllers\LatestNewsController@delete',
    'as'=>'latest-news-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
