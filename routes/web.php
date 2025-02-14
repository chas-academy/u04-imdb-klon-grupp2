<?php

use App\Http\Controllers\AdminController;
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
    Route::put('/ban/{id}', 'ban')->name('profile.ban');
});

Route::controller(ListController::class)->group(function () {
    Route::get('/u/{username}/lists', 'index')->name('lists');
    Route::get('/list/{id}', 'show')->name('list');
    Route::post('/list', 'store')->middleware(['auth'])->name('list.store');
    Route::delete('/list/{id}', 'destroy')->middleware(['auth'])->name('list.destroy');
    Route::put('/list/{listId}/{movieId}', 'addToList')->middleware(['auth'])->name('list.add-to-list');
    Route::post('/lists/{list}/add-movie', [ListController::class, 'addMovie'])->name('lists.add-movie');
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
    Route::post('/profile/{id}', 'store')->middleware(['auth'])->name('report.store.profile');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/create-movie', [AdminController::class, 'createMovieForm'])->name('admin.create.movie');
    Route::post('/create-movie', [AdminController::class, 'createMovie'])->name('admin.store.movie');
    Route::get('/edit-movie/{id}', [AdminController::class, 'editMovieForm'])->name('admin.edit.movie');
    Route::put('/edit-movie/{id}', [AdminController::class, 'editMovie'])->name('admin.save.movie');
    Route::get('/create-user', [AdminController::class, 'createUserForm'])->name('admin.create.user');
    Route::post('/create-user', [AdminController::class, 'createUser'])->name('admin.store.user');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/make-admin/{id}', [ProfileController::class, 'makeAdmin'])->name('admin.profile.make-admin');
    Route::delete('/m/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

    Route::controller(ReportController::class)->prefix('/reports')->group(function () {
        Route::get('/users', 'reportedUsers')->name('reported.users');
        Route::get('/reviews', 'reportedReviews')->name('reported.reviews');
        Route::get('/review/{id}', 'showReviewReport')->name('reported.review');
        Route::get('/users/{username}', 'showUserReports')->name('reported.user');
        Route::put('/clear/{username}/{id}', 'clearUserReport')->name('clear.user.report');
        Route::put('/clear/{id}', 'clearReviewReport')->name('clear.review.report');
        Route::delete('/delete/{id}', 'deleteReview')->name('delete.review');
    });
});

require __DIR__.'/auth.php';
