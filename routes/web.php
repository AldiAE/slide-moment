<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RowController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\FooterController;


Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

// 👇 ROUTE UNTUK GUEST (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('welcome');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// 👇 ROUTE UNTUK USER YANG SUDAH LOGIN
Route::middleware('auth:web')->group(function () {
    Route::get('/home', function () {
        return view('home', [
            'title' => 'Home',
            'menu_active' => 'home'
        ]);
    })->name('home');

    // CMS Routes
    Route::resource('pages', PageController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('rows', RowController::class);
    Route::resource('headers', App\Http\Controllers\HeaderController::class);
    Route::resource('footers', App\Http\Controllers\FooterController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
