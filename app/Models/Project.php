<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Project extends Model
{
    use Sushi;

    private const string LOGO_STORAGE_PATH = 'storage/portfolio_logos/';

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected array $rows = [
        [
            'name' => 'Keis One',
            'description' => 'A brand website for YouTuber and documentary filmmaker <span class="font-semibold">@keisone</span>',
            'testimonial' => 'Chris did an amazing job setting up my site. The service was super fast and the communication was excellent. Highly Recommended!',
            'logo' => 'https://unavatar.io/youtube/keisone',
            'url' => 'keisone.net',
            'featured' => true,
        ],
        [
            'name' => '16Personalities',
            'description' => 'A 3 month contract job asissting in modernising the codebase and helping to develop API\'s',
            'testimonial' => '',
            'logo' => '16p.svg',
            'url' => '16personalities.com',
            'featured' => true,
        ],
        [
            'name' => 'Everyone.co.uk',
            'description' => 'A contract helping set-up a new learning platform',
            'testimonial' => '',
            'logo' => 'everyone.png',
            'url' => '',
            'featured' => false,
        ],
        [
            'name' => 'Townsend Music',
            'description' => 'Assisting in a brand redesign and general day-to-day development work',
            'testimonial' => '',
            'logo' => 'https://unavatar.io/tmstor.es',
            'url' => 'tmstor.es',
            'featured' => true,
        ],
        [
            'name' => 'App-Hive',
            'description' => 'Contract work developing features and enhancements for a Shopify plugin development agency',
            'testimonial' => '',
            'logo' => 'https://unavatar.io/x/Philo01',
            'url' => 'app-hive.dev',
            'featured' => true,
        ],
    ];

    #[Scope]
    public function featured(Builder $query): Builder
    {
        return $query->where(column: 'featured', operator: true);
    }

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->resolveLogoPath(value: $value),
        );
    }

    private function resolveLogoPath(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        return filter_var($value, filter: FILTER_VALIDATE_URL)
            ? $value
            : asset(path: self::LOGO_STORAGE_PATH.$value);
    }
}
