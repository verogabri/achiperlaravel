<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpsController;
use App\Http\Controllers\Auth\Register;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [ChirpsController::class, 'index']);
Route::post('/chirps', [ChirpsController::class, 'store']);

Route::get('/chirps/{chirp}/edit', [ChirpsController::class, 'edit']);
Route::put('/chirps/{chirp}', [ChirpsController::class, 'update']);
Route::delete('/chirps/{chirp}', [ChirpsController::class, 'destroy']);


Route::get('/register', function () {
    return view('auth.register');
})
    ->middleware('guest')
    ->name('register');   

Route::post('/register', Register::class)
    ->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\Logout::class, '__invoke'])
    ->middleware('auth')
    ->name('logout');

Route::get('/login', function () {
    return view('auth.login');
})
    ->middleware('guest')
    ->name('login');    
Route::post('/login', [App\Http\Controllers\Auth\login::class, '__invoke'])
    ->middleware('guest');  

    