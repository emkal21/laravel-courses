<?php

namespace App\Responses;

class EntityNotFoundResponse extends ErrorResponse
{
    protected int $httpStatus = 404;

    protected string $message;

    /**
     * @param string $message
     */
    public function __construct(string $message = 'Entity not found.')
    {
        parent::__construct([$message]);
    }
}
