<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    logger("hi");
});


Route::get('/test', function () {
    return 'Docker Env Setup Success';
});
