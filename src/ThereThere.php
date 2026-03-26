<?php

namespace Spatie\ThereThere;

use Closure;
use Spatie\ThereThere\Http\Requests\ThereThereRequest;

class ThereThere
{
    protected ?Closure $sidebarClosure = null;

    public function sidebar(Closure $closure): self
    {
        $this->sidebarClosure = $closure;

        return $this;
    }

    /** @return array<int, SidebarItem> */
    public function sidebarItems(ThereThereRequest $request): array
    {
        if (! $this->sidebarClosure) {
            return [];
        }

        return ($this->sidebarClosure)($request);
    }
}
