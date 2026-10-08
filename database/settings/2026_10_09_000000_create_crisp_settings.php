<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('crisp.website_id', null);
        $this->migrator->add('crisp.identify_users', false);
        $this->migrator->add('crisp.only_when_open', false);
    }
};
