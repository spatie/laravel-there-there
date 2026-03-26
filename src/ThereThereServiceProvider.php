<?php

namespace Spatie\ThereThere;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\ThereThere\Http\Controllers\ThereThereController;

class ThereThereServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('there-there')
            ->hasConfigFile();
    }

    public function registeringPackage(): void
    {
        $this->app->scoped(ThereThere::class);
    }

    public function bootingPackage(): void
    {
        $url = config('there-there.url');

        if ($url) {
            Route::post($url, ThereThereController::class)
                ->middleware(config('there-there.middleware'));
        }
    }
}
