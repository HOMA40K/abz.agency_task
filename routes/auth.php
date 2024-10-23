<?php

use App\Http\Controllers\Auth\MyAuthController;
use Illuminate\Support\Facades\Route;



Route::post('/register', [MyAuthController::class, 'register']) -> name('register');

Route::post('/login', [MyAuthController::class, 'login']) -> name('login');

Route::post('/logout', [MyAuthController::class, 'logout'] ) -> name('logout');