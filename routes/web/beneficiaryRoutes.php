<?php

Route::any('/accounts', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@index',
    'as'=>'beneficiaries',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-accounts', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@getBeneficiaries',
    'as'=>'get-beneficiaries',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/account-save', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@store',
    'as'=>'beneficiary-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/account-update', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@update',
    'as'=>'beneficiary-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/account-status-update', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@statusUpdate',
    'as'=>'beneficiary-status-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/account-delete', [
    'uses'=>'App\Http\Controllers\BeneficiaryController@delete',
    'as'=>'beneficiary-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);
