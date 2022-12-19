<?php

namespace App\Repositories;

use App\Entities\Course;

class CourseRepository extends DoctrineRepository implements CourseRepositoryInterface
{
    protected string $entity = Course::class;

    /**
     * @return class-string<Course>
     */
    protected function getEntityClass(): string
    {
        return Course::class;
    }
}
