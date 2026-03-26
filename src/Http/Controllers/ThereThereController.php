<?php

namespace Spatie\ThereThere\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Spatie\ThereThere\Http\Requests\ThereThereRequest;
use Spatie\ThereThere\SidebarItem;
use Spatie\ThereThere\ThereThere;

class ThereThereController
{
    public function __invoke(ThereThereRequest $request, ThereThere $thereThere): JsonResponse
    {
        $items = $thereThere->sidebarItems($request);

        $data = collect($items)
            ->map(fn (SidebarItem $item) => $item->toArray())
            ->all();

        return response()->json(['data' => $data]);
    }
}
