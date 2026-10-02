<?php

namespace App\Http\Requests\Traits;

use Illuminate\Validation\Rule;

trait HasActivityRules
{
    public function activityRules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required', 'string', 'max:30', Rule::unique('activities', 'code')->ignore($this->route()?->parameter('activity'))],
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'capacity' => ['required', 'integer', 'min:1', 'max:500'],
            'poster' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
