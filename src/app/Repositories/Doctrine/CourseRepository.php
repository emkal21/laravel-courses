<?php

namespace App\Repositories\Doctrine;

use App\Entities\Course;
use App\Repositories\CourseRepositoryInterface;

class CourseRepository extends AbstractRepository implements CourseRepositoryInterface
{
    protected string $entity = Course::class;

    /**
     * @param int $id
     * @return Course|null
     */
    public function findById(int $id): ?Course
    {
        $results = $this->getById($id);

        if (count($results) === 0) {
            return null;
        }

        return $results[0];
    }
}
