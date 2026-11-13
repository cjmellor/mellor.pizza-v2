<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RedirectToCanonicalUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $uri = $request->getRequestUri();
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $query = parse_url($uri, PHP_URL_QUERY);

        $canonicalPath = preg_replace('#^/index\.php(?=/|$)#', '', $path) ?: '/';
        $canonicalPath = $canonicalPath === '/' ? '/' : mb_rtrim($canonicalPath, '/');

        if ($canonicalPath === $path) {
            return $next($request);
        }

        return redirect()->to($canonicalPath.($query ? "?{$query}" : ''), 301);
    }
}
