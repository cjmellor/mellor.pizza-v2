<?php

declare(strict_types=1);

return [

    'retired' => [
        'replace-laravel-mix-with-vite',
        'simplifying-my-blog-laravel-folio-sushi',
        'build-a-chat-room-using-tall-stack-and-websockets',
        'torchlight-code-highlighting-in-a-markdown-wysiwyg',
    ],

    'articles' => [
        'php-8-2-end-of-life-laravel' => [
            'title' => 'PHP 8.2 End of Life: What to Check on Your PHP Servers',
            'short_title' => 'PHP 8.2 end of life',
            'h1' => 'PHP 8.2 end of life and the November 2026 security release: what to check',
            'description' => 'PHP 8.2 security fixes end on 31 December 2026. What the 19 November PHP security release fixed, how to check your servers, and how to upgrade, with extra checks for Laravel.',
            'published_at' => '2026-11-19T14:20:00+00:00',
            'updated_at' => '2026-11-20T00:20:00+00:00',
            'published' => true,
        ],
        'php-8-6-laravel' => [
            'title' => 'PHP 8.6 for Laravel: should you upgrade yet?',
            'short_title' => 'PHP 8.6 for Laravel',
            'h1' => "PHP 8.6 for Laravel: what's new, and should you upgrade yet?",
            'description' => "PHP 8.6 is out. Here's what's useful in a Laravel app, what might break, and whether you should upgrade production yet. Laravel 13 still lists PHP 8.3 to 8.5.",
            'published_at' => '2026-11-20T00:20:00+00:00',
            'updated_at' => '2026-11-20T00:20:00+00:00',
            'published' => true,
            'faqs' => [
                [
                    'question' => 'Does Laravel 13 support PHP 8.6?',
                    'answer' => 'Not officially yet. When I checked on 20 November 2026, the [Laravel support table](https://laravel.com/docs/13.x/releases#support-policy) listed PHP 8.3 to 8.5 for Laravel 13. Laravel\'s Composer constraint allows 8.6, but that isn\'t the same as support.',
                ],
                [
                    'question' => 'Composer lets me install PHP 8.6. Is that enough?',
                    'answer' => 'No. Composer only checks version constraints. For production, wait until Laravel lists 8.6 for your version, `composer why-not php 8.6.0` lists no packages, and your tests pass on 8.6.',
                ],
                [
                    'question' => 'Should I skip 8.5 and go straight to 8.6?',
                    'answer' => 'Only if Laravel lists 8.6 and your packages and host are ready. If you need to leave PHP 8.2 now, move to 8.4 or 8.5, which Laravel 12 and 13 both list.',
                ],
            ],
            'cta' => "If you'd like a written view of what PHP your servers really run, and whether an upgrade is safe yet, I do a fixed-price [PHP patch and upgrade check](/app-security-review#php-patch-check). It's $295, written up within one working day. If you're still on PHP 8.2, the [PHP 8.2 end of life article](/articles/php-8-2-end-of-life-laravel) covers what to do first.",
        ],
    ],

];
