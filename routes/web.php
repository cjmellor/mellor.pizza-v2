<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('homepage');

Route::view('/cv', 'cv')->name('cv');
