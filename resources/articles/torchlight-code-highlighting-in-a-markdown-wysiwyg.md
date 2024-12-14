## What is Torchlight?

[Torchlight](https://torchlight.dev/) is an HTTP API that sends code to a server to parse it and then sends it back to the user looking like the kind code highlighting you might see in your code editor.

An overview of Torchlight and how it works can be found on its [main website documentation](https://torchlight.dev/docs/overview)

## Getting started

Torchlight can be used in a bunch of different ways, using different clients. Probably the most popular one is the **Laravel** client as it offers several features and a handy Blade Component, making wrapping code blocks — and highlighting them — a cinch.

> This article will not be focusing on the Laravel client. If you wish to know how to use this, [check out the specific section of the documentation for using Torchlight with Laravel](https://torchlight.dev/docs/clients/laravel)
>

### Using with CommonMark

This article will be all about how to utilise Torchlight using its **CommonMark PHP** client.

The reason I chose this client was that for this blog when writing articles, I am using a third-party application called **[EasyMDE](https://github.com/Ionaru/easy-markdown-editor)**. And even though this website is built with Laravel, I could not utilise that client because I cannot use the Blade Components in a content editable text area.

The CommonMark client is just an extension of the [CommonMark package from The PHP League](https://commonmark.thephpleague.com/).

The reason I am doing it like this is that the extension will pick up any code — in any language, wrapped in back-ticks and highlight the code directly on the browser.

> All the highlighted code in this article is using Torchlight

## Installation

Installation is pretty simple, you just install it via composer!

```php
composer require torchlight/torchlight-commonmark
```

### Configuration

You might also want to publish the packages configuration file, so you can customise it as you see fit.

```php
php artisan torchlight:install
```

You will need an **API Token** to use Torchlight. You can get this for free by [registering an account](https://app.torchlight.dev/register?plan=free_month) on the Torchlight website and creating a new token from the [dashboard](https://app.torchlight.dev/tokens).

Then add the new token to a new environment variable in your `.env` file.

```markdown
TORCHLIGHT_TOKEN=YOUR_API_TOKEN
```

You can also change things like which cache driver you want to use and a theme. A list of available themes can be found [in the documentation](https://torchlight.dev/docs/themes).

## Enable the Extension

As I mentioned, this client is just an extension, so we just need to enable it.

Quite simply, all you need to enable it is to add this code

```php
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;

$environment = Environment::createCommonMarkEnvironment(['html_input' => 'strip']);
$environment->addExtension(new TorchlightExtension());
```

This can be added wherever you output your Markdown content on your page.

### But...

I'd like to bring up how I achieved this when building this blog.

First, I'll quickly go over how I have my `Posts` model structured:

Here is the migration

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('category_id')->constrained();
    $table->string('title')->index();
    $table->string('slug')->unique();
    $table->string('excerpt');
    $table->text('post_content')->index();
    $table->boolean('is_published')->default(false)->index();
    $table->string('post_image')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

`post_content` is where the content of a blog posts is stored.

In the `Posts` Model, I have [defined a new Accessor](https://laravel.com/docs/8.x/eloquent-mutators#defining-an-accessor)

```php
public function getContentAttribute(): bool|RenderedContentInterface
{
    if ($this->post_content == null) {
        return false;
    }

    return $this->convert($this->post_content);
}
```

Adding this means I can now access the value of this attribute by using `$post->content` instead of `$post->post_content` . Both ways will still work, but the former has been transformed now to call the `convert` method.

### Utilising a Trait

The aforementioned `convert` method is part of a custom Trait. The Trait is name-spaced at `App\Concerns\Convert.php` and contains the following:

```php
namespace App\Concerns;

use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;
use Torchlight\Commonmark\V2\TorchlightExtension;

trait Convert
{
    public function convert($content): RenderedContentInterface
    {
        $environment = Environment::createCommonMarkEnvironment(['html_input' => 'strip']);
        $environment->addExtension(new TorchlightExtension());

        $converter = new MarkdownConverter($environment);

        return $converter->convertToHtml($content);
    }
}
```

You'll have spotted the code mentioned above to enable Torchlight when using the CommonMark client.

So now, whenever I access the new `content` attribute, if the value is using Markdown, it will be automatically converted to HTML and if it is using code blocks, they will be highlighted with Torchlight.

Within a Blade file, I would just call it like so

```php
<p>{{ $post->content }}</p>
```

### Worth noting ❗️

When you hit the web page with the newly highlighted code for the first time, it will cache the response, so the page might take slightly longer to load than usual, but it's just a one time thing. You could queue it if that is going to be an issue.

## Styling

You will have to style the code blocks to make them look nice. Fortunately, the documentation gives you the CSS to implement into your build. It shows the styles for Vanilla CSS and TailwindCSS. [Check that out here](https://torchlight.dev/docs/css).

> Some annotations also require custom CSS and these are outlined in the individual annotations' documentation page.
>

## Annotations

What makes Torchlight stand out from its competition is how it can render code via comments in your code. For example, you could focus a line in your code block:

```
// torchlight! {"torchlightAnnotations": false}
public function author(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id'); // [tl! focus]
}
```

On line 3, there is an inline comment `// [tl! focus]` which tells Torchlight to render this code block with this line highlighted, as shown below:

```php
public function author(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id'); // [tl! focus]
}
```

Another example is that you can highlight a line of code in the code block:

```
// torchlight! {"torchlightAnnotations": false}
public function setType(string $type): string
{
    return $data['attributes'] = match ($type) {
        'info' => 'info',
        'success' => 'success', // [tl! highlight]
        'warning' => 'warning',
        'error' => 'error', // [tl! highlight:1]
        default => null,
    };
}
```

On line 5, you'll see the line is highlighted.

You can also do a range of lines, as outlined on line 7 which adds a `:1` indicating to also highlight 1 line below the first.

```php
public function setType(string $type): string
{
    return $data['attributes'] = match ($type) {
        'info' => 'info',
        'success' => 'success', // [tl! highlight]
        'warning' => 'warning',
        'error' => 'error', // [tl! highlight:1]
        default => null,
    };
}
```

For a final example, you can do code differentiation, similar to how you see it on GitHub.

Here is an example below:

```
// torchlight! {"torchlightAnnotations": false}
private function deleteUnusedImage()
{
    Storage::disk(config('filesystems.default')) // [tl! remove]
		Storage::disk('s3') // [tl! add]
        ->deleteDirectory('post_headers/'.Str::slug($this->postRequest->title));

    if (! $this->postRequest->has('post_image_delete')) {
        return null;
    }
}
```

Adding a `// [tl! remove]` comment will mark the line in red and adding a `// [tl! add]` comment will mark the line in green.

```php
private function deleteUnusedImage()
{
    Storage::disk(config('filesystems.default')) // [tl! remove]
    Storage::disk('s3') // [tl! add]
        ->deleteDirectory('post_headers/'.Str::slug($this->postRequest->title));

    if (! $this->postRequest->has('post_image_delete')) {
        return null;
    }
}
```

Those are just three examples that I think are pretty cool, but there are lots more too. Check out [this overview](https://torchlight.dev/docs/annotations) of the other available annotations.

So check out [Torchlight](https://torchlight.dev) and consider using it for your next project that requires some code highlighting!
