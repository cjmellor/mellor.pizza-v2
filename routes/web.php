<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('homepage');

Route::get('/articles', ArticleController::class)->name('articles');

Route::view('/cv', 'cv')->name('cv');
