<?php

declare(strict_types=1);

namespace App\Providers;

use App\Seo\Seo;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Head\Enums\ImageType;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Enums\TwitterCard;
use Laravel\Head\Facades\Head;
use Laravel\Head\HeadBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Head::defaults(fn (HeadBuilder $head) => $head
            ->canonical()
            ->og(type: OgType::Website, siteName: config('seo.site_name'), image: Seo::url('images/open_graph_image.jpg'))
            ->twitter(card: TwitterCard::SummaryWithLargeImage)
            ->favicon(asset('favicon.svg'), type: ImageType::Svg)
            ->meta('twitter:domain', 'mellor.pizza')
            ->preconnect('https://fonts.googleapis.com')
            ->preconnect('https://fonts.gstatic.com', crossorigin: true));

        Blade::directive('showHide', fn () => <<< 'ANIMATE'
           x-transition:enter="ease-out duration-200"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="ease-in duration-75"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
        ANIMATE
        );
    }
}
