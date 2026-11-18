# Changelog

All notable changes to `laravel-crisp` will be documented in this file.

## 1.2.0 - 2026-11-17

### Cookie consent

With [laravel-cookie-consent](https://github.com/jeffersongoncalves/laravel-cookie-consent) 4.6+ installed and `block_scripts` on, the scripts wait until the visitor allows their cookie category (rendered as `type="text/plain" data-category="…"`, run with their CSP nonce once allowed). Nothing changes without it: this package still does not require laravel-cookie-consent.

## 1.1.0 - 2026-10-09

- Every `<script>` rendered by the package carries Laravel's Vite CSP nonce when the app sets one (e.g. via laravel-security-headers), so nonce-based `script-src` policies work without `'unsafe-inline'`.

## 1.0.0 - 2026-10-08

First release.

- `@include('crisp::script')` renders the Crisp chat widget once the settings are complete
- `CrispSettings` stored with spatie/laravel-settings, validated before rendering
- `identify_users`: sends the signed-in user's name and email to the chat
- `only_when_open`: hides the chat outside the jeffersongoncalves/laravel-open-hours schedule
- `Crisp` facade and `crisp_settings()` helper

Requires PHP 8.2+ and Laravel 12.61+ or 13.
