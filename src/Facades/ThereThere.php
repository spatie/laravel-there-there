<?php

namespace Spatie\ThereThere\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Spatie\ThereThere\ThereThere sidebar(\Closure $closure)
 *
 * @see \Spatie\ThereThere\ThereThere
 */
class ThereThere extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Spatie\ThereThere\ThereThere::class;
    }
}
