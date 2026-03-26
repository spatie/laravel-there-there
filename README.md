# Expose application data as JSON for There There

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-there-there.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-there-there)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-there-there/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/laravel-there-there/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-there-there.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-there-there)

This package makes it easy to expose application data to [There There](https://there-there.app). When a customer opens a ticket in There There, it will call your application to fetch relevant data and display it in the sidebar.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-there-there.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-there-there)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-there-there
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="there-there-config"
```

This is the contents of the published config file:

```php
return [
    'secret' => env('THERE_THERE_SECRET'),
    'url' => '/there-there',
    'middleware' => [
        Spatie\ThereThere\Http\Middleware\IsValidThereThereRequest::class,
        'api',
    ],
];
```

Add the secret to your `.env` file. You can find it in your There There workspace settings.

```
THERE_THERE_SECRET=your-secret-here
```

## Usage

In a service provider (for example `AppServiceProvider`), register a sidebar callback using the `ThereThere` facade:

```php
use Spatie\ThereThere\Facades\ThereThere;
use Spatie\ThereThere\SidebarItem;
use Spatie\ThereThere\Http\Requests\ThereThereRequest;

ThereThere::sidebar(function (ThereThereRequest $request) {
    $user = User::firstWhere('email', $request->email());

    if (! $user) {
        return [];
    }

    return [
        SidebarItem::markdown('Name', $user->name),
        SidebarItem::date('Registered at', $user->created_at),
        SidebarItem::numeric('Total orders', $user->orders()->count()),
        SidebarItem::boolean('Is subscribed', $user->subscribed()),
    ];
});
```

Each `SidebarItem` has a name, value, and type. The following types are available:

| Type | Method | Value |
|------|--------|-------|
| `numeric` | `SidebarItem::numeric($name, $value)` | An integer or float |
| `markdown` | `SidebarItem::markdown($name, $value)` | A string (supports Markdown) |
| `date` | `SidebarItem::date($name, $value)` | A `DateTimeInterface` or ISO 8601 string |
| `boolean` | `SidebarItem::boolean($name, $value)` | A boolean |

The package will respond with JSON in this format:

```json
{
    "data": [
        {"name": "Name", "value": "John Doe", "type": "markdown"},
        {"name": "Registered at", "value": "2024-01-15T10:30:00+00:00", "type": "date"},
        {"name": "Total orders", "value": 42, "type": "numeric"},
        {"name": "Is subscribed", "value": true, "type": "boolean"}
    ]
}
```

## Security

All requests are verified using HMAC-SHA256 signatures. The package will reject any request without a valid `X-There-There-Signature` header.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
