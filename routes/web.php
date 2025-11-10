<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;

Route::resource('pages', PageController::class);

Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('welcome');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/home', function () {
        return view('home', ['title' => 'Home']);
    })->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});