<?php

namespace App\Repositories;

use App\Entities\Course;

interface CourseRepositoryInterface
{
    /**
     * @return Course[]
     */
    public function all(): array;

    /**
     * @param int $itemsPerPage
     * @param int $page
     * @return Course[]
     */
    public function paginate(int $itemsPerPage, int $page): array;

    /**
     * @param int $id
     * @return Course|null
     */
    public function findById(int $id): ?Course;
}
