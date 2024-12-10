<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
    }
}
