<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('test', function (Request $request) {
//    return \App\Http\Responses\ApiResponse::success('Success Message', ['token' => 'token', 'user' => "user"]);
    return \App\Http\Responses\ApiResponse::error(
        'Internal Server Error', 500
    );
});
