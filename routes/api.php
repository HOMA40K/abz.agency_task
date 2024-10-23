<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/dropUsers', [UsersController::class, 'dropUsers']) -> name('dropUsers');

Route::get('/users', [UsersController::class, 'getUsers']) -> name('getUsers');

Route::get('/generateUsers/{count}', [UsersController::class, 'generateUsers']) -> name('generateUsers');

Route::get('/users', [UsersController::class, 'getUsers']) -> name('getUsers');

Route::post('/uploadPicture', [ImageController::class, 'upload']) -> name('uploadPicture');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
