---
name: crisp-development
description: Add Crisp to a Laravel app with jeffersongoncalves/laravel-crisp — Blade include, settings stored in the database via spatie/laravel-settings.
---

# Laravel Crisp Development

## When to use this skill

- Adding Crisp to a Laravel / Blade app
- Changing the Crisp settings at runtime (admin panel, seeder, tinker)
- Debugging why the Crisp script doesn't show up

## Setup

```bash
composer require jeffersongoncalves/laravel-crisp
php artisan vendor:publish --tag=crisp-settings-migrations
php artisan migrate
```

```blade
@include('crisp::script')
```

```php
$settings = crisp_settings();
$settings->website_id = '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b';
$settings->save();
```

## Settings

| Setting | Type | Default |
|---------|------|---------|
| `website_id` | `?string` | `null` |
| `identify_users` | `bool` | `false` |
| `only_when_open` | `bool` | `false` |

## Troubleshooting

- **No script in the HTML**: the settings are incomplete or invalid — check `crisp_settings()->isConfigured()`.
- **Settings not found**: run the settings migration (`php artisan migrate` after publishing).
- **Filament panel**: use `jeffersongoncalves/filament-crisp`, which injects the same view into panels and adds a settings page.
