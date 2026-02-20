<?php

Route::any('/eca-types', [
    'uses'=>'App\Http\Controllers\ECATypeController@index',
    'as'=>'eca-types',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-type-save', [
    'uses'=>'App\Http\Controllers\ECATypeController@store',
    'as'=>'eca-type-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-type-update', [
    'uses'=>'App\Http\Controllers\ECATypeController@update',
    'as'=>'eca-type-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-type-status-update', [
    'uses'=>'App\Http\Controllers\ECATypeController@statusUpdate',
    'as'=>'eca-type-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/eca-type-delete', [
    'uses'=>'App\Http\Controllers\ECATypeController@delete',
    'as'=>'eca-type-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
