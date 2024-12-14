<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

// Route::view('/', 'index');
Route::view('/', 'index2');
Route::get('/search', [SearchController::class, 'search',]);