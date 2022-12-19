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

    /**
     * @param T $entity
     * @return T
     */
    public function save($entity);

    /**
     * @param T $entity
     * @return void
     */
    public function delete($entity): void;

    /**
     * @param T $entity
     * @return void
     */
    public function softDelete($entity): void;

    /**
     * @return void
     */
    public function truncate(): void;
}
