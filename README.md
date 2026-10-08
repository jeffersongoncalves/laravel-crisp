<div class="filament-hidden">

![Laravel Crisp](https://raw.githubusercontent.com/jeffersongoncalves/laravel-crisp/main/art/jeffersongoncalves-laravel-crisp.png)

</div>

# Laravel Crisp

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-crisp.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-crisp)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-crisp/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/laravel-crisp/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-crisp.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-crisp)

Add [Crisp](https://crisp.chat) — live chat widget for customer support — to your Laravel app. The settings are stored in the database with [spatie/laravel-settings](https://github.com/spatie/laravel-settings), so you can change them at runtime (e.g. from an admin panel) instead of in `.env`.

For a Filament settings page, use [jeffersongoncalves/filament-crisp](https://github.com/jeffersongoncalves/filament-crisp).

## Installation

```bash
composer require jeffersongoncalves/laravel-crisp
```

Publish and run the settings migration:

```bash
php artisan vendor:publish --tag=crisp-settings-migrations
php artisan migrate
```

## Configuration

```php
$settings = crisp_settings();
$settings->website_id = '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b';
$settings->save();
```

Or through the settings class or the Facade:

```php
use JeffersonGoncalves\Crisp\Facades\Crisp;
use JeffersonGoncalves\Crisp\Settings\CrispSettings;

$settings = app(CrispSettings::class);
$value = Crisp::getFacadeRoot()->website_id;
```

### Available settings

| Setting | Type | Default | Description |
|---------|------|---------|-------------|
| `website_id` | `?string` | `null` | Your Crisp website id. The script only renders when it is valid. |
| `identify_users` | `bool` | `false` | Send the signed-in user's name and email to the chat. |
| `only_when_open` | `bool` | `false` | Hide the chat while [laravel-open-hours](https://github.com/jeffersongoncalves/laravel-open-hours) says you're closed (ignored when it isn't installed). |

### Identify users and opening hours

- `identify_users`: sends the signed-in user's name and email to Crisp, so your agents see who they're talking to. Leave it off on pages served from a shared full-page cache.
- `only_when_open`: with [jeffersongoncalves/laravel-open-hours](https://github.com/jeffersongoncalves/laravel-open-hours) installed, the widget is only rendered while you're open.

```bash
composer require jeffersongoncalves/laravel-open-hours
```

## Usage

Add the script to your Blade layout, right before `</body>`:

```blade
@include('crisp::script')
```

Nothing is rendered until the settings are complete, so you can ship the include everywhere and turn Crisp on later.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
