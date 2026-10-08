## Laravel Crisp

### Overview
Renders the Crisp script in Blade layouts. The settings are stored in the database with `spatie/laravel-settings` (`CrispSettings`, group `crisp`) — no config file, no `.env`.

### Usage

@verbatim
<code-snippet name="blade-include" lang="blade">
@include('crisp::script')
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="configure" lang="php">
$settings = crisp_settings();
$settings->website_id = '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b';
$settings->save();
</code-snippet>
@endverbatim

### Conventions
- Namespace: `JeffersonGoncalves\Crisp`; view namespace `crisp` (`crisp::script`)
- The script renders only when `CrispSettings::shouldRender()` is true
- Publish migrations with `php artisan vendor:publish --tag=crisp-settings-migrations`
