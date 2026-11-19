<?php

declare(strict_types=1);

use App\Http\Controllers\ArticleController;
use App\Seo\Seo;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()
    ->view('index')
    ->header('Link', '</llms.txt>; rel="describedby"; type="text/plain", </sitemap.xml>; rel="sitemap"; type="application/xml"'))
    ->name('homepage')
    ->withHead(
        title: 'Chris Mellor - Laravel & PHP contractor',
        description: 'Chris Mellor is a Laravel & PHP contractor, remote and available worldwide. I build features, rescue rushed apps and harden app security for teams.',
    );

Route::view('/cv', 'cv')
    ->name('cv')
    ->withHead(
        title: 'Chris Mellor - Laravel & PHP Contractor CV',
        description: "Chris Mellor's CV: full-stack Laravel and PHP developer working remotely, with Vue experience, shipping production software for product teams worldwide.",
    );

Route::view('/portfolio', 'portfolio')
    ->name('portfolio')
    ->withHead(
        title: 'Laravel & PHP Client Portfolio - Chris Mellor',
        description: 'Client projects Chris Mellor has built as a Laravel and PHP contractor, including PoweredByRental, App-Hive and 16Personalities, plus Kandu in development.',
    );

Route::view('/services', 'services.index')
    ->name('services')
    ->withHead(
        title: 'Laravel & PHP Development Services - Chris Mellor',
        description: 'Laravel and PHP services from Chris Mellor: contract development, rescuing rushed or AI-built apps, and a fixed-price security review. Remote, worldwide.',
    );

Route::view('/services/laravel-php-contractor', 'services.laravel-php-contractor')
    ->name('services.laravel-php-contractor')
    ->withHead(
        title: 'Remote Laravel Developer for Hire - Chris Mellor',
        description: 'Hire Chris Mellor as a remote Laravel and PHP contractor for features, fixes, integrations and releases. Spec first, every change reviewed. Available now.',
    );

Route::view('/services/app-rescue', 'services.app-rescue')
    ->name('services.app-rescue')
    ->withHead(
        title: 'App Rescue for Rushed and AI-Built Apps - Chris Mellor',
        description: "Built fast by a team in a hurry or with AI tools? I find what's exposed or slow, fix it, and can quote to keep the app hosted, backed up and patched.",
    );

Route::view('/app-security-review', 'app-security-review')
    ->name('app-security-review')
    ->withHead(
        title: 'Security Review for AI-Built Apps - Chris Mellor',
        description: 'A fixed-price security review for apps built fast, written up in 5 working days, plus a smaller PHP patch and upgrade check.',
    );

Route::view('/contact', 'contact')
    ->name('contact')
    ->withHead(
        title: 'Hire a Laravel & PHP Contractor - Chris Mellor',
        description: 'Get in touch with Chris Mellor about a Laravel or PHP contract project, a rescue job or an app security review. Available now, and I reply the same day.',
    );

Route::view('/privacy', 'privacy')
    ->name('privacy')
    ->withHead(
        title: 'Privacy Policy - Chris Mellor',
        description: 'How Mellor Code Ltd handles the personal data you send through the contact form on mellor.pizza, why, and your rights under UK GDPR.',
    );

Route::redirect('/about', '/cv', 301);
Route::redirect('/services/app-security-review', '/app-security-review', 301);

Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles')
    ->withHead(
        title: 'Laravel & PHP Articles - Chris Mellor',
        description: 'Practical notes from Chris Mellor on running, patching and upgrading Laravel and PHP apps in production.',
    );

Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

foreach ([
    '/replace-laravel-mix-with-vite',
    '/simplifying-my-blog-laravel-folio-sushi',
    '/build-a-chat-room-using-tall-stack-and-websockets',
    '/torchlight-code-highlighting-in-a-markdown-wysiwyg',
] as $gonePath) {
    Route::get($gonePath, fn () => abort(410));
}

Route::get('/sitemap.xml', fn () => response()->view('sitemap')->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/llms.txt', fn () => response(Seo::llmsTxt())->header('Content-Type', 'text/plain; charset=utf-8'))->name('llms');
