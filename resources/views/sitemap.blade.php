{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach (App\Seo\Seo::publicRouteNames() as $name)
        <url>
            <loc>{{ App\Seo\Seo::url(route($name, absolute: false)) }}</loc>
        </url>
    @endforeach
</urlset>
