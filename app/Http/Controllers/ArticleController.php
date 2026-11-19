<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Articles\Article;
use Illuminate\Contracts\View\View;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;

final class ArticleController
{
    public function index(): View
    {
        abort_if(Article::published()->isEmpty(), 410);

        return view('articles.index', ['articles' => Article::published()]);
    }

    public function show(string $slug): View
    {
        abort_if(Article::isRetired($slug), 410);

        $article = Article::find($slug) ?? abort(404);

        Head::title($article->title)
            ->description($article->description)
            ->og(type: OgType::Article, title: $article->title, description: $article->description, url: $article->url())
            ->meta('article:published_time', $article->publishedAt->toIso8601String(), property: true)
            ->meta('article:modified_time', $article->updatedAt->toIso8601String(), property: true);

        return view('articles.show', ['article' => $article]);
    }
}
