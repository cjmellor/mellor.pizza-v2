<?php

declare(strict_types=1);

use App\Seo\Seo;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('homepage');

Route::view('/cv', 'cv')->name('cv');

Route::view('/portfolio', 'portfolio')->name('portfolio');

Route::view('/app-security-review', 'app-security-review')->name('app-security-review');

Route::view('/contact', 'contact')->name('contact');

Route::get('/sitemap.xml', fn () => response()->view('sitemap')->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/llms.txt', fn () => response(Seo::llmsTxt())->header('Content-Type', 'text/plain; charset=utf-8'))->name('llms');
