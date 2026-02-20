<?php

Route::any('/country', [
    'uses'=>'App\Http\Controllers\CountryController@index',
    'as'=>'country',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/country-save', [
    'uses'=>'App\Http\Controllers\CountryController@store',
    'as'=>'country-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/country-update', [
    'uses'=>'App\Http\Controllers\CountryController@update',
    'as'=>'country-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/country-status-update', [
    'uses'=>'App\Http\Controllers\CountryController@statusUpdate',
    'as'=>'country-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/country-delete', [
    'uses'=>'App\Http\Controllers\CountryController@delete',
    'as'=>'country-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
