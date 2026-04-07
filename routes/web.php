<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController4;

Route::get('/', [MovieController4::class, 'index']);

Route::get('/movie/add', 'App\Http\Controllers\MovieController4@create')->name('movie.create');

Route::post('/movie/add', 'App\Http\Controllers\MovieController4@store')->name('movie.store');
