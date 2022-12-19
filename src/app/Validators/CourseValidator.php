<?php

namespace App\Validators;

use App\Enums\CourseStatus;
use Illuminate\Validation\Rules\Enum;

class CourseValidator extends BaseValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'status' => ['required', 'string', new Enum(CourseStatus::class)],
            'is_premium' => ['required', 'boolean'],
        ];
    }
}
