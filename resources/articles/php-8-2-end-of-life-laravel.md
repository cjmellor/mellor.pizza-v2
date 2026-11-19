PHP 8.2 stops getting security fixes on 31 December 2026. On 19 November php.net shipped another security release for every supported version, a month after October's php2shell fixes. [TBC from release notes: confirm the release shipped for every supported version.] This is what I check on a Laravel app, and what I'd do this week.

## What was released on 19 November 2026?

[TBC from release notes: the fixed version for each branch.] Before the release, php.net said the highest severity is critical, and that the critical issues "require either non-default configuration or uncommon setups" ([announcement, 18 November](https://www.php.net/archive/2026.php#2026-11-18-1)).

| Branch | Fixed version            | Changes                  |
| ------ | ------------------------ | ------------------------ |
| 8.2    | [TBC from release notes] | [TBC from release notes] |
| 8.3    | [TBC from release notes] | [TBC from release notes] |
| 8.4    | [TBC from release notes] | [TBC from release notes] |
| 8.5    | [TBC from release notes] | [TBC from release notes] |

[TBC from release notes: each CVE with its ID, a one-line description, its severity and the setting or setup it needs.]

[TBC from release notes: whether CVE-2026-115560, the session upload progress issue, is among them.]

[TBC from release notes: whether PHP 8.6.0 shipped the same day.]

If php.net publishes more detail, I'll update this page and the date at the top will change.

## Am I affected?

Every supported version got fixes, so update in the normal way. The critical issues only affect [TBC from release notes: the non-default or uncommon setups php.net names]. Most Laravel apps on a standard setup are in the lower-severity group. [TBC from release notes: confirm that every branch got fixes, and that a standard Laravel setup is outside the critical group.]

The bigger risk is October's release. If you haven't installed PHP 8.2.35, 8.3.36, 8.4.27 or 8.5.12, you're still exposed to php2shell. That's two critical bugs that allow unauthenticated remote code execution, [CVE-2026-109618](https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w) and [CVE-2026-109619](https://github.com/php/php-src/security/advisories/GHSA-6wmf-4rv5-p3rp). php.net named PHP-FPM, Apache with mod_php, php-cgi, FrankenPHP and LiteSpeed as at risk, with mod_php the highest ([advisory, 21 October](https://www.php.net/archive/2026.php#2026-10-21-5)). CISA added both bugs to its Known Exploited Vulnerabilities catalogue on 26 October ([CISA alert](https://www.cisa.gov/news-events/alerts/2026/10/21/critical-vulnerabilities-php-require-immediate-patching)).

PHP 8.1 and older no longer receive updates from the PHP project. For php2shell, php.net also published minimal source backports for 7.4, 8.0 and 8.1, for people who build PHP themselves. Otherwise you depend on your distro or an LTS vendor.

## How do I check which PHP version my server actually runs?

Check the PHP that serves web requests, not only the CLI. They're separate binaries, and on a server with several PHP versions installed they can differ.

- **Command line.** `php -v` shows the CLI version. `php artisan about` shows the PHP and Laravel versions, but the PHP it reports is also the CLI one.
- **PHP-FPM.** Run the FPM binary for your version, for example `php-fpm8.4 -v`. You can also add a temporary `phpinfo()` page, read it, and delete it straight away.
- **composer.json.** The `require.php` line is a constraint. It doesn't tell you what's running.
- **Laravel Forge.** Each PHP version on a Forge server runs its own FPM process, and you patch a version from the server's Runtime tab ([Forge docs](https://laravel.com/forge/docs/servers/php)). Check the version on the server after you patch it.
- **Docker.** An image tag like `php:8.4-fpm` doesn't update itself. Pull and rebuild the PHP Docker image, then confirm the version from the image itself.
- **Distro packages.** To check the PHP version on Ubuntu or Debian, use `apt policy`. On Red Hat and Fedora, use `dnf info`. Distros often backport fixes without changing the upstream version number, so check your vendor's security tracker for the CVE. Debian, Ubuntu and Red Hat all have one.

```bash
php -v
php-fpm8.4 -v
php artisan about
apt policy php8.4-fpm
docker run --rm php:8.4-fpm php -v
```

When php2shell landed, I flagged it to my client's team on release day. On my own server the OS packages couldn't deliver the fix, so I built a containerised PHP-FPM 8.4.27 the same day and moved three production sites onto it with no downtime and a tested rollback. There's more about that on the [security review page](/app-security-review).

## How do I update to the patched release?

Update the package or image, restart every PHP worker, then check the version again.

1. Update the PHP package, use Forge's Update option, or rebuild the Docker image.
2. Restart PHP-FPM or the web server. Restart queue workers, Horizon and Octane too. They're long-running PHP processes, and they keep the old binary until they restart.
3. Check `php -v` and the version your web server reports.
4. Run your test suite and watch the logs.

```bash
sudo systemctl restart php8.4-fpm
php artisan queue:restart
php artisan horizon:terminate
```

Run the last two only if you use queues or Horizon, and only if a process manager such as Supervisor starts them again. If you run Octane, stop and start it through your process manager, so the new workers start on the new PHP binary. A patch release inside a branch, such as moving to a later 8.4 release, doesn't need code changes in normal cases. Treat it like any other PHP security update.

## Should I turn off `session.upload_progress.enabled`?

On 23 October php.net suggested setting `session.upload_progress.enabled=0` until the next regular bugfix release, to block an unlikely remote code execution vector ([advisory, 23 October](https://www.php.net/archive/2026.php#2026-10-23-1)). Whether you still need it after 19 November depends on the release notes. [TBC from release notes]

The issue needs an unusual setup. The app sets `session.serialize_handler` to `php_binary` or `php_serialize` in its configuration, then switches it to `php` with `ini_set()` before calling `session_start()`, with upload progress still enabled. php.net said it would publish the full advisory for CVE-2026-115560 with the next release. The same setting was already a listed mitigation for CVE-2026-109619.

Most Laravel apps don't use PHP's native upload progress, and Laravel's own sessions don't depend on it. Check that nothing in your app or your packages does before you turn it off. Set it in `php.ini` or the FPM pool, not with `ini_set()` or `.user.ini`, then restart every worker:

```ini
session.upload_progress.enabled = 0
```

## When does PHP 8.2 reach end of life?

Security fixes for PHP 8.2 end on 31 December 2026. After that, the PHP project releases no fixes for it at all. That's what PHP 8.2 EOL means in practice.

These are the PHP supported versions, from [php.net](https://www.php.net/supported-versions.php):

| Branch | Active support until | Security support until |
| ------ | -------------------- | ---------------------- |
| 8.2    | 31 December 2024     | 31 December 2026       |
| 8.3    | 31 December 2025     | 31 December 2027       |
| 8.4    | 31 December 2026     | 31 December 2028       |
| 8.5    | 31 December 2027     | 31 December 2029       |

Laravel's PHP version compatibility matters as much. From Laravel's [support policy](https://laravel.com/docs/13.x/releases):

| Laravel | PHP        | Security fixes until |
| ------- | ---------- | -------------------- |
| 11      | 8.2 to 8.4 | 12 March 2026        |
| 12      | 8.2 to 8.5 | 24 February 2027     |
| 13      | 8.3 to 8.5 | 17 March 2028        |

So an app on Laravel 11 hasn't had framework security fixes since 12 March 2026. If it's also on PHP 8.2, it gets no PHP security fixes after 31 December 2026 either. Some distros and LTS vendors offer extended support for PHP after its end of support. That can cover PHP for longer, but it doesn't cover Laravel.

## Why does staying on PHP 8.2 carry more risk now?

Serious runtime bugs are being found and turned into working exploits faster than before. A PHP version that no longer gets fixes is exposed sooner.

php2shell is an example. OpenAI says [Calif found a critical flaw using GPT-5.6 Sol](https://openai.com/index/coordinated-disclosure-of-critical-vulnerabilities/), as part of OpenAI's Patch the Planet programme, and that Wiz independently found and reported both bugs. Amazon [recorded an exploitation attempt dated 17 October](https://aws.amazon.com/blogs/security/amazon-threat-intelligence-identifies-php2shell-exploitation-prior-to-public-disclosure-in-madpot/), four days before the fixes were public. CISA listed both bugs as known exploited on 26 October.

It isn't only PHP. On 21 October, the day of the PHP fixes, Node.js fixed an out-of-bounds write in its bundled Brotli decoder, [CVE-2026-111497](https://nodejs.org/en/blog/vulnerability/october-2026-security-releases), and its advisory credits OpenAI Codex Security with the report. Andi Gutmans, one of PHP's original co-authors, [made this point on 18 November](https://x.com/andigutmans/status/2123100688385523903). His view is that the pattern is showing up across runtimes, not in PHP alone.

The gap between a fix and a working exploit is getting shorter, and the PHP serving production often lags behind php.net, on Forge servers, in Docker images and in distro packages. That's why I check what's running, as in the section on checking your version. On PHP 8.2 after 31 December, there won't be a fix to apply at all.

## Should I upgrade PHP 8.2 to 8.4 or 8.5?

Both work with Laravel 12 and 13. PHP 8.5 gets security fixes for a year longer, until 31 December 2029, so I'd aim for 8.5 unless a package you depend on doesn't support it yet. If one doesn't, 8.4 is supported until 31 December 2028. Check your Composer packages first.

1. Check that your Laravel version supports the target PHP version. Laravel 11 stops at 8.4.
2. Ask Composer what's in the way.
3. Update the packages that block the upgrade.
4. Read php.net's migration guides for [8.3](https://www.php.net/manual/migration83.php), [8.4](https://www.php.net/manual/migration84.php) and [8.5](https://www.php.net/manual/migration85.php). Moving from 8.2 to 8.5 crosses all three.
5. If you use static analysis or Rector, run them to find deprecated code.
6. Run the tests.
7. Upgrade staging, then production.
8. Keep the old PHP version installed until you're sure, so you can roll back.

```bash
composer why-not php 8.5
```

On Laravel Forge, install PHP 8.4 or 8.5 on the server, then switch each site to it. With Docker, change the base image tag and rebuild.

## What about PHP 8.6?

php.net set the PHP 8.6 release date as 19 November 2026 ([RC7 announcement](https://www.php.net/archive/2026.php#2026-11-12-1)). [TBC from release notes: whether PHP 8.6.0 shipped.] It's new, so I wouldn't move production onto it the same week. Wait until your packages and hosting support it, and for the first patch releases.

## When should I get help?

Get help if you can't tell what's actually running, if your packages block an upgrade, or if you're on PHP 8.2 or 8.1 with no one to do the upgrade.

The [PHP patch and upgrade check](/app-security-review#php-patch-check) covers the first two and gives you a written plan. If something then needs fixing, [app rescue](/services/app-rescue) covers the fix work. All the services are listed on the [services page](/services).
