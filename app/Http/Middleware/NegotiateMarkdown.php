<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Seo\HtmlToMarkdown;
use App\Seo\Seo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class NegotiateMarkdown
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->setVary('Accept', false);

        if (! $this->prefersMarkdown($request) || ! $request->isMethod('GET') || $response->isRedirection()) {
            return $response;
        }

        $status = $response->getStatusCode();
        $isHtml = str_starts_with((string) $response->headers->get('Content-Type'), 'text/html');

        if ($status >= 400) {
            $body = $this->errorBody($status);
        } elseif ($isHtml) {
            $body = HtmlToMarkdown::convert((string) $response->getContent());
        } else {
            return $response;
        }

        $response->setContent($body);
        $response->headers->set('Content-Type', 'text/markdown; charset=utf-8');

        return $response;
    }

    private function prefersMarkdown(Request $request): bool
    {
        $accepted = $request->getAcceptableContentTypes();
        $markdown = array_search('text/markdown', $accepted, true);

        if ($markdown === false) {
            return false;
        }

        $html = array_search('text/html', $accepted, true);

        return $html === false || $markdown < $html;
    }

    private function errorBody(int $status): string
    {
        $links = implode("\n", [
            '- ['.config('seo.site_name').']('.Seo::url().')',
            '- [Sitemap]('.Seo::url('sitemap.xml').')',
            '- [llms.txt]('.Seo::url('llms.txt').')',
        ]);

        $message = match ($status) {
            404 => "# Page not found\n\nThere is no page at this address. Try one of these instead:",
            410 => "# Gone\n\nThis article was removed and is not coming back. The current pages are linked from the homepage:",
            default => "# Error {$status}\n\nSomething went wrong loading this page. Try one of these instead:",
        };

        return "{$message}\n\n{$links}\n";
    }
}
