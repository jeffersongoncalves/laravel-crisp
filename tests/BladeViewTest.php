<?php

use Illuminate\Foundation\Auth\User;
use JeffersonGoncalves\OpenHours\OpenHours;

it('renders the Crisp script once configured', function () {
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);

    $this->blade('@include("crisp::script")')
        ->assertSee('client.crisp.chat/l.js', false)
        ->assertSee('\'3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b\'', false);
});

it('renders nothing while it is not configured', function () {
    crisp(['website_id' => null]);

    $this->blade('@include("crisp::script")')->assertDontSee('client.crisp.chat', false);
});

it('does not render an invalid value into the page', function () {
    crisp(['website_id' => 'x\'); alert(1); (\'']);

    $this->blade('@include("crisp::script")')
        ->assertDontSee('client.crisp.chat', false)
        ->assertDontSee('alert(1)', false);
});

it('identifies the signed-in user when enabled', function () {
    crisp([...['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b'], 'identify_users' => true]);
    $this->actingAs((new User)->forceFill(['id' => 1, 'name' => 'Ada Lovelace', 'email' => 'ada@example.com']));

    $this->blade('@include("crisp::script")')
        ->assertSee("'ada@example.com'", false)
        ->assertSee("'Ada Lovelace'", false);
});

it('does not send the user when identification is off', function () {
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);
    $this->actingAs((new User)->forceFill(['id' => 1, 'name' => 'Ada Lovelace', 'email' => 'ada@example.com']));

    $this->blade('@include("crisp::script")')->assertDontSee('ada@example.com', false);
});

it('hides the chat outside opening hours when only_when_open is on', function () {
    crisp([...['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b'], 'only_when_open' => true]);
    $this->mock(OpenHours::class, fn ($mock) => $mock->shouldReceive('isOpen')->andReturn(false));

    $this->blade('@include("crisp::script")')->assertDontSee('client.crisp.chat', false);
});

it('shows the chat during opening hours when only_when_open is on', function () {
    crisp([...['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b'], 'only_when_open' => true]);
    $this->mock(OpenHours::class, fn ($mock) => $mock->shouldReceive('isOpen')->andReturn(true));

    $this->blade('@include("crisp::script")')->assertSee('client.crisp.chat', false);
});
