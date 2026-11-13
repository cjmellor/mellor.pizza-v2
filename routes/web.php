<?php

declare(strict_types=1);

use App\Seo\Seo;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()
    ->view('index')
    ->header('Link', '</llms.txt>; rel="describedby"; type="text/plain", </sitemap.xml>; rel="sitemap"; type="application/xml"'))
    ->name('homepage');

Route::view('/cv', 'cv')->name('cv');

Route::view('/portfolio', 'portfolio')->name('portfolio');

Route::view('/app-security-review', 'app-security-review')->name('app-security-review');

Route::view('/contact', 'contact')->name('contact');

Route::get('/sitemap.xml', fn () => response()->view('sitemap')->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/llms.txt', fn () => response(Seo::llmsTxt())->header('Content-Type', 'text/plain; charset=utf-8'))->name('llms');
