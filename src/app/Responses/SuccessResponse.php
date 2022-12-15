<?php

namespace App\Responses;

class SuccessResponse extends BaseResponse
{
    protected array $payload = [];

    /**
     * @param array $payload
     */
    public function __construct(array $payload = [])
    {
        $this->payload = $payload;
    }

    /**
     * @return array[]
     */
    protected function getPayload(): array
    {
        return ['data' => $this->payload];
    }
}
