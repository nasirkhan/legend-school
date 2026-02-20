<?php

Route::any('/', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@index',
    'as'=>'/'
]);

Route::any('/principal-speech', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@principalSpeech',
    'as'=>'principal-speech'
]);

Route::any('/mission-vision', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@missionVision',
    'as'=>'mission-vision'
]);

Route::any('/page/{id}', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@page',
    'as'=>'page'
]);

Route::any('/popular-facility/{id}', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@popularECA',
    'as'=>'popular-eca'
]);

Route::any('/our-popular-facilities', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@allPopularECA',
    'as'=>'all-popular-ecas'
]);

Route::any('/blog/{id}', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@blog',
    'as'=>'latest-blog'
]);

Route::any('/blogs', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@blogs',
    'as'=>'all-blogs'
]);

Route::any('/sub-page/{id}', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@subPage',
    'as'=>'sub-page'
]);

Route::any('/photo-gallery', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@photoGallery',
    'as'=>'photo-gallery'
]);

Route::any('/contact-us', [
    'uses'=>'App\Http\Controllers\Front\FrontEndController@contactUs',
    'as'=>'contact-us'
]);
