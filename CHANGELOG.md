# Changelog

All notable changes to `laravel-crisp` will be documented in this file.

## 1.0.0 - 2026-10-08

First release.

- `@include('crisp::script')` renders the Crisp chat widget once the settings are complete
- `CrispSettings` stored with spatie/laravel-settings, validated before rendering
- `identify_users`: sends the signed-in user's name and email to the chat
- `only_when_open`: hides the chat outside the jeffersongoncalves/laravel-open-hours schedule
- `Crisp` facade and `crisp_settings()` helper

Requires PHP 8.2+ and Laravel 12.61+ or 13.
