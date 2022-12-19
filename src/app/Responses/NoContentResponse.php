<?php

namespace App\Responses;

class NoContentResponse extends BaseResponse
{
    protected int $httpStatus = 204;

    /**
     * @return array
     */
    protected function getPayload(): array
    {
        return ['success' => true];
    }
}
