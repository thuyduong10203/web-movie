<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController4;
use App\Http\Controllers\MovieController1;
use App\Http\Controllers\MovieController2;
use App\Http\Controllers\AdminMovieController;

// ==================== FRONTEND ====================
Route::get('/', [MovieController4::class, 'index'])->name('home');

Route::get('/movie/add', [MovieController4::class, 'create'])->name('movie.create');
Route::post('/movie/add', [MovieController4::class, 'store'])->name('movie.store');

Route::get('/theloai/{id}', [MovieController1::class, 'index'])->name('genre.filter');
Route::post('/timkiem', [MovieController1::class, 'search'])->name('search');

// THÊM DÒNG NÀY - route chi tiết phim
Route::get('/movie/{id}', [MovieController2::class, 'chitiet'])->name('movie.chitiet');

// ==================== ADMIN ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('index');
    Route::get('/movie/create', [AdminMovieController::class, 'create'])->name('movie.create');
    Route::post('/movies', [AdminMovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}', [AdminMovieController::class, 'show'])->name('movies.show');  // THÊM DÒNG NÀY
    Route::delete('/movies/{id}', [AdminMovieController::class, 'destroy'])->name('movies.destroy');
});