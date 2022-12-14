<?php

namespace App\Responses;

use App\Entities\Course;
use App\Transformers\CourseTransformer;

abstract class CourseResponse
{
    /**
     * @param Course $course
     * @return array
     */
    public static function one(Course $course): array
    {
        return CourseTransformer::transform($course);
    }

    /**
     * @param Course[] $courses
     * @return array
     */
    public static function many(array $courses): array
    {
        return array_map(fn(Course $course): array => CourseTransformer::transform($course), $courses);
    }
}
