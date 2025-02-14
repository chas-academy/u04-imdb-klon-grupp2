<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
    Route::delete('/list/{id}', 'destroy')->middleware(['auth'])->name('list.destroy');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('/u/{username}/reviews', 'index')->name('reviews.user');
    Route::get('/m/{id}/{title}/reviews', 'index')->name('reviews.movie');
    Route::get('/review/{id}', 'show')->name('review');
    Route::post('/m/{id}/{title}', 'store')->middleware(['auth'])->name('review.store');
    Route::delete('/review/{id}', 'destroy')->middleware(['auth'])->name('review.destroy');
    Route::put('/review/{id}', 'update')->middleware(['auth'])->name('review.update');
});

Route::controller(ReportController::class)->group(function () {
    Route::post('/review/{id}', 'store')->middleware(['auth'])->name('report.store.review');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('/admin')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/create-movie', [MovieController::class, 'create'])->name('admin.create.movie');
    Route::get('/create-user', fn () => view('admin.create-user'))->name('admin.create.user');
    Route::get('/users', fn () => view('admin.users'))->name('admin.users');
    Route::get('/featured', fn () => view('admin.featured-lists'))->name('admin.featured');

    Route::controller(ReviewController::class)->prefix('/reports')->group(function () {
        Route::get('/users', 'index')->name('reports.user');
        Route::get('/reviews', 'index')->name('reports.review');
    });
});

require __DIR__.'/auth.php';
