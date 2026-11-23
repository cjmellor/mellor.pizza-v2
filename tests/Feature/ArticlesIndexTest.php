<?php

declare(strict_types=1);

it('links the articles index to the PHP patch check after the lede', function () {
    $this->get('/articles')
        ->assertOk()
        ->assertSeeInOrder([
            'Notes on running and upgrading Laravel and PHP apps in production, from client work and my own servers.',
            'href="'.route('app-security-review').'#php-patch-check"',
            'PHP patch and upgrade check</a>',
            'role="list"',
        ], escape: false);
});

it('links the articles index to the PHP patch check in Markdown', function () {
    $this->get('/articles', ['Accept' => 'text/markdown'])
        ->assertOk()
        ->assertHeader('Content-Type', 'text/markdown; charset=utf-8')
        ->assertSeeInOrder([
            'Notes on running and upgrading Laravel and PHP apps in production, from client work and my own servers.',
            '[PHP patch and upgrade check]('.route('app-security-review').'#php-patch-check)',
            '- ## [',
        ], escape: false);
});
