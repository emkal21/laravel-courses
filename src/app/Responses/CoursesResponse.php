<?php

namespace App\Responses;

use App\Transformers\CourseTransformer;
use App\Transformers\TransformerInterface;

class CoursesResponse extends EntitiesResponse
{
    /**
     * @return class-string<TransformerInterface>
     */
    protected function getTransformerClass(): string
    {
        return CourseTransformer::class;
    }
}
