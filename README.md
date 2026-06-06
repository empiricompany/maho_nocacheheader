# Maho NoCacheHeader

![Maho Commerce](https://img.shields.io/badge/Maho_Commerce-module-orange)
![License](https://img.shields.io/badge/license-OSL--3.0-blue)
![PHP](https://img.shields.io/badge/php-%3E%3D8.3-8892BF)
![PHPStan Level](https://img.shields.io/badge/PHPStan-level%208-brightgreen)

A Maho module that sends `Cache-Control: no-store, no-cache, must-revalidate` and `Pragma: no-cache` headers on all frontend pages. Configurable via admin.

## When to use this module

Maho supports the browser's back-forward cache (bfcache) natively via the `pageshow` JavaScript event (see [PR #991](https://github.com/MahoCommerce/maho/pull/991)). This is the recommended approach: pages are served from bfcache for instant navigation, and the `pageshow` handler refreshes dynamic content (cart sidebar, checkout state) when the page is restored.

This module is intended for **custom or legacy themes** that do not implement the `pageshow` event (or equivalent client-side logic) and need to prevent stale dynamic content by disabling bfcache on the server side via `Cache-Control: no-store`.

## Requirements

- PHP >= 8.3
- Maho Commerce

## Installation

```bash
composer require empiricompany/maho-nocacheheader
```

Clear the cache after installation:

```bash
./maho cache:flush
```

## Configuration

Go to *System → Configuration → Web → Cache-Control Header* and set *Add Cache-Control: no-store, no-cache, must-revalidate and Pragma: no-cache headers* to **Yes**.

The setting applies to frontend only — admin panel is not affected.

## Development

This module ships with the standard Maho CI gates:

- **PHPStan** (level 8) — `vendor/bin/phpstan analyze`
- **Rector** (dry-run) — `vendor/bin/rector -c .rector.php --dry-run`
- **PHP CS Fixer** (dry-run) — `vendor/bin/php-cs-fixer fix --dry-run`
- **PHP / XML syntax checks** — automatic on CI

Run `composer install` and you can execute any of the above locally before pushing.

## License

OSL-3.0 / AFL-3.0
