<?php

namespace App\Services;

use App\Entities\Course;
use App\Repositories\CourseRepositoryInterface;

class CoursesService
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param int $itemsPerPage
     * @param int $page
     * @return array
     */
    public function paginate(int $itemsPerPage, int $page): array
    {
        return $this->courseRepository->paginate($itemsPerPage, $page);
    }

    /**
     * @param int $id
     * @return Course|null
     */
    public function findById(int $id): ?Course
    {
        return $this->courseRepository->findById($id);
    }
}
