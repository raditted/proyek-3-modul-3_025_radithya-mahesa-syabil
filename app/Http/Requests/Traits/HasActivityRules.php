<?php

namespace App\Http\Requests\Traits;

use Illuminate\Validation\Rule;

trait HasActivityRules
{
    public function activityRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'activity_date' => ['required', 'date'],
            'category' => ['required', 'string', 'max:50'],
            'status' => [
                'required',
                Rule::in(['Planned', 'Ongoing', 'Done']),
            ],
        ];
    }
}
