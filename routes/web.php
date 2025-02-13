<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(MovieController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/m/{id}/{title}', 'show')->name('movie');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/u/{username}', 'show')->name('profile');
});

Route::controller(ListController::class)->group(function () {
    Route::get('/u/{username}/lists', 'index')->name('lists');
    Route::get('/list/{id}', 'show')->name('list');
    Route::post('/list', 'store')->middleware(['auth'])->name('list.store');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('/u/{username}/reviews', 'index')->name('reviews.user');
    Route::get('/m/{id}/{title}/reviews', 'index')->name('reviews.movie');
    Route::get('/review/{id}', 'show')->name('review');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/create-movie', [AdminController::class, 'createMovieForm'])->name('admin.create.movie');
    Route::post('/create-movie', [AdminController::class, 'createMovie'])->name('admin.store.movie');
    Route::get('/create-user', [AdminController::class, 'createUserForm'])->name('admin.create.user');
    Route::post('/create-user', [AdminController::class, 'createUser'])->name('admin.store.user');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/featured', fn() => view('admin.featured-lists'))->name('admin.featured');

    Route::controller(ReviewController::class)->prefix('/reports')->group(function () {
        Route::get('/users', 'index')->name('reports.user');
        Route::get('/reviews', 'index')->name('reports.review');
        Route::get('/review/{id}', 'showReport')->name('reports.show');
    });
});

require __DIR__ . '/auth.php';
