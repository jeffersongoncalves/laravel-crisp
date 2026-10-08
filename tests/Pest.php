<?php

use JeffersonGoncalves\Crisp\Settings\CrispSettings;
use JeffersonGoncalves\Crisp\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Saves the given values on top of the stored Crisp settings.
 *
 * @param  array<string, mixed>  $values
 */
function crisp(array $values): CrispSettings
{
    $settings = app(CrispSettings::class);
    foreach ($values as $name => $value) {
        $settings->{$name} = $value;
    }
    $settings->save();

    return $settings;
}
