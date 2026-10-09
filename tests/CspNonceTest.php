<?php

use Illuminate\Support\Facades\Vite;

it('stamps the CSP nonce on every script tag', function () {
    Vite::useCspNonce('test-nonce');
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);
    $html = (string) $this->blade('@include("crisp::script")');

    preg_match_all('/<script\b[^>]*>/', $html, $tags);

    expect($tags[0])->not->toBeEmpty()->each->toContain('nonce="test-nonce"');
});

it('renders no nonce attribute when the app uses none', function () {
    crisp(['website_id' => '3f2b8c1e-7a4d-4e5f-9b6a-1c2d3e4f5a6b']);
    $html = (string) $this->blade('@include("crisp::script")');

    expect($html)->toContain('<script')->not->toContain('nonce=');
});
