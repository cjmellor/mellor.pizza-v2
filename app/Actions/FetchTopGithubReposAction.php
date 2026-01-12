<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchTopGithubReposAction
{
    public function handle(int $limit = 5): array
    {
        return collect(value: Cache::remember(key: 'github.top_repos', ttl: now()->addDay(), callback: function (): mixed {
            return Http::withHeaders(headers: [
                'Accept' => 'application/vnd.github+json',
            ])->get(url: 'https://api.github.com/users/cjmellor/repos', query: [
                'sort' => 'pushed',
                'direction' => 'desc',
                'per_page' => 100,
            ])->throw()->json() ?? [];
        }))->sortByDesc('stargazers_count')->take($limit)
            ->map(fn (array $repo): array => [
                'name' => $repo['name'] ?? null,
                'html_url' => $repo['html_url'] ?? null,
                'stargazers_count' => $repo['stargazers_count'] ?? 0,
            ])->all();
    }
}
