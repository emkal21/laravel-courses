<?php

namespace App\Repositories;

/** @template T of object */
interface DoctrineRepositoryInterface
{
    /**
     * @return T[]
     */
    public function all(): array;

    /**
     * @param int $itemsPerPage
     * @param int $page
     * @return T[]
     */
    public function paginate(int $itemsPerPage, int $page): array;

    /**
     * @param int $id
     * @return T|null
     */
    public function findById(int $id);
}
