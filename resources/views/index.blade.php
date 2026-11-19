@php
    $faqs = [
        [
            'question' => 'What kind of work do you take on?',
            'answer' => 'Contract Laravel and PHP development on your team, rescue work on apps that were built in a hurry or with AI tools, and a fixed-price security review. Details are on the [services page](' . route('services') . ').',
        ],
        [
            'question' => 'Do you work with teams outside the UK?',
            'answer' => 'Yes. I work remotely with clients worldwide, including the UK, EU and US. I work flexibly across time zones and can adapt to your team\'s working hours.',
        ],
        [
            'question' => 'Do you use AI to write code?',
            'answer' => 'Yes. AI writes a lot of my code, mostly through Claude Code, and I review all of it before it lands, security included.',
        ],
        [
            'question' => 'How do I get in touch?',
            'answer' => 'Email [chris@mellor.pizza](mailto:chris@mellor.pizza) or use the [contact form](' . route('contact') . '). I reply the same day. I\'m available now.',
        ],
    ];
@endphp

<x-layout.main
    :schema="[
        App\Seo\Seo::website(),
        App\Seo\Seo::webPage('WebPage', 'homepage'),
        ...App\Portfolio\Testimonial::all()->map(fn ($testimonial) => App\Seo\Seo::review($testimonial))->all(),
        App\Seo\Seo::faqPage($faqs),
    ]"
>
    <x-main :$faqs />
</x-layout.main>
