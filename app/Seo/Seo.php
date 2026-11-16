<?php

declare(strict_types=1);

namespace App\Seo;

use App\Portfolio\Testimonial;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

final class Seo
{
    private const array EXCLUDED_ROUTES = ['sitemap', 'llms'];

    private const array SERVICE_ROUTES = ['services', 'services.laravel-php-contractor', 'services.app-rescue', 'app-security-review'];

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
                && $route->getMetadata('head', []) !== []
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
            '@id' => self::url(route($routeName, absolute: false)).'#service',
            'name' => $name,
            'description' => $description,
            'url' => self::url(route($routeName, absolute: false)),
            'provider' => ['@id' => self::url().'#organization'],
            'areaServed' => 'Worldwide',
            ...($offer ? ['offers' => ['@type' => 'Offer', ...$offer]] : []),
        ];
    }

    /**
     * @param  list<array{question: string, answer: string}>  $faqs
     * @return array<string, mixed>
     */
    public static function faqPage(array $faqs): array
    {
        return [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function review(Testimonial $testimonial): array
    {
        return [
            '@type' => 'Review',
            'reviewBody' => $testimonial->quote,
            'itemReviewed' => ['@id' => self::url().'#organization'],
            'author' => [
                '@type' => 'Person',
                'name' => $testimonial->name,
                ...($testimonial->role ? ['jobTitle' => $testimonial->role] : []),
                'worksFor' => ['@type' => 'Organization', 'name' => $testimonial->company],
            ],
        ];
    }

    /**
     * @param  array<string, string>  $trail  route name => label
     * @return array<string, mixed>
     */
    public static function breadcrumbs(array $trail): array
    {
        $position = 0;

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($trail)
                ->map(fn (string $label, string $routeName): array => [
                    '@type' => 'ListItem',
                    'position' => ++$position,
                    'name' => $label,
                    'item' => self::url(route($routeName, absolute: false)),
                ])
                ->values()
                ->all(),
        ];
    }

    public static function llmsTxt(): string
    {
        $entry = function (string $name): string {
            $page = self::page($name);
            $url = self::url(route($name, absolute: false));

            return "- [{$page['title']}]({$url}): {$page['description']}";
        };

        $names = self::publicRouteNames();
        $pages = $names->reject(fn (string $name): bool => in_array($name, self::SERVICE_ROUTES, true))->map($entry)->implode("\n");
        $services = collect(self::SERVICE_ROUTES)->intersect($names)->map($entry)->implode("\n");

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
            '## Services',
            '',
            $services,
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
