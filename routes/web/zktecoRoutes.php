<?php
//use Illuminate\Http\Request;

Route::any('/iclock/cdata',[
    'uses'=>'App\Http\Controllers\ZktecoController@index',
    'as'=>'zkteco'
]);

Route::any('/att-test',[
    'uses'=>'App\Http\Controllers\ZktecoController@test',
    'as'=>'att-test'
]);

Route::any('/sms-balance',[
    'uses'=>'App\Http\Controllers\ZktecoController@get_balance',
    'as'=>'sms-balance'
]);

//Route::any('/iclock/cdata',[
//    'uses'=>'App\Http\Controllers\DeviceController@receivePunch',
//    'as'=>'zkteco'
//]);

//Route::any('/iclock/cdata',function (Request $request){
//    \Log::info('ZKTeco PUSH', $request->all());
//    return response('OK');
//});

//use App\Http\Controllers\ZKTecoController;
//
//Route::any('/iclock/cdata', [ZktecoController::class, 'handleCData']);
//Route::any('/iclock/devicecmd', [ZktecoController::class, 'handleDeviceCmd']);
//Route::any('/iclock/getrequest', [ZktecoController::class, 'handleGetRequest']);

