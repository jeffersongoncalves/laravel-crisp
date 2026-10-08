<?php

namespace JeffersonGoncalves\Crisp;

use Illuminate\Support\Facades\Config;
use JeffersonGoncalves\Crisp\Settings\CrispSettings;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CrispServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-crisp')
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        Config::set('settings.settings', array_merge(
            Config::get('settings.settings', []),
            [CrispSettings::class]
        ));
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $settingsMigrationsPath = __DIR__.'/../database/settings';

        Config::set('settings.migrations_paths', array_merge(
            [$settingsMigrationsPath],
            Config::get('settings.migrations_paths', [])
        ));

        $this->publishes([
            $settingsMigrationsPath => database_path('settings'),
        ], 'crisp-settings-migrations');
    }
}
