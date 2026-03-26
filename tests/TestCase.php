<?php

namespace Spatie\ThereThere\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\ThereThere\ThereThereServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ThereThereServiceProvider::class,
        ];
    }
}
