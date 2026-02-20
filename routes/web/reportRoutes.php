<?php

Route::any('/report-form/{from}/{type}', [
    'uses'=>'App\Http\Controllers\ReportController@index',
    'as'=>'report-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/report', [
    'uses'=>'App\Http\Controllers\ReportController@report',
    'as'=>'report',
    'middleware'=>['auth:sanctum', 'verified']
]);

