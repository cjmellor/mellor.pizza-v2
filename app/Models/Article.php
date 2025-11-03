<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Sushi\Sushi;
use Torchlight\Commonmark\V2\TorchlightExtension;

class Article extends Model
{
    use Sushi;

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected array $rows = [
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/torchlight-code-highlighting-in-a-markdown-wysiwyg.md',
            'excerpt' => 'A tutorial on implementing Torchlight, a powerful code highlighting service, within a Markdown WYSIWYG editor using the CommonMark PHP client. The guide demonstrates how to set up syntax highlighting, customize themes, and use advanced features like line focusing and code differentiation to enhance code presentation in web content.',
            'published_at' => '2021-12-14',
            'slug' => 'torchlight-code-highlighting-in-a-markdown-wysiwyg',
            'title' => 'Torchlight: Code Highlighting in a Markdown WYSIWYG',
            'visibility' => 'public'
        ],
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/query-scopes-an-undocumented-feature.md',
            'excerpt' => 'An exploration of a lesser-known feature in Laravel\'s Query Scopes that allows developers to extend query builder functionality within scope classes. The article reveals how to organize and bundle related query scopes together using macros, providing a cleaner and more maintainable approach to handling complex database queries.',
            'published_at' => '2022-06-25',
            'slug' => 'query-scopes-an-undocumented-feature',
            'title' => 'Query Scopes: An Undocumented Feature',
            'visibility' => 'public'
        ],
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/replace-laravel-mix-with-vite.md',
            'excerpt' => 'A practical walkthrough for upgrading existing Laravel applications from Mix to Vite, Laravel\'s new front-end asset bundling tool. The guide covers the complete migration process, including removing Mix, configuring Vite, updating dependencies, and implementing hot module reloading, helping developers modernize their Laravel applications with faster build times.',
            'published_at' => '2022-06-29',
            'slug' => 'replace-laravel-mix-with-vite',
            'title' => 'Replace Laravel Mix with Vite',
            'visibility' => 'public'
        ],
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/build-a-chat-room-using-tall-stack-and-websockets.md',
            'excerpt' => 'A comprehensive guide to building a real-time chat application using the TALL stack (Tailwind, Alpine.js, Laravel, and Livewire) with WebSocket integration through Pusher. The tutorial covers everything from setting up the database and models to implementing real-time features like message broadcasting and typing indicators, perfect for developers looking to add live chat functionality to their applications.',
            'published_at' => '2023-01-15',
            'slug' => 'build-a-chat-room-using-tall-stack-and-websockets',
            'title' => 'Build a Chat Room using TALL Stack and WebSockets',
            'visibility' => 'public'
        ],
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/simplifying-my-blog-laravel-folio-sushi.md',
            'excerpt' => 'Learn how I simplified my blog by moving from a traditional MySQL database to a static-content approach using Laravel\'s Sushi package. Through this process I discovered how to maintain Eloquent\'s powerful features without the overhead of a full database. The changes not only made my site snappier but also simplified the content management process.',
            'published_at' => '2024-12-19',
            'slug' => 'simplifying-my-blog-laravel-folio-sushi',
            'title' => 'Simplifying My Blog: Laravel Folio & Sushi',
            'visibility' => 'public'
        ],
    ];

    public function content(): string
    {
        $environment = new Environment(['html_input' => 'strip']);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new TorchlightExtension);

        $converter = new MarkdownConverter($environment);

        return $converter->convert(file_get_contents(resource_path($this->content)));
    }
}
