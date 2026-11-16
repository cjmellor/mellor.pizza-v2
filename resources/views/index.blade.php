<x-layout.main
    :schema="[
        App\Seo\Seo::website(),
        App\Seo\Seo::webPage('WebPage', 'homepage'),
        ...App\Portfolio\Testimonial::all()->map(fn ($testimonial) => App\Seo\Seo::review($testimonial))->all(),
    ]"
>
    <x-main />
</x-layout.main>
