<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


// Privacy and policy --------------------------
// --------------------------------------------- 
Route::get('/privacy-policy', function (){
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');


// Terms and conditions --------------------------
// ----------------------------------------------
Route::get('/terms-of-service', function (){
    return Inertia::render('TermsOfService');
})->name('terms-of-service');
