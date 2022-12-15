<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

abstract class BaseResponse
{
    protected int $httpStatus = 200;

    /**
     * @return JsonResponse
     */
    public function send(): JsonResponse
    {
        return response()->json($this->getPayload(), $this->httpStatus);
    }

    /**
     * @return array
     */
    abstract protected function getPayload(): array;
}
