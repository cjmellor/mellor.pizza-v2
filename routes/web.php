<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('homepage');

Route::view('/cv', 'cv')->name('cv');

Route::view('/portfolio', 'portfolio')->name('portfolio');
