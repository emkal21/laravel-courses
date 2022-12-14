<?php

namespace App\Responses;

class EntityNotFoundResponse
{
    /**
     * @return array
     */
    public static function make(): array
    {
        return [
            'error' => [
                'message' => 'Entity not found.',
            ],
        ];
    }
}
