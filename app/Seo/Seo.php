<?php

declare(strict_types=1);

namespace App\Seo;

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

final class Seo
{
    private const array EXCLUDED_ROUTES = ['sitemap', 'llms'];

    /**
     * @return array{title: string, description: string}
     */
    public static function page(?string $routeName = null): array
    {
        $route = Route::getRoutes()->getByName($routeName ?? Route::currentRouteName() ?? 'homepage')
            ?? Route::getRoutes()->getByName('homepage');

        return array_merge(...array_values($route->getMetadata('head', [])));
    }

    public static function url(string $path = '/'): string
    {
        $root = mb_rtrim((string) config('app.url'), '/');
        $path = mb_trim($path, '/');

        return $path === '' ? $root : "{$root}/{$path}";
    }

    public static function canonical(): string
    {
        return self::url(request()->path());
    }

    /**
     * @return Collection<int, string>
     */
    public static function publicRouteNames(): Collection
    {
        return collect(Route::getRoutes()->getRoutes())
            ->filter(fn (RoutingRoute $route): bool => in_array('GET', $route->methods(), true)
                && $route->getName() !== null
                && $route->parameterNames() === []
                && in_array('web', $route->gatherMiddleware(), true)
                && ! in_array($route->getName(), self::EXCLUDED_ROUTES, true))
            ->map(fn (RoutingRoute $route): string => $route->getName())
            ->values();
    }

    /**
     * @param  list<array<string, mixed>>  $pageNodes
     */
    public static function jsonLd(array $pageNodes = []): string
    {
        $graph = [
            ['@type' => 'Person', '@id' => self::url().'#person', ...self::person()],
            ['@type' => 'Organization', '@id' => self::url().'#organization', ...self::organization()],
            ...$pageNodes,
        ];

        return json_encode(
            ['@context' => 'https://schema.org', '@graph' => $graph],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR | JSON_HEX_TAG,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => self::url().'#website',
            'name' => config('seo.site_name'),
            'url' => self::url(),
            'publisher' => ['@id' => self::url().'#person'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function webPage(string $type, string $routeName): array
    {
        $page = self::page($routeName);

        return [
            '@type' => $type,
            '@id' => self::url(route($routeName, absolute: false)).'#webpage',
            'url' => self::url(route($routeName, absolute: false)),
            'name' => $page['title'],
            'description' => $page['description'],
            'isPartOf' => ['@id' => self::url().'#website'],
            ...($type === 'ProfilePage' ? ['mainEntity' => ['@id' => self::url().'#person']] : []),
        ];
    }

    /**
     * @param  array<string, mixed>|null  $offer
     * @return array<string, mixed>
     */
    public static function service(string $name, string $description, string $routeName, ?array $offer = null): array
    {
        return [
            '@type' => 'Service',
            'name' => $name,
            'description' => $description,
            'url' => self::url(route($routeName, absolute: false)),
            'provider' => ['@id' => self::url().'#organization'],
            'areaServed' => 'Worldwide',
            ...($offer ? ['offers' => ['@type' => 'Offer', ...$offer]] : []),
        ];
    }

    public static function llmsTxt(): string
    {
        $pages = self::publicRouteNames()
            ->map(function (string $name): string {
                $page = self::page($name);
                $url = self::url(route($name, absolute: false));

                return "- [{$page['title']}]({$url}): {$page['description']}";
            })
            ->implode("\n");

        $organization = config('seo.organization');

        return implode("\n", [
            '# '.config('seo.site_name'),
            '',
            '> '.config('seo.summary'),
            '',
            '## Main pages',
            '',
            $pages,
            '',
            '## Key facts',
            '',
            "- Works remotely with clients worldwide, through {$organization['name']} (company no. {$organization['company_number']}, registered in England and Wales).",
            '- Main stack: Laravel, PHP, Livewire and Vue.',
            '- Contact: '.config('seo.person.email'),
            '',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private static function person(): array
    {
        $person = config('seo.person');

        return [
            'name' => $person['name'],
            'url' => self::url(),
            'image' => self::url($person['image']),
            'jobTitle' => $person['job_title'],
            'email' => "mailto:{$person['email']}",
            'worksFor' => ['@id' => self::url().'#organization'],
            'knowsAbout' => $person['knows_about'],
            'sameAs' => $person['same_as'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function organization(): array
    {
        $organization = config('seo.organization');

        return [
            'name' => $organization['name'],
            'legalName' => $organization['name'],
            'url' => self::url(),
            'founder' => ['@id' => self::url().'#person'],
            'identifier' => [
                '@type' => 'PropertyValue',
                'propertyID' => 'Companies House company number',
                'value' => $organization['company_number'],
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'sales',
                'email' => config('seo.person.email'),
                'url' => self::url(route('contact', absolute: false)),
            ],
        ];
    }
}
