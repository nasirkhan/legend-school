<?php

Route::any('/cash-sale-report', [
    'uses'=>'App\Http\Controllers\ReportController@cashSaleReport',
    'as'=>'cash-sale-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-cash-sale-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDateCashSaleReport',
    'as'=>'date-to-date-cash-sale-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/credit-sale-report', [
    'uses'=>'App\Http\Controllers\ReportController@creditSaleReport',
    'as'=>'credit-sale-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-credit-sale-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDateCreditSaleReport',
    'as'=>'date-to-date-credit-sale-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/other-income-report', [
    'uses'=>'App\Http\Controllers\ReportController@otherIncomeReport',
    'as'=>'other-income-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-other-income-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDateOtherIncomeReport',
    'as'=>'date-to-date-other-income-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/purchase-report', [
    'uses'=>'App\Http\Controllers\ReportController@purchaseReport',
    'as'=>'purchase-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-purchase-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDatePurchaseReport',
    'as'=>'date-to-date-purchase-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/other-expense-report', [
    'uses'=>'App\Http\Controllers\ReportController@otherExpenseReport',
    'as'=>'other-expense-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-other-expense-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDateOtherExpenseReport',
    'as'=>'date-to-date-other-expense-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/transport-and-labour-cost-report', [
    'uses'=>'App\Http\Controllers\ReportController@transportAndLabourCostReport',
    'as'=>'transport-and-labour-cost-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/date-to-date-transport-and-labour-cost-report', [
    'uses'=>'App\Http\Controllers\ReportController@dateToDateTransportAndLabourCostReport',
    'as'=>'date-to-date-transport-and-labour-cost-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-report', [
    'uses'=>'App\Http\Controllers\ReportController@bankLoanReport',
    'as'=>'bank-loan-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/bank-loan-report-detail', [
    'uses'=>'App\Http\Controllers\ReportController@bankLoanReportDetail',
    'as'=>'bank-loan-report-detail',
    'middleware'=>['auth:sanctum', 'verified']
]);
