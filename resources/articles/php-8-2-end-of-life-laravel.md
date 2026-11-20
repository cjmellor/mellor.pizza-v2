PHP 8.2 stops getting security fixes on 31 December 2026. On 19 November php.net shipped another security release for every supported version, a month after October's php2shell fixes. This is what I check on any PHP server, and what I'd do this week. If you run Laravel, the section for Laravel users near the end covers the extra checks.

## What was released on 19 November 2026?

php.net released [PHP 8.2.36](https://www.php.net/archive/2026.php#2026-11-19-1), [8.3.37](https://www.php.net/archive/2026.php#2026-11-19-2), [8.4.28](https://www.php.net/archive/2026.php#2026-11-19-3) and [8.5.13](https://www.php.net/archive/2026.php#2026-11-19-4) at about 14:00 UTC. All four are security releases. Before the release, php.net said the highest severity is critical, and that the critical issues "require either non-default configuration or uncommon setups" ([announcement, 18 November](https://www.php.net/archive/2026.php#2026-11-18-1)).

| Branch | Fixed version | Changes                                                                                |
| ------ | ------------- | -------------------------------------------------------------------------------------- |
| 8.2    | 8.2.36        | 12 security fixes, 4 of them critical                                                  |
| 8.3    | 8.3.37        | 13 security fixes, 5 of them critical                                                  |
| 8.4    | 8.4.28        | 14 security fixes, 5 of them critical, plus bug fixes                                  |
| 8.5    | 8.5.13        | 17 security fixes, 7 of them critical, plus bug fixes and an updated uriparser library |

The counts come from the [PHP 8 ChangeLog](https://www.php.net/ChangeLog-8.php). The severities and conditions below come from each GitHub advisory. Each one lists the setup an attacker needs.

| CVE                                                                                       | Severity | Branches      | What it is, and what it needs                                                                                                                                                                                                                     |
| ----------------------------------------------------------------------------------------- | -------- | ------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| [CVE-2026-129289](https://github.com/php/php-src/security/advisories/GHSA-qc49-hpvq-g2w6) | Critical | All           | PHP-FPM request smuggling that can run attacker code. Needs a front end that reuses FastCGI connections, such as nginx `fastcgi_keep_conn on` or Apache `enablereuse=on`, and an app path that opens `php://input` without reading it to the end. |
| [CVE-2026-129496](https://github.com/php/php-src/security/advisories/GHSA-gr4f-wgx5-jpfv) | Critical | All           | Use-after-free in the timezone cache. Needs a warning at PHP startup, such as an invalid `date.timezone`, written to a PHP `error_log` file.                                                                                                      |
| [CVE-2026-126714](https://github.com/php/php-src/security/advisories/GHSA-fm2m-fjf5-v3cp) | Critical | All           | A half-written session file can be read as attacker-controlled objects. Needs PHP's native `files` session handler, attacker influence over session data, an interrupted write and a usable gadget chain.                                         |
| [CVE-2026-115560](https://github.com/php/php-src/security/advisories/GHSA-658j-r8rw-q6mx) | Critical | All           | The session upload progress issue. Needs upload progress enabled, two different `session.serialize_handler` values on the same session data, and a usable gadget chain.                                                                           |
| [CVE-2026-129481](https://github.com/php/php-src/security/advisories/GHSA-g3vh-838c-65v7) | Critical | 8.3, 8.4, 8.5 | Use-after-free after session shutdown fails. Needs PHP's native sessions and a fatal error in a callback during session cleanup.                                                                                                                  |
| [CVE-2026-129474](https://github.com/php/php-src/security/advisories/GHSA-8mjj-2r7p-4hg2) | Critical | 8.5           | Use-after-free in backtraces of `__call()` and `__callStatic()`. Needs `fatal_error_backtraces=1` and `zend.exception_ignore_args=0`.                                                                                                             |
| [CVE-2026-129182](https://github.com/php/php-src/security/advisories/GHSA-2fjv-p558-g82m) | Critical | 8.5           | Use-after-free of a fatal error backtrace after shutdown. Needs path-specific INI overrides plus an early warning from Apache per-directory config or a `PHP_VALUE` FastCGI parameter.                                                            |
| [CVE-2026-129291](https://github.com/php/php-src/security/advisories/GHSA-jm4m-qfqx-967m) | High     | All           | PHP-FPM local privilege escalation to the master's user, often root. Needs code already running in a worker and `catch_workers_output` enabled, which the official PHP-FPM Docker images do.                                                      |
| [CVE-2026-128090](https://github.com/php/php-src/security/advisories/GHSA-68fq-fh7h-f8gr) | High     | All           | Phar OpenSSL signature bypass. Needs an app that loads an OpenSSL-signed Phar an attacker can replace.                                                                                                                                            |
| [CVE-2026-128064](https://github.com/php/php-src/security/advisories/GHSA-f6gg-rchx-xw8j) | High     | All           | `HTTPS://` and `FTPS://` URLs with an uppercase `S` go out unencrypted through PHP's stream functions. Needs such a URL or redirect, and someone watching the network.                                                                            |
| [CVE-2026-127960](https://github.com/php/php-src/security/advisories/GHSA-mmf9-xm3v-hg2x) | High     | All           | Denial of service from folded HTTP response headers. Needs the app to fetch a URL the attacker controls through PHP's stream functions.                                                                                                           |
| [CVE-2026-129538](https://github.com/php/php-src/security/advisories/GHSA-5j3f-64r7-f564) | Medium   | All           | Out-of-bounds read and write in `php-cgi`. PHP-FPM and mod_php aren't affected.                                                                                                                                                                   |
| [CVE-2026-129292](https://github.com/php/php-src/security/advisories/GHSA-3mg3-cr28-46gc) | Medium   | All           | XSS in the PHP-FPM status page. Needs the status page enabled and viewed as HTML.                                                                                                                                                                 |
| [CVE-2026-15353](https://github.com/php/php-src/security/advisories/GHSA-q23r-hr55-xmpg)  | Medium   | All           | SOAP leaks a few bytes of memory. Needs a SOAP endpoint or client that handles untrusted input.                                                                                                                                                   |
| [CVE-2026-129506](https://github.com/php/php-src/security/advisories/GHSA-4646-p932-gw34) | Medium   | All           | SOAP use-after-free that crashes the worker. Needs untrusted SOAP XML, WSDL or schema input.                                                                                                                                                      |
| [CVE-2026-129501](https://github.com/php/php-src/security/advisories/GHSA-x8r7-mg3g-74hg) | Medium   | 8.4, 8.5      | Double free that crashes the worker. Needs `saveXml()` on an untrusted `Dom\XMLDocument` or `Dom\HTMLDocument`.                                                                                                                                   |
| [CVE-2026-129438](https://github.com/php/php-src/security/advisories/GHSA-mg3p-mxj9-g2mm) | Medium   | 8.5           | `Uri\Rfc3986\Uri` returns a wrong string for a URI of about 2 GiB.                                                                                                                                                                                |

PHP 8.5.13 also updates its bundled uriparser to 1.0.3 for CVE-2026-48841. That fix has no php-src advisory.

CVE-2026-115560, the session upload progress issue, is in the list. The section on `session.upload_progress.enabled` covers what it means now.

php.net announced PHP 8.6.0 later on 19 November. The section on PHP 8.6 has the details.

If php.net publishes more detail, I'll update this page and the date at the top will change.

## Am I affected?

Every supported version got fixes, so update in the normal way. Each critical issue needs a particular setup, listed in the table above. Check these four first.

- **Your own `session_start()` calls.** Three critical issues need PHP's native sessions: CVE-2026-126714, CVE-2026-115560 and CVE-2026-129481. Most plain PHP apps and many CMSs use native sessions, usually with the default `files` handler. If your app does, these three are the reason to update today.
- **PHP 8.5 with `zend.exception_ignore_args=0`.** That's CVE-2026-129474. An attack needs a request path that reaches a `__call()` or `__callStatic()` method, and most frameworks and many libraries have one. `php.ini-production` sets `zend.exception_ignore_args=1`, which blocks it. PHP's built-in default is 0, and the official Docker image loads no `php.ini` unless you copy one in. I ran `php:8.5-fpm` with no changes, and it reported 0.
- **A front end that keeps FastCGI connections open.** That's CVE-2026-129289, and it needs no unusual PHP setting. Look for `fastcgi_keep_conn on` in nginx or `enablereuse=on` in Apache.
- **A PHP startup warning written to an error log file.** That's CVE-2026-129496. An invalid `date.timezone` or a deprecated session setting is enough.

Check the settings in the PHP that serves requests, not the CLI:

```bash
php-fpm8.5 -i | grep -E 'exception_ignore_args|fatal_error_backtraces|error_log|upload_progress.enabled'
sudo nginx -T | grep fastcgi_keep_conn
```

If you're on PHP 8.5 and can't update today, set `zend.exception_ignore_args = 1` in `php.ini` or the FPM pool and restart the workers. The advisory gives this as the workaround for CVE-2026-129474.

The bigger risk is October's release. If you haven't installed PHP 8.2.35, 8.3.36, 8.4.27 or 8.5.12, you're still exposed to php2shell. That's two critical bugs that allow unauthenticated remote code execution, [CVE-2026-109618](https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w) and [CVE-2026-109619](https://github.com/php/php-src/security/advisories/GHSA-6wmf-4rv5-p3rp). php.net named PHP-FPM, Apache with mod_php, php-cgi, FrankenPHP and LiteSpeed as at risk, with mod_php the highest ([advisory, 21 October](https://www.php.net/archive/2026.php#2026-10-21-5)). CISA added both bugs to its Known Exploited Vulnerabilities catalogue on 26 October ([CISA alert](https://www.cisa.gov/news-events/alerts/2026/10/21/critical-vulnerabilities-php-require-immediate-patching)).

PHP 8.1 and older no longer receive updates from the PHP project. For php2shell, php.net also published minimal source backports for 7.4, 8.0 and 8.1, for people who build PHP themselves. Otherwise you depend on your distro or an LTS vendor.

## How do I check which PHP version my server actually runs?

Check the PHP that serves web requests, not only the CLI. They're separate binaries, and on a server with several PHP versions installed they can differ.

- **Command line.** `php -v` shows the CLI version.
- **PHP-FPM.** Run the FPM binary for your version, for example `php-fpm8.4 -v`. You can also add a temporary `phpinfo()` page, read it, and then delete it.
- **composer.json.** The `require.php` line is a constraint. It doesn't tell you what's running.
- **Hosting panels.** If a control panel or server management service patches PHP for you, check the version on the server afterwards, not only in the panel.
- **Docker.** An image tag like `php:8.4-fpm` doesn't update itself. Pull and rebuild the PHP Docker image, then confirm the version from the image itself.
- **Distro packages.** To check the PHP version on Ubuntu or Debian, use `apt policy`. On Red Hat and Fedora, use `dnf info`. Distros often backport fixes without changing the upstream version number, so check your vendor's security tracker for the CVE. Debian, Ubuntu and Red Hat all have one.

```bash
php -v
php-fpm8.4 -v
apt policy php8.4-fpm
docker run --rm php:8.4-fpm php -v
```

When php2shell landed, I flagged it to my client's team on release day. On my own server the OS packages couldn't deliver the fix, so I built a containerised PHP-FPM 8.4.27 the same day and moved three production sites onto it with no downtime and a tested rollback. There's more about that on the [security review page](/app-security-review).

## How do I update to the patched release?

Update the package or image, restart every PHP worker, then check the version again.

1. Update the PHP package, use your hosting panel's update option, or rebuild the Docker image.
2. Restart PHP-FPM or the web server.
3. Restart queue workers, daemons and other long-running PHP processes. They keep the old binary until they restart.
4. Check `php -v` and the version your web server reports.
5. Run your test suite and watch the logs.

```bash
sudo systemctl restart php8.4-fpm
```

If Supervisor or systemd runs your workers, restart them through it. A patch release inside a branch, such as moving to a later 8.4 release, doesn't need code changes in normal cases. Treat it like any other PHP security update.

## Should I turn off `session.upload_progress.enabled`?

On 23 October php.net suggested setting `session.upload_progress.enabled=0` until the next regular bugfix release, to block an unlikely remote code execution path ([advisory, 23 October](https://www.php.net/archive/2026.php#2026-10-23-1)). The 19 November release fixes that issue as [CVE-2026-115560](https://github.com/php/php-src/security/advisories/GHSA-658j-r8rw-q6mx). It also turns session upload progress off by default, and it rejects runtime changes to session settings while upload progress is on.

After you update, you don't need to change anything unless your configuration turns upload progress on explicitly. An explicit `session.upload_progress.enabled = 1` overrides the new default. The fix also doesn't make separate configurations use the same serializer. If you keep upload progress on, every app, pool and CLI job that reads that session store must use the same `session.serialize_handler`.

The issue needs an unusual setup. Session data written with one serializer, `php_binary` or `php_serialize`, has to be read with `php`. That happens when an app switches the handler with `ini_set()` before calling `session_start()`. It also happens when two apps, pools or CLI jobs with different settings share one session store. Code execution needs a suitable gadget chain too, and the reporters used Guzzle and Monolog. The same setting was already a listed mitigation for CVE-2026-109619 and is one for CVE-2026-126714.

Few apps use upload progress. The feature stores the progress of a file upload in the PHP session. Before you turn it off, check that nothing in your app or your packages uses it. Set it in `php.ini` or the FPM pool, not with `ini_set()` or `.user.ini`, then restart every worker:

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

Some distros and LTS vendors offer extended support for PHP after its end of support. That support covers PHP itself, not your framework, CMS or Composer packages. Check their support dates too.

## Why does staying on PHP 8.2 carry more risk now?

Researchers now find serious runtime bugs faster, and attackers turn them into working exploits faster. A PHP version that no longer gets fixes is exposed sooner.

php2shell is an example. OpenAI says [Calif found a critical flaw using GPT-5.6 Sol](https://openai.com/index/coordinated-disclosure-of-critical-vulnerabilities/), as part of OpenAI's Patch the Planet programme, and that Wiz independently found and reported both bugs. Amazon [recorded an exploitation attempt dated 17 October](https://aws.amazon.com/blogs/security/amazon-threat-intelligence-identifies-php2shell-exploitation-prior-to-public-disclosure-in-madpot/), four days before the fixes were public. CISA listed both bugs as known exploited on 26 October.

It isn't only PHP. On 21 October, the day of the PHP fixes, Node.js fixed an out-of-bounds write in its bundled Brotli decoder, [CVE-2026-111497](https://nodejs.org/en/blog/vulnerability/october-2026-security-releases), and its advisory credits OpenAI Codex Security with the report. Andi Gutmans, one of PHP's original co-authors, [made this point on 18 November](https://x.com/andigutmans/status/2123100688385523903). His view is that the pattern is showing up across runtimes, not in PHP alone.

The gap between a fix and a working exploit is getting shorter. The PHP that serves production often lags behind php.net, on managed servers, in Docker images and in distro packages. That's why I check what's running, as in the section on checking your version. On PHP 8.2 after 31 December, there won't be a fix to apply at all.

## Should I upgrade PHP 8.2 to 8.4 or 8.5?

PHP 8.5 gets security fixes for a year longer, until 31 December 2029, so I'd aim for 8.5 unless a package you depend on doesn't support it yet. If one doesn't, 8.4 is supported until 31 December 2028. Check your Composer packages first.

1. Check that your framework or CMS supports the target PHP version.
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

On a server that runs several PHP versions, install 8.4 or 8.5 next to 8.2, then switch each site to it. With Docker, change the base image tag and rebuild.

## What about PHP 8.6?

php.net [announced PHP 8.6.0](https://www.php.net/archive/2026.php#2026-11-19-5) on 19 November 2026. It's new, so I wouldn't move production onto it the same week. Wait until your packages and your hosting support it. Wait for the first patch releases too. If you're leaving 8.2 now, move to 8.4 or 8.5.

My [PHP 8.6 for Laravel article](/articles/php-8-6-laravel) covers what's new in 8.6, what might break, and how to check whether an app is ready.

## What should Laravel users check?

Everything above applies to Laravel apps. These checks are specific to Laravel.

- **Sessions.** Laravel's session drivers don't call `session_start()`. The three native session issues apply only if other code in your app calls it.
- **PHP 8.5 and facades.** The CVE-2026-129474 advisory names Laravel facades as a potentially relevant path, because facades use `__callStatic()`. The advisory also says no one has shown an attack on a complete Laravel app. Check `zend.exception_ignore_args` in the PHP that serves requests.
- **`php artisan about`.** The command shows the PHP and Laravel versions, but the PHP version it reports is the CLI one.
- **Laravel Forge.** Each PHP version on a Forge server runs its own FPM process. You patch a version from the server's **Runtime** tab ([Forge docs](https://laravel.com/forge/docs/servers/php)). Check the version on the server after you patch it. To upgrade, install PHP 8.4 or 8.5 on the server, then switch each site to it.
- **Workers.** Queue workers, Horizon and Octane keep the old PHP binary until they restart.

```bash
php artisan queue:restart
php artisan horizon:terminate
```

Run these commands only if you use queues or Horizon, and only if a process manager such as Supervisor starts the workers again. If you run Octane, stop and start it through your process manager.

Laravel's own support dates matter as much as PHP's. From Laravel's [support policy](https://laravel.com/docs/13.x/releases):

| Laravel | PHP        | Security fixes until |
| ------- | ---------- | -------------------- |
| 11      | 8.2 to 8.4 | 12 March 2026        |
| 12      | 8.2 to 8.5 | 24 February 2027     |
| 13      | 8.3 to 8.5 | 17 March 2028        |

An app on Laravel 11 hasn't had framework security fixes since 12 March 2026, and it can't move past PHP 8.4. Laravel 12 and 13 both run on PHP 8.4 and 8.5. Extended PHP support from a distro or LTS vendor doesn't cover Laravel.

## When should I get help?

Get help if you can't tell what's actually running, if your packages block an upgrade, or if you're on PHP 8.2 or 8.1 with no one to do the upgrade.

The [PHP patch and upgrade check](/app-security-review#php-patch-check) covers the first two and gives you a written plan. If something then needs fixing, [app rescue](/services/app-rescue) covers the fix work. All the services are listed on the [services page](/services).
