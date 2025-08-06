<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('welcome');

Route::get('/oauth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');
Route::get('/oauth/{provider}/callback', [SocialiteController::class, 'callback'])->name('google.callback');

Route::get('/login-success', function(){
    return Inertia::render('auth/login-success');
})->name('login.success');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
