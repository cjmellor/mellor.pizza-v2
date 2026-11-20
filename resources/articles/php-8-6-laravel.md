PHP 8.6.0 came out on 19 November 2026, but Laravel 13's support table still lists only PHP 8.3 to 8.5. Until Laravel lists 8.6, I wouldn't move a production Laravel app onto it, even if Composer lets you install it. If you're still on PHP 8.2, that's the more urgent upgrade, because [PHP 8.2 stops getting security fixes on 31 December 2026](/articles/php-8-2-end-of-life-laravel).

The rest of this article covers the PHP 8.6 features you're likely to use in a Laravel app, the changes that can break one, and a checklist for the upgrade.

## Is PHP 8.6 out, and does Laravel support it yet?

PHP 8.6 is out, and Laravel doesn't list it yet.

php.net [announced PHP 8.6.0](https://www.php.net/archive/2026.php#2026-11-19-5) on 19 November 2026. Its [supported versions page](https://www.php.net/supported-versions.php) gives 8.6 active support until 31 December 2028 and security fixes until 31 December 2030.

The [Laravel support table](https://laravel.com/docs/13.x/releases#support-policy) lists PHP 8.3 to 8.5 for Laravel 13, and PHP 8.2 to 8.5 for Laravel 12. Laravel's own [test workflow](https://github.com/laravel/framework/blob/13.x/.github/workflows/tests.yml) runs on 8.3, 8.4 and 8.5. I checked the php.net pages, the support table and the workflow on 20 November 2026 at about 00:15 UTC.

Composer is a separate question. `laravel/framework` 13.x requires `"php": "^8.3"`, and under Composer's rules that range includes 8.6. So Composer won't stop you. That isn't the same as Laravel supporting 8.6, and your other packages may still block it. On this site, which runs Laravel 13.20, `composer why-not php 8.6.0` listed three packages: `brianium/paratest`, `nette/schema` and `nette/utils`. The versions installed here all cap PHP at 8.5.

Check that your host or Docker base image offers PHP 8.6 before you plan a production switch. The official `php:8.6-cli` image was on Docker Hub on release day.

## If you're still on PHP 8.2, should you jump to 8.6?

No. Move to a PHP version that Laravel lists first.

PHP 8.2 gets security fixes until 31 December 2026. Laravel 13 needs PHP 8.3 or later and lists up to 8.5, so for now the target is 8.4 or 8.5. PHP 8.4 gets security fixes until 31 December 2028, and 8.5 until 31 December 2029. From either one, you can move to 8.6 later, once Laravel lists it. My [PHP 8.2 end of life article](/articles/php-8-2-end-of-life-laravel) covers the checks and the upgrade.

## What's new in PHP 8.6 that you'll actually use in Laravel?

These are the PHP 8.6 features I expect to use most in Laravel code. Each one has a short example. I ran every "before" example on PHP 8.5 and every "after" example on the official PHP 8.6.0 Docker image, with Laravel 13's collections and query builder loaded. php.net's [PHP 8.6 release page](https://www.php.net/releases/8.6/en.php) has more examples.

### Partial function application

[Partial function application](https://wiki.php.net/rfc/partial_function_application_v2) lets you call a function with `?` in place of some arguments. Instead of running the function, PHP returns a closure that takes the missing arguments. You can use it in place of the short arrow functions you write for `map()` and `filter()` callbacks.

Before, on PHP 8.5:

```php
$slugs = collect($titles)
    ->map(fn (string $title) => str_replace(' ', '-', $title))
    ->map(fn (string $slug) => strtolower($slug));
```

After, on PHP 8.6:

```php
$slugs = collect($titles)
    ->map(str_replace(' ', '-', ?))
    ->map(strtolower(?));
```

Laravel's `map()` also passes each item's key to the callback. The closure from `strtolower(?)` has one parameter, so PHP ignores the key.

Two rules are easy to miss:

- PHP evaluates the arguments you supply once, when it creates the closure. A call such as `now()` in those arguments doesn't run again each time the closure runs.
- Each `?` becomes a required parameter, even when the original parameter was optional. `str_pad('x', 10, ?)` returns a closure that needs one argument.

A `...` placeholder stands for all the remaining arguments.

### `clamp()`

[`clamp()`](https://wiki.php.net/rfc/clamp_v2) returns a value if it's inside a range, and the nearest limit if it isn't. Before PHP 8.6 you nested `min()` and `max()`, and it's easy to swap the two limits by mistake.

Before:

```php
$perPage = min(100, max(1, $request->integer('per_page', 15)));
```

After:

```php
$perPage = clamp($request->integer('per_page', 15), min: 1, max: 100);
```

`clamp()` throws a `ValueError` if `min` is greater than `max`. It works with any values PHP can compare, including `Time\Duration` objects.

You don't have to wait for PHP 8.6 to use `clamp()` in Laravel 13. Since Laravel 13.7.0, `laravel/framework` requires `symfony/polyfill-php86`. That package defines `clamp()` and the `SortDirection` enum when PHP is older than 8.6.

### `Time\Duration`

[`Time\Duration`](https://wiki.php.net/rfc/duration_class) holds a length of time, measured like a stopwatch, with nanosecond precision. It has no time zone or calendar, so it can't represent "one month". It's for timeouts, delays and timings. This example is adapted from the backoff example on php.net's release page.

Before, the unit lives only in the variable name:

```php
$delayMs = min(100 * (2 ** $attempt), 30_000);
usleep($delayMs * 1000);
```

After:

```php
use Time\Duration;

$delay = Duration::fromMilliseconds(100)->multiplyBy(2 ** $attempt);
$delay = min($delay, Duration::fromSeconds(30));
time_nanosleep($delay->seconds, $delay->nanoseconds);
```

`min()` works here because PHP can compare two `Duration` objects. A `Duration` keeps whole seconds in `$seconds` and the remainder in `$nanoseconds`.

Laravel's own methods don't accept a `Duration` yet. For example, a queued job's `release()` in Laravel 13 takes a whole number of seconds, a `DateInterval` or a `DateTimeInterface`.

### Readonly property defaults

A readonly property can now have a [default value](https://wiki.php.net/rfc/readonly_property_defaults). Before PHP 8.6, you had to assign a fixed value in the constructor.

Before:

```php
final readonly class ExportSettings
{
    public string $disk;

    public function __construct(public string $format = 'csv')
    {
        $this->disk = 'exports';
    }
}
```

After:

```php
final readonly class ExportSettings
{
    public string $disk = 'exports';

    public function __construct(public string $format = 'csv') {}
}
```

The default counts as the property's initialisation. If the constructor then tries to assign `$disk`, PHP throws an `Error`.

### `#[\Override]` on class constants

You can now put [`#[\Override]`](https://wiki.php.net/rfc/override_constants) on a class constant or an enum case. It tells PHP that the constant must replace one from a parent class or an interface.

```php
abstract class Report
{
    public const string FORMAT = 'csv';
}

final class SalesReport extends Report
{
    #[\Override]
    public const string FORMAT = 'xlsx';
}
```

If someone renames `Report::FORMAT`, PHP 8.6 stops with `SalesReport::FORMAT has #[\Override] attribute, but no matching parent constant exists`. Without the attribute, `SalesReport::FORMAT` would become a new constant that nothing reads.

### `SortDirection`

[`SortDirection`](https://wiki.php.net/rfc/sort_direction_enum) is a built-in enum with two cases, `Ascending` and `Descending`. Use it in your own methods in place of a boolean or an `'asc'` string.

Laravel 13 already accepts it. Since Laravel 13.7.0, collection and `Arr` sort methods take a `SortDirection`. Since 13.8.0, the query builder's `orderBy()` takes one too. On PHP 8.3 to 8.5, the enum comes from `symfony/polyfill-php86`.

Before:

```php
function rankScores(Collection $scores, bool $descending = true): Collection
{
    return $scores->sortBy('points', SORT_REGULAR, $descending);
}

$leaders = rankScores($scores, false);
```

After:

```php
function rankScores(Collection $scores, SortDirection $direction): Collection
{
    return $scores->sortBy('points', SORT_REGULAR, $direction);
}

$leaders = rankScores($scores, SortDirection::Ascending);

$posts = Post::query()->orderBy('published_at', SortDirection::Descending);
```

### What else is in PHP 8.6?

These additions are smaller, or matter more to library authors than to app code:

- The [polling API](https://wiki.php.net/rfc/poll_api), `Io\Poll`, watches many streams at once using epoll, kqueue or the platform's equivalent. php.net describes it as a base for event loop libraries such as ReactPHP and AMPHP. Most Laravel apps won't call it directly.
- The [stream errors API](https://wiki.php.net/rfc/stream_errors) can make stream functions such as `file_get_contents()` throw a `StreamException`, in place of a warning. `stream_last_errors()` returns the errors as `StreamError` objects.
- `pack()` and `unpack()` accept the `<` and `>` endianness modifiers on [integer](https://wiki.php.net/rfc/pack-unpack-endianness-signed-integers-support) and [float](https://wiki.php.net/rfc/pack-unpack-float-endianness-modifier) format codes.
- [`grapheme_strrev()`](https://wiki.php.net/rfc/grapheme_strrev) reverses a string by grapheme cluster, so accented letters and emoji stay intact.
- JSON error messages now say where the error is. For `{"a":1,}`, `json_last_error_msg()` returns `Syntax error near location 1:8`, where PHP 8.5 returned `Syntax error`.
- Function and method parameters can have their own [doc comments](https://wiki.php.net/rfc/parameter-doccomments), which `ReflectionParameter::getDocComment()` returns.
- Enums can define [`__debugInfo()`](https://wiki.php.net/rfc/debugable-enums).
- You can [change a property of an object stored in a constant](https://wiki.php.net/rfc/const_object_property_write) directly.

The [new features page of the PHP 8.6 migration guide](https://www.php.net/manual/en/migration86.new-features.php) lists the rest, including changes to cURL, Intl, OpenSSL, Sodium, URI and Zip.

## What might break when you move a Laravel app to 8.6?

These are the changes I'd look for first in a Laravel app.

### `trim()` now strips form feeds

`trim()`, `ltrim()` and `rtrim()` now remove the form feed character, `\f`, by default ([RFC](https://wiki.php.net/rfc/trim_form_feed)). If your code relies on `trim()` keeping a form feed at the start or end of a string, the output changes.

### PHP's session defaults are stricter

PHP's native session settings now default to `session.use_strict_mode=1`, `session.cookie_httponly=1` and `session.cookie_samesite=Lax` ([RFC](https://wiki.php.net/rfc/session_security_defaults)). The `php.ini-production` file in the official PHP 8.6 Docker image sets the same three values.

A standard Laravel app doesn't use PHP's native sessions. Laravel's session middleware sets its own cookie from `config/session.php`, where `http_only` defaults to `true` and `same_site` defaults to `'lax'`. Those apps see no change.

Check for these cases:

- Your code or an older package calls `session_start()` or uses `$_SESSION`.
- Another site POSTs back to your app and needs PHP's session cookie, as some SAML sign-in and payment callbacks do. With `Lax`, the browser doesn't send the cookie on that request. To send it again, set `session.cookie_samesite=None` and `session.cookie_secure=1`.
- Your JavaScript reads PHP's session cookie. With `cookie_httponly` on, it can't.
- Your app passes a session ID from one site or subdomain to another and starts a session with it there. Strict mode rejects an ID that has no stored session yet, and PHP starts a new session with a new ID. Call `session_write_close()` on the side that creates the session before you pass the ID on.

### More functions reject bad arguments

Many functions now throw a `ValueError` for out-of-range values, invalid flags, or strings that contain NUL bytes. Before 8.6, they truncated or ignored those values. For example, `array_filter()` now throws when its `$mode` argument isn't a valid mode. The [backward incompatible changes page](https://www.php.net/manual/en/migration86.incompatible.php) has the full list.

### `fclose()`, `file_put_contents()` and `copy()` can return `false` in more cases

These three functions now return `false` when PHP can't flush or close the stream. Before 8.6, PHP ignored that failure. If your code checks their return values, it can now see failures that it missed before.

### Which deprecations are likely in app and package code?

Deprecations don't stop anything running yet. They show up in your logs and in test runs that report deprecations. These are the ones I'd expect in a Laravel codebase or its packages:

- A `return` inside a `finally` block ([RFC](https://wiki.php.net/rfc/deprecations_php_8_6#deprecate_returning_from_a_finally_block)).
- Returning a value from `__construct()` or `__destruct()`, or making either one a generator ([RFC](https://wiki.php.net/rfc/deprecate-return-value-from-construct)).
- Passing an object to `array_walk()`, `array_walk_recursive()` or `http_build_query()`. Call `get_object_vars()` on the object first.
- The `is_long()`, `is_integer()`, `is_double()` and `doubleval()` aliases. Use `is_int()`, `is_float()` and `floatval()`.
- `spl_object_hash()`. Use `spl_object_id()`.
- `mb_ereg()`, `mb_split()` and the other mbstring regex functions, because the Oniguruma library behind them is no longer maintained ([RFC](https://wiki.php.net/rfc/eol-oniguruma)). Use the `preg_` functions with the `u` modifier.
- `strcoll()` and the `SORT_LOCALE_STRING` sort flag. Use the `Collator` class from the intl extension.

The [deprecated features page](https://www.php.net/manual/en/migration86.deprecated.php) lists every deprecation in 8.6.

## How do you check whether your app is ready?

Work through these steps in order before you upgrade a Laravel app to PHP 8.6:

1. Check that your host or Docker base image offers PHP 8.6.
2. Check the [Laravel support table](https://laravel.com/docs/13.x/releases#support-policy) for your Laravel version. If it doesn't list 8.6, test on staging, and leave production where it is.
3. If a Laravel release adds 8.6 support, update to that release.
4. Run `composer why-not php 8.6.0`. Each package it lists has a PHP constraint that excludes 8.6. Update or replace each one. `composer prohibits` is the same command.
5. Run your test suite on PHP 8.6 in CI or in a staging image, with deprecations reported. PHPUnit's `--display-deprecations` option lists them.
6. If your `composer.json` sets `config.platform.php`, raise it to 8.6. Then switch production.

The PHP version in `composer.json` isn't always the version that serves requests. PHP-FPM, the CLI that runs your queue workers and your Docker base image can each run a different version, so check every one.

### Can a coding agent run these checks for you?

Yes. Paste this prompt into your coding agent. It points the agent at this article, which it can fetch as Markdown by sending an `Accept: text/markdown` header.

```text
Check whether this Laravel app is ready for PHP 8.6. Follow
https://mellor.pizza/articles/php-8-6-laravel
(send "Accept: text/markdown" to get it as Markdown).

1. Check the Laravel support table for this app's Laravel
   version, and tell me whether it lists PHP 8.6.
2. Run `composer why-not php 8.6.0`. For each package it
   lists, find a version that allows PHP 8.6.
3. Search the code and config for the breaking changes and
   deprecations in the article. List each match with its
   file and line.
4. If PHP 8.6 is available, run the test suite on it with
   deprecations reported.

Report what you found. Don't change dependencies, config or
code, and don't deploy, until I've read the report.
```

## Should you upgrade production yet?

Not yet, for most Laravel apps:

- If Laravel doesn't list 8.6 for your version, don't upgrade production. Test on staging.
- If you're on PHP 8.2, upgrade to 8.4 or 8.5 first. The [PHP 8.2 end of life article](/articles/php-8-2-end-of-life-laravel) covers how.
- If you're on 8.4 or 8.5, Laravel lists 8.6, your packages allow it and your tests pass, plan the upgrade. You don't need to do it on release day.

If packages block the upgrade and you need someone to do the work, that's part of my [app rescue](/services/app-rescue) service.
