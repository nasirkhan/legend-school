<?php

Route::any('/partners', [
    'uses'=>'App\Http\Controllers\PartnerController@index',
    'as'=>'partners',
    'middleware'=>['auth:sanctum', 'verified']
]);

//Route::any('/partner-add', [
//    'uses'=>'App\Http\Controllers\PartnerController@create',
//    'as'=>'partner-add',
//    'middleware'=>['auth:sanctum', 'verified']
//]);

Route::any('/partner-save', [
    'uses'=>'App\Http\Controllers\PartnerController@store',
    'as'=>'partner-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/partner-edit/{id}', [
    'uses'=>'App\Http\Controllers\PartnerController@edit',
    'as'=>'partner-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/partner-update', [
    'uses'=>'App\Http\Controllers\PartnerController@update',
    'as'=>'partner-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/update-partner-status/{id}', [
    'uses'=>'App\Http\Controllers\PartnerController@statusUpdate',
    'as'=>'update-partner-status',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/partner-delete/{id}', [
    'uses'=>'App\Http\Controllers\PartnerController@delete',
    'as'=>'partner-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
