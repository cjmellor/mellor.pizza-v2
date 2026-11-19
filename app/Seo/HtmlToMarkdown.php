<?php

declare(strict_types=1);

namespace App\Seo;

use Dom\Element;
use Dom\HTMLDocument;
use Dom\Node;
use Dom\Text;

final class HtmlToMarkdown
{
    private const array SKIPPED_TAGS = ['script', 'style', 'svg', 'template', 'noscript', 'ui-tooltip', 'form', 'input', 'textarea', 'select', 'button'];

    /** @var list<string> */
    private array $codeBlocks = [];

    public static function convert(string $html): string
    {
        $document = HTMLDocument::createFromString($html, LIBXML_NOERROR);
        $root = $document->querySelector('main') ?? $document->body;

        $converter = new self;
        $markdown = $converter->children($root);
        $markdown = preg_replace(['/[ \t]+\n/', '/\n[ \t]+/', '/(?<=\)) (?=[.,;:](?:\s|$))/'], ["\n", "\n", ''], $markdown);
        $markdown = mb_trim(preg_replace('/\n{3,}/', "\n\n", $markdown));

        return preg_replace_callback('/\x00(\d+)\x00/', fn (array $match): string => $converter->codeBlocks[(int) $match[1]], $markdown).PHP_EOL;
    }

    private function children(Node $node): string
    {
        $out = '';

        foreach ($node->childNodes as $child) {
            $out .= $this->node($child);
        }

        return $out;
    }

    private function node(Node $node): string
    {
        if ($node instanceof Text) {
            return preg_replace('/\s+/', ' ', $node->data);
        }

        if (! $node instanceof Element) {
            return '';
        }

        $tag = mb_strtolower($node->localName);

        if (in_array($tag, self::SKIPPED_TAGS, true)
            || $node->getAttribute('aria-hidden') === 'true'
            || in_array('eyebrow', explode(' ', $node->getAttribute('class') ?? ''), true)) {
            return '';
        }

        if ($tag === 'pre') {
            return $this->codeBlock($node);
        }

        if ($tag === 'table') {
            return $this->table($node);
        }

        $inner = $this->children($node);

        return match (true) {
            $tag === 'code' => '`'.$this->inline($inner).'`',
            preg_match('/^h([1-6])$/', $tag, $level) === 1 => "\n\n".str_repeat('#', (int) $level[1]).' '.$this->inline($inner)."\n\n",
            $tag === 'a' => $this->link($node, $inner),
            $tag === 'strong' || $tag === 'b' => $this->wrap($inner, '**'),
            $tag === 'em' || $tag === 'i' => $this->wrap($inner, '*'),
            $tag === 'br' => "\n",
            $tag === 'ul' || $tag === 'ol' => $this->list($node, $tag === 'ol'),
            $tag === 'blockquote' => "\n\n> ".$this->inline($inner)."\n\n",
            in_array($tag, ['p', 'div', 'section', 'header', 'hgroup', 'figure', 'figcaption', 'main', 'dl', 'dt', 'dd', 'li'], true) => "\n\n".mb_trim($inner)."\n\n",
            default => $inner,
        };
    }

    private function list(Element $list, bool $ordered): string
    {
        $items = [];

        foreach ($list->childNodes as $child) {
            if ($child instanceof Element && mb_strtolower($child->localName) === 'li') {
                $items[] = $this->inline($this->children($child));
            }
        }

        $lines = array_map(
            fn (string $item, int $index): string => ($ordered ? ($index + 1).'.' : '-').' '.$item,
            $items,
            array_keys($items),
        );

        return "\n\n".implode("\n", $lines)."\n\n";
    }

    private function codeBlock(Element $pre): string
    {
        $code = $pre->querySelector('code') ?? $pre;
        preg_match('/(?:^|\s)language-(\S+)/', $code->getAttribute('class') ?? '', $language);

        $this->codeBlocks[] = '```'.($language[1] ?? '')."\n".mb_rtrim($code->textContent)."\n```";

        return "\n\n\x00".array_key_last($this->codeBlocks)."\x00\n\n";
    }

    private function table(Element $table): string
    {
        $rows = [];
        $columns = null;

        foreach ($table->querySelectorAll('tr') as $row) {
            $cells = [];

            foreach ($row->childNodes as $cell) {
                if ($cell instanceof Element && in_array(mb_strtolower($cell->localName), ['th', 'td'], true)) {
                    $cells[] = str_replace('|', '\|', $this->inline($this->children($cell)));
                }
            }

            $columns ??= count($cells);
            $rows[] = '| '.implode(' | ', $cells).' |';
        }

        if ($rows === []) {
            return '';
        }

        $separator = '|'.str_repeat(' --- |', $columns);

        return "\n\n".implode("\n", [$rows[0], $separator, ...array_slice($rows, 1)])."\n\n";
    }

    private function link(Element $anchor, string $inner): string
    {
        $href = $anchor->getAttribute('href') ?? '';
        $text = $this->inline($inner) ?: ($anchor->getAttribute('aria-label') ?? '');

        if ($text === '' || $href === '' || str_starts_with($href, '#')) {
            return $inner;
        }

        $url = str_starts_with($href, '/') ? Seo::url($href) : $href;

        return "[{$text}]({$url})";
    }

    private function wrap(string $inner, string $marker): string
    {
        $text = $this->inline($inner);

        return $text === '' ? '' : "{$marker}{$text}{$marker}";
    }

    private function inline(string $text): string
    {
        return mb_trim(preg_replace('/\s+/', ' ', $text));
    }
}
