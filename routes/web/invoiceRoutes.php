<?php

Route::any('/fees-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@feesForm',
    'as'=>'fees-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-fees', [
    'uses'=>'App\Http\Controllers\InvoiceController@getFees',
    'as'=>'get-fees',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice-creation-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@invoiceCreationForm',
    'as'=>'invoice-creation-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice-creation-for-student', [
    'uses'=>'App\Http\Controllers\InvoiceController@invoiceCreationForStudent',
    'as'=>'invoice-creation-for-student',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/create-student-invoice', [
    'uses'=>'App\Http\Controllers\InvoiceController@createStudentInvoice',
    'as'=>'create-student-invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-students-for-creating-invoice', [
    'uses'=>'App\Http\Controllers\InvoiceController@getStudentsForCreatingInvoice',
    'as'=>'get-students-for-creating-invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/create-class-wise-invoice', [
    'uses'=>'App\Http\Controllers\InvoiceController@createClassWiseInvoice',
    'as'=>'create-class-wise-invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/invoice-check-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@invoiceCheckForm',
    'as'=>'invoice-check-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-invoice-check', [
    'uses'=>'App\Http\Controllers\InvoiceController@classWiseInvoiceCheck',
    'as'=>'class-wise-invoice-check',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoice',
    'as'=>'student-invoice',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceNew',
    'as'=>'student-invoice-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

//Student Invoice From Student Profile
Route::any('/student-new-invoice', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceNew',
    'as'=>'student-new-invoice',
]);

Route::any('/student-invoice-delete-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceDeleteNew',
    'as'=>'student-invoice-delete-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice-edit-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceEditNew',
    'as'=>'student-invoice-edit-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice-edit', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceEdit',
    'as'=>'student-invoice-edit',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice-update', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceUpdate',
    'as'=>'student-invoice-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-invoice-delete', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentInvoiceDelete',
    'as'=>'student-invoice-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-collection-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@paymentCollectionForm',
    'as'=>'payment-collection-form',
    'middleware'=>['auth:sanctum', 'verified']
]);


Route::any('/add-to-payment', [
    'uses'=>'App\Http\Controllers\InvoiceController@addToPayment',
    'as'=>'add-to-payment',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-collection-form-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@paymentCollectionFormNew',
    'as'=>'payment-collection-form-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/collect-payment', [
    'uses'=>'App\Http\Controllers\InvoiceController@collectPayment',
    'as'=>'collect-payment',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/check-payment', [
    'uses'=>'App\Http\Controllers\InvoiceController@checkPayment',
    'as'=>'check-payment',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/collect-payment-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@collectPaymentNew',
    'as'=>'collect-payment-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-collection-report', [
    'uses'=>'App\Http\Controllers\InvoiceController@paymentCollectionReportForm',
    'as'=>'payment-collection-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/payment-collection-report-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@paymentCollectionReportFormNew',
    'as'=>'payment-collection-report-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-payment-report', [
    'uses'=>'App\Http\Controllers\InvoiceController@getPaymentReport',
    'as'=>'get-payment-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-payment-report-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@getPaymentReportNew',
    'as'=>'get-payment-report-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-due-report-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@classWisePaymentReportForm',
    'as'=>'class-wise-payment-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/class-wise-due-report', [
    'uses'=>'App\Http\Controllers\InvoiceController@classWiseDueReport',
    'as'=>'class-wise-due-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-report-form', [
    'uses'=>'App\Http\Controllers\InvoiceController@dueReportForm',
    'as'=>'due-report-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-report-form-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@dueReportFormNew',
    'as'=>'due-report-form-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-due-report', [
    'uses'=>'App\Http\Controllers\InvoiceController@getDueReport',
    'as'=>'get-due-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-due-report-new', [
    'uses'=>'App\Http\Controllers\InvoiceController@getDueReportNew',
    'as'=>'get-due-report-new',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/student-payment-report', [
    'uses'=>'App\Http\Controllers\InvoiceController@studentPaymentReport',
    'as'=>'student-payment-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/get-payment-item', [
    'uses'=>'App\Http\Controllers\InvoiceController@getPaymentItem',
    'as'=>'get-payment-item',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/item-wise-payment-report', [   //not done yet
    'uses'=>'App\Http\Controllers\InvoiceController@itemWisePaymentReport',
    'as'=>'item-wise-payment-report',
    'middleware'=>['auth:sanctum', 'verified']
]);

//Special Route
Route::any('/student-payment-item-due-date-update-form', [   //not done yet
    'uses'=>'App\Http\Controllers\InvoiceController@studentPaymentItemDueDateUpdateForm',
    'as'=>'student-payment-item-due-date-update-form',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/due-date-add', [   //not done yet
    'uses'=>'App\Http\Controllers\InvoiceController@dueDateAdd',
    'as'=>'due-date-add',
    'middleware'=>['auth:sanctum', 'verified']
]);
