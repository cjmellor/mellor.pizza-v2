<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Model::preventLazyLoading(! $this->app->isProduction());

        // “Reading Time”
        Str::macro('readingTime', function (...$text) {
            $totalWords = str_word_count(implode(' ', $text));

            $minutes = max(1, ceil(num: $totalWords / 200));

            return ($minutes > 1) ? $minutes.' minutes' : $minutes.' minute';
        });

        Blade::directive('slideUp', fn () => <<< 'ANIMATE'
            x-transition:enter="ease-in-out duration-700"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="ease-in-out duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
        ANIMATE
        );

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
