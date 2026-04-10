<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('genres/{genre}/books', [GenreController::class, 'books']);
Route::apiResource('genres', GenreController::class);
Route::apiResource('books', BookController::class);
