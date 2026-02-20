<?php

Route::any('/cash-book', [
    'uses'=>'App\Http\Controllers\CashBookController@cashBook',
    'as'=>'cash-book',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-cash-book', [
    'uses'=>'App\Http\Controllers\CashBookController@dateToDateCashBook',
    'as'=>'date-to-date-cash-book',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/profit-loss', [
    'uses'=>'App\Http\Controllers\CashBookController@profitLoss',
    'as'=>'profit-loss',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-profit-loss', [
    'uses'=>'App\Http\Controllers\CashBookController@dateToDateProfitLoss',
    'as'=>'date-to-date-profit-loss',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/balance-summary', [
    'uses'=>'App\Http\Controllers\CashBookController@balanceSummary',
    'as'=>'balance-summary',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-balance-summary', [
    'uses'=>'App\Http\Controllers\CashBookController@dateToDateBalanceSummary',
    'as'=>'date-to-date-balance-summary',
    'middleware'=>['auth:sanctum', 'verified']
]);
