@php
    use App\Seo\Seo;
    use Illuminate\Support\Str;

    $breadcrumbs = ['homepage' => 'Home', 'articles' => 'Articles', $article->url() => $article->shortTitle];
    $schema = [Seo::blogPosting($article), Seo::breadcrumbs($breadcrumbs)];

    if ($article->faqs !== []) {
        $schema[] = Seo::faqPage($article->faqs);
    }
@endphp

<x-layout.main :$schema>
    <main>
        <x-page-head
            :title="$article->h1"
            label=""
            :$breadcrumbs
        >
            <p class="font-roboto-mono text-muted text-xs tracking-[0.04em]">
                Chris Mellor · Published
                <time datetime="{{ $article->publishedAt->toDateString() }}">{{ $article->publishedAt->format('j F Y') }}</time>
                @if ($article->wasUpdated())
                    · Updated
                    <time datetime="{{ $article->updatedAt->toDateString() }}">{{ $article->updatedAt->format('j F Y') }}</time>
                @endif
            </p>
        </x-page-head>

        <section class="relative px-6 py-10 sm:px-10 sm:py-12 lg:px-14">
            <div class="article-prose max-w-[72ch]">
                {{ $article->body() }}

                @if ($article->faqs !== [])
                    <h2>Frequently asked questions</h2>

                    @foreach ($article->faqs as $faq)
                        <h3>{{ $faq['question'] }}</h3>
                        <p>{{ Str::of($faq['answer'])->inlineMarkdown()->toHtmlString() }}</p>
                    @endforeach
                @endif
            </div>

            <div class="border-brand/40 mt-12 flex max-w-[72ch] flex-col items-start gap-4 border-l-2 pl-4">
                @if ($article->cta)
                    <div class="article-prose">
                        {{ Str::of($article->cta)->markdown()->toHtmlString() }}
                    </div>
                @else
                    <flux:text class="copy">
                        If you'd like a second pair of eyes, I do a fixed-price
                        <flux:link href="{{ route('app-security-review') }}#php-patch-check">PHP patch and upgrade check</flux:link>
                        that covers what PHP your servers are really running, whether they picked up the fixes, and a written plan to get
                        off 8.2. It's $295, written up within one working day.
                    </flux:text>
                @endif
                <flux:button
                    href="{{ route('contact') }}"
                    variant="primary"
                    wire:navigate.hover
                >
                    Ask for a patch check
                </flux:button>
            </div>

            <div class="border-line mt-12 flex max-w-[72ch] items-center gap-4 border-t pt-8">
                <img
                    class="size-14 flex-none rounded-full bg-white object-cover object-top grayscale dark:sepia"
                    src="{{ asset('images/faces/avatar-face-448.jpg') }}"
                    alt="Chris Mellor"
                    height="56"
                    width="56"
                />
                <flux:text class="copy">
                    Chris Mellor is a Laravel and PHP contractor working remotely through Mellor Code Ltd. His
                    <flux:link
                        href="{{ route('cv') }}"
                        wire:navigate.hover
                    >
                        CV
                    </flux:link>
                    and
                    <flux:link
                        href="{{ route('services') }}"
                        wire:navigate.hover
                    >
                        services
                    </flux:link>
                    pages have more detail.
                </flux:text>
            </div>
        </section>
    </main>
</x-layout.main>
