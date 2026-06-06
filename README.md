# Maho NoCacheHeader

![Maho Commerce](https://img.shields.io/badge/Maho_Commerce-module-orange)
![License](https://img.shields.io/badge/license-OSL--3.0-blue)
![PHP](https://img.shields.io/badge/php-%3E%3D8.3-8892BF)
![PHPStan Level](https://img.shields.io/badge/PHPStan-level%208-brightgreen)

Adds `Cache-Control: no-store, no-cache, must-revalidate` and `Pragma: no-cache` headers globally on all frontend pages, restoring the default behavior from OpenMage. Configurable via admin.

See the related issue: [#992 — Response send path bypasses Symfony's default Cache-Control; decide policy for dynamic GET/JSON responses](https://github.com/MahoCommerce/maho/issues/992)

## Why is this needed?

Maho uses a custom HTTP response layer that bypasses Symfony's header emission (see [issue #990](https://github.com/MahoCommerce/maho/issues/990)). Unlike OpenMage, Maho does not send any `Cache-Control` header by default. This causes two problems:

**1. Stale dynamic content on bfcache restore.** Modern browsers use the back-forward cache (bfcache) to instantly restore pages when navigating back. Without `Cache-Control: no-store`, pages are cached in bfcache and restored without revalidating with the server. If a user removes an item from the cart and navigates back, the sidebar still shows the old cart state.

**2. Missing conservative cache default.** Symfony's `ResponseHeaderBag::computeCacheControlValue()` normally injects `Cache-Control: no-cache, private` as a safe default. Since Maho bypasses Symfony's send path, this default is never applied, potentially exposing session-specific content to shared caches.

This module restores the OpenMage behavior by adding the appropriate headers. It may be required by custom themes that rely on dynamic content (cart sidebar, checkout state) and need to prevent stale data on browser back/forward navigation.

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
