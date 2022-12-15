<?php

namespace App\Repositories;

use App\Entities\Course;

/**
 * @extends DoctrineRepositoryInterface<Course>
 */
interface CourseRepositoryInterface extends DoctrineRepositoryInterface
{
    /**
     * @param int $id
     * @return Course|null
     */
    public function findById(int $id): ?Course;
}
