<?php

Route::any('/unit-conversion', [
    'uses'=>'App\Http\Controllers\UnitConversionController@index',
    'as'=>'unit-conversion',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-conversion-save', [
    'uses'=>'App\Http\Controllers\UnitConversionController@store',
    'as'=>'unit-conversion-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-conversion-update', [
    'uses'=>'App\Http\Controllers\UnitConversionController@update',
    'as'=>'unit-conversion-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-conversion-status-update', [
    'uses'=>'App\Http\Controllers\UnitConversionController@statusUpdate',
    'as'=>'unit-conversion-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/unit-conversion-delete', [
    'uses'=>'App\Http\Controllers\UnitConversionController@delete',
    'as'=>'unit-conversion-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
