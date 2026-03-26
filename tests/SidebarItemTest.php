<?php

use Carbon\Carbon;
use Spatie\ThereThere\Enums\SidebarItemType;
use Spatie\ThereThere\SidebarItem;

it('can create a numeric item', function () {
    $item = SidebarItem::numeric('Total orders', 42);

    expect($item->toArray())->toBe([
        'name' => 'Total orders',
        'value' => 42,
        'type' => 'numeric',
    ]);
});

it('can create a markdown item', function () {
    $item = SidebarItem::markdown('Notes', '**Important** customer');

    expect($item->toArray())->toBe([
        'name' => 'Notes',
        'value' => '**Important** customer',
        'type' => 'markdown',
    ]);
});

it('can create a date item from a string', function () {
    $item = SidebarItem::date('Registered at', '2024-01-15T10:30:00+00:00');

    expect($item->toArray())->toBe([
        'name' => 'Registered at',
        'value' => '2024-01-15T10:30:00+00:00',
        'type' => 'date',
    ]);
});

it('can create a date item from a DateTimeInterface', function () {
    $date = Carbon::parse('2024-01-15 10:30:00', 'UTC');
    $item = SidebarItem::date('Registered at', $date);

    expect($item->toArray())
        ->name->toBe('Registered at')
        ->type->toBe('date')
        ->and($item->value)->toContain('2024-01-15');
});

it('can create a boolean item', function () {
    $item = SidebarItem::boolean('Is subscribed', true);

    expect($item->toArray())->toBe([
        'name' => 'Is subscribed',
        'value' => true,
        'type' => 'boolean',
    ]);
});

it('can create an item with the constructor', function () {
    $item = new SidebarItem('Custom', 'value', SidebarItemType::Markdown);

    expect($item->toArray())->toBe([
        'name' => 'Custom',
        'value' => 'value',
        'type' => 'markdown',
    ]);
});
