<?php

namespace App\Responses;

class ErrorResponse extends BaseResponse
{
    protected int $httpStatus = 422;

    /* @var string[] $errors */
    protected array $errors = [];

    /**
     * @param string[] $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    protected function getPayload(): array
    {
        return ['errors' => $this->errors];
    }
}
