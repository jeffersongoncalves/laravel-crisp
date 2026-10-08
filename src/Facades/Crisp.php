<?php

namespace JeffersonGoncalves\Crisp\Facades;

use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\Crisp\Settings\CrispSettings;

/**
 * @property ?string $website_id
 * @property bool $identify_users
 * @property bool $only_when_open
 *
 * @see CrispSettings
 */
class Crisp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CrispSettings::class;
    }
}
