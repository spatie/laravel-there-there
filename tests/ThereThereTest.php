<?php

use Spatie\ThereThere\Facades\ThereThere;
use Spatie\ThereThere\SidebarItem;

it('returns items as json when the endpoint is called with a valid signature', function () {
    ThereThere::sidebar(function ($request) {
        return [
            SidebarItem::numeric('Total orders', 42),
            SidebarItem::boolean('Is VIP', true),
        ];
    });

    $payload = json_encode(['email' => 'john@example.com']);
    $signature = hash_hmac('sha256', $payload, 'test-secret');

    $this->postJson('/there-there', ['email' => 'john@example.com'], [
        'X-There-There-Signature' => $signature,
    ])->assertOk()->assertExactJson([
        'data' => [
            ['name' => 'Total orders', 'value' => 42, 'type' => 'numeric'],
            ['name' => 'Is VIP', 'value' => true, 'type' => 'boolean'],
        ],
    ]);
});

it('returns a 403 when the signature is missing', function () {
    $this->postJson('/there-there', ['email' => 'john@example.com'])
        ->assertForbidden();
});

it('returns a 403 when the signature is invalid', function () {
    $this->postJson('/there-there', ['email' => 'john@example.com'], [
        'X-There-There-Signature' => 'invalid-signature',
    ])->assertForbidden();
});

it('returns an empty array when no sidebar is registered', function () {
    $payload = json_encode(['email' => 'john@example.com']);
    $signature = hash_hmac('sha256', $payload, 'test-secret');

    $this->postJson('/there-there', ['email' => 'john@example.com'], [
        'X-There-There-Signature' => $signature,
    ])->assertOk()->assertExactJson(['data' => []]);
});

it('passes the email from the request to the sidebar closure', function () {
    $receivedEmail = null;

    ThereThere::sidebar(function ($request) use (&$receivedEmail) {
        $receivedEmail = $request->email();

        return [];
    });

    $payload = json_encode(['email' => 'john@example.com']);
    $signature = hash_hmac('sha256', $payload, 'test-secret');

    $this->postJson('/there-there', ['email' => 'john@example.com'], [
        'X-There-There-Signature' => $signature,
    ])->assertOk();

    expect($receivedEmail)->toBe('john@example.com');
});

beforeEach(function () {
    config()->set('there-there.secret', 'test-secret');
});
