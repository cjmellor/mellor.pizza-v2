<?php

declare(strict_types=1);

namespace App\Portfolio;

use Illuminate\Support\Collection;

final readonly class Project
{
    public function __construct(
        public string $name,
        public string $description,
        public string $testimonial,
        public string $logo,
        public string $url,
        public bool $featured,
    ) {}

    /**
     * @return Collection<int, self>
     */
    public static function all(): Collection
    {
        return collect([
            new self(
                name: 'Keis One',
                description: 'A brand website for YouTuber and documentary filmmaker <span class="font-semibold">@keisone</span>',
                testimonial: 'Chris did an amazing job setting up my site. The service was super fast and the communication was excellent. Highly Recommended!',
                logo: asset('images/portfolio_logos/keisone.jpg'),
                url: 'keisone.net',
                featured: true,
            ),
            new self(
                name: '16Personalities',
                description: 'A 3 month contract job asissting in modernising the codebase and helping to develop API\'s',
                testimonial: '',
                logo: asset('images/portfolio_logos/16p.svg'),
                url: '16personalities.com',
                featured: true,
            ),
            new self(
                name: 'Everyone.co.uk',
                description: 'A contract helping set-up a new learning platform',
                testimonial: '',
                logo: asset('images/portfolio_logos/everyone.png'),
                url: '',
                featured: false,
            ),
            new self(
                name: 'Townsend Music',
                description: 'Assisting in a brand redesign and general day-to-day development work',
                testimonial: '',
                logo: asset('images/portfolio_logos/townsend-music.jpg'),
                url: 'tmstor.es',
                featured: true,
            ),
            new self(
                name: 'App-Hive',
                description: 'Contract work developing features and enhancements for a Shopify plugin development agency',
                testimonial: 'I was looking to hire someone to help with my Shopify app, and Chris immediately stood out by going above and beyond writing a thoughtful, personalized motivation letter on his website. Since then, he helped launch new features and improve workflows using AI.',
                logo: asset('images/portfolio_logos/app-hive.jpg'),
                url: 'app-hive.dev',
                featured: true,
            ),
        ]);
    }

    /**
     * @return Collection<int, self>
     */
    public static function featured(): Collection
    {
        return self::all()->filter(fn (self $project): bool => $project->featured)->values();
    }
}
