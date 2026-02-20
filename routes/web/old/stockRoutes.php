<?php

Route::any('/stock', [
    'uses'=>'App\Http\Controllers\StockController@index',
    'as'=>'stock',
    'middleware'=>['auth:sanctum', 'verified']
]);
