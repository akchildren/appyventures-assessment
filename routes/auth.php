<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterUserController::class)
                ->middleware('guest')
                ->name('register');

Route::post('/login', LoginController::class)
                ->middleware('guest')
                ->name('login');
