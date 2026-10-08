<?php

use JeffersonGoncalves\Crisp\Settings\CrispSettings;

if (! function_exists('crisp_settings')) {
    function crisp_settings(): CrispSettings
    {
        return app(CrispSettings::class);
    }
}
