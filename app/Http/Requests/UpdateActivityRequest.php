<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\HasActivityRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    use HasActivityRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->activityRules();
    }
}
