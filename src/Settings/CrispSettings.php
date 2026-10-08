<?php

namespace JeffersonGoncalves\Crisp\Settings;

use JeffersonGoncalves\OpenHours\OpenHours;
use Spatie\LaravelSettings\Settings;

class CrispSettings extends Settings
{
    /** Crisp website id. Empty = no script. */
    public ?string $website_id;

    /** Send the signed-in user's name and email to the chat. */
    public bool $identify_users;

    /** Render only while laravel-open-hours says the business is open. */
    public bool $only_when_open;

    public static function group(): string
    {
        return 'crisp';
    }

    /** Whether the settings are complete enough to render the script. */
    public function isConfigured(): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', (string) $this->website_id) === 1;
    }

    /** Configured, and — with only_when_open and jeffersongoncalves/laravel-open-hours installed — open right now. */
    public function shouldRender(): bool
    {
        if (! $this->isConfigured()) {
            return false;
        }

        if ($this->only_when_open && class_exists(OpenHours::class)) {
            return app(OpenHours::class)->isOpen();
        }

        return true;
    }
}
