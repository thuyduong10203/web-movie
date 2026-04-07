<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

// ==================== ADMIN ====================
Route::prefix('admin')->name('admin.')->group(function () {
     Route::get('/movies', [App\Http\Controllers\AdminMovieController::class, 'index'])
          ->name('movies.index');

     Route::get('/movies/create', [App\Http\Controllers\AdminMovieController::class, 'create'])
          ->name('movies.create');


     Route::delete('/movies/{id}', [App\Http\Controllers\AdminMovieController::class, 'destroy'])
          ->name('movies.destroy');
});