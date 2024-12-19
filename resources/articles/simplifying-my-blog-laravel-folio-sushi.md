When I first built this website, I used a typical structure to do it:

- A database backend (MySQL) to store the blog posts.
- An entire admin panel, custom-built, that only I would ever use, to add CRUD capability to the blog posts.

I remember it took me longer to build the admin panel than I anticipated and don’t get me talking about building the WYSIWYG editor… sheesh.

But once I *finished* the work, I actually got to writing some blog posts, albeit, not many…

**Something I want to point out:** while I might have spent more time than I wanted to building this site, that I barely used myself, and definitely barely anybody visits, I didn’t let that deter me from keeping it online and maintaining it (I keep dependencies upgraded) because I use that time as a learning exercise, to keep my skills sharp, and where possible, use some newer features that might be available with the newer versions of the software I might have upgraded to. These skills you might learn while doing stuff like this are invaluable and can put you ahead of the game if say you’re looking for a developer role.

Anyway, I digress…

Since the website was first deployed, the Laravel team released a package called [Folio](https://laravel.com/docs/folio) which is a page based router, similar to Next.js Router or Astro.

It looked like a good fit for my blog posts, as the way I had it was a bit overkill, and I had some free time so thought I would make the switch, so I got to work.

First, I had made the decision to try and do all this without using a database, as the site was only going to be static content, so I eventually came to the decision to… use a database. Huh? Hear me out… I use a package called [**Sushi**](https://github.com/calebporzio/sushi).

## Removing the Database, sorta…

I still wanted all the great benefits of using Eloquent, but without the overhead of a database. The Sushi package is perfect for this scenario, as it allows you to just add a Trait, and define all your data as an `array` and then use Eloquent in the standard way. Here is an example from the repo:

**app/Models/Article.php**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Article extends Model
{
    use Sushi;
    
    protected array $rows = [
        [
            'author' => 'Chris Mellor',
            'content' => 'articles/torchlight-code-highlighting-in-a-markdown-wysiwyg.md',
            'excerpt' => 'A tutorial on implementing Torchlight, a powerful code highlighting service, within a Markdown WYSIWYG editor using the CommonMark PHP client. The guide demonstrates how to set up syntax highlighting, customize themes, and use advanced features like line focusing and code differentiation to enhance code presentation in web content.',
            'published_at' => '2021-12-14',
            'slug' => 'torchlight-code-highlighting-in-a-markdown-wysiwyg',
            'title' => 'Torchlight: Code Highlighting in a Markdown WYSIWYG',
        ],
        
        // more posts ...
    ];
}
```

First, I added the Trait — this is where all the magic happens.

Second, as I stated before, the data you’d want to use just needs to be put into an `array` with a property name of `$rows`.

Now, I can use Eloquent as you’re used to, e.g.

```php
Article::first()->author;
```

Under the hood, this package creates and caches a SQLite database specifically for this model. It creates a table and populates it with rows. If it can't cache a .sqlite file, it falls back to using an in-memory SQLite database.

There is a lot more this package can do, including using relationships but this goes beyond the scope of this post. [Check out the documentation](https://github.com/calebporzio/sushi) to see what else you can do.

That’s it, that’s the database side of things done.

## Using Folio

Folio requires you to set up a `pages` folder within the `resources/views` folder. You can then use an Artisan command to create a new page:

```bash
php artisan folio:page articles
```

This is just a Blade file, that you’ll be used to. You can also use PHP code within these files, which allows you to do things like fetch your data to display.

You might be thinking that you would use the `@php @endphp` directives, but you can just add the raw PHP code above the HTML in your page, e.g.

```php
<?php

\Laravel\Folio\name('articles');

$name = 'Chris';

?>

<x-layout.main sub-title="Web Development Articles & Tutorials">
  <h1>Hey {{ $name }}</h1>

  <!-- code here -->
</x-layout.main>
```

So now because I have data I use (thanks to Sushi) I can call for this data in this file, and display it using the familiar Eloquent syntax.

### Render Hooks

The Folio package includes a feature called "[Render Hooks](https://laravel.com/docs/11.x/folio#render-hooks)". This lets you add additional data to the View, or even customise it completely. Here is how I utilised it:

```php
\Laravel\Folio\render(function (Illuminate\View\View $view, \App\Models\Article $article): void {
    $view->with('articles', $article->latest('published_at')->simplePaginate(perPage: 10));
});
```

Now I can loop over `$articles` and list out the data from the Article Model.

### Route Model Binding

Within your `views/pages` folder, if you add a new file named:

```php
[Article].blade.php
```

Folio will use [Route Model Binding](https://laravel.com/docs/11.x/folio#route-model-binding) to link to your Model.

I use the `slug` column to resolve the bound column to the Model (by default, it will use the `id`). To get Folio to use a different key, change the name of the file:

```php
[Article:slug].blade.php
```

And now any time you go to *<your-website>/my-cool-blog-post* it will link the slug to the slug from the Article Model. Now, within this file, I can use the captured Model's data as variables, e.g.

```php
<x-layout.main>

  {{ $article->content }}

</x-layout.main>
```

### Working with Content

I put my articles, written in Markdown inside their own folder and then added a method to the Article Model to fetch it and display it:

```php
public function content(): string
{
    return file_get_contents(resource_path($this->content));
}
```

Now, when I want to add a new article, I just write the content in a Markdown file, put it in the folder read by the function, update the `$rows` `array` in the Article Model and it’s live! It could all be done through GitHub!

## Further Improvements

So the site is pretty snappy right now, not having to wait for data to be retrieved from a DB really helped.

### Caching

This comes directly from the docs, but if you use the `route:cache` Artisan command then you won’t even hit the SQLite DB at all. Technically, Sushi also caches the data, but doesn’t hurt to do it twice, right?

### Livewire

My site was already utilising [Livewire](https://livewire.laravel.com) (mostly for the admin panel) so I just decided to keep it around as I figured I'd find some use for it, and I did! Using the wire:navigate feature to [prefetch](https://livewire.laravel.com/docs/navigate#prefetching-links) the links; this sped things up even more! Probably overkill, but I’ll take any opportunity to use these cool features where possible.

## Conclusion

Thanks for taking the time to read this, I hope you learnt something!
