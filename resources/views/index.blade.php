<x-layout.main
    container
    :schema="[App\Seo\Seo::website(), App\Seo\Seo::webPage('WebPage', 'homepage')]"
>
    <x-header></x-header>
    <x-main></x-main>
</x-layout.main>
