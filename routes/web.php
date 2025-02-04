<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/sign-up', function () {
    return view('auth.sign-up');
});

Route::get('/log-in', function () {
    return view('auth.log-in');
});

Route::get('/u/{username}', function () {
    return view('profile');
});

Route::get('/m/{id}/{title}', function () {
    return view('movie');
});

Route::get('/review/{id}', function () {
    return view('review');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
