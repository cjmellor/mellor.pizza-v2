<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Article extends Model
{
    use Sushi;

    protected array $rows = [
        [
            'author' => 'Chris Mellor',
            'published_at' => '2021-12-14',
            'slug' => 'torchlight-code-highlighting-in-a-markdown-wysiwyg',
            'title' => 'Torchlight: Code Highlighting in a Markdown WYSIWYG',
            'excerpt' => 'Learn how to enable and use Torchlight for highlighting code on your pages',
        ],
    ];
}
