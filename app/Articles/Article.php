<?php

declare(strict_types=1);

namespace App\Articles;

use App\Seo\Seo;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final readonly class Article
{
    /**
     * @param  list<array{question: string, answer: string}>  $faqs
     */
    public function __construct(
        public string $slug,
        public string $title,
        public string $shortTitle,
        public string $h1,
        public string $description,
        public CarbonImmutable $publishedAt,
        public CarbonImmutable $updatedAt,
        public bool $published,
        public array $faqs = [],
        public ?string $cta = null,
    ) {}

    /**
     * @return Collection<int, self>
     */
    public static function published(): Collection
    {
        return collect(config('articles.articles'))
            ->map(fn (array $article, string $slug): self => new self(
                slug: $slug,
                title: $article['title'],
                shortTitle: $article['short_title'],
                h1: $article['h1'],
                description: $article['description'],
                publishedAt: CarbonImmutable::parse($article['published_at']),
                updatedAt: CarbonImmutable::parse($article['updated_at']),
                published: $article['published'],
                faqs: $article['faqs'] ?? [],
                cta: $article['cta'] ?? null,
            ))
            ->filter(fn (self $article): bool => $article->published)
            ->sortByDesc(fn (self $article): int => $article->publishedAt->getTimestamp())
            ->values();
    }

    public static function find(string $slug): ?self
    {
        return self::published()->firstWhere('slug', $slug);
    }

    public static function isRetired(string $slug): bool
    {
        return in_array($slug, config('articles.retired'), true);
    }

    public function url(): string
    {
        return Seo::url(route('articles.show', $this->slug, absolute: false));
    }

    public function wasUpdated(): bool
    {
        return $this->updatedAt->greaterThan($this->publishedAt);
    }

    public function body(): HtmlString
    {
        return new HtmlString(Str::markdown(file_get_contents(resource_path("articles/{$this->slug}.md"))));
    }
}
