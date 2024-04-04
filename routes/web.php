<?php

use App\Http\Middleware\ReverseUserAuthCheck;
use App\Http\Middleware\UserAuthCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->middleware(ReverseUserAuthCheck::class);

Route::post('/register', [UserController::class, 'create'])->middleware(ReverseUserAuthCheck::class);

Route::get('/login', function () {
    return view('login');
})->middleware(ReverseUserAuthCheck::class);

Route::post('/login', [UserController::class, 'authenticate'])->middleware(ReverseUserAuthCheck::class);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(UserAuthCheck::class);
