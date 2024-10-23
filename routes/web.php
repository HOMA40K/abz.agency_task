<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;



Route::get('/', function () {
    return view('index');
});

Route::get('/loginform', function () {
    return view('login');
});

Route::get('/getToken', function () {    
    $token = Cookie::get('auth_token');
    return response()->json(['token' => $token]);

});

Route::get('/registerform', function () {
    return view('register');
});

Route::get('/showusers', function () {
    return view('showusers');
});

Route::get('/upload', function () {
    return view('upload');
});


Route::get('/profile', function () {
    $jwtSecret = env('JWT_SECRET');
    $token = Cookie::get('auth_token');
       
    if ($token) {
        try {
            $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256') );
            $user = User::where('email', $decoded->userMail)->first();

            if ($user) {
                return view('profile', ['user' => $user]);
                // return response()->json(['user' => $user]);

            } else {
                return redirect('/loginform', 402);
            }
        } catch (Exception $e) {
            return redirect('/loginform', 403);
        }
    } else {
        return redirect('/loginform', 404);
    }

});

require __DIR__.'/auth.php';
