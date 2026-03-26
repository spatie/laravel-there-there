<?php

namespace Spatie\ThereThere\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThereThereRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [];
    }

    public function email(): string
    {
        return $this->input('email', '');
    }
}
