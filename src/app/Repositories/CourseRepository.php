<?php

namespace App\Repositories;

use App\Entities\Course;

class CourseRepository extends DoctrineRepository implements CourseRepositoryInterface
{
    protected string $entity = Course::class;

    /**
     * @param int $id
     * @return Course|null
     */
    public function findById(int $id): ?Course
    {
        /* @var Course[] $results */
        $results = $this->getById($id);

        if (count($results) === 0) {
            return null;
        }

        return $results[0];
    }

    /**
     * @return class-string<Course>
     */
    protected function getEntityClass(): string
    {
        return Course::class;
    }
}
