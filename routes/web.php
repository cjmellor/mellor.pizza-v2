<?php

use App\Http\Controllers\BlogIndexController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('homepage');

Route::get('/blog', BlogIndexController::class)->name('blog');

Route::view('/cv', 'cv')->name('cv');
