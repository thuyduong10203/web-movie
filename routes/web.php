<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController1::class, 'index']);
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController1::class, 'index']);
