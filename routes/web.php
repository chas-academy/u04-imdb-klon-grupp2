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

Route::get('/u/{username}/lists', function () {
    return view('lists');
});

Route::get('/u/{username}/reviews', function () {
    return view('reviews');
});

Route::get('/m/{id}/{title}', function () {
    return view('movie');
});

Route::get('/m/{id}/{title}/reviews', function () {
    return view('reviews');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/review/{id}', function () {
    return view('review');
});

Route::get('/list/{id}', function () {
    return view('movie-list');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin/create-movie', function () {
    return view('create-movie');
});

Route::get('/admin/create-user', function () {
    return view('create-user');
});

Route::get('/admin/users', function () {
    return view('users');
});

Route::get('/admin/featured', function () {
    return view('featured-lists');
});

Route::get('/admin/reports/users', function () {
    return view('reported-users');
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
