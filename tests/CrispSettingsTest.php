<?php

use JeffersonGoncalves\Crisp\Facades\Crisp;
use JeffersonGoncalves\Crisp\Settings\CrispSettings;

it('can resolve CrispSettings from the container', function () {
    expect(app(CrispSettings::class))->toBeInstanceOf(CrispSettings::class);
});

it('is not configured by default', function () {
    expect(app(CrispSettings::class)->isConfigured())->toBeFalse();
});

it('can update and persist settings', function () {
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);

    expect(app(CrispSettings::class)->isConfigured())->toBeTrue()
        ->and(app(CrispSettings::class)->website_id)->toBe('3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b');
});

it('belongs to the crisp group', function () {
    expect(CrispSettings::group())->toBe('crisp');
});

it('can be accessed via the helper function', function () {
    expect(crisp_settings())->toBeInstanceOf(CrispSettings::class);
});

it('reads a persisted value through the Facade', function () {
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);

    expect(Crisp::getFacadeRoot()->website_id)->toBe('3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b');
});
