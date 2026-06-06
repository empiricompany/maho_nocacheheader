# Maho NoCacheHeader

![Maho Commerce](https://img.shields.io/badge/Maho_Commerce-module-orange)
![License](https://img.shields.io/badge/license-OSL--3.0-blue)
![PHP](https://img.shields.io/badge/php-%3E%3D8.3-8892BF)
![PHPStan Level](https://img.shields.io/badge/PHPStan-level%208-brightgreen)

Adds `Cache-Control: no-cache, private` header globally on all frontend pages, restoring the default behavior from OpenMage. Configurable via admin.

Useful to prevent stale dynamic content (cart sidebar, checkout state) when the browser serves pages from bfcache (back-forward cache). With `no-cache` the browser can still use bfcache but must revalidate with the server on restore.

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

Go to *System → Configuration → Web → Cache-Control Header* and set *Add Cache-Control: no-cache, private header* to **Yes**.

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
