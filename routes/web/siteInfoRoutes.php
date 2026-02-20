<?php

Route::any('/site-info', [
    'uses'=>'App\Http\Controllers\SiteInfoController@index',
    'as'=>'site-info',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/site-info-edit', [
    'uses'=>'App\Http\Controllers\SiteInfoController@edit',
    'as'=>'site-info-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/site-info-update', [
    'uses'=>'App\Http\Controllers\SiteInfoController@update',
    'as'=>'site-info-update',
    'middleware'=>['auth:sanctum', 'verified']
]);
