<?php

// login, logout, register, password/reset
Auth::routes();

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
