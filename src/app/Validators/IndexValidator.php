<?php

namespace App\Validators;

class IndexValidator extends BaseValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'page' => ['integer', 'min:1'],
            'items_per_page' => ['integer', 'min:1', 'max:100'],
        ];
    }
}
