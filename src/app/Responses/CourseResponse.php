<?php

namespace App\Responses;

use App\Transformers\CourseTransformer;
use App\Transformers\TransformerInterface;

class CourseResponse extends EntityResponse
{
    /**
     * @return class-string<TransformerInterface>
     */
    protected function getTransformerClass(): string
    {
        return CourseTransformer::class;
    }
}
