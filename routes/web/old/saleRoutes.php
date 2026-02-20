<?php

Route::any('/sale', [
    'uses'=>'App\Http\Controllers\SaleController@index',
    'as'=>'sale',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/stock-check', [
    'uses'=>'App\Http\Controllers\SaleController@stockCheck',
    'as'=>'stock-check',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/add-to-cart', [
    'uses'=>'App\Http\Controllers\SaleController@addToCart',
    'as'=>'add-to-cart',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/cart-collection', [
    'uses'=>'App\Http\Controllers\SaleController@cartCollection',
    'as'=>'cart-collection',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/cart-quantity-update', [
    'uses'=>'App\Http\Controllers\SaleController@cartQuantityUpdate',
    'as'=>'cart-quantity-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/cart-price-update', [
    'uses'=>'App\Http\Controllers\SaleController@cartPriceUpdate',
    'as'=>'cart-price-update',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/cart-item-delete', [
    'uses'=>'App\Http\Controllers\SaleController@cartItemDelete',
    'as'=>'cart-item-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sale-save', [
    'uses'=>'App\Http\Controllers\SaleController@store',
    'as'=>'sale-save',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/pending-order', [
    'uses'=>'App\Http\Controllers\SaleController@orders',
    'as'=>'pending-order',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/order-complete', [
    'uses'=>'App\Http\Controllers\SaleController@orderComplete',
    'as'=>'order-complete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/order-delete', [
    'uses'=>'App\Http\Controllers\SaleController@orderDelete',
    'as'=>'order-delete',
    'middleware'=>['auth:sanctum', 'verified']
]);

Route::any('/sale-update', [
    'uses'=>'App\Http\Controllers\SaleController@update',
    'as'=>'sale-update',
    'middleware'=>['auth:sanctum', 'verified']
]);
